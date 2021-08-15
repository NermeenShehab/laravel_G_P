<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;
    protected $fillable = [
        'rater_id',
        'ratee_id',
        'rate',
        'review',
        'project_id'

    ];

    public function rater()
    {
        return $this->belongsTo(User::class);
    }
    public function ratee()
    {
        return $this->belongsTo(User::class , 'ratee_id');
    }
    public function project()
    {
        return $this->belongsTo(project::class , 'project_id');
    }
}
