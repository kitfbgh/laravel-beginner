<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta name="robots" content="noindex, nofollow">
        <meta name="robots" content="noarchive">
        <title>{{ $data['name'] }}</title>
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
                <h5 class="card-header">課程 : {{ $data['name'] }}</h5>
                <div class="card-body">
                    <p id="id">CourseID : {{ $data['id'] }}</p>
                    <p>Description : {{ $data['description'] }}</p>
                    <p>Outline : {{ $data['outline'] }}</p>
                </div>
                <div class="card-footer">
                    <button class="btn btn-primary profileBtn">Get</button>
                </div>
                <div class="result">
                </div>
                @if (count($students))
                    <div class="links">
                        <ul class="list-group">
                        @foreach ($students as $student)
                            @component('record')
                                @slot('title')
                                    StudentID : {{ $student['id'] }}
                                @endslot
                                <a href="/student/{{ $student['id'] }}">{{ $student['last_name'] }} {{ $student['first_name'] }}</a>
                            @endcomponent
                        @endforeach
                        </ul>
                    </div>
                @endif
            </div>
        </div>
    </body>
    <script>
        $(function() {
            let $result = $('.result');
            $('.profileBtn').click(function(e) {
                $.ajax({
                    type: 'GET',
                    url: '/api/courses/' + {{ $data['id'] }},
                    headers: {
                        'Authenticate' : 'ada63e98fe50eccb55036d88eda4b2c3709f53c2b65bc0335797067e9a2a5d8b'
                    },
                    dataType: 'json',
                    success: function(data) {
                        $result.html(JSON.stringify(data));
                    },
                    error: function(xhr) {
                        alert(xhr.message);
                    }
                });
            });
        });
    </script>
</html>