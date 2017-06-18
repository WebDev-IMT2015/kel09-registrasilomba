@extends('../layouts.app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">

			<div class="panel panel-default">
				<div class="panel-heading">User List</div>

				<div class="panel-body">
					<div class="col-md-12 table-responsive">
						<table class="table table-bordered table-hover">
							
							<thead>
								<tr>
									<th>Id</th>
									<th>Nama</th>
									<th>Email</th>
									<th>Alamat</th>
									<th>Phone Number</th>
								</tr>
							</thead>
							<tbody>
								@foreach($users as $user)
									<tr>
										<td>{{ $user->id }}</td>
										<td>{{ $user->name }}</td>
										<td style="color:@if($user->confirmed == 1) green @else red @endif">{{ $user->email }}</td>
										<td>{{ $user->alamat }}</td>
										<td>{{ $user->phone_number }}</td>
									</tr>
								@endforeach
							</tbody>
						</table>
						<div class="text-center">
							{{ $users->render() }}
						</div>	
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
