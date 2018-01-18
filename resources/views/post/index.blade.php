@extends('layouts.master')

@section('header_title')
   <div class="blog-header">
        <div class="container">
          <h1 class="blog-title">The Bootstrap Blog</h1>
          <p class="lead blog-description">An example blog template built with Bootstrap.</p>
        </div>
    </div>

@endsection
 
@section('content')
<div class="col-sm-8 blog-main">
  @foreach($posts as $post)
      @include('post.post')
  @endforeach

  <nav class="blog-pagination">
    <a class="btn btn-outline-primary" href="#">Older</a>
    <a class="btn btn-outline-secondary disabled" href="#">Newer</a>
  </nav> 
</div>        
@endsection
