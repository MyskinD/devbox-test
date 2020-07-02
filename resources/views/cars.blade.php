<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                margin: 0;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

        </style>

        <title>Webstudio-test</title>

    </head>
    <body>
        <div class="flex-center position-ref full-height">


            <div class="container" style="padding-top: 50px;">

                <div class="row">
                    {{ $cars->render() }}
                </div>

                @foreach ($cars as $car)
                    <div class="row" style="margin: 20px">
                        <div class="col-3">
                            <a href="{{ $car->link }}">
                                @if ($car->image)
                                    <img src="{{ $car->image }}" alt="" width="180" height="134">
                                @else
                                    No image
                                @endif
                            </a>
                        </div>
                        <div class="col-3">
                            <div class="row">
                                <div class="col" style="height: 3vh">
                                    @if ($car->age)
                                        {{ $car->age }}
                                    @else
                                        No age
                                    @endif
                                </div>
                            </div>
                            <div class="row">
                                <div class="col" style="height: 3vh">
                                    @if ($car->price_rub)
                                        {!! $car->price_rub !!}
                                    @else
                                        No price rub
                                    @endif
                                </div>
                            </div>
                            <div class="row">
                                <div class="col" style="height: 3vh">
                                    @if ($car->price_usd)
                                        {{ $car->price_usd }}
                                    @else
                                        No price usd
                                    @endif
                                </div>
                            </div>
                            <div class="row">
                                <div class="col" style="height: 3vh">
                                    @if ($car->location)
                                        {{ $car->location }}
                                    @else
                                        No location
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="row">
                                <div class="col" style="height: 4vh">
                                    @if ($car->title)
                                        {{ $car->title }}
                                    @else
                                        No title
                                    @endif
                                </div>
                            </div>
                            <div class="row">
                                <div class="col text-truncate" style="height: 4vh">
                                    @if ($car->description)
                                        {!! $car->description !!}
                                    @else
                                        No description
                                    @endif
                                </div>
                            </div>
                            <div class="row">
                                <div class="col text-truncate" style="height: 4vh">
                                    @if ($car->message)
                                        {{ $car->message }}
                                    @else
                                        No message
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach

                <div class="row">
                    {{ $cars->render() }}
                </div>
            </div>

        </div>

        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
    </body>
</html>
