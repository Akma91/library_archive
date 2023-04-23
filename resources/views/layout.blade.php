<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

        <!-- Styles -->
        <style>
            .header {
                height: 50px;
                display: flex;
                justify-content: space-between;;
                align-items: center;
                padding-left: 2em;
                padding-right: 2em;
                margin-bottom: 4em;
            }

            .body {
                margin: auto;
                margin-bottom: 5em;
                max-width: 1020px;
                font-family: "Helvetica Neue",Helvetica,Arial,sans-serif;
                background-color:#DFCFBE
            }

            .form {
                display: flex;
                justify-content: center;
                align-items: center;
                margin-top: 8em;
            }

            #loginForm {
                width: 300px;
            }

            .loginInput {
                width: 100%;
                border-radius: 5px;
                padding: 0.5em;
            }

            .post {
                margin-bottom: 2em;
                padding: 1em;
                box-shadow: 0px 5px 6px 0px rgba(73, 73, 73, 0.3);
                border-radius: 5px;
                background-color: #f8f5f1;
            }

            .postsWrapper {
                margin-top: 0.5em;
            }

            .postTitle {
                color: rgb(78, 78, 78);
                border-bottom: 1px solid #ebebeb;
                padding-bottom: 1em;
            }

            .postFooter {
                border-top: 1px solid #ebebeb;
                text-align: right;
            }

            .postFooter p {
                margin-top: 0.5em;
                margin-bottom: 0;
                color: #929292;
            }

            .postFooter a {
                margin-top: 1em;
            }

            .postFooter > a > p {
                color: #1d4424;
            }

            a, a:visited, a:hover, a:active {
                text-decoration: none;
                color:rgb(78, 78, 78);
            }

            .adminHeader {
                text-align: right;
                position:sticky;
                z-index: 1;
                width: 100%;
                background-color: #3d657c;
            }

            .adminHeader a {
                display: inline-block;
                padding-right: 1em;
                color: #f8f5f1;
                font-family: Arial, Helvetica, sans-serif;
            }

            .header a {
                display: inline-block;
                background: rgb(226, 226, 226);
                height: 50px;
                padding: 1em;
                box-shadow: 0px 3px 4px 0px rgba(73, 73, 73, 0.3);
                border-radius: 5px;
            }

            .header a:hover {
                box-shadow: 0px 5px 6px 0px rgba(73, 73, 73, 0.3);
            }

            .bookRow {
                margin: 0 -5px;
            }

            .bookRow:after {
                content: "";
                display: table;
                clear: both;
            }

            .bookColumn {
                float: left;
                width: 25%;
            }

            .bookCard {
                min-height: 300px;;
                margin: 0.5em;
                padding: 1em;
                box-shadow: 0px 3px 4px 0px rgba(73, 73, 73, 0.3);
                background-color: #f8f5f1;
            }

            .bookCard:hover {
                box-shadow: 0px 5px 6px 0px rgba(73, 73, 73, 0.3);
                background-color: #fdfdfc;
            }

            .recommendedBooksOuter {
                background-color: #c2d3bf;
                padding: 0 1.5em;
                border-radius: 5px;
            }

            .recommendedBooks {
                display: flex;
                flex-wrap: wrap;
                justify-content: space-between;
                width: 100%;
                justify-content: space-between;
            }

            .recommendationBookCard {
                flex: 0 1 15%;
                margin: 0.5em;
                padding: 0.5em;
                box-shadow: 0px 3px 4px 0px rgba(73, 73, 73, 0.3);
                background-color: #f8f5f1;
            }

            .recommendationBookCard:hover {
                box-shadow: 0px 5px 6px 0px rgba(73, 73, 73, 0.3);
                background-color: #fdfdfc;
            }

            .bookDetailsRow {
                margin: 0 -5px;
            }

            .bookDetailsRow:after {
                content: "";
                display: table;
                clear: both;
            }

            .bookDetailsColumn {
                float: left;
                width: 50%;
                background-color:#DFCFBE;
            }

            .bookReservationForm {
                margin: 50px;
                background-color:#DFCFBE;
            }

            #bookQuery {
                resize: none;
                width: 100%;
                padding: 0.5em;
                -webkit-box-sizing: border-box;
                -moz-box-sizing: border-box;
                box-sizing: border-box;
            }

            .bookOpenQueryForm form {
                margin: 50px;
            }

            .formLabel {
                display: block;
                clear: both;
                margin: 1em 0;
            }

            .pager {
                clear: both;
            }

            #reservationSubmitButton {
                width: 120px;
                clear: both;
                float: right;
                background-color: #4fb652;
                border: none;
                color: white;
                padding: 0.5em;
                text-align: center;
                text-decoration: none;
                display: inline-block;
                font-size: 16px;
                cursor: pointer;
                box-shadow: 0px 3px 4px 0px rgba(73, 73, 73, 0.3);
            }

            #reservationSubmitButton:hover {
                box-shadow: 0px 5px 6px 0px rgba(73, 73, 73, 0.3);
            }

            #querySubmitButton {
                margin-top: 1em;
                width: 120px;
                clear: both;
                float: right;
                background-color: #4fb652;
                border: none;
                color: white;
                padding: 0.5em;
                text-align: center;
                text-decoration: none;
                display: inline-block;
                font-size: 16px;
                cursor: pointer;
                box-shadow: 0px 3px 4px 0px rgba(73, 73, 73, 0.3);
            }

            #postTitleInput {
                padding: 0.5em;
                height: 2em;
                width: 100%;
                -webkit-box-sizing: border-box;
                -moz-box-sizing: border-box;
                box-sizing: border-box;
            }

            #publishFormName {
                text-align: center;
            }

            #publishButtonSection {
                text-align: right;
                width: 100%;
            }

            #publishButton {
                margin-top: 1em;
                width: 120px;
                background-color: #4fb652;
                border: none;
                color: white;
                padding: 0.5em;
                text-align: center;
                text-decoration: none;
                display: inline-block;
                font-size: 16px;
                cursor: pointer;
                box-shadow: 0px 3px 4px 0px rgba(73, 73, 73, 0.3);
            }

            #querySubmitButton:hover {
                box-shadow: 0px 5px 6px 0px rgba(73, 73, 73, 0.3);
            }

            .successMessage, .errorMessage {
                padding-left: 2em;
                display: flex;
                align-items: center;
                color: white;
                height: 50px;
            }

            .successMessage {
                background-color: #4fb652;
            }

            .errorMessage {
                background-color: #db6058;
            }

            input[type="date"] {
                -webkit-align-items: center;
                display: -webkit-inline-flex;
                font-family: "Helvetica Neue",Helvetica,Arial,sans-serif;
                overflow: hidden;
                padding: 0.5em;
                -webkit-padding-start: 0.5em;
            }

            .userSection {
                display: flex;
                align-items: center;
            }

            .greeting {
                display: inline-block;
                float: left;
                margin-right: 1em;
            }

            #logoutForm {
                display: inline-block;
                float: right;
            }

            #logoutForm button {
                background-color: rgb(226, 226, 226);
                border: none;
                padding: 0.5em;
                text-align: center;
                text-decoration: none;
                display: inline-block;
                font-size: 16px;
                cursor: pointer;
                box-shadow: 0px 3px 4px 0px rgba(73, 73, 73, 0.3);
                border-radius: 3px;
            }

            #logoutForm button:hover {
                box-shadow: 0px 5px 6px 0px rgba(73, 73, 73, 0.3);
            }

            ::-webkit-datetime-edit-fields-wrapper {}
            ::-webkit-datetime-edit-month-field {}
            ::-webkit-datetime-edit-day-field {}
            ::-webkit-datetime-edit-year-field {}
            ::-webkit-inner-spin-button { display: none; }
            ::-webkit-calendar-picker-indicator {}

            .imagePlaceholder {
                background-color: rgb(189, 189, 189);
                min-width: 100%;
                height: 200px;
            }

            .recommendationImagePlaceholder {
                background-color: rgb(189, 189, 189);
                min-width: 100%;
                height: 120px;
            }

            .recommendationBookCard h4 {
                font-size: 1em;
                margin: 0.5em 0 0.2em 0;
            }
            

            .recommendationBookCard p {
                font-size: 0.8em;
                margin: 0.5em 0 0.2em 0;
            }
            
        </style>
    </head>
    <body class="body">


        @can('admin')
            <div class="adminHeader">
                <div class='adminNavSection'>
                    <a href="{{ route('postCreate') }}" class=""><h4>Objavi</h4></a>
                </div>
            </div>
        @endcan


        <div class="header">
            <div class='navSection'>
                <a href="{{ route('home') }}" class=""><h2>Početna</h2></a>
                <a href="{{ route('catalog') }}" class=""><h2>Katalog</h2></a>
            </div>
            <div class='userSection'>
                @auth
                <span class="greeting">Dobrodošli, {{ auth()->user()->name }}</span>

                <form id="logoutForm" method="POST" action="/logout">
                    @csrf
                    <button type="submit">Odjavite se</button>
                </form>
                @else
                    <a href="{{ route('login') }}" class=""><h3>Prijavite se</h3></a>
                @endauth
            </div>
        </div>

        <x-messages/>

        @auth
            @cannot('admin')
            <x-recommender :customerBookRecommendations="$customerBookRecommendations" />
            @endcannot
        @endauth

        @yield('content')
    </body>
</html>