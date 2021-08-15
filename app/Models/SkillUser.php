<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SkillUser extends Model
{
    protected $table = 'skill_user';
    use HasFactory;
    protected $fillable = [
        'skill_id',
        'user_id'

    ];

    public function skill(){
        return $this->belongsTo(Skill::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
