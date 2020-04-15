<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

use App\Headline;
use App\Category;
use DataTables;
use Image;
use File;

class HeadlineController extends Controller
{
    public $path;

    public function __construct()
    {
        $this->path = storage_path('app/public/images/headline');
    }

    public function index()
    {
        return view('headline/headline');
    }

    public function listHeadline(){
        $query = Headline::query()
            ->select([
                'headline.id',
                'headline.title as headlinetitle',
                'headline.image',
                'headline.url',
                'headline.label',
                'headline.order',
                'headline.status',
                'headline.created_at',
                'headline.updated_at',
                'category.title as categorytitle'
            ])
            ->leftJoin('category', 'headline.categoryId', '=', 'category.id');

        $data = DataTables::eloquent($query)
            ->addColumn('action', function ($headline) {
                return '<a href="headline/edit/'.$headline->id.'" class="btn btn-sm btn-warning">Edit</a> <a href="headline/delete/' . $headline->id . '" class="btn btn-sm btn-danger">Delete</a>';
            })
            ->editColumn('label', function ($headline) {
                if ($headline->label) {
                    return $headline->label;
                } else {
                    return '--';
                }
            })
            ->editColumn('status', function ($headline) {
                if ($headline->status === "Active") {
                    return '<span class="badge badge-success">Active</span>';
                } else {
                    return '<span class="badge badge-danger">Not Active</span>';
                }
            })
            ->editColumn('headlinetitle', function ($headline) {
                return '<a href="'.$headline->url.'" target="_blank">'.$headline->headlinetitle.'</a>';
            })
            ->editColumn('image', function ($headline) {
                $contentImage = Storage::url('images/headline/'.$headline->image);
                return '<div class="attachment-block clearfix"><img class="img-fluid pad" style="width: 150px; height: auto; object-fit: cover;" src="'.$contentImage.'"></div>';
            })
            ->rawColumns(['action', 'status', 'headlinetitle', 'image', 'label'])
            ->make(true);

        return $data;
    }

    public function add()
    {
        $categoryCombo = Category::all();
        return view('headline/headlineAdd', ['categoryCombo' => $categoryCombo]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => ['required', 'string', 'max:255'],
            'url' => ['required', 'string', 'max:255'],
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:1024',
            'order' => ['required', 'integer', 'max:100'],
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

        Headline::create([
            'title' => $request->title,
            'image' => $fileName,
            'url' => $request->url,
            'categoryId' => $request->categoryId,
            'status' => $status,
            'label' => $request->label,
            'order' => $request->order,
        ]);

        return redirect('/headline');
    }

    public function edit($id)
    {
        $headline = Headline::find($id);
        $categoryCombo = Category::all();
        $contentImage = Storage::url('images/headline/'.$headline->image);
        return view('headline/headlineEdit', ['headline' => $headline, 'categoryCombo' => $categoryCombo, 'contentImage' => $contentImage]);
    }

    public function update($id, Request $request)
    {
        $this->validate($request, [
            'title' => ['required', 'string', 'max:255'],
            'url' => ['required', 'string', 'max:255'],
            'order' => ['required', 'integer', 'max:100'],
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

        $headline = Headline::find($id);
        $headline->title = $request->title;
        $headline->url = $request->url;
        $headline->categoryId = $request->categoryId;
        $headline->status = $status;
        $headline->label = $request->label;
        $headline->order = $request->order;

        if ($files) {
            $headline->image = $fileName;
        }

        $headline->save();
        return redirect('/headline');
    }

    public function delete($id)
    {
        $headline = Headline::find($id);
        $headline->delete();
        return redirect('/headline');
    }
}
