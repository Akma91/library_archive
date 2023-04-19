@extends('layout')

@section('content')
    <div class="postsWrapper">
        @foreach ($posts as $post)
            <div class="post">
                <h2 class="postTitle">{{ $post->title }}</h2>

                {!! $post->body !!}
            </div>
        @endforeach
        {{ $posts->links() }}
    </div>

@endsection

