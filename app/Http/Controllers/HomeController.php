<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductModel;
use App\Models\CartModel;
use App\Models\WishlistModel;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index() {
        $data['header_title'] = 'Trang chủ';
        $data['all_product'] = ProductModel::getRecord();
        $data['men_record'] = ProductModel::getProductBySex(0);
        $data['women_record'] = ProductModel::getProductBySex(1);
        //$data['all_wishlist'] = WishlistModel::getAll();
        return view('client/home', $data);
    }
}
