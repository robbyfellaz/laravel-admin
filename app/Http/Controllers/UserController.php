<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use App\Group;
use DataTables;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        return view('user/user');
    }

    public function listUser(){
        $query = User::query()
            ->select([
                'users.id',
                'users.name as username',
                'users.email',
                'users.phone',
                'users.status',
                'users.created_at',
                'users.updated_at',
                'group.name as groupname'
            ])
            ->leftJoin('group', 'users.groupId', '=', 'group.id');

        $data = DataTables::eloquent($query)
            ->addColumn('action', function ($user) {
                return '<a href="user/edit/'.$user->id.'" class="btn btn-sm btn-warning">Edit</a> <a href="user/delete/' . $user->id . '" class="btn btn-sm btn-danger">Delete</a>';
            })
            ->editColumn('groupname', function ($user) {
                if ($user->groupname) {
                    return $user->groupname;
                } else {
                    return '--';
                }
            })
            ->editColumn('phone', function ($user) {
                if ($user->phone) {
                    return $user->phone;
                } else {
                    return '--';
                }
            })
            ->editColumn('status', function ($user) {
                if ($user->status === "Active") {
                    return '<span class="badge badge-success">Active</span>';
                } else {
                    return '<span class="badge badge-danger">Not Active</span>';
                }
            })
            ->rawColumns(['action', 'status'])
            ->make(true);

        return $data;
    }

    public function add()
    {
        $groupCombo = Group::all();
        return view('user/userAdd', ['groupCombo' => $groupCombo]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'phone' => ['required', 'string', 'max:255'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ]);

        if ($request->status === "on") {
            $status = "Active";
        } else {
            $status = "Not Active";
        }

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'groupId' => $request->groupId,
            'status' => $status,
            'password' => Hash::make($request->password)
        ]);

        return redirect('/user');
    }

    public function edit($id)
    {
        $user = User::find($id);
        $groupCombo = Group::all();
        return view('user/userEdit', ['user' => $user, 'groupCombo' => $groupCombo]);
    }

    public function update($id, Request $request)
    {
        $userById = User::find($id);
        if ($userById->email !== $request->email) {
            $this->validate($request, [
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users']
            ]);
        }

        if (!empty($request->password)) {
            $this->validate($request, [
                'password' => ['required', 'string', 'min:6', 'confirmed']
            ]);
        }

        $this->validate($request, [
            'name' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:255']
        ]);

        if ($request->status === "on") {
            $status = "Active";
        } else {
            $status = "Not Active";
        }

        $user = User::find($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->groupId = $request->groupId;
        $user->status = $status;

        if (!empty($request->password)) {
            $user->password = Hash::make($request->password);
        }

        $user->save();
        return redirect('/user');
    }

    public function delete($id)
    {
        $user = User::find($id);
        $user->delete();
        return redirect('/user');
    }
}
