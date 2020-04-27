<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

use App\News;
use App\Category;
use App\Tag;
use App\TagNews;
use App\User;
use DataTables;
use Image;
use File;
use Carbon\Carbon;

class NewsController extends Controller
{
    public $path;

    public function __construct()
    {
        $this->path = storage_path('app/public/images/news');
    }

    public function index()
    {
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
                'category.url as categoryurl',
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
                return '<a href="/'.$news->categoryurl.'/'.$news->url.'" target="_blank">'.$news->newstitle.'</a>';
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
        $dateNow = Carbon::now()->toDateTimeString();
        $categoryCombo = Category::all();
        $tagCombo = Tag::all();
        $userCombo = User::all();
        return view('news/newsAdd', ['categoryCombo' => $categoryCombo, 'tagCombo' => $tagCombo, 'userCombo' => $userCombo, 'dateNow' => $dateNow]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => ['required', 'string', 'max:255'],
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:1024',
            'synopsis' => ['required', 'string', 'max:255'],
            'datePublish' => 'required|date_format:Y-m-d H:i:s',
            'content' => ['required'],
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

        if ($request->isHeadline === "on") {
            $isHeadline = "Yes";
        } else {
            $isHeadline = "No";
        }

        if ($request->isEditorPick === "on") {
            $isEditorPick = "Yes";
        } else {
            $isEditorPick = "No";
        }

        $urlNews = str_replace(' ', '-', strtolower($request->title)).'-'.uniqid().'.html';
        $news = News::create([
            'title' => $request->title,
            'synopsis' => $request->synopsis,
            'image' => $fileName,
            'imageinfo' => $request->imageinfo,
            'url' => $urlNews,
            'categoryId' => $request->categoryId,
            'tagId' => json_encode($request->tagId),
            'content' => e($request->content),
            'datePublish' => $request->datePublish,
            'userId' => Auth::user()->id,
            'reporterId' => $request->reporterId,
            'editorId' => $request->editorId,
            'photographerId' => $request->photographerId,
            'isHeadline' => $isHeadline,
            'isEditorPick' => $isEditorPick,
            'status' => $status,
        ]);

        foreach ($request->tagId as $k => $v) {
            $tag = Tag::where('id', $v)->first();

            TagNews::create([
                'tagId' => $tag->id,
                'tagName' => $tag->name,
                'tagURL' => $tag->url,
                'newsId' => $news->id,
            ]);
        }

        return redirect('/news');
    }

    public function edit($id)
    {
        $news = News::find($id);
        $dateNow = Carbon::now()->toDateTimeString();
        $categoryCombo = Category::all();
        $tagCombo = Tag::all();
        $userCombo = User::all();
        $contentHtml = htmlspecialchars_decode($news->content);
        $contentImage = Storage::url('images/news/'.$news->image);
        return view('news/newsEdit', ['news' => $news, 'categoryCombo' => $categoryCombo, 'contentImage' => $contentImage, 'tagCombo' => $tagCombo, 'userCombo' => $userCombo, 'dateNow' => $dateNow, 'contentHtml' => $contentHtml]);
    }

    public function update($id, Request $request)
    {
        $this->validate($request, [
            'title' => ['required', 'string', 'max:255'],
            'synopsis' => ['required', 'string', 'max:255'],
            'datePublish' => 'required|date_format:Y-m-d H:i:s',
            'content' => ['required'],
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

        if ($request->isHeadline === "on") {
            $isHeadline = "Yes";
        } else {
            $isHeadline = "No";
        }

        if ($request->isEditorPick === "on") {
            $isEditorPick = "Yes";
        } else {
            $isEditorPick = "No";
        }

        $news = News::find($id);
        $news->title = $request->title;
        $news->categoryId = $request->categoryId;
        $news->status = $status;
        $news->synopsis = $request->synopsis;
        $news->imageinfo = $request->imageinfo;
        $news->tagId = json_encode($request->tagId);
        $news->content = e($request->content);
        $news->datePublish = $request->datePublish;
        $news->userId = Auth::user()->id;
        $news->reporterId = $request->reporterId;
        $news->editorId = $request->editorId;
        $news->photographerId = $request->photographerId;
        $news->isHeadline = $isHeadline;
        $news->isEditorPick = $isEditorPick;

        if ($files) {
            $news->image = $fileName;
        }

        $news->save();

        TagNews::where('newsId', $id)->delete();
        foreach ($request->tagId as $k => $v) {
            $tag = Tag::where('id', $v)->first();

            TagNews::create([
                'tagId' => $tag->id,
                'tagName' => $tag->name,
                'tagURL' => $tag->url,
                'newsId' => $id,
            ]);
        }

        return redirect('/news');
    }

    public function delete($id)
    {
        $news = News::find($id);
        $news->delete();
        return redirect('/news');
    }
}
