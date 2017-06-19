@extends('../../layouts.app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">

			<div class="panel panel-default">
				<div class="panel-heading">View Attachment</div>

				<div class="panel-body">
					<div class="col-md-10 col-md-offset-1 table-responsive">
						<table class="table table-bordered table-hover">
							<tbody>
								<tr>
									<td>KTP</td>
									<td><a href="{{ url('attachment/'.$participant->id.'/view/ktp') }}"><span class="glyphicon glyphicon-file" aria-hidden="true"></span>Download</a></td>
								</tr>
								<tr>
									<td>Surat Pernyataan Bebas Plagiat</td>
									<td><a href="{{ url('attachment/'.$participant->id.'/view/surat') }}"><span class="glyphicon glyphicon-file" aria-hidden="true"></span>Download</a></td>
								</tr>
								@for($i = 1; $i <= $attachment->count(); $i++)
									<tr>
										<td>Hasil Karya {{ $i }}</td>
										<td><a href="{{ url('attachment/'.$participant->id.'/view/karya/'.$i) }}"><span class="glyphicon glyphicon-file" aria-hidden="true"></span>Download</a></td>
									</tr>
								@endfor
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
