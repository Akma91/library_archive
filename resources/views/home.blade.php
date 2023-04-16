@extends('layout')

@section('content')

    <div class="">
        @foreach ($posts as $post)
            <div class="post">
                <h2 class="postTitle">{{ $post->title }}</h2>

                {!! $post->body !!}
            </div>
        @endforeach
        {{ $posts->links() }}
    </div>

@endsection

