<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Auth;
class AdminController extends Controller
{

    public function index()
    {
        $admin =Auth:: user();
        return view('admin.edit_profile',compact('admin'));
    }

    public function change_password(Request $request)
    {
        $data = $request->except('_token');
        $check = Hash::check($data['current_password'], auth()->user()->password);
        if(!$check)
        {
            return redirect()->back()->with('error', 'Your current password is wrong.'); 
        }
        if($data['new_password'] != $data['confirm_password'])
        {
            return redirect()->back()->with('error', 'New password and confirm password does not match.');  
        }
        User::find(auth()->user()->id)->update(['password'=> Hash::make($request->new_password)]);
        return redirect()->back()->with('success', 'Password successfully changed.'); 
    }
    public function update_profile(Request $request)
    {
        $user = Auth::user();
        $user->name = $request->name;
        $user->phone_no = $request->phone_no;
        $user->address = $request->address;
        $user->city = $request->city;
        $user->state = $request->state;
        $user->country = $request->country;
        $user->zip_code = $request->zip_code;
        $user->save();
        return redirect()->back()->with('success', 'Data updated successfully.'); 
    }
}