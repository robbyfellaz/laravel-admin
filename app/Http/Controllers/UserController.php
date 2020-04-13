<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use DataTables;

class UserController extends Controller
{
    public function index()
    {
        return view('user/user');
    }

    public function listUser(){
        return Datatables::of(User::all())
          ->addColumn('action', function ($user) {
              return '<a href="tag/edit/'.$user->id.'" class="btn btn-sm btn-warning">Edit</a>';
          })
          ->make(true);
      }

    public function add()
    {
        return view('user/userAdd');
    }

    public function edit($id)
    {
		    $user = User::find($id);
		    return view('user/userEdit', ['user' => $user]);
    }
}
