<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Tag;
use DataTables;

class TagController extends Controller
{

    public function index()
    {
    	return view('tag/tag');
    }

    public function listTag(){
		return Datatables::of(Tag::all())
		    ->addColumn('action', function ($tag) {
			    return '<a href="tag/edit/'.$tag->id.'" class="btn btn-sm btn-warning">Edit</a> <a href="tag/delete/'.$tag->id.'" class="btn btn-sm btn-danger">Delete</a>';
		    })
		    ->make(true);
    }

    public function add()
    {
    	return view('tag/tagAdd');
    }

    public function store(Request $request)
    {
    	$this->validate($request,[
    		'name' => 'required',
    		'url' => 'required'
    	]);

    	Tag::create([
    		'name' => $request->name,
    		'url' => $request->url
    	]);
  
    	return redirect('/tag');
    }

    public function edit($id)
    {
		$tag = Tag::find($id);
		return view('tag/tagEdit', ['tag' => $tag]);
    }

    public function update($id, Request $request)
    {
		$this->validate($request,[
			'name' => 'required',
			'url' => 'required'
		]);

		$tag = Tag::find($id);
		$tag->name = $request->name;
		$tag->url = $request->url;
		$tag->save();
		return redirect('/tag');
    }

    public function delete($id)
    {
		$tag = Tag::find($id);
		$tag->delete();
		return redirect('/tag');
    }

}
