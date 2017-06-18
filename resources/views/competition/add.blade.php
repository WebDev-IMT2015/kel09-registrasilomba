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
                        <div class="form-group @if(session('name')) has-error @endif">
                            <label for="name" class="col-md-4 control-label">Competition Name</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" required autofocus>

                                @if (session('name'))
                                    <span class="help-block">
                                        <strong>Competition Name cannot be Empty.</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group @if(session('attachment_total')) has-error @endif">
                            <label for="attachment_total" class="col-md-4 control-label">Number of Attachment</label>

                            <div class="col-md-6">
                                <input id="attachment_total" type="number" min="3" class="form-control" name="attachment_total" value="3" required>

                                @if (session('attachment_total'))
	                                <span class="help-block">
	                                    <strong>The minimum Number of Attachment is 3.</strong>
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