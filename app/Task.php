<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable=[
        'title','prior','user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class,'user_id','id');
    }
}
