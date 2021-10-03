<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    use HasFactory;

    protected $fillable = ['name','total_votes','poll_id'];

    public function poll()
    {
        return $this->belongsTo(Poll::class, 'poll_id','id');
    }
}
