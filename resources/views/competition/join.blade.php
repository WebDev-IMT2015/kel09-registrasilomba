@extends('../layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">

            <div class="panel panel-default">
                <div class="panel-heading"> Add New Competition </div>

                <div class="panel-body">
                    <form action="/upload" method="post" enctype="multipart/form-data">
                        {{ csrf_field() }}
                         Upload File KTP:
                        <input type="file" name="photos[]" multiple />
                         <br>
                         Upload File PDF:
                        <input type="file" name="file[]" multiple />
                         <br>
                         Upload Hasil Karya:
                        <input type="file" name="photos[]" multiple />
                        <br>
                        <input type="submit" value="Upload" />
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection