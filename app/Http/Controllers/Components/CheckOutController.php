<?php

namespace App\Http\Controllers\Components;

use App\Http\Controllers\Controller;
use App\Http\Requests\CheckoutRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\CartModel;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Payment;

class CheckOutController extends Controller
{

    public function index()
    {
        $data['header_title'] = 'Checkout';
        return view('client.components.checkout', $data);
    }

    public function checkout(CheckoutRequest $request, $payment_method, $payment_status)
    {
        $order = new Order();
        $order->user_id = Auth::user()->id;
        $order->full_name = $request->fullname;
        $order->email = $request->email;
        $order->phone = $request->phone;
        $order->country = $request->country;
        $order->province = $request->province;
        $order->street_address = $request->street_address;
        $order->notes = $request->notes;
        $order->save();

        $carts = CartModel::getRecord();
        if (!empty($carts)) {
            foreach ($carts as $cart) {
                $orderDetail = new OrderDetail();
                $orderDetail->product_id = $cart->product_id;
                $orderDetail->order_id = $order->id;
                $orderDetail->product_name = $cart->product_name;
                $orderDetail->quantity = $cart->quantity;
                $orderDetail->price = $cart->price;
                $orderDetail->save();
            }
        }

        $payment = new Payment();
        $payment->order_id = $order->id;
        $payment->payment_method = $payment_method;
        $payment->amount = $request->fntotal;
        $payment->status = $payment_status;
        $payment->save();

        CartModel::where('user_id', Auth::user()->id)->delete();
        session()->put('fntotal', 0);
        return $payment->id;
    }

    public function execPostRequest($url, $data)
    {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt(
            $ch,
            CURLOPT_HTTPHEADER,
            array(
                'Content-Type: application/json',
                'Content-Length: ' . strlen($data)
            )
        );
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
        //execute post
        $result = curl_exec($ch);
        //close connection
        curl_close($ch);
        return $result;
    }

