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
			->editColumn('desc', function ($tag) {
                if ($tag->desc) {
                    return $tag->desc;
                } else {
                    return '--';
                }
			})
			->editColumn('name', function ($tag) {
                return '<a href="tag/'.$tag->url.'" target="_blank">'.$tag->name.'</a>';
			})
			->rawColumns(['action', 'desc', 'name'])
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
		]);

    	Tag::create([
    		'name' => $request->name,
			'url' => str_replace(' ', '-', strtolower($request->name)),
			'desc' => $request->desc
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
		]);

		$tag = Tag::find($id);
		$tag->name = $request->name;
		$tag->url = str_replace(' ', '-', strtolower($request->name));
		$tag->desc = $request->desc;
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
