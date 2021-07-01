<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <script>window.Laravel = { csrf_token: "{{ csrf_token() }}" }</script>
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">

        <title>Stock Manager</title>
    </head>

    <body>
        <section id="app">
            <section class="container">
                <article class="wrapper">
                    <section class="row">
                        <article class="col-md-6">
                            <stocks></stocks>
                        </article>
                        <article class="col-md-6">
                            <clients></clients>
                        </article>
                    </section>
                </article>
                <article class="row">
                    <section class="col-md-12">
                        <purchase></purchase>
                    </section>
                </article>
            </section>
        </section>

        <script src="{{ asset('js/app.js') }}"></script>        
    </body>
</html>
