<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Trendingtag;
use App\Tag;
use DataTables;

class TrendingTagController extends Controller
{
    public function index()
    {
        return view('trendingTag/trendingtag');
    }

    public function listTrendingTag(){
        $query = TrendingTag::query()
            ->select([
                'trendingtag.id',
                'trendingtag.title as trendingtagtitle',
                'trendingtag.custom_url',
                'trendingtag.order',
                'trendingtag.status',
                'trendingtag.created_at',
                'trendingtag.updated_at',
                'tag.name as tagname'
            ])
            ->leftJoin('tag', 'trendingtag.tagId', '=', 'tag.id');

        $data = DataTables::eloquent($query)
            ->addColumn('action', function ($trendingtag) {
                return '<a href="trendingtag/edit/'.$trendingtag->id.'" class="btn btn-sm btn-warning">Edit</a> <a href="trendingtag/delete/' . $trendingtag->id . '" class="btn btn-sm btn-danger">Delete</a>';
            })
            ->editColumn('custom_url', function ($trendingtag) {
                if ($trendingtag->custom_url) {
                    return $trendingtag->custom_url;
                } else {
                    return '--';
                }
            })
            ->editColumn('status', function ($trendingtag) {
                if ($trendingtag->status === "Active") {
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
        $tagCombo = Tag::all();
        return view('trendingTag/trendingtagAdd', ['tagCombo' => $tagCombo]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => ['required', 'string', 'max:255'],
            'order' => ['required', 'integer', 'max:100'],
        ]);

        if ($request->status === "on") {
            $status = "Active";
        } else {
            $status = "Not Active";
        }

        TrendingTag::create([
            'title' => $request->title,
            'tagId' => $request->tagId,
            'custom_url' => $request->custom_url,
            'status' => $status,
            'order' => $request->order
        ]);

        return redirect('/trendingtag');
    }

    public function edit($id)
    {
        $trendingtag = TrendingTag::find($id);
        $tagCombo = Tag::all();
        return view('trendingTag/trendingtagEdit', ['trendingtag' => $trendingtag, 'tagCombo' => $tagCombo]);
    }

    public function update($id, Request $request)
    {
        $this->validate($request, [
            'title' => ['required', 'string', 'max:255'],
            'order' => ['required', 'integer', 'max:10'],
        ]);

        if ($request->status === "on") {
            $status = "Active";
        } else {
            $status = "Not Active";
        }

        $trendingtag = TrendingTag::find($id);
        $trendingtag->title = $request->title;
        $trendingtag->tagId = $request->tagId;
        $trendingtag->custom_url = $request->custom_url;
        $trendingtag->status = $status;
        $trendingtag->order = $request->order;

        $trendingtag->save();
        return redirect('/trendingtag');
    }

    public function delete($id)
    {
        $trendingtag = TrendingTag::find($id);
        $trendingtag->delete();
        return redirect('/trendingtag');
    }
}
