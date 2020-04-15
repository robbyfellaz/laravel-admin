<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Category;
use DataTables;

class CategoryController extends Controller
{
    public function index()
    {
    	return view('category/category');
    }

    public function listCategory(){
		return Datatables::of(Category::all())
		    ->addColumn('action', function ($category) {
			    return '<a href="category/edit/'.$category->id.'" class="btn btn-sm btn-warning">Edit</a> <a href="category/delete/'.$category->id.'" class="btn btn-sm btn-danger">Delete</a>';
			})
			->editColumn('desc', function ($category) {
                if ($category->desc) {
                    return $category->desc;
                } else {
                    return '--';
                }
            })
            ->editColumn('status', function ($category) {
                if ($category->status === "Active") {
                    return '<span class="badge badge-success">Active</span>';
                } else {
                    return '<span class="badge badge-danger">Not Active</span>';
                }
            })
            ->editColumn('title', function ($category) {
                return '<a href="category/'.$category->url.'" target="_blank">'.$category->title.'</a>';
			})
            ->rawColumns(['action', 'status', 'title'])
		    ->make(true);
    }

    public function add()
    {
    	return view('category/categoryAdd');
    }

    public function store(Request $request)
    {
    	$this->validate($request,[
    		'title' => 'required',
        ]);
        
        if ($request->status === "on") {
            $status = "Active";
        } else {
            $status = "Not Active";
        }

    	Category::create([
    		'title' => $request->title,
			'url' => str_replace(' ', '-', strtolower($request->title)),
            'desc' => $request->desc,
            'status' => $status,
    	]);
  
    	return redirect('/category');
    }

    public function edit($id)
    {
		$category = Category::find($id);
		return view('category/categoryEdit', ['category' => $category]);
    }

    public function update($id, Request $request)
    {
		$this->validate($request,[
			'title' => 'required',
        ]);
        
        if ($request->status === "on") {
            $status = "Active";
        } else {
            $status = "Not Active";
        }

		$category = Category::find($id);
		$category->title = $request->title;
		$category->url = str_replace(' ', '-', strtolower($request->title));
        $category->desc = $request->desc;
        $category->status = $status;
		$category->save();
		return redirect('/category');
    }

    public function delete($id)
    {
		$category = Category::find($id);
		$category->delete();
		return redirect('/category');
    }
}
