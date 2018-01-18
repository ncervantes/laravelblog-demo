<?php

namespace App;

use Carbon\Carbon;

//use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    //protected $fillable = ['title', 'body'];
    //protected $guarded = [];
    public function comments() {
        return $this->hasMany(Comment::class);
    }
    // $post->user to get the associated user with a post.
    public function user() {
        return $this->belongsTo(User::class);
    }

    public function addComment($body) {
        // There's another way to do this, rather then manually specifying the post id. 
        // Comment::create([
        //     'body' => $body,
        //     'post_id' => $this->id
        // ]);
        // Behind the scene, this will also set the post_id for the comment because of the relationship we've created.
        $this->comments()->create(compact('body'));
    }
    public function scopeFilter($query, $filters)
    {
        //dd('ddddd');
        if($month = $filters['month']) {
           $query->whereMonth('created_at','=',Carbon::parse($month)->month);
        }

        if($year = $filters['year']) {
           $query->whereYear('created_at','=',$year);
        }
        //dd(Carbon::parse($month)->month);
//dd($query);
    }
    public static function archives() {
        return static::selectRaw('year(created_at) year, monthname(created_at) month, count(*) published')
         ->groupBy('year', 'month')
         ->orderByRaw('min(created_at) desc') 
         ->get()
         ->toArray();

    }
}
