@extends('../layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">

            <div class="panel panel-default">
                <div class="panel-heading"> Manage Registrant of {{ $competition->name }} </div>

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
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($participants as $participant)
                                    @if($participant->status != 3)
                                        @if($user = $users->find($participant->user_id))
                                            <tr>
                                                <td>{{ $user->id }}</td>
                                                <td>{{ $user->name }}</td>
                                                <td style="color:@if($user->confirmed == true) green @else red @endif">{{ $user->email }}</td>
                                                <td>{{ $user->alamat }}</td>
                                                <td>{{ $user->phone_number }}</td>
                                                <td>
                                                    <a href="{{ url('attachment/'.$participant->id.'/view') }}">
                                                        <span class="glyphicon glyphicon-align-left" aria-hidden="true"></span> Manage Attachment
                                                    </a>
                                                </td>
                                            </tr>
                                        @endif
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