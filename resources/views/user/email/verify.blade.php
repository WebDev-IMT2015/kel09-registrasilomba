<!DOCTYPE html>
<html lang="en-US">
    <head>
        <meta charset="utf-8">
    </head>
    <body>
        <h2>Verify Your Email Address</h2>

        <div>
            Thanks for creating an account in Congress. <br>
            Please follow the link below to verify your email address <br>
            <a href="{{ URL::to('verify/' . $confirmation_code) }}">{{ URL::to('verify/' . $confirmation_code) }}</a> <br/>
            Or you can type this Verification Code : {{ $confirmation_code }} in {{ URL::to('verify') }}

        </div>

    </body>
</html>