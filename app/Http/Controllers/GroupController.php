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

    public function listGroup()
    {
        return Datatables::of(Group::all())
            ->addColumn('action', function ($group) {
                return '<a href="group/edit/' . $group->id . '" class="btn btn-sm btn-warning">Edit</a> <a href="group/delete/' . $group->id . '" class="btn btn-sm btn-danger">Delete</a>';
            })
            ->editColumn('desc', function ($group) {
              if ($group->desc) {
                  return $group->desc;
              } else {
                  return '--';
              }
            })
            ->editColumn('status', function ($group) {
                if ($group->status === "Active") {
                    return '<span class="badge badge-success">Active</span>';
                } else {
                    return '<span class="badge badge-danger">Not Active</span>';
                }
            })
            ->rawColumns(['action', 'status'])
            ->make(true);
    }

    public function add()
    {
        return view('group/groupAdd');
    }

    public function store(Request $request)
    {
        $this->validate($request, ['name' => 'required', ]);

        if ($request->status === "on") {
            $status = "Active";
        } else {
            $status = "Not Active";
        }

        Group::create(['name' => $request->name, 'desc' => $request->desc, 'status' => $status, ]);

        return redirect('/group');
    }

    public function edit($id)
    {
        $group = Group::find($id);
        return view('group/groupEdit', ['group' => $group]);
    }

    public function update($id, Request $request)
    {
        $this->validate($request, ['name' => ['required', 'string', 'max:255']]);

        if ($request->status === "on") {
            $status = "Active";
        } else {
            $status = "Not Active";
        }

        $group = Group::find($id);
        $group->name = $request->name;
        $group->desc = $request->desc;
        $group->status = $status;
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
