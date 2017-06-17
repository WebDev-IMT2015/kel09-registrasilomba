@extends('../../layouts.app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">

			@if(session('changePass') || session('editProfile'))
				<div class="alert alert-success fade in">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
					@if(session('changePass'))
						Change Password <strong>Success</strong>
					@elseif(session('editProfile'))
						Edit Profile <strong>Success</strong>
					@endif
				</div>
			@endif

			<div class="panel panel-default">
				<div class="panel-heading">Profile</div>

				<div class="panel-body">
					<div class="col-md-10 col-md-offset-1 table-responsive">
						<table class="table table-bordered table-hover">
							<tbody>
								<tr>
									<td style="width: 30%;">Name</td>
									<td colspan="2">{{ $user->name }}</td>
								</tr>
								<tr>
									<td>Email</td>
									<td>{{ $user->email }}</td>
									<a href="/">
										<td style="text-align: center;color: {{ $user->confirmed == 1 ? 'Green' : 'red' }}">@if($user->confirmed == 1) Verified @else Not Verified @endif</td>
									</a>
								</tr>
								<tr>
									<td>Alamat</td>
									<td colspan="2">{{ $user->alamat }}</td>
								</tr>
								<tr>
									<td>Nomor Handphone</td>
									<td colspan="2">{{ $user->phone_number }}</td>
								</tr>
							</tbody>
						</table>
						<a href="{{ url('profile/'.$user->id.'/edit') }}" class="btn btn-primary">Edit Profile</a>
						<a href="{{ url('profile/'.$user->id.'/changepass') }}" class="btn btn-danger">Change Password</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
