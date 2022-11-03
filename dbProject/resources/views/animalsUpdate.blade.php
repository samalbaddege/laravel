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

    <form name="update_animal_form" method="post" action="/updateanimal">
        {{ csrf_field() }}
            <table border="1" align="center">
            <caption>Update {{$animals->name}} Record</caption>
            <tbody>
            <tr>
                <td>Name</td>
                <td>:</td>
                <td>
                <input type="text" id= "animalName" name="animalName" value="{{$animals->name}}">
                <input type="hidden" id= "animalID" name="animalID" value="{{$animals->id}}">
                </td>
            </tr>
            <tr>
                <td>Type</td>
                <td>:</td>
                <td>
                    <select name="selectType" id="selectType">
                        @foreach($animalTypes as $animalType)
                            @if($animals->type_id==$animalType->id)
                                <option selected value="{{$animalType->id}}">
                                    {{$animalType->name}}
                                </option>
                            @else
                                <option value="{{$animalType->id}}">
                                    {{$animalType->name}}
                                </option>
                            @endif
                        @endforeach
                    </select>
                </td>
            </tr>
            <tr>
                <td>Color</td>
                <td>:</td>
                <td>
                    <select name="selectColor" id="selectColor">
                        @foreach($animalColors as $animalColor)
                            @if($animals->color_id==$animalColor->id)
                                <option selected value="{{$animalColor->id}}">
                                    {{$animalColor->name}}
                                </option>
                            @else
                                <option value="{{$animalColor->id}}">
                                    {{$animalColor->name}}
                                </option>
                            @endif
                        @endforeach
                    </select>
                </td>
            </tr>
            <tr>
                <td># of Legs</td>
                <td>:</td>
                <td>
                    <select name="selectLegs" id="selectLegs">
                        @foreach($animalNoOfLegs as $animalNoOfLeg)
                            @if($animals->legs_id==$animalNoOfLeg->id)
                                <option selected value="{{$animalNoOfLeg->id}}">
                                    {{$animalNoOfLeg->name}}
                                </option>
                            @else
                                <option value="{{$animalNoOfLeg->id}}">
                                    {{$animalNoOfLeg->name}}
                                </option>
                            @endif
                        @endforeach
                    </select>
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
