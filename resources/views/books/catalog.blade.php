@extends('layout')

@section('content')

    @foreach ($books as $book)
        @if($loop->first)
            <div class="bookRow">
        @endif

            <div class="bookColumn">
                <a href="/books/{{ $book->slug }}">
                    <div class="bookCard">
                        <div class="imagePlaceholder"> Image placeholder</div>
                        <h3 class="">{{Str::limit($book->title, $limit = 25, $end = '...')}}</h3>
                        {{Str::limit($book->author->name, $limit = 25, $end = '...')}}
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