    public function handleCheckout(CheckoutRequest $request)
    {
        if (isset($_POST['cod'])) {
            $this->checkout($request, 1, 0);
            return redirect()->route('home');
        } 
        else if(isset($_POST['payUrl'])) {
            $endpoint = "https://test-payment.momo.vn/v2/gateway/api/create";
            $partnerCode = 'MOMOBKUN20180529';
            $accessKey = 'klm05TvNBzhg7h7j';
            $secretKey = 'at67qH6mk8w5Y1nAyMoYKMWACiEi2bsa';

            $orderInfo = "Thanh toán qua MoMo";
            $amount = strval($request->fntotal * 23000);
            //dd($amount);
            $orderId = time() . "";
            $redirectUrl = "https://myfashion.do/paymentOnline";
            $ipnUrl = "https://myfashion.do/home";
            
            $extraData = "";
            $partnerCode = $partnerCode;
            $accessKey = $accessKey;
            $serectkey = $secretKey;
            $orderId = $orderId; // Mã đơn hàng
            $orderInfo = $orderInfo;
            $amount = $amount;
            $ipnUrl = $ipnUrl;
            $redirectUrl = $redirectUrl;
            $extraData = $this->checkout($request, 2, 0);

            $requestId = time() . "";
            $requestType = "payWithATM";
            //$extraData = ($_POST["extraData"] ? $_POST["extraData"] : "");
            //before sign HMAC SHA256 signature
            $rawHash = "accessKey=" . $accessKey . "&amount=" . $amount . "&extraData=" . $extraData . "&ipnUrl=" . $ipnUrl . "&orderId=" . $orderId . "&orderInfo=" . $orderInfo . "&partnerCode=" . $partnerCode . "&redirectUrl=" . $redirectUrl . "&requestId=" . $requestId . "&requestType=" . $requestType;
            $signature = hash_hmac("sha256", $rawHash, $serectkey);
            $data = array(
                'partnerCode' => $partnerCode,
                'partnerName' => "Test",
                "storeId" => "MomoTestStore",
                'requestId' => $requestId,
                'amount' => $amount,
                'orderId' => $orderId,
                'orderInfo' => $orderInfo,
                'redirectUrl' => $redirectUrl,
                'ipnUrl' => $ipnUrl,
                'lang' => 'vi',
                'extraData' => $extraData,
                'requestType' => $requestType,
                'signature' => $signature
            );
            
            $result = $this->execPostRequest($endpoint, json_encode($data));
            $jsonResult = json_decode($result, true); 
            //dd($result);
             return redirect()->to( $jsonResult['payUrl'])->send();
            
        }
        else {
            $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
            $vnp_Returnurl = "https://myfashion.do/paymentOnline";
            $vnp_TmnCode = "NQLK65B1";//Mã website tại VNPAY 
            $vnp_HashSecret = "BMXCLNOJRCLKIXZPWEPKYWVOCAOAWNZC"; //Chuỗi bí mật
            
            $vnp_TxnRef = time() . ""; //Mã đơn hàng. Trong thực tế Merchant cần insert đơn hàng vào DB và gửi mã này sang VNPAY
            $vnp_OrderInfo = 'Thanh toán VNPAY'; //
            $vnp_OrderType = 'billpayment';
            $vnp_Amount = $request->fntotal * 23000 * 100;
            $vnp_Locale = 'vn';
            $vnp_BankCode = 'NCB';
            $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];
            //Add Params of 2.0.1 Version
            //$vnp_ExpireDate = $_POST['txtexpire'];
            //Billing

            
            $inputData = array(
                "vnp_Version" => "2.1.0",
                "vnp_TmnCode" => $vnp_TmnCode,
                "vnp_Amount" => $vnp_Amount,
                "vnp_Command" => "pay",
                "vnp_CreateDate" => date('YmdHis'),
                "vnp_CurrCode" => "VND",
                "vnp_IpAddr" => $vnp_IpAddr,
                "vnp_Locale" => $vnp_Locale,
                "vnp_OrderInfo" => $vnp_OrderInfo,
                "vnp_OrderType" => $vnp_OrderType,
                "vnp_ReturnUrl" => $vnp_Returnurl,
                "vnp_TxnRef" => $vnp_TxnRef,
            );
            
            if (isset($vnp_BankCode) && $vnp_BankCode != "") {
                $inputData['vnp_BankCode'] = $vnp_BankCode;
            }
            if (isset($vnp_Bill_State) && $vnp_Bill_State != "") {
                $inputData['vnp_Bill_State'] = $vnp_Bill_State;
            }
            
            //var_dump($inputData);
            ksort($inputData);
            $query = "";
            $i = 0;
            $hashdata = "";
            foreach ($inputData as $key => $value) {
                if ($i == 1) {
                    $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
                } else {
                    $hashdata .= urlencode($key) . "=" . urlencode($value);
                    $i = 1;
                }
                $query .= urlencode($key) . "=" . urlencode($value) . '&';
            }
            
            $vnp_Url = $vnp_Url . "?" . $query;
            if (isset($vnp_HashSecret)) {
                $vnpSecureHash =   hash_hmac('sha512', $hashdata, $vnp_HashSecret);//  
                $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
            }
            //dd($vnp_Url);
            $returnData = array('code' => '00'
                , 'message' => 'success'
                , 'data' => $vnp_Url);
                if (isset($_POST['vnPay'])) {
                    $paymentId = $this->checkout($request, 1, 0);
                    $payment = Payment::find($paymentId);
                    $payment->status = 1;
                    $payment->amount =  $request->fntotal * 23000;
                    $payment->save();
                    header('Location: ' . $vnp_Url);
                    die();
                } else {
                    echo json_encode($returnData);
                }
        }
    }

    public function paymentOnline(Request $request) {
        if($request->message == 'Successful.'){
            $payment = Payment::find($request->extraData);
            $payment->status = 1;
            $payment->amount = $request->amount;
            $payment->save();
        }
        return redirect()->route('home')->with('success', 'Order success');
    }
}
