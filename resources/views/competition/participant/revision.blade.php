@extends('../../layouts.app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">

			<div class="panel panel-default">
				<div class="panel-heading">Attachment Revision</div>
				
				<div class="panel-body">
					<form class="form-horizontal" role="form" method="POST" action={{ url('attachment/'.$participant->id.'/revision') }} enctype="multipart/form-data">
                        {{ csrf_field() }}
						<div class="col-md-12 table-responsive">
							<table class="table table-bordered table-hover">
								<tbody>
									@if($participant->ktp_confirmed == false)
										<tr>
											<td><label for="ktp" class="control-label">KTP</label></td>
											<td>
					                            <input id="ktp" type="file" class="form-control" name="ktp" required autofocus>
					                            @if ($errors->has('ktp'))
					                                <span class="help-block">
					                                    <strong>{{ $errors->first('ktp') }}</strong>
					                                </span>
					                            @endif
											</td>
										</tr>
									@endif
									@if($participant->pdf_confirmed == false)
										<tr>
											<td>
                            					<label for="surat" class="control-label">Surat Pernyataan Bebas Plagiat</label>
											</td>
											<td>
												<input id="surat" type="file" class="form-control" name="surat" required>

				                                @if ($errors->has('surat'))
				                                    <span class="help-block">
				                                        <strong>{{ $errors->first('surat') }}</strong>
				                                    </span>
				                                @endif
											</td>
										</tr>
									@endif
									@foreach($attachment->get() as $attach)
										@if($attach->attachment_confirmed == false)
											<tr>
												<td>Hasil Karya {{ $attach->attachment_no }}</td>
												<td>
													<input id="hasil_karya[{{ $attach->attachment_no }}]" type="file" class="form-control" name="hasil_karya[{{ $attach->attachment_no }}]" required>
													
				                                    @if ($errors->has('hasil_karya.'.$attach->attachment_no))
				                                        <span class="help-block">
				                                            <strong>{{ $errors->first('hasil_karya.'.$attach->attachment_no) }}</strong>
				                                        </span>
				                                    @endif
												</td>
											</tr>
										@endif
									@endforeach
								</tbody>
							</table>
						</div>
						<div class="form-group">
                            <div class="col-md-12 text-center">
                                <button type="submit" class="btn btn-primary">
                                    Upload Revision
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
