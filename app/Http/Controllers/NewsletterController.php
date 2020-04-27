<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Newsletter;
use DataTables;

class NewsletterController extends Controller
{
    public function index()
    {
    	return view('newsletter/newsletter');
    }

    public function listNewsletter(){
		return Datatables::of(Newsletter::all())->make(true);
    }
}
