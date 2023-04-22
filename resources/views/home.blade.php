@extends('layout')

@section('content')
    <div class="postsWrapper">
        @foreach ($posts as $post)
            <div class="post">
                <a href="{{ route('postDetails', $post->slug) }}">
                    <h2 class="postTitle">{{ $post->title }}</h2>
                </a>

                {!! $post->exerpt !!}
                <div class="postFooter">
                    <p>{{ date('Y.m.d', strtotime($post->published_at)) }}</p>
                </div>
            </div>
        @endforeach
        {{ $posts->links() }}
    </div>

@endsection

