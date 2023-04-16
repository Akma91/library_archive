@extends('layout')

@section('content')

    @foreach ($books as $book)
        @if($loop->first)
            <div class="bookRow">
        @endif

            <div class="bookColumn">
                <a href="/books/{{ $book->slug }}">
                    <div class="bookCard">
                        <h3 class="">{{ $book->title }}</h3>
                        {!! $book->description !!}
                    </div>
                </a>
            </div>

        @if(($loop->iteration % 4 == 0) && (!$loop->last))
            </div>
            <div class="bookRow">
        @endif
        
        @if($loop->last)
            </div>
        @endif
    @endforeach
    <div class="pager">
        {{ $books->links() }}
    </div>

@endsection

