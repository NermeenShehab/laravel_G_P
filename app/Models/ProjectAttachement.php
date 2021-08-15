<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectAttachement extends Model
{
    use HasFactory;
    protected $fillable = [
        'attachement',
        'project_id'

    ];
    public function project(){
        return $this->belongsTo(Project::class);
    }
}
