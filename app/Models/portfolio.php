<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class portfolio extends Model
{
    use HasFactory;
    protected $fillable = ['name','description','link','user_id','skills','images'];

    protected $casts = [
        'skills'=> 'array',
        'images'=> 'array'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }


}
