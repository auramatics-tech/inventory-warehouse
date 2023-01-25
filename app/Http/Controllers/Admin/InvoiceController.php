<?php

namespace App\Http\Controllers\Admin;

use foo\bar;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Response;
use Hash;
use App\Models\Invoice;
use App\Models\Product;
use App\Models\Supplier;
use App\Models\Category;
use App\Models\Branch;
use App\Models\InvoiceProduct;
use App\Models\ProductQuantity;
use Auth;
use Helper;

class InvoiceController extends Controller
{

    public function index(Request $request)
    {
        $invoices = Invoice::when(isset($request->q), function ($query) use ($request) {
            $query->whereRaw("(supplier_invoice_number LIKE '%" . $request->q . "%')")
                ->orWhere('supplier_name', 'LIKE', '%' . $request->q . '%');
        })->orderby('id', 'desc')->paginate(10);
        return view('admin.invoice.index', compact('invoices'));
    }
    public function create_invoice()
    {
        $branches = Branch::where('active', 1)->orderby('id', 'desc')->get();
        $categories = Category::where('active', 1)->orderby('id', 'desc')->get();
        $suppliers = Supplier::orderby('id', 'desc')->get();
        $products = Product::where('active', 1)->orderby('id', 'desc')->get();
        return view('admin.invoice.create', compact('products', 'suppliers', 'categories', 'branches'));
    }
    public function edit_invoice($id)
    {
        $invoice = Invoice::Find($id);
        $invoice_product = InvoiceProduct::where('invoice_id', $id)->get();
        // echo"<pre>";print_r($invoice_product);die;
        $branches = Branch::where('active', 1)->orderby('id', 'desc')->get();
        $categories = Category::where('active', 1)->orderby('id', 'desc')->get();
        $suppliers = Supplier::orderby('id', 'desc')->get();
        $products = Product::orderby('id', 'desc')->get();
        // $data['product_id'] = json_decode($invoice['product_id'], true);
        // $data['product_code'] = json_decode($invoice['product_code'], true);
        // $data['product_name'] = json_decode($invoice['product_name'], true);
        // $data['qty'] = json_decode($invoice['qty'], true);
        // $data['price'] = json_decode($invoice['price'], true);
        // $data['total_price'] = json_decode($invoice['total_price'], true);
        // $data['branch'] = json_decode($invoice['branch'], true);
        // $data['master_qty'] = json_decode($invoice['master_qty'], true);
        return view('admin.invoice.create', compact('products', 'suppliers', 'categories', 'branches',  'invoice', 'invoice_product'));
    }
    public function store_invoice(Request $request)
    {
        // echo "<pre>";
        // print_r($request->all());
        // die;
        if (isset($request->id)) {
            $invoice = Invoice::Find($request->id);
        } else {

            $invoice = new Invoice();
        }
        $invoice->supplier_name = $request->supplier_name;
        $invoice->supplier_invoice_number = $request->supplier_invoice_number;
        $invoice->invoice_date = $request->invoice_date;
        $invoice->save();
        if (count($request->product_name)) {
            foreach ($request->product_name as $key => $product) {
                $transfer_product = new InvoiceProduct();
                $transfer_product->product_name = $product;
                $transfer_product->invoice_id = $invoice->id;
                $transfer_product->product_id = $request->p_id[$key];
                $transfer_product->product_code = $request->product_code[$key];
                $transfer_product->branch = $request->branch[$key];
                $transfer_product->master_qty = $request->master_qty[$key];
                $transfer_product->qty = $request->qty[$key];
                $transfer_product->price = $request->price[$key];
                $transfer_product->total_price = $request->total_price[$key];
                $transfer_product->save();
                $update_product_qty = ProductQuantity::where('product_id', $request->p_id[$key])->where('branch', $request->branch[$key])->first();
                if (!empty($update_product_qty)) {
                    $update_product_qty->qty = $update_product_qty->qty + $request->qty[$key];
                    $update_product_qty->save();
                } else {
                    $product_qty = new ProductQuantity();
                    $product_qty->product_id = $request->p_id[$key];
                    $product_qty->branch = $request->branch[$key];
                    $product_qty->qty = $request->qty[$key];
                    $product_qty->save();
                }
            }
        }

        // if(isset($request->id)){
        //     $invoice = Invoice::Find($request->id);
        // }else{
        //     $invoice = new Invoice();
        // }
        // $invoice->supplier_name = $request->supplier_name;
        // $invoice->supplier_invoice_number = $request->supplier_invoice_number;
        // $invoice->invoice_date = $request->invoice_date;
        // $invoice->product_id = json_encode($request->p_id);
        // $invoice->product_code = json_encode($request->product_code);
        // $invoice->product_name = json_encode($request->product_name);
        // $invoice->master_qty = json_encode($request->master_qty);
        // $invoice->branch = json_encode($request->branch);
        // $invoice->qty = json_encode($request->qty);
        // $invoice->price = json_encode($request->price);
        // $invoice->total_price = json_encode($request->total_price);
        // $invoice->save();
        return redirect()->route('admin.invoice')->with('success', 'data updated successfully');
    }
    public function delete_invoice($id)
    {
        $invoice = Invoice::Find($id);
        $invoice->delete();
        return back()->with('success', 'data deleted successfulyy');
    }
    public function update_invoice(Request $request)
    {

        if (isset($request->id)) {
            $invoice = Invoice::Find($request->id);
        }
        $invoice->supplier_name = $request->supplier_name;
        $invoice->supplier_invoice_number = $request->supplier_invoice_number;
        $invoice->invoice_date = $request->invoice_date;
        $invoice->product_id = json_encode($request->product_id);
        $invoice->qty = json_encode($request->qty);
        $invoice->price = json_encode($request->price);
        $invoice->total_price = json_encode($request->total_price);
        $invoice->save();
        return redirect()->route('admin.invoice')->with('success', 'data updated successfully');
    }
    public function invoice_detail(Request $request, $id)
    {
        $invoice = Invoice::Find($id);
        $invoice_product = InvoiceProduct::where('invoice_id', $id)->get();
        // $data['product_id'] = json_decode($invoice['product_id'], true);
        // $data['product_code'] = json_decode($invoice['product_code'], true);
        // $data['product_name'] = json_decode($invoice['product_name'], true);
        // $data['master_qty'] = json_decode($invoice['master_qty'], true);
        // $data['qty'] = json_decode($invoice['qty'], true);
        // $data['price'] = json_decode($invoice['price'], true);
        // $data['total_price'] = json_decode($invoice['total_price'], true);
        return view('admin.invoice.invoice_detail', compact('invoice', 'invoice_product'));
    }
    public function get_product_code(Request $request)
    {
        $products = Product::when(isset($request->keyword), function ($query) use ($request) {
            $query->where('products.product_code', 'LIKE', '%' . $request->keyword . '%');
        })->where('active', 1)->get();
        // echo"<pre>";print_r($products->all());die;
        return response($products);
    }
}
