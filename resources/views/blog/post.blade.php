@extends('layouts.master')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <p class="quote">{{$post->title}}</p>
        </div>
    </div>
        <div class="row">
        <div class="col-md-12">
            <p class="text-center"> {{count($post->likes) }} Likes |
                <a href="{{route('blog.post.like',['id'=>$post])}}">Like</a>
            </p>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <p class="text-center"> {{$post->content}}</p>
        </div>
    </div>
@endsection