<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Poll extends Model
{
    use HasFactory;

    protected $fillable = ['title','slug','user_id'];

    public function answers()
    {
        return $this->hasMany(Answer::class,'poll_id','id');
    }

    public function pollOwner()
    {
        return $this->belongsTo(User::class,'user_id','id');
    }
}
