<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Work extends Model
{
    protected $guarded = [];


    protected $fillable = [
        'title',
        'description',
        'location',
        'latitude',
        'longitude',
        'start_time',
        'end_time',
        'work_date',
        'is_completed',
        'is_rescheduled',
        'note',
        'status',
        'team_id',
        'category_id',
        'unique_id'
    ];

    protected $casts = [
        'start_time' => 'datetime:H:i',
        'end_time' => 'datetime:H:i',
        'work_date' => 'date:Y-m-d',
        'is_completed' => 'boolean',
        'is_rescheduled' => 'boolean',
    ];

    // relation with team table
    public function team()
    {
        return $this->belongsTo(Team::class);
    }

    // relation with category table
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // relation with work_images table
    public function images()
    {
        return $this->hasMany(WorkImage::class, 'work_id');
    }
}
