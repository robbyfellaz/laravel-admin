<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    protected $table = "news";

    protected $fillable = ['title', 'synopsis', 'content', 'image', 'imageinfo', 'url', 'categoryId', 'tagId', 'datePublish', 'userId', 'reporter', 'editor', 'photographer', 'isHeadline', 'isEditorPick','status'];
}
