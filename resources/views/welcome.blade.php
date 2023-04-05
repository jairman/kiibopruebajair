<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>kiibo Prueba</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">

</head>

<body>
    <h1>
        W E L C O M E
    </h1>
    <h2>
        API KIIBO PRUEBA
    </h2>

    <style>
        body {
            background-color: black;
            font-family: 'Open Sans', sans-serif;
            color: white;
            text-align: center;
        }

        h1 {
            font-size: 5rem;
            margin-top: 45vh;
        }
    </style>
</body>

</html>
