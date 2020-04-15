<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

use App\News;
use App\Category;
use App\Tag;
use App\User;
use DataTables;
use Image;
use File;

class NewsController extends Controller
{
    public $path;

    public function __construct()
    {
        $this->path = storage_path('app/public/images/news');
    }

    public function index()
    {
        //dd(Auth::user()->id);
        return view('news/news');
    }

    public function listNews(){
        $query = News::query()
            ->select([
                'news.id',
                'news.title as newstitle',
                'news.image',
                'news.url',
                'news.datePublish',
                'news.isHeadline',
                'news.isEditorPick',
                'news.status',
                'news.created_at',
                'news.updated_at',
                'category.title as categorytitle',
                'users.name as editorname'
            ])
            ->leftJoin('category', 'news.categoryId', '=', 'category.id')
            ->leftJoin('users', 'news.editorId', '=', 'users.id');

        $data = DataTables::eloquent($query)
            ->addColumn('action', function ($news) {
                return '<a href="news/edit/'.$news->id.'" class="btn btn-sm btn-warning">Edit</a> <a href="news/delete/' . $news->id . '" class="btn btn-sm btn-danger">Delete</a>';
            })
            ->editColumn('status', function ($news) {
                if ($news->status === "Active") {
                    return '<span class="badge badge-success">Active</span>';
                } else {
                    return '<span class="badge badge-danger">Not Active</span>';
                }
            })
            ->editColumn('newstitle', function ($news) {
                return '<a href="'.$news->url.'" target="_blank">'.$news->newstitle.'</a>';
            })
            ->editColumn('image', function ($news) {
                $contentImage = Storage::url('images/news/'.$news->image);
                return '<div class="attachment-block clearfix"><img class="img-fluid pad" style="width: 150px; height: auto; object-fit: cover;" src="'.$contentImage.'"></div>';
            })
            ->rawColumns(['action', 'status', 'newstitle', 'image'])
            ->make(true);

        return $data;
    }

    public function add()
    {
        $categoryCombo = Category::all();
        $tagCombo = Tag::all();
        $userCombo = User::all();
        return view('news/newsAdd', ['categoryCombo' => $categoryCombo, 'tagCombo' => $tagCombo, 'userCombo' => $userCombo]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => ['required', 'string', 'max:255'],
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:1024',
            'synopsis' => ['required', 'string', 'max:255'],
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

        $urlNews = str_replace(' ', '-', strtolower($request->title));
        News::create([
            'title' => $request->title,
            'synopsis' => $request->synopsis,
            'image' => $fileName,
            'imageInfo' => $request->imageInfo,
            'url' => $urlNews,
            'categoryId' => $request->categoryId,
            'tagId' => $request->tagId,
            'content' => $request->content,
            'datePublish' => $request->datePublish,
            'userId' => $request->userId,
            'reporterId' => $request->reporterId,
            'editorId' => $request->editorId,
            'photographerId' => $request->photographerId,
            'isHeadline' => $request->isHeadline,
            'isEditorPick' => $request->isEditorPick,
            'status' => $status,
        ]);

        return redirect('/news');
    }

    public function edit($id)
    {
        $news = News::find($id);
        $categoryCombo = Category::all();
        $tagCombo = Tag::all();
        $userCombo = User::all();
        $contentImage = Storage::url('images/news/'.$news->image);
        return view('news/newsEdit', ['news' => $news, 'categoryCombo' => $categoryCombo, 'contentImage' => $contentImage, 'tagCombo' => $tagCombo, 'userCombo' => $userCombo]);
    }

    public function update($id, Request $request)
    {
        $this->validate($request, [
            'title' => ['required', 'string', 'max:255'],
            'synopsis' => ['required', 'string', 'max:255'],
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

        $news = News::find($id);
        $news->title = $request->title;
        $news->categoryId = $request->categoryId;
        $news->status = $status;
        $news->synopsis = $request->synopsis;
        $news->imageInfo = $request->imageInfo;
        $news->tagId = $request->tagId;
        $news->content = $request->content;
        $news->datePublish = $request->datePublish;
        $news->userId = $request->userId;
        $news->reporterId = $request->reporterId;
        $news->editorId = $request->editorId;
        $news->photographerId = $request->photographerId;
        $news->isHeadline = $request->isHeadline;
        $news->isEditorPick = $request->isEditorPick;

        if ($files) {
            $news->image = $fileName;
        }

        $news->save();
        return redirect('/news');
    }

    public function delete($id)
    {
        $news = News::find($id);
        $news->delete();
        return redirect('/news');
    }
}
