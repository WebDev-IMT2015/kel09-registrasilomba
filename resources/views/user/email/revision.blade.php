<!DOCTYPE html>
<html lang="en-US">
    <head>
        <meta charset="utf-8">
    </head>
    <body>
        <h2>Hello {{ $user->name }}</h2>

        <div>
            Thank you for participating in {{ $competition->name }} <br>
            But there's something you need to do now, you need to do a revision on some of the requirement <br>
            Click <a href="{{ url('attachment/'.$participant->id.'/revision') }}"><strong>Here</strong></a> if you want to do the revision now. <br>
            Or you can just log in to your account and do it later. <br><br>
            Here's the full link you can copy to your address bar if you want : {{ url('attachment/'.$participant->id.'/revision') }}
        </div>

    </body>
</html>