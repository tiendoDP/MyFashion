<?php

namespace App\Http\Controllers\Components;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProductModel;
use App\Models\CartModel;
use App\Models\WishlistModel;


class ProductController extends Controller
{
    public function index($id) {
        
        $data['product_detail'] = ProductModel::getProductById($id);
        $data['header_title'] = $data['product_detail'][0]['name'];
        if($data['product_detail'][0]['sex'] == null) $data['product_detail'][0]['sex'] = 2;
        $data['also_like'] = ProductModel::getProductByCategory($data['product_detail'][0]['category_id'], $data['product_detail'][0]['sex']);
        return view('client/components/product-detail', $data);
    }
}
