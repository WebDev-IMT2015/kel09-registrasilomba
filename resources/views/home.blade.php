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
                    @if(Auth::user()->role == "admin")
                        <div class="col-md-12" style="margin-bottom: 1em;">
                            <a href="{{ url('competition/add') }}" class="btn btn-primary">Add New Competition</a>
                        </div>
                        <div class="col-md-12 table-responsive">
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Nama Lomba</th>
                                        <th>Jumlah Karya</th>
                                        <th>Jumlah Pendaftar</th>
                                        <th style="width: 35%;">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(isset($allCompetition))
                                        @foreach ($allCompetition as $competition)
                                            <tr>
                                                <td>{{ $competition->name }}</td>
                                                <td class="text-center">{{ $competition->attachment_total }}</td>
                                                <td class="text-center">{{ $participant->where('competition_id', $competition->id)->count() }} </td>
                                                <td>
                                                    <a href="{{ url('competition/'.$competition->id.'/manage') }}">
                                                        <span class="glyphicon glyphicon-user" aria-hidden="true"></span> Manage
                                                    </a>
                                                    <a href="{{ url('competition/'.$competition->id.'/list') }}">
                                                        <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span> View List
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
                    @elseif(Auth::user()->role == "user")
                        <div class="col-md-12 table-responsive">
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Nama Lomba</th>
                                        <th>Jumlah Karya</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(isset($allCompetition))
                                        @foreach($allCompetition as $competition)
                                            <tr>
                                                <td>{{ $competition->name }}</td>
                                                <td class="text-center">{{ $competition->attachment_total }}</td>
                                                <td>
                                                    @if($participant->where('user_id', Auth::user()->id)->where('competition_id', $competition->id)->count() > 0)
                                                        Registered
                                                    @else
                                                        <a href="{{ url('competition/'.$competition->id.'/join') }}">
                                                            <span class="glyphicon glyphicon-ok" aria-hidden="true"></span> Join
                                                        </a>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                            
                            @if(isset($allCompetition))
                                <div class="text-center">
                                    {{ $allCompetition->render() }}
                                </div>
                            @endif
                        </div>
                    @endif
                </div>
            </div>
            @if(Auth::user()->role == "user" && isset($participate) && $participate->count() > 0)
                <div class="panel panel-default">
                    <div class="panel-heading"> Competition Status </div>
                    <div class="panel-body">
                        <div class="col-md-12 table-responsive">
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Nama Lomba</th>
                                        <th>Jumlah Karya</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($participate as $status)
                                        @if($competition = $allCompetition->where('id', $status->competition_id)->first())
                                            <tr>
                                                <td>{{ $competition->name }}</td>
                                                <td class="text-center">{{ $competition->attachment_total }}</td>
                                                <td>
                                                    @if($status->status == 0)
                                                        <span style="color:black">Validating</span>
                                                    @elseif($status->status == 1)
                                                        <a href=""><span style="color:red">Need Revision</span></a>
                                                    @elseif($status->status == 2)
                                                        <span style="color:green">Accepted</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <a href="{{ url('attachment/'.$status->id.'/view') }}"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span> View </a>
                                                    @if($status->status == 1)
                                                        <a href="{{ url('attachment/'.$status->id.'/revision') }}"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span> Make Revision </a>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endif
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="text-center">
                                {{ $participate->render() }}
                            </div>
                        </div>
                    </div>  
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
