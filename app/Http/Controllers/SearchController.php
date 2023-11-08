<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductModel;
use Stripe\Product;

class SearchController extends Controller
{
    public function index(Request $request) {
        $keyword = $request->search;
        session()->flash('keyword', $request->search);
        $data['header_title'] = 'Trang chủ';
        $data['results'] = ProductModel::getProductByName($keyword);
        return view('client/components/list-products', $data);
    }

}
