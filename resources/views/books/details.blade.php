@extends('layout')

@section('content')

    <div class="bookDetailsRow">
        <div class="bookDetailsColumn">
            <div class="bookCard">
                <h1>{{ $book->title }}</h1>

                <p>{{ $book->description }}</p>
            </div>
        </div>

        <div class="bookDetailsColumn">
            <div class="bookReservationForm">
                <h2>Rezervirajte posudbu:</h2>
                <form method="POST" action="{{ route('reservation') }}">
                    @csrf
                    @if(empty($book->reserved_to))
                    <label class="formLabel"><strong>Knjiga je slobodna za rezervaciju</label>
                    @else
                        <label class="formLabel"><strong>Knjiga je rezervirana do: </strong>{{ $book->reserved_to }}</label>
                        <input type="hidden" name="reserved_from" value="{{ $book->reserved_to }}">
                    @endif

                    <label class="formLabel" for="reserved_to"><strong>Rezerviraj do:</strong></label>
                    <input type="date" name="reserved_to" value="@if(empty($book->reserved_to)){{ date("Y-m-d") }}@else{{ $book->reserved_to }}@endif" 
                        min="@if(empty($book->reserved_to)){{date("Y-m-d")}}@else{{ date("Y-m-d", strtotime ( '+1 day' , strtotime ( $book->reserved_to ) )) }}@endif" 
                        max="@if(empty($book->reserved_to)){{date("Y-m-d", strtotime('+1 month' , strtotime (date("Y-m-d"))))}}@else{{date("Y-m-d", strtotime('+1 month' , strtotime ($book->reserved_to)))}}@endif"
                    >

                    <input type="hidden" name="book_id" value="{{ $book->id }}">

                    <input type="hidden" name="reserved_from" value="@if(empty($book->reserved_to)){{date("Y-m-d")}}@else{{ $book->reserved_to }}@endif">
                    
                    @auth
                        <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                    @endauth

                    <button class="submitButton" type="submit">Rezerviraj</button>
                </form>
            </div>
        </div>
    </div>

@endsection