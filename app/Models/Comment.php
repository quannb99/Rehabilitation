<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $guarded = ['id'];
    public function post()
    {
        return $this->belongsTo('App\Models\Post');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    public function isAuthUserLikedComment()
    {
        return $this->likes()->where('user_id',  auth()->id())->get('id')->first();
    }
}
