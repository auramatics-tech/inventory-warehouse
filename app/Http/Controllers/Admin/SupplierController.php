<?php

namespace App\Http\Controllers\Admin;

use foo\bar;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Response;
use Hash;
use App\Models\Supplier;
use Auth;
use Helper;

class SupplierController extends Controller
{

    public function index(Request $request)
    {
        $suppliers = Supplier::when(isset($request->q), function ($query) use ($request) {
            $query->whereRaw("(name LIKE '%" . $request->q . "%')");
        })->orderby('id', 'desc')->paginate(10);
        return view('admin.supplier.index', compact('suppliers'));
    }
    public function create_supplier(){
        return view('admin.supplier.create');
    }
    public function edit_supplier($id){
        $supplier = Supplier::Find($id);
        return view('admin.supplier.create',compact('supplier'));
    }
    public function store_supplier(Request $request){
       
       $this->validate($request, [
                'name' => ['required', 'string', 'max:255','unique:suppliers,name,id'],
        ]);
        if(isset($request->id)){
            $supplier = Supplier::Find($request->id);
        }else{
            $supplier = new Supplier();
        }
        $supplier->name = $request->name;
        $supplier->save();
        return redirect()->route('admin.supplier')->with('success','Data updated successfully');
    }
    public function delete_supplier($id){
        $supplier = Supplier::Find($id);
        $supplier->delete();
        return back()->with('success','Data deleted successfully');
    }
}
