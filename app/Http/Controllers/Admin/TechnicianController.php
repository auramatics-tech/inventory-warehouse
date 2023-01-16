<?php

namespace App\Http\Controllers\Admin;

use foo\bar;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Response;
use Hash;
use App\Models\Technician;
use App\Models\Branch;
use Auth;
use Helper;
use DB;

class TechnicianController extends Controller
{

    public function index(Request $request)
    {
        $technicians = Technician::select('technicians.*',DB::raw("(select branches.name from `branches` where `branches`.`id` = technicians.branch and `technicians`.`branch` is not null order by `created_at` desc limit 1) as branch"))->when(isset($request->q), function ($query) use ($request) {
            $query->whereRaw("(name LIKE '%" . $request->q . "%')");
        })->orderby('id', 'desc')->paginate(10);
        return view('admin.technician.index', compact('technicians'));
    }
    public function create_technician(){
        $branches = Branch::orderby('id','desc')->get();
        return view('admin.technician.create', compact('branches'));
    }
    public function edit_technician($id){
        $technician = Technician::Find($id);
        $branches = Branch::orderby('id','desc')->get();
        return view('admin.technician.create',compact('technician','branches'));
    }
    public function store_technician(Request $request){
        $this->validate($request, [
            'name' => ['required'],
            'phone_no'  => ['required'],
            'branch'  => ['required']
        ]);
        if(isset($request->id)){
            $technician = Technician::Find($request->id);
        }else{
            $this->validate($request, [
                'name' => ['required', 'string', 'max:255','unique:technicians,name,id'],
                'phone_no'  => ['required'],
                'branch'  => ['required']
            ]);
            $technician = new Technician();
        }
        $technician->name = $request->name;
        $technician->branch = $request->branch;
        $technician->phone_no = $request->phone_no;
        $technician->address = $request->address;
        $technician->city = $request->city;
        $technician->state = $request->state;
        $technician->country = $request->country;
        $technician->zip_code = $request->zip_code;
        $technician->save();
        return redirect()->route('admin.technician')->with('success','Data updated successfully');
    }
    public function delete_technician($id){
        $technician = Technician::Find($id);
        $technician->delete();
        return back()->with('success','Data deleted successfully');
    }
}
