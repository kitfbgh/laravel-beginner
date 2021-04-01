<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta name="robots" content="noindex, nofollow">
        <meta name="robots" content="noarchive">
        <title>{{ $data['last_name'] }} {{ $data['first_name'] }}</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.0-2/css/all.min.css" rel="stylesheet">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
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

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
        @component('nav')
            
        @endcomponent
        <div class="container">
            <div class="card">
                <h5 class="card-header">學生 : {{ $data['last_name'] }} {{ $data['first_name'] }}</h5>
                <div class="card-body">
                    <p>StudentID : {{ $data['id'] }}</p>
                    <p>Email : {{ $profile['email'] }}</p>
                    <p>Github : <a href={{ $github }}>{{ $profile['github'] }}</a></p>
                    <p>註冊時間 : {{ $data['register_at'] }}</p>
                </div>
                @if (count($courses))
                    <div class="links">
                        <ul class="list-group">
                        @foreach ($courses as $course)
                            @component('record')
                                @slot('title')
                                    CourseID : {{ $course['id'] }}
                                @endslot
                                <a href="/course/{{ $course['id'] }}">{{ $course['name'] }}</a> -  Grade : {{ $course->pivot->grade }}
                            @endcomponent
                        @endforeach
                        </ul>
                    </div>
                @endif
            </div>
        </div>
    </body>
</html>