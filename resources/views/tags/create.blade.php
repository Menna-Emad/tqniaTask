@extends('layouts.parent')

@section('title', 'create tag')
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
    <form action="{{url('dashboard')}}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="form-row">
            <div class="col-6">
                <label for="name">name</label>
                <input type="text" name="name" id="name" class="form-control" placeholder=""
                    aria-describedby="" value="{{ old('name') }}">
            </div>



        </div>
        
       
        <div class="form-row my-3">
            <div class="col-2">
                <button class="btn btn-primary" name="page" value="index">Create</button>
            </div>

            <div class="col-2">
                <button class="btn btn-dark" name="page" value="back">Create & return</button>
            </div>
        </div>


    </form>
@endsection