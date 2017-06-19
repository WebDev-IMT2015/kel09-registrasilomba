@extends('../layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">

            <div class="panel panel-default">
                <div class="panel-heading"> List Registrant of {{ $competition->name }} </div>

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
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($participants as $participant)
                                    @if($user = $users->find($participant->user_id))
                                        <tr>
                                            <td>{{ $user->id }}</td>
                                            <td>{{ $user->name }}</td>
                                            <td style="color:@if($user->confirmed == true) green @else red @endif">{{ $user->email }}</td>
                                            <td>{{ $user->alamat }}</td>
                                            <td>{{ $user->phone_number }}</td>
                                            <td>
                                                @if($participant->status == 0)
                                                    <span style="color:black">Validating</span>
                                                @elseif($participant->status == 1)
                                                    <span style="color:red">Need Revision</span>
                                                @elseif($participant->status == 2)
                                                    <span style="color:green">Accepted</span>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ url('attachment/'.$participant->id.'/view') }}">
                                                    <span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span> View Attachment
                                                </a>
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                        <div class="text-center">
                            {{ $participants->render() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection