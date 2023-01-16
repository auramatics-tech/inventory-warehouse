<?php

namespace App\Http\Controllers\Admin;

use foo\bar;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Response;
use Hash;
use App\Models\Category;
use Auth;
use Helper;

class CategoryController extends Controller
{

    public function index(Request $request)
    {
        $categories = Category::when(isset($request->q), function ($query) use ($request) {
            $query->whereRaw("(name LIKE '%" . $request->q . "%')");
        })->orderby('id', 'desc')->paginate(10);
        return view('admin.category.index', compact('categories'));
    }
    public function create_category(){
        return view('admin.category.create');
    }
    public function edit_category($id){
        $category = Category::Find($id);
        return view('admin.category.create',compact('category'));
    }
    public function store_category(Request $request){
        $this->validate($request, [
            'name' => ['required', 'string', 'max:255','unique:categories,name,id'],
        ]);
        if(isset($request->id)){
            $category = Category::Find($request->id);
        }else{
            $category = new Category();
        }
        $category->name = $request->name;
        $category->active = isset($request->active) ? 1 : 0;
        $category->save();
        return redirect()->route('admin.category')->with('success','Data updated successfully');
    }
    public function delete_category($id){
        $category = Category::Find($id);
        $category->delete();
        return back()->with('success','Data deleted successfully');
    }
}
