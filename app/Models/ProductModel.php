<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use PhpOffice\PhpSpreadsheet\Calculation\LookupRef\Offset;

class ProductModel extends Model
{
    use HasFactory;

    protected $table = 'products';
    protected $filable = [
        'name',
        'description',
        'image',
        'category_id',
        'sex',
        'quantity',
        'price',
        'discount',
        'status',
    ];

    static public function getRecord() {
        return self::select('products.*', 'categories.name as category_name')
        ->join('categories', 'products.category_id', '=', 'categories.id')
        ->get();
    }
    static public function getProductById($id) {
        return self::select('products.*', 'categories.name as category_name')
        ->join('categories', 'products.category_id', '=', 'categories.id')
        ->where('products.id', $id)
        ->get();
    }

    static public function getProductByCategory($category, $sex) {
        return self::select('products.*', 'categories.name as category_name')
        ->join('categories', 'products.category_id', '=', 'categories.id')
        ->where('products.category_id', $category)
        ->where('products.sex', $sex)
        ->limit(10)
        ->offset(0)
        ->get();
    }

    static public function getProductBySex($sex) {
        return self::select('products.*', 'categories.name as category_name')
        ->join('categories', 'products.category_id', '=', 'categories.id')
        ->where('products.sex', $sex)
        ->limit(10)
        ->offset(0)
        ->get();
    }

    static public function getProductByName($keyword = null) {
        if($keyword != null) return self::select('products.*', 'categories.name as category_name')
        ->join('categories', 'products.category_id', '=', 'categories.id')
        ->where('products.name', 'like', '%' . $keyword . '%')
        ->paginate(6);
        else return self::select('products.*', 'categories.name as category_name')
        ->join('categories', 'products.category_id', '=', 'categories.id')
        ->paginate(6);
    }
}
