<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProductModel;
use App\Models\CategoryModel;

use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function list() {
        $data['header_title'] = 'Product';
        $data['getRecord'] = ProductModel::getRecord();
        //dd($data['getRecord']);
        return view('admin.product.list', $data);
    }

    public function add() {
        $data['header_title'] = 'Add new Product';
        $data['getRecord_Category'] = CategoryModel::getRecord();
        return view('admin.product.add', $data);
    }

    public function insert(Request $request) {

        $request->validate([
            'name' => 'required',
            'quantity' => 'required',
            'price' => 'required|decimal:0,2',
            'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg',
        ], [
            'required' => 'The :attribute field is required',
            'max' => ':attribute must not exceed max:2080',
        ]);

        $fileName = time().'.'.$request->image->getCLientOriginalExtension();
        $request->image->move(public_path('assets/images'), $fileName);

        $product = new ProductModel;
        $product->name = $request->name;
        $product->created_by = Auth::user()->id;
        $product->status = $request->status;
        $product->description = $request->description;
        $product->category_id = $request->category_id;
        $product->quantity = $request->quantity;
        $product->price = $request->price;
        $product->discount = $request->discount;
        $product->image = $fileName;

        $product->save();
        
        return redirect('admin/product/list')->with('success', "Product Successfully Created");
    }

    public function edit($id) {
        $data['header_title'] = 'Edit Product';
        $data['product'] = ProductModel::find($id);
        $data['getRecord_Category'] = CategoryModel::getRecord();
        return view('admin.product.edit', $data);
    }

    public function update($id, Request $request) {

        $request->validate([
            'name' => 'required',
            'quantity' => 'required',
            'price' => 'required',
            'image' => 'image|mimes:jpg,png,jpeg,gif,svg',
        ], [
            'required' => 'The :attribute field is required',
            'max' => ':attribute must not exceed max:2080',
        ]);

        $fileName = $request->old_image;

        if(!empty($request->image)) {
            $fileName = time().'.'.$request->image->getCLientOriginalExtension();
            $request->image->move(public_path('assets/images'), $fileName);
        }


        $product = ProductModel::find($id);
        $product->name = $request->name;
        $product->created_by = Auth::user()->id;
        $product->status = $request->status;
        $product->description = $request->description;
        $product->category_id = $request->category_id;
        $product->quantity = $request->quantity;
        $product->price = $request->price;
        $product->image = $fileName;

        $product->save();
        
        return redirect('admin/product/list')->with('success', "Product Successfully Updated");
    }
    public function delete($id, Request $request) {
        $category = ProductModel::find($id);       
        $category->delete();
        
        return redirect()->back()->with('success', "Product Successfully Deleted");
    }
}
