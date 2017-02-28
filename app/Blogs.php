<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;

use Auth;

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

    public static function getBlogs()
    {
        $perpage = config('datatables.pagination.perpage');
        $blogs = Blogs::orderBy('created_at', 'desc')->paginate($perpage);

        foreach ($blogs as $blog) {
            $blogId = $blog->id;

            if (Auth::user()) {
                $userId = Auth::user()->id;
            }

            if (isset($blogId) && isset($userId)) {
                $blog->isLiked = Bloglikes::where('user_id', $userId)->where('blog_id', $blogId)->get()->count() > 0 ? true : false;
                $blog->numLiked = Bloglikes::where('user_id', $userId)->where('blog_id', $blogId)->get()->count();
            }
        }

        return $blogs;
    }
}
