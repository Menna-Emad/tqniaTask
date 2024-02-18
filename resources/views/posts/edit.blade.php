@extends('layouts.parent')

@section('title', 'edit post')
{{-- method =post
    action= 127.0.0.1.8000/dashboard/post/store
    store post:1)validate 2)upload image 3)insert 4)direct to page --}}

@section('content')
    <div class="col-12">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>
    {{-- @include('admin.includes.message') --}}
    <form action="{{url('posts.update',$post->id)}}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-row">
            <div class="col-6">
                <label for="title">Title</label>
                <input type="text" name="title" id="title" class="form-control" placeholder=""
                    aria-describedby="" value="{{ $post->title }}">
            </div>



        </div>
        {{-- <div class="form-row">

            <div class="col-4">
                <label for="pinned">pinned</label>
                <select name="pinned" id="pinned" class="form-control">
                    <option {{ old('pinned') == 1 ? 'selected' : '' }} value="1">true</option>
                    <option {{ old('pinned') == 0 ? 'selected' : '' }}value="0">false</option>
                </select>
            </div>
          


        </div> --}}
        <div class="form-row">
            <div class="col-6">
                <label for="body">body</label>
                <textarea name="body" id="body" cols="30" rows="10" class="form-control">{{ $post->id}}</textarea>
            </div>
        </div>



        <div class="form-row">
            <div class="col-12">
                <label for="cover_image">Image</label>
                <input type="file" name="cover_image" id="cover_image" class="form-control">
            </div>
            <div class="col-4">
                <img src="{{ url('img/posts/' . $post->cover_image) }}" alt="{{ $post->title }}"
                    class="w-100">
            </div>
        </div>

        <div class="form-row my-3">
            <div class="col-2">
                <button class="btn btn-primary" name="page" value="index">Update</button>
            </div>

           
        </div>


    </form>
@endsection