<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\BreakingNews;
use DataTables;

class BreakingNewsController extends Controller
{
    public function index()
    {
    	return view('breakingNews/breakingnews');
    }

    public function listBreakingNews(){
		return Datatables::of(BreakingNews::all())
		    ->addColumn('action', function ($breakingnews) {
			    return '<a href="breakingnews/edit/'.$breakingnews->id.'" class="btn btn-sm btn-warning">Edit</a> <a href="breakingnews/delete/'.$breakingnews->id.'" class="btn btn-sm btn-danger">Delete</a>';
            })
            ->editColumn('status', function ($breakingnews) {
                if ($breakingnews->status === "Active") {
                    return '<span class="badge badge-success">Active</span>';
                } else {
                    return '<span class="badge badge-danger">Not Active</span>';
                }
            })
            ->editColumn('title', function ($breakingnews) {
                return '<a href="'.$breakingnews->url.'" target="_blank">'.$breakingnews->title.'</a>';
            })
            ->rawColumns(['action', 'status', 'title'])
		    ->make(true);
    }

    public function add()
    {
    	return view('breakingNews/breakingnewsAdd');
    }

    public function store(Request $request)
    {
    	$this->validate($request,[
            'title' => 'required',
            'url' => 'required'
        ]);

        if ($request->status === "on") {
            $status = "Active";
        } else {
            $status = "Not Active";
        }

    	BreakingNews::create([
    		'title' => $request->title,
			'url' => $request->url,
            'status' => $status,
    	]);
  
    	return redirect('/breakingnews');
    }

    public function edit($id)
    {
		$breakingnews = BreakingNews::find($id);
		return view('breakingNews/breakingnewsEdit', ['breakingnews' => $breakingnews]);
    }

    public function update($id, Request $request)
    {
		$this->validate($request,[
            'title' => 'required',
            'url' => 'required'
        ]);

        if ($request->status === "on") {
            $status = "Active";
        } else {
            $status = "Not Active";
        }

		$breakingnews = BreakingNews::find($id);
		$breakingnews->title = $request->title;
		$breakingnews->url = $request->url;
        $breakingnews->status = $status;
		$breakingnews->save();
		return redirect('/breakingnews');
    }

    public function delete($id)
    {
		$breakingnews = BreakingNews::find($id);
		$breakingnews->delete();
		return redirect('/breakingnews');
    }
}
