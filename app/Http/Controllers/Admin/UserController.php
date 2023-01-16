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

    public function index(Request $request)
    {
        $users = User::when(isset($request->q), function ($query) use ($request) {
            $query->whereRaw("(name LIKE '%" . $request->q . "%' or email LIKE '%" . $request->q . "%')");
        })->orderby('id', 'desc')->paginate(10);
        return view('admin.user.index', compact('users'));
    }
    public function create_user()
    {
        return view('admin.user.create');
    }
    public function edit_user($id)
    {
        $user = User::Find($id);
        return view('admin.user.create', compact('user'));
    }
    public function store_user(Request $request)
    {
        $this->validate($request, [
            'role' => ['required'],
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required'],
        ]);
        if (isset($request->id)) {
            $user = User::Find($request->id);
        } else {
            $this->validate($request, [
                'role' => ['required'],
                'name' => ['required', 'string', 'max:255'],
                'password' => ['required', 'string', 'min:4'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,id'],
            ]);
            $user = new User();
        }
        $user->name = $request->name;
        $user->email = $request->email;
        if(isset($request->password)){
            $user->password = Hash::make($request->password);
        }
        
        $user->role = $request->role;
        $user->phone_no = $request->phone_no;
        $user->address = $request->address;
        $user->city = $request->city;
        $user->state = $request->state;
        $user->country = $request->country;
        $user->zip_code = $request->zip_code;
        $user->save();
        return redirect()->route('admin.user')->with('success', 'Data updated successfully');
    }
    public function delete_user($id)
    {
        $user = User::Find($id);
        $user->delete();
        return back()->with('success', 'Data deleted successfully');
    }
}
