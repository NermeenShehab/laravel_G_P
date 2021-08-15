<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SkillProject extends Model
{
    protected $table = 'skill_project';
    use HasFactory;
    protected $fillable = [
        'name',
        'project_id',
        'skill_id'

    ];

    public function skill(){
        return $this->belongsTo(Skill::class);
    }

    public function project(){
        return $this->belongsTo(Project::class);
    }
}
