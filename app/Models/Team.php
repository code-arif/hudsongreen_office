<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    protected $fillable = ['name', 'unique_id', 'description'];

    public function users()
    {
        return $this->belongsToMany(User::class, 'team_users', 'team_id', 'user_id');
    }

    public function teamUser()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * A team has many works
     */
    public function works()
    {
        return $this->hasMany(Work::class, 'team_id');
    }
}
