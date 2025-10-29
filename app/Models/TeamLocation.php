<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

// app/Models/TeamLocation.php
class TeamLocation extends Model
{
    protected $fillable = [
        'team_id',
        'user_id',
        'latitude',
        'longitude',
        'accuracy',
        'status',
        'tracked_at'
    ];

    protected $casts = [
        'tracked_at' => 'datetime',
        'latitude' => 'decimal:7',
        'longitude' => 'decimal:7',
    ];

    public function team()
    {
        return $this->belongsTo(Team::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
