@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">

			@if(Auth::user()->confirmed == false)
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
                <div class="panel-heading"> {{ Auth::user()->role == "admin" ? "Competition Manager" : "Competition List"}} </div>

                <div class="panel-body">
                    @if($user->role == "admin")
                        <div class="col-md-12 text-center" style="margin-bottom: 1em;">
                            <a href="{{ url('competition/add') }}" class="btn btn-primary">Add New Competition</a>
                        </div>
                        <div class="col-md-12 table-responsive">
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Nama Lomba</th>
                                        <th>Jumlah Karya</th>
                                        <th>Jumlah Pendaftar</th>
                                        <th style="width: 30%;">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(isset($allCompetition))
                                        @foreach ($allCompetition as $competition)
                                            <tr>
                                                <td>{{ $competition->name }}</td>
                                                <td class="text-center">{{ $competition->attachment_total }}</td>
                                                <td class="text-center">@if(isset($registrant)) {{ $registrant->count() }} @else 0 @endif</td>
                                                <td>
                                                    <a href="{{ url('competition/'.$competition->id.'/manage') }}">
                                                        <span class="glyphicon glyphicon-check" aria-hidden="true"></span> Manage
                                                    </a>
                                                    <a href="{{ url('competition/'.$competition->id.'/list') }}">
                                                        <span class="glyphicon glyphicon-zoom-in" aria-hidden="true"></span> View List
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                            <div class="text-center">
                                {{ $allCompetition->render() }}
                            </div>  
                        </div>
                    @elseif($user->role == "user")
                        <div class="col-md-10 col-md-offset-1 table-responsive">
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Nama Lomba</th>
                                        <th>Stuff</th>
                                        <th>Stuff</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(isset($allCompetition))
                                        @foreach($allCompetition as $competition)
                                            <tr>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                            <div class="text-center">
                                {{ $allCompetition->render() }}
                            </div>
                        </div>
                    @endif
                </div>
            </div>
            @if($user->role == "user")
                <div class="panel panel-default">
                    <div class="panel-heading"> Competition Status </div>
                    <div class="panel-body">
                        <div class="col-md-10 col-md-offset-1 table-responsive">
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Nama Lomba</th>
                                        <th>Stuff</th>
                                        <th>Stuff</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(isset($competitionStatus))
                                        @foreach($competitionStatus as $status)
                                            <tr>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>  
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
