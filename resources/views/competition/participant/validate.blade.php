@extends('../../layouts.app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">

			<div class="panel panel-default">
				<div class="panel-heading">Validate Attachment</div>
				
				<div class="panel-body">
					<form class="form-horizontal" role="form" method="POST" action={{ url('attachment/'.$participant->id.'/validate') }}>
                        {{ csrf_field() }}
						<div class="col-md-10 col-md-offset-1 table-responsive">
							<table class="table table-bordered table-hover">
								<tbody>
									<tr>
										<td>
											<input id="ktp" type="checkbox" class="form-control" name="ktp" style="height:15px" @if($participant->ktp_confirmed == true) disabled @endif>
										</td>
										<td>KTP</td>
										<td><a href="{{ url('attachment/'.$participant->id.'/view/ktp') }}"><span class="glyphicon glyphicon-file" aria-hidden="true"></span>Download</a></td>
									</tr>
									<tr>
										<td>
											<input id="pdf" type="checkbox" class="form-control" name="pdf" style="height:15px" @if($participant->pdf_confirmed == true) disabled @endif>
										</td>
										<td>Surat Pernyataan Bebas Plagiat</td>
										<td><a href="{{ url('attachment/'.$participant->id.'/view/surat') }}"><span class="glyphicon glyphicon-file" aria-hidden="true"></span>Download</a></td>
									</tr>
									@foreach($attachment->get() as $attach)
										<tr>
											<td>
												<input id="hasil_karya{{ $attach->attachment_no }}" type="checkbox" class="form-control" name="hasil_karya{{ $attach->attachment_no }}" style="height:15px" @if($attach->attachment_confirmed == true) disabled @endif>
											</td>
											<td>Hasil Karya {{ $attach->attachment_no }}</td>
											<td><a href="{{ url('attachment/'.$participant->id.'/view/karya/'.$attach->attachment_no) }}"><span class="glyphicon glyphicon-file" aria-hidden="true"></span>Download</a></td>
										</tr>
									@endforeach
								</tbody>
							</table>
						</div>
						<div class="form-group">
                            <div class="col-md-12 text-center">
                                <button type="submit" class="btn btn-primary" formaction="{{ url('attachment/'.$participant->id.'/accept') }}">
                                    Accept All
                                </button>
                                <button type="submit" class="btn btn-danger">
                                    Accept Selected
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
