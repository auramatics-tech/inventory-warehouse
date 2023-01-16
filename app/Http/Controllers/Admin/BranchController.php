<?php

namespace App\Http\Controllers\Admin;

use foo\bar;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Response;
use Hash;
use App\Models\Branch;
use Auth;
use Helper;

class BranchController extends Controller
{

    public function index(Request $request)
    {
        $branches = Branch::when(isset($request->q), function ($query) use ($request) {
            $query->whereRaw("(name LIKE '%" . $request->q . "%')");
        })->orderby('id', 'desc')->paginate(10);
        return view('admin.branch.index', compact('branches'));
    }
    public function create_branch()
    {
        return view('admin.branch.create');
    }
    public function edit_branch($id)
    {
        $branch = Branch::Find($id);
        return view('admin.branch.create', compact('branch'));
    }
    public function store_branch(Request $request)
    {
        $this->validate($request, [
            'name' => ['required', 'string', 'max:255','unique:branches,name,id'],
        ]);
        if (isset($request->id)) {
            $branch = Branch::Find($request->id);
        } else {
            $branch = new Branch();
        }
        $branch->name = $request->name;
        // $branch->active = isset($request->active) ? 1 : 0;
        $branch->save();
        return redirect()->route('admin.branch')->with('success', 'Data updated successfully');
    }
    public function delete_branch($id)
    {
        $branch = Branch::Find($id);
        $branch->delete();
        return back()->with('success', 'Data deleted successfully');
    }
}
