<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    use HasFactory;

    protected $table = 'order_details'; 

    protected $fillable = [
        'product_id',
        'order_id',
        'quantity',
        'price',
    ];

    public static function getRecord($id) {
        $details =  self::select('orders.*', 
        'products.image as image', 'products.name as product_name',
        'order_details.quantity as quantity', 'order_details.price as price', 'order_details.product_id as product_id',
        'payments.payment_method as payment_method', 'payments.amount as amount', 'payments.status as payment_status') 
        ->join('orders', 'orders.id', '=', 'order_details.order_id')
        ->join('products', 'products.id', '=', 'order_details.product_id')
        ->join('payments', 'payments.order_id', '=', 'orders.id')
        ->where('order_details.order_id', '=', $id)
        ->get();
        return $details;
    }
}
