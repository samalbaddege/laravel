<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

        <style>
            body {
                font-family: 'Nunito', sans-serif;
            }
        </style>
    </head>
    <body class="antialiased">
        @foreach($animals AS $animal)
        {{ $animal->name }}<br>
        @endforeach

        <br>
        <br>
        <br>
        @foreach($animals AS $animal)
        The {{ $animal->animalType->name }} 
        {{$animal->name}} which is 
        {{$animal->animalColor->name}} has 
        {{$animal->animalLegs->name}} legs.
        <a href="/updateanimalpage/{{$animal->id}}">Update</a>
        <a href="/deleteanimal/{{$animal->id}}">Delete</a>
        <br>
        @endforeach




        <form name="new_animal_form" method="post" action="/saveanimal">
        {{ csrf_field() }}
            <table border="1" align="center">
            <caption>Add New Animal</caption>
            <tbody>
            <tr>
                <td>Name</td>
                <td>:</td>
                <td><input type="text" id= "animalName" name="animalName" placeholder="Enter Animal Name"></td>
            </tr>
            <tr>
                <td>Type</td>
                <td>:</td>
                <td><select name="selectType" id="selectType">
                    @foreach($animalTypes as $animalType)
                    <option value="{{$animalType->id}}">
                    {{$animalType->name}}
                    </option>
                    @endforeach
                </select></td>
            </tr>
            <tr>
                <td>Color</td>
                <td>:</td>
                <td><select name="selectColor" id="selectColor">
                    @foreach($animalColors as $animalColor)
                    <option value="{{$animalColor->id}}">
                    {{$animalColor->name}}
                    </option>
                    @endforeach
                </select></td>
            </tr>
            <tr>
                <td># of Legs</td>
                <td>:</td>
                <td><select name="selectLegs" id="selectLegs">
                    @foreach($animalNoOfLegs as $animalNoOfLeg)
                    <option value="{{$animalNoOfLeg->id}}">
                    {{$animalNoOfLeg->name}}
                    </option>
                    @endforeach
                </select></td>
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
