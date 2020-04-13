<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\ContactUs;
use DataTables;

class ContactUsController extends Controller
{
    public function index()
    {
    	  return view('contactUs/contactUs');
    }

    public function listContactUs(){
		    return Datatables::of(ContactUs::all())->make(true);
    }
}
