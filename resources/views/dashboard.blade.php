@extends('layouts.parent')
@section('title','dashboard')

@section('content')


    
@foreach($posts as $post)
@if($post->is_pinned){
    <p>{{$post->is_pinned}}
}@endif
<article class="col-12 col-md-6 tm-post">
    <hr class="tm-hr-primary">
    <a href="" class="effect-lily tm-post-link tm-pt-60">
        <div class="tm-post-link-inner">
            <img src='img/posts/.{{$post->cover_image}}' alt="Image" class="img-fluid">                            
        </div>
        {{-- <span class="position-absolute tm-new-badge">New</span> --}}
        <h2 class="tm-pt-30 tm-color-primary tm-post-title">{{$post->title}}</h2>
    </a>                    
    <p class="tm-pt-30">
      {{$post->body}}  
    </p>
    <div class="d-flex justify-content-between tm-pt-45">
        <span class="tm-color-primary"></span>
        <span class="tm-color-primary"></span>
        <a href="{{ route('posts.edit', $post->id) }}" class ="btn btn-warning">Edit</a>
        <form action="{{ route('posts.destroy', $post->id) }}" method="POST" class="d-inline">
            @method('DELETE')
            @csrf
            <button class="btn btn-danger">Delete</button>
        </form>
        @if(Auth::user())
  <form action="{{ route('posts.pin', $post) }}" method="POST">
    @csrf
    <button class=" btn btn-danger" type="submit"><i class="fa-solid fa-map-pin"></i></button>
  </form>
@endif
    </div>
    <hr>
    @foreach ($tags as $tag )
        
   
    <div class="d-flex justify-content-between">
        <span>{{$tag->name}}</span>
        <div class="d-flex justify-content-between tm-pt-45">
            
            
            <a href="{{ route('tags.edit', $tag->id) }}" class ="btn btn-warning">Edit</a>
            <form action="{{ route('tags.destroy', $tag->id) }}" method="POST" class="d-inline">
                @method('DELETE')
                @csrf
                <button class="btn btn-danger">Delete</button>
            </form>
           
        </div>
    </div>
    @endforeach
</article>
@endforeach
@endsection