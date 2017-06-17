@extends('../../layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">

			<div class="panel panel-default">
                <div class="panel-heading">Change Password</div>

                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action={{ url('profile/'.$user->id.'/savepass') }}>
                        {{ csrf_field() }}

                        <div class="form-group {{ session('error') ? ' has-error' : '' }}">
                            <label for="lastPassword" class="col-md-4 control-label">Old Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="lastPassword" required>

                                @if (session('error'))
                                    <span class="help-block">
                                        <strong>Incorrect Password</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

						<div class="form-group">
                            <label for="newPassword" class="col-md-4 control-label">New Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="newPassword" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="newPassword" class="col-md-4 control-label">Retype Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="retypePassword" required>

                                @if (session('retype'))
                                    <span class="help-block">
                                        <strong>Incorrect Password</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Change Password
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
