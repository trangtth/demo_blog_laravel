<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;

class Blogs extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'content', 'image', 'author_id'
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    public function user()
    {
        return $this->belongsTo('App\User', 'author_id');
    }

    public function bloglikes()
    {
        return $this->hasMany('App\Bloglikes', 'blog_id');
    }

    public function comments()
    {
        return $this->hasMany('App\Comments', 'blog_id');
    }
}
