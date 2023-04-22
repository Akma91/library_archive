@extends('layout')

@section('content')

    <div class="postsWrapper">
        <div class="post">
            <h2 class="postTitle">{{ $post->title }}</h2>

            {!! $post->body !!}
            <div class="postFooter">
                <p>{{ date('Y.m.d', strtotime($post->published_at)) }}</p>
                <a href="{{route('home')}}"><p>< Nazad</p></a>
            </div>
        </div>
    </div>
@endsection