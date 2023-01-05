<?php

namespace App\Http\Controllers\Admin;

use foo\bar;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Response;
use Hash;
use App\Models\User;
use Auth;
use Helper;

class UserController extends Controller
{

    public function index()
    {
        $users = User::where('role', 2)->orderby('id','desc')->get();
        return view('admin.user.index', compact('users'));
    }
    public function create_user(){
        return view('admin.user.create');
    }
    public function edit_user($id){
        $user = User::Find($id);
        return view('admin.user.create',compact('user'));
    }
    public function store_user(Request $request){
        if(isset($request->id)){
            $user = User::Find($request->id);
        }else{
            $user = new User();
        }
        $user->name = $request->name;
        $user->role = $request->role;
        $user->phone_no = $request->phone_no;
        $user->save();
        return redirect()->route('admin.user')->with('success','data updated successfully');
    }
    public function delete_user($id){
        $user = User::Find($id);
        $user->delete();
        return back()->with('success','data deleted successfulyy');
    }
}
