<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RescheduleRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'work_id',
        'team_id',
        'suggested_start_time',
        'suggested_end_time',
        'suggested_work_date',
        'status',
        'note'
    ];

    // relation with work table
    public function work()
    {
        return $this->belongsTo(Work::class);
    }

    // relation with team table
    public function team()
    {
        return $this->belongsTo(Team::class, 'team_id');
    }
}
