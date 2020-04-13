<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TrendingTag extends Model
{
    protected $table = "trendingtag";

    protected $fillable = ['title', 'tagId', 'custom_url', 'status', 'order'];
}
