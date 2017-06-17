@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">

			@if(Auth::user()->confirmed == 0)
				<div class="alert alert-info">
					Your Email Address is not <strong>Verified</strong>. Please Click <a href={{ url('verify') }}>Here</a> to Verify
				</div>
			@elseif(session('verified'))
                <div class="alert alert-success fade in">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    Your Email Address is now <strong>Verified</strong>.
                </div>
            @endif

            <div class="panel panel-default">
                <div class="panel-heading"> {{ Auth::user()->role == "admin" ? "Event Manager" : "User Panel"}} </div>

                <div class="panel-body">
                    @if($user->role == "admin")
                        <div class="col-md-12 text-center" style="margin-bottom: 1em;">
                            <a href="{{ url('add/event') }}" class="btn btn-primary">Add New Event</a>
                        </div>
                        <div class="col-md-10 col-md-offset-1 table-responsive">
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Lomba</th>
                                        <th>fgh</th>
                                        <th style="width: 35%;">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td>
                                            <a href="">
                                                <span class="glyphicon glyphicon-check" aria-hidden="true"></span> Manage
                                            </a>
                                            <a href="">
                                                <span class="glyphicon glyphicon-edit" aria-hidden="true"></span> Edit
                                            </a>
                                            <a href="">
                                                <span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Delete
                                            </a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    @elseif($user->role == "user")

                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
