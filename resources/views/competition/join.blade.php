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

                        <div class="form-group {{ $errors->has('ktp') ? ' has-error' : '' }}">
                            <label for="ktp" class="col-md-4 control-label">KTP</label>

                            <div class="col-md-6">
                                <input id="ktp" type="file" class="form-control" name="ktp" required autofocus>

                                @if ($errors->has('ktp'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('ktp') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group {{ $errors->has('surat') ? ' has-error' : '' }}">
                            <label for="surat" class="col-md-4 control-label">Surat Pernyataan Bebas Plagiat</label>

                            <div class="col-md-6">
                                <input id="surat" type="file" class="form-control" name="surat" required>

                                @if ($errors->has('surat'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('surat') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        @for ($i = 1; $i <= $competition->attachment_total; $i++)
                            <div class="form-group {{ $errors->has('hasil_karya.'.$i) ? ' has-error' : '' }}">
                                <label for="hasil_karya[{{ $i }}]" class="col-md-4 control-label">Hasil Karya {{ $i }}</label>

                                <div class="col-md-6">
                                    <input id="hasil_karya[{{ $i }}]" type="file" class="form-control" name="hasil_karya[{{ $i }}]" required>

                                    @if ($errors->has('hasil_karya.'.$i))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('hasil_karya.'.$i) }}</strong>
                                        </span>
                                    @endif
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