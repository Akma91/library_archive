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
                <h2>Rezervirajte posudbu</h2>
                <form method="POST" action="{{ route('reservation') }}">
                    @csrf
                    @if(empty($book->reserved_to))
                    <label class="formLabel"><strong>Knjiga je slobodna za rezervaciju</strong></label>
                    @else
                        <label class="formLabel"><strong>Knjiga je rezervirana do: </strong>{{ $book->reserved_to }}</label>
                        <input type="hidden" name="reserved_from" value="{{ $book->reserved_to }}">
                    @endif

                    <label class="formLabel" for="reserved_to"><strong>Rezerviraj do:</strong></label>
                    <input type="date" name="reserved_to" value="@if(empty($book->reserved_to)){{ date("Y-m-d") }}@else{{ $book->reserved_to }}@endif" 
                        min="@if(empty($book->reserved_to)){{date("Y-m-d")}}@else{{ date("Y-m-d", strtotime ( '+1 day' , strtotime ( $book->reserved_to ) )) }}@endif" 
                        max="@if(empty($book->reserved_to)){{date("Y-m-d", strtotime('+1 month' , strtotime (date("Y-m-d"))))}}@else{{date("Y-m-d", strtotime('+1 month' , strtotime ($book->reserved_to)))}}@endif"
                    >

                    @error('reserved_to')
                        <p>{{ $message }}</p>
                    @enderror

                    <input type="hidden" name="book_id" value="{{ $book->id }}">
                    <input type="hidden" name="reserved_from" value="@if(empty($book->reserved_to)){{date("Y-m-d")}}@else{{ $book->reserved_to }}@endif">

                    @error('book_id')
                        <p>{{ $message }}</p>
                    @enderror

                    <button id="reservationSubmitButton" type="submit">Rezerviraj</button>
                </form>
            </div>
        </div>
    </div>
    
    <div>
        <form method="POST" action="{{ route('openBookQuery') }}">
            @csrf
            <h2>Pošalji upit u vezi knjige</h2>
            <textarea id="bookQuery" name="query_text" rows="10" cols="50" maxlength="500"></textarea>
            <input type="hidden" name="book_id" value="{{ $book->id }}">
            <button id="querySubmitButton" type="submit">Pošalji</button>
        </form>
    </div>

@endsection