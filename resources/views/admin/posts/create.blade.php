@extends('layout')

@section('content')

    <div class="postsWrapper">
        <div class="post">
            <h3 id="publishFormName">Novi post</h3>
            <form method="POST" action="{{ route('publish') }}">
                @csrf

                <label class="formLabel"><strong>Naslov</strong></label>
                <input name="title" id="postTitleInput" maxlength="50" type="text">
                <label class="formLabel"><strong>Text</strong></label>
                <textarea id="bookQuery" name="body" rows="10" cols="50" maxlength="5000"></textarea>
                <div id="publishButtonSection">
                    <button id="publishButton" type="submit">Objavi</button>
                </div>
            </form>
        </div>
    </div>
@endsection