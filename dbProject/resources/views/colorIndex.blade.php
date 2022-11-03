<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Animal Color Index</title>

        <!-- Fonts -->
        <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

        <style>
            body {
                font-family: 'Nunito', sans-serif;
            }
        </style>
    </head>
    <body class="antialiased">
        Animal Color List,<br>
        @foreach($animalColors AS $animalColor)
        {{ $animalColor->id }} - {{ $animalColor->name }} 
        <a href="/updateanimalcolorpage/{{$animalColor->id}}">Update|
        <a href="/deleteanimalcolor/{{$animalColor->id}}">Delete</a>
        </a><br>

        @endforeach
        <br>
        <br>

        <form name="new_animal_color_form" method="post" action="/savecolor">
        {{ csrf_field() }}
            <table border="1" align="center">
            <caption>Add New Animal Color</caption>
            <tbody>
            <tr>
                <td>Name</td>
                <td>:</td>
                <td><input type="text" id= "animalColor" name="animalColor" placeholder="Enter Animal Color"></td>
            </tr>

            <tr>
                <th scope="row" colspan="3">
                    <input value="Reset" type="reset">&nbsp;
                    <input value="Save" type="submit">
                </th>
            </tr>
            </tbody>
            </table>

       </form>    

    </body>
</html>
