<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Todo App</title>

        <!-- Fonts -->
        <link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet'>
        <link href='https://fonts.googleapis.com/css?family=Open Sans' rel='stylesheet'>
    </head>
    <body class="antialiased">
        <div id="app">
            <app-component></app-component>
        </div>
        @vite('resources/js/app.js')

    </body>
</html>
