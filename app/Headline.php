<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Headline extends Model
{
    protected $table = "headline";

    protected $fillable = ['title', 'image', 'url', 'categoryId', 'label', 'status', 'order'];
}
