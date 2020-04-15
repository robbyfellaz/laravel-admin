<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use App\Recommended;
use App\Category;
use DataTables;
use Image;
use File;

class RecommendedController extends Controller
{
    public $path;

    public function __construct()
    {
        $this->path = storage_path('app/public/images/recommended');
    }

    public function index()
    {
        return view('recommended/recommended');
    }

    public function listRecommended(){
        $query = Recommended::query()
            ->select([
                'recommended.id',
                'recommended.title as recommendedtitle',
                'recommended.image',
                'recommended.url',
                'recommended.status',
                'recommended.created_at',
                'recommended.updated_at',
                'category.title as categorytitle'
            ])
            ->leftJoin('category', 'recommended.categoryId', '=', 'category.id');

        $data = DataTables::eloquent($query)
            ->addColumn('action', function ($recommended) {
                return '<a href="recommended/edit/'.$recommended->id.'" class="btn btn-sm btn-warning">Edit</a> <a href="recommended/delete/' . $recommended->id . '" class="btn btn-sm btn-danger">Delete</a>';
            })
            ->editColumn('status', function ($recommended) {
                if ($recommended->status === "Active") {
                    return '<span class="badge badge-success">Active</span>';
                } else {
                    return '<span class="badge badge-danger">Not Active</span>';
                }
            })
            ->editColumn('recommendedtitle', function ($recommended) {
                return '<a href="'.$recommended->url.'" target="_blank">'.$recommended->recommendedtitle.'</a>';
            })
            ->editColumn('image', function ($recommended) {
                $contentImage = Storage::url('images/recommended/'.$recommended->image);
                return '<div class="attachment-block clearfix"><img class="img-fluid pad" style="width: 150px; height: auto; object-fit: cover;" src="'.$contentImage.'"></div>';
            })
            ->rawColumns(['action', 'status', 'recommendedtitle', 'image'])
            ->make(true);

        return $data;
    }

    public function add()
    {
        $categoryCombo = Category::all();
        return view('recommended/recommendedAdd', ['categoryCombo' => $categoryCombo]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => ['required', 'string', 'max:255'],
            'url' => ['required', 'string', 'max:255'],
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:1024',
        ]);

        $nameImage = str_replace(' ', '-', strtolower($request->title));
        $files = $request->file('image');
        if ($files) {
            if (!File::isDirectory($this->path)) {
                File::makeDirectory($this->path,0777,true);
            }
            $fileName =  $nameImage.'-'.uniqid().'.'.$request->image->getClientOriginalExtension();
            Image::make($files)->save($this->path . '/' . $fileName);
        }

        if ($request->status === "on") {
            $status = "Active";
        } else {
            $status = "Not Active";
        }

        Recommended::create([
            'title' => $request->title,
            'image' => $fileName,
            'status' => $status,
            'url' => $request->url,
            'categoryId' => $request->categoryId
        ]);

        return redirect('/recommended');
    }

    public function edit($id)
    {
        $recommended = Recommended::find($id);
        $categoryCombo = Category::all();
        $contentImage = Storage::url('images/recommended/'.$recommended->image);
        return view('recommended/recommendedEdit', ['recommended' => $recommended, 'categoryCombo' => $categoryCombo, 'contentImage' => $contentImage]);
    }

    public function update($id, Request $request)
    {
        $this->validate($request, [
            'title' => ['required', 'string', 'max:255'],
            'url' => ['required', 'string', 'max:255'],
        ]);

        $nameImage = str_replace(' ', '-', strtolower($request->title));
        $files = $request->file('image');
        if ($files) {
            $this->validate($request, [
                'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:1024',
            ]);

            if (!File::isDirectory($this->path)) {
                File::makeDirectory($this->path,0777,true);
            }
            $fileName =  $nameImage.'-'.uniqid().'.'.$request->image->getClientOriginalExtension();
            Image::make($files)->save($this->path . '/' . $fileName);
        }

        if ($request->status === "on") {
            $status = "Active";
        } else {
            $status = "Not Active";
        }

        $recommended = Recommended::find($id);
        $recommended->title = $request->title;
        $recommended->status = $status;
        $recommended->url = $request->url;
        $recommended->categoryId = $request->categoryId;

        if ($files) {
            $recommended->image = $fileName;
        }

        $recommended->save();
        return redirect('/recommended');
    }

    public function delete($id)
    {
        $recommended = Recommended::find($id);
        $recommended->delete();
        return redirect('/recommended');
    }
}
