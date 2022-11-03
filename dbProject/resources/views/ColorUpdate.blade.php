<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Update Animal</title>

        <!-- Fonts -->
        <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

        <style>
            body {
                font-family: 'Nunito', sans-serif;
            }
        </style>
    </head>
    <body class="antialiased">

    <form name="update_animal_color_form" method="post" action="/updateanimalcolor">
        {{ csrf_field() }}
            <table border="1" align="center">
            <caption>Update {{$animalColors->name}} Record</caption>
            <tbody>
            <tr>
                <td>Name</td>
                <td>:</td>
                <td>
                <input type="text" id= "animalColorName" name="animalColorName" value="{{$animalColors->name}}">
                <input type="hidden" id= "animalColorID" name="animalColorID" value="{{$animalColors->id}}">
                </td>
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
