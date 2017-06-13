@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">

			<div class="alert alert-info">
				@if(session('emailSent'))
					Please check your Email for your Verification Code
				@else
					@if(Auth::user()->role == "user")
                    We already sent you the Verification Code after you register, if you can't find it, Click <strong><a href={{ route('sendEmailVerification') }}>Here</a></strong>.
                    @else
                    To get your Verification Code, please Click <strong><a href={{ route('sendEmailVerification') }}>Here</a></strong>.
                    @endif
				@endif
			</div>
            <div class="panel panel-default">
                <div class="panel-heading">Verify Email Address</div>

                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action={{ url('verify') }}>
                        {{ csrf_field() }}

                        <div class="form-group{{ session('error') ? ' has-error' : '' }}">
                            <label for="verification_code" class="col-md-4 control-label">Verification Code</label>

                            <div class="col-md-6">
                                <input id="password" type="text" class="form-control" name="verification_code" required>

                                @if (session('error'))
                                    <span class="help-block">
                                        <strong>Incorrect Verification Code</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Verify
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
