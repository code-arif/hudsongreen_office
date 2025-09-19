<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Work extends Model
{
    protected $guarded = [];

    // relation with team table
    public function team(){
        return $this->belongsTo(Team::class);
    }

    // relation with category table
    public function category(){
        return $this->belongsTo(Category::class);
    }
}
