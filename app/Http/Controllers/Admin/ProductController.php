<?php

namespace App\Http\Controllers\Admin;

use foo\bar;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Response;
use Hash;
use App\Models\Category;
use App\Models\Supplier;
use App\Models\Product;
use Auth;
use Helper;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $products = Product::when(isset($request->q), function ($query) use ($request) {
            $query->whereRaw("(name LIKE '%" . $request->q . "%')");
        })->orderby('id', 'desc')->paginate(10);
        return view('admin.product.index', compact('products'));
    }
    public function create_product(){
        $categories = Category::where('active', 1)->orderby('id','desc')->get();
        $suppliers = Supplier::orderby('id','desc')->get();
        return view('admin.product.create' , compact('categories','suppliers'));
    }
    public function edit_product($id){
        $product = Product::Find($id);
        $categories = Category::where('active', 1)->orderby('id','desc')->get();
        $suppliers = Supplier::orderby('id','desc')->get();
        return view('admin.product.create',compact('product', 'categories','suppliers'));
    }
    public function store_product(Request $request){
        $this->validate($request, [
            'name' => ['required'],
            'category' => ['required'],
            'product_code' => ['required'],
        ]);
        if(isset($request->id)){
            $product = Product::Find($request->id);
        }else{
            $this->validate($request, [
                'name' => ['required', 'string', 'max:255','unique:products,name,id'],
                'category' => ['required'],
                'product_code' => ['required'],
            ]);
            $product = new Product();
        }
        $product->name = $request->name;
        $product->category = $request->category;
        $product->product_code = $request->product_code;	
        $product->product_color = $request->product_color;	
        $product->supplier_id = $request->supplier_id;	
        $product->manufacturer = $request->manufacturer;	
        $product->active = isset($request->active) ? 1 : 0;
        $product->save();
        return redirect()->route('admin.product')->with('success','Data updated successfully');
    }
    public function delete_product($id){
        $product = Product::Find($id);
        $product->delete();
        return back()->with('success','Data deleted successfully');
    }
}
