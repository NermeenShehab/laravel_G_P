<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purposal extends Model
{
    use HasFactory;
    protected $fillable = [
        'cover_letter',
        'budget',
        'time',
        'owner_id',
        'developer_id',
        'project_id'

    ];
    public function client(){
        return $this->belongsTo(User::class , 'owner_id');
    }

    public function developer(){
        return $this->belongsTo(User::class , 'developer_id');
    }

    public function project(){
        return $this->belongsTo(Project::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
}
