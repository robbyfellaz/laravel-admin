<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TagNews extends Model
{
    protected $table = "tag_news";

    protected $fillable = ['tagId','tagName', 'tagURL', 'newsId'];
}
