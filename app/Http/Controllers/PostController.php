<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use Carbon\Carbon;

class PostController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    public function index() {
    	// $query = Post::latest();

     //    if($month = request('month')) {
     //       $query->whereMonth('created_at',Carbon::parse($month)->month);
     //    }

     //    if($year = request('year')) {
     //       $query->whereYear('created_at',$year);
     //    }

     //    $posts = $query->get();
//dd(request()->year);
        $posts = Post::latest()              
          ->filter(request(['month', 'year']))        
          ->get();
        

        // $archives = Post::selectRaw('year(created_at) year, monthname(created_at) month, count(*) published')
        // ->groupBy('year', 'month')
        // ->orderByRaw('min(created_at) desc') 
        // ->get()
        // ->toArray();

          //$archives = Post::archives();

    	return view('post.index', compact('posts'));
    }
    public function create() {
    	return view('post.create');
    }
    public function store() {
       // $post = new Post;
       // $post->title = request('title');
       // $post->body = request('body');
       // $post->save();
       // return view('post.index');

    	// Post::create([
     //       'title' => request('title'),
     //       'body' => request('body')
    	// ]);

        
    	$this->validate(request(), [
            'title' => 'required',
            'body' => 'required'
        ]);
        // Another way to do the above.
        // Post::create([
        //     'title' => request('title'),
        //     'body' => request('body'),
        //     'user_id' => auth()->id()
        // ]);


        auth()->user()->publish( new Post(request(['title','body'])));

    	return redirect ('/');
    }

    public function show($id)
    {
        $post = Post::find($id);

    	return view('post.show',compact('post'));
    }
}
