<?php

namespace App\Http\Controllers\Admin;

use foo\bar;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Response;
use Hash;
use App\Models\Branch;
use App\Models\Shelve;
use Auth;
use Helper;

class ShelveController extends Controller
{

    public function index(Request $request)
    {
        $shelves = Shelve::when(isset($request->q), function ($query) use ($request) {
            $query->whereRaw("(name LIKE '%" . $request->q . "%')");
        })->orderby('id', 'desc')->paginate(10);
        return view('admin.shelve.index', compact('shelves'));
    }
    public function create_shelve(){
        $branches = Branch::where('active', 1)->orderby('id','desc')->get();
        return view('admin.shelve.create' , compact('branches'));
    }
    public function edit_shelve($id){
        $shelve = Shelve::Find($id);
        $branches = Branch::where('active', 1)->orderby('id','desc')->get();
        return view('admin.shelve.create',compact('shelve', 'branches'));
    }
    public function store_shelve(Request $request){
       $this->validate($request, [
            'name' => ['required'],
            'branch' => ['required'],
        ]);
        $old_shelve = Shelve::where(['name'=>$request->name,'branch'=>$request->branch])->first();
        if(!empty($old_shelve)){
            return back()->with('error','Shelve already exist in this branch');
        }
        if(isset($request->id)){
            $shelve = Shelve::Find($request->id);
        }else{
            $shelve = new Shelve();
        }
        $shelve->name = $request->name;
        $shelve->branch = $request->branch;
        $shelve->active = isset($request->active) ? 1 : 0;
        $shelve->save();
        return redirect()->route('admin.shelve')->with('success','Data updated successfully');
    }
    public function delete_shelve($id){
        $shelve = Shelve::Find($id);
        $shelve->delete();
        return back()->with('success','Data deleted successfully');
    }
}
