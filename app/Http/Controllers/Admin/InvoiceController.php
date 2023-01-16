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
use Auth;
use Helper;

class InvoiceController extends Controller
{

    public function index(Request $request)
    {
       $invoices = Invoice::when(isset($request->q), function ($query) use ($request) {
        $query->whereRaw("(supplier_invoice_number LIKE '%" . $request->q . "%')");
    })->orderby('id', 'desc')->paginate(10);
        return view('admin.invoice.index' ,compact('invoices'));
    }
    public function create_invoice(){
        $suppliers = Supplier::orderby('id','desc')->get();
        $products = Product::orderby('id','desc')->get();
        return view('admin.invoice.create' ,compact('products','suppliers'));
    }
    public function edit_invoice($id){
        $invoice = Invoice::Find($id);
        $products = Product::orderby('id','desc')->get();
        $invoice['product_id'] = json_decode($invoice['product_id'],true);
        $invoice['qty'] = json_decode($invoice['qty'],true);
        $invoice['price'] = json_decode($invoice['price'],true);
        $invoice['total_price'] = json_decode($invoice['total_price'],true);
        return view('admin.invoice.edit',compact('invoice','products'));
    }
    public function store_invoice(Request $request){
        
        if(isset($request->id)){
            $invoice = Invoice::Find($request->id);
        }else{
            $invoice = new Invoice();
        }
        $invoice->supplier_name = $request->supplier_name;
        $invoice->supplier_invoice_number = $request->supplier_invoice_number;
        $invoice->invoice_date = $request->invoice_date;
        $invoice->product_id = json_encode($request->product_id);
        $invoice->qty = json_encode($request->qty);
        $invoice->price = json_encode($request->price);
        $invoice->total_price = json_encode($request->total_price);
        $invoice->save();
        return redirect()->route('admin.invoice')->with('success','data updated successfully');
    }
    public function delete_invoice($id){
        $invoice = Invoice::Find($id);
        $invoice->delete();
        return back()->with('success','data deleted successfulyy');
    }
    public function update_invoice(Request $request){
        
        if(isset($request->id)){
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
        return redirect()->route('admin.invoice')->with('success','data updated successfully');
    }
    public function invoice_detail(Request $request ,$id){
        $invoice = Invoice::Find($id);
        $products = Product::orderby('id','desc')->get();
        $invoice['product_id'] = json_decode($invoice['product_id'],true);
        $invoice['qty'] = json_decode($invoice['qty'],true);
        $invoice['price'] = json_decode($invoice['price'],true);
        $invoice['total_price'] = json_decode($invoice['total_price'],true);
        return view('admin.invoice.invoice_detail',compact('invoice','products'));
    }
}
