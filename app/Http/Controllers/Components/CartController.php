<?php

namespace App\Http\Controllers\Components;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProductModel;
use App\Models\CartModel;
use App\Models\WishlistModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{

    public function add(Request $request) {
        $id = $request->id;
        if($id!=null) {

            $cart = CartModel::getCartByProductId($id);
 
            $product = ProductModel::find($id);
            if(!$cart) {      
                $cartNew = new CartModel;
                $cartNew->product_id = $product->id;                  
                ($request->quantity == null) ? $cartNew->quantity = 1 : $cartNew->quantity = $request->quantity;
                if($product->discount == null) $cartNew->money = (int) $cartNew->quantity * (int) $product->price;
                else $cartNew->money = (int) $product->price - ((int) $cartNew->quantity * (int) $product->price * (int) $product->discount / 100);
                $cartNew->user_id = Auth::user()->id;
                $cartNew->save();
                return redirect()->back()->with('success', 'Cart added successfully');
            }
            else {       
                ($request->quantity == null) ? $data['quantity'] = $cart[0]->quantity + 1 : $data['quantity'] = $cart[0]->quantity + $request->quantity;
                $data['money'] = (int) $product->price * (int) $data['quantity'] - (int) $data['quantity'] * (int) $product->price * (int) $product->discount / 100;
                DB::table('carts')->where('product_id', $id)->where('user_id', Auth::user()->id)->update($data);
                return redirect()->back()->with('success', 'Cart added successfully');
            }
        }
    }

    public function view_cart() {
        $data['header_title'] = 'View Cart';
        $data['total'] = CartModel::total();
        session()->put('fntotal', $data['total']);
        session()->put('type_shipping', 'Free Shipping');      
        return view('client/components/cart', $data);
    }

    public function delete($id) {
        $cart = CartModel::find($id);
        $cart->delete();
        return redirect()->back()->with('success', "Product Successfully Deleted");
    }

}
