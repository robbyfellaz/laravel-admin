<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Group;
use DataTables;

class GroupController extends Controller
{
    public function index()
    {
    	return view('group/group');
    }

    public function listGroup(){
		return Datatables::of(Group::all())
		    ->addColumn('action', function ($group) {
			    return '<a href="group/edit/'.$group->id.'" class="btn btn-sm btn-warning">Edit</a> <a href="group/delete/'.$group->id.'" class="btn btn-sm btn-danger">Delete</a>';
		    })
		    ->make(true);
    }

    public function add()
    {
    	return view('group/groupAdd');
    }

    public function store(Request $request)
    {
        
    	$this->validate($request,[
    		'name' => 'required',
        ]);

        if ($request->status === "on") {
            $status = "1";
        } else {
            $status = "0";
        }

    	Group::create([
    		'name' => $request->name,
            'desc' => $request->desc,
            'status' => $status,
    	]);
  
    	return redirect('/group');
    }

    public function edit($id)
    {
		$group = Group::find($id);
		return view('group/groupEdit', ['group' => $group]);
    }

    public function update($id, Request $request)
    {
		$this->validate($request,[
			'name' => 'required',
		]);

		$group = Group::find($id);
		$group->name = $request->name;
        $group->desc = $request->desc;
        $group->status = $request->status;
		$group->save();
		return redirect('/group');
    }

    public function delete($id)
    {
		$group = Group::find($id);
		$group->delete();
		return redirect('/group');
    }
}
