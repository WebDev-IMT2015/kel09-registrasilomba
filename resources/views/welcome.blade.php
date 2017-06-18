<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
    <title>Contest Regis</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">   
    <head>
    </head>
        <body>
        <div class="container">
    <div class="row">
        <div class="col-lg-12"> 
        <div class="jumbotron">
             <form action="/upload" method="post" enctype="multipart/form-data">

                    File Name:
                    <input type="text" name="name"> 
                    <br>
                    Upload files :
                    <input type="file" name="photos[]" multiple>
                    <br>
                    <button type="submit" value="Upload" class="btn btn-primary"> </button>
                    </form>
        </div>
        </div>
        </div>
        </div>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    </body>
</html>
