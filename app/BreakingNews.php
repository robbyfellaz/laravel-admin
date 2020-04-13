<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BreakingNews extends Model
{
    protected $table = "breakingnews";

    protected $fillable = ['title','url', 'status'];
}
