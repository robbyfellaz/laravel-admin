<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Recommended extends Model
{
    protected $table = "recommended";

    protected $fillable = ['title', 'image', 'status', 'url', 'categoryId'];
}
