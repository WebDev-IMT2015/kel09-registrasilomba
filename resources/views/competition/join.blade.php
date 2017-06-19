@extends('../layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">

            <div class="panel panel-default">
                <div class="panel-heading"> Add New Competition </div>

                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('competition/'.$competition->id.'/join') }}" enctype="multipart/form-data">
                        {{ csrf_field() }}

                        <div class="form-group">
                            <label for="ktp" class="col-md-4 control-label">KTP</label>

                            <div class="col-md-6">
                                <input id="ktp" type="file" class="form-control" name="ktp" required autofocus>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="pdf" class="col-md-4 control-label">Surat Bebas Plagiat</label>

                            <div class="col-md-6">
                                <input id="pdf" type="file" class="form-control" name="pdf" required>
                            </div>
                        </div>
                        @for ($i = 1; $i <= $competition->attachment_total; $i++)
                            <div class="form-group">
                                <label for="hasil_karya[{{ $i }}]" class="col-md-4 control-label">Hasil Karya {{ $i }}</label>

                                <div class="col-md-6">
                                    <input id="hasil_karya[{{ $i }}]" type="file" class="form-control" name="hasil_karya[{{ $i }}]" required>
                                </div>
                            </div>
                        @endfor

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Upload
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection