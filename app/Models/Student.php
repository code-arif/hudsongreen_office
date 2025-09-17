<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'school_id',
        'name',
        'gender',
        'date_of_birth',
        'class',
        'section',
        'created_by',
        'class_roll'
    ];

    //date mutator for date_of_birth
    protected $casts = [
        'date_of_birth' => 'datetime',
    ];

    // Relationship to School
    public function school()
    {
        return $this->belongsTo(School::class);
    }

    // Relationship to User (creator)
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    // Relation with ality test table
    public function testScores()
    {
        return $this->hasMany(TestScore::class);
    }
}
