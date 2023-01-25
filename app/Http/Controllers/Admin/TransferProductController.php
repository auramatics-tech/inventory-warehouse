<?php

namespace App\Http\Controllers\Admin;

use foo\bar;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Branch;
use App\Models\Invoice;
use App\Models\Product;
use App\Models\Shelve;
use App\Models\TransferProduct;
use App\Models\ProductQuantity;
use Auth;
use DB;

class TransferProductController extends Controller
{

    public function index(Request $request)
    {
        $branches = Branch::where('active', 1)->orderby('id', 'desc')->get();
        $products = Product::where('active', 1)->get();
        return view('admin.transfer_product.index', compact('branches', 'products'));
    }
    public function get_branches(Request $request)
    {
        $branch_id = ProductQuantity::where('product_id', $request->product_id)->where('qty', '>', 0)->pluck('branch')->toarray();
        $branches = Branch::whereIn('id', $branch_id)->get();
        return response($branches);
    }
    // public function get_shelves(Request $request)
    // {
    //     $shelves = Shelve::where('branch', $request->branch_id)->get();
    //     return response($shelves);
    // }

    public function store_transfer_products(Request $request)
    {
        echo "<pre>";print_r($request->all());die;
        $transfer_product = new TransferProduct();
        $transfer_product->product_id = $request->product_name;
        $transfer_product->from_branch =  $request->from_branch;
        $transfer_product->to_branch = $request->to_branch;
        // $transfer_product->shelve = $request->shelve;
        $transfer_product->quantity = $request->quantity;
        $transfer_product->save();
        $update_from_branch = ProductQuantity::where('product_id', $request->product_name)->where('branch', $request->from_branch)->first();
        $update_from_branch->qty = $update_from_branch->qty - $request->quantity;
        // echo "<pre>";print_r($update_from_branch);die;
        $update_from_branch->save();
        $update_to_branch = ProductQuantity::where('product_id', $request->product_name)->where('branch', $request->to_branch)->first();
        if (!empty($update_to_branch)) {
            $update_to_branch->qty = $update_to_branch->qty + $request->quantity;
            $update_to_branch->save();
        } else {
            $update_to_branch = new ProductQuantity();
            $update_to_branch->product_id = $request->product_name;
            $update_to_branch->branch =  $request->to_branch;
            $update_to_branch->qty =  $request->quantity;
            $update_to_branch->save();
        }
        return response('success');
    }

    public function get_quantity(Request $request)
    {

        $qty = ProductQuantity::where('product_id', $request->product_id)->where('branch', $request->branch_id)->pluck('qty')->toarray();
        return response($qty[0]);
    }


    public function transfer_product_history(Request $request)
    {
        $get_product_history = TransferProduct::select(
            'transfer_products.*',
            DB::raw("(select products.name from products where transfer_products.product_id = products.id ) as product_name"),
            DB::raw("(select branches.name from branches where transfer_products.from_branch = branches.id ) as from_branch_name"),
            DB::raw("(select branches.name from branches where transfer_products.to_branch = branches.id ) as to_branch_name"),
        )->when(isset($request->q), function ($query) use ($request) {
            $query->havingRaw("product_name LIKE '%" . $request->q . "%'");
        })->get();
        // echo"<pre>";print_r($get_product_history);die;
        return view('admin.transfer_product.history', compact('get_product_history'));
    }
}
