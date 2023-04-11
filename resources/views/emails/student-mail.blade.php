<!DOCTYPE html>
    <html>
        <head>
            <title>{{ env('APP_NAME') }}</title>
        </head>
        <body>
            <h1>Thank You For Purchasing...</h1>

            <p>Your LoginId and Password can be declared is here</p>

            <h4>Login Id : {{ $user['email'] }}</h4>
            @if ($user['password'] != '')
                <h4>Password : {{ $user['password'] }}</h4>
            @endif

            <p>Please fill the enrolment form <a href="{{ $user['url'] }}">Click here</a> </p>
        </body>
    </html>
