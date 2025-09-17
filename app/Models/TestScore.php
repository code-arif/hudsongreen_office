<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TestScore extends Model
{
    protected $fillable = [
        'student_id',
        'fitness_test_id',
        'tested_by',
        'data',
        'unit',
        'score',
        'test_date',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function fitnessTest()
    {
        return $this->belongsTo(FitnessTests::class);
    }
}
