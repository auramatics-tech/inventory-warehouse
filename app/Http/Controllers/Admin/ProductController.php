<?php

namespace App\Http\Controllers\Admin;

use foo\bar;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Response;
use Hash;
use App\Models\Category;
use App\Models\Product;
use Auth;
use Helper;

class ProductController extends Controller
{

    public function index()
    {
        $products = Product::where('active', 1)->orderby('id','desc')->get();
        return view('admin.product.index', compact('products'));
    }
    public function create_product(){
        $categories = Category::where('active', 1)->orderby('id','desc')->get();
        return view('admin.product.create' , compact('categories'));
    }
    public function edit_product($id){
        $product = Product::Find($id);
        $categories = Category::where('active', 1)->orderby('id','desc')->get();
        return view('admin.product.create',compact('product', 'categories'));
    }
    public function store_product(Request $request){
        if(isset($request->id)){
            $product = Product::Find($request->id);
        }else{
            $product = new Product();
        }
        $product->name = $request->name;
        $product->category = $request->category;
        $product->active = isset($request->active) ? 1 : 0;
        $product->save();
        return redirect()->route('admin.product')->with('success','data updated successfully');
    }
    public function delete_product($id){
        $product = Product::Find($id);
        $product->delete();
        return back()->with('success','data deleted successfulyy');
    }
}
