<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class FitnessTests extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'scoring_type'
    ];

    protected $casts = [
        'scoring_type' => 'string'
    ];

    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    public function testScores()
    {
        return $this->hasMany(TestScore::class);
    }
}
