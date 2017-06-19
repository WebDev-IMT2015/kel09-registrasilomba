@extends('../layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">

            <div class="panel panel-default">
                <div class="panel-heading"> Add New Competition </div>

                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('competition/save') }}">

                        {{ csrf_field() }}
                        <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Competition Name</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group {{ $errors->has('attachment_total') ? ' has-error' : '' }}">
                            <label for="attachment_total" class="col-md-4 control-label">Number of Attachment</label>

                            <div class="col-md-6">
                                <input id="attachment_total" type="number" min="3" max="5" class="form-control" name="attachment_total" value="3" required>

                                @if ($errors->has('attachment_total'))
	                                <span class="help-block">
	                                    <strong>{{ $errors->first('attachment_total') }}</strong>
	                                </span>
	                            @endif
                            </div>
                        </div>
                        
						<div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Add Competition
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