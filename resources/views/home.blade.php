@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header" id="headingOne">
                    <h5 class="mb-0">
                        <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                            Pending Requests
                        </button>
                    </h5>
                </div>

                <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                    <div class="card-body">
                        @foreach($requests->where('assignee_status', 'requested') as $request)
                                <li class="list-group-item">
                                    By {{ $request->leave->user->name }} | {{ $request->date }}
                                    <div class="dropdown">
                                        <button class="btn btn-primary dropdown-toggle" type="button" id="actionMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            Action
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="actionMenuButton">
                                            <a class="dropdown-item" href="/assign/{{ $request->id }}/approve">Approve</a>
                                            <a class="dropdown-item" href="/assign/{{ $request->id }}/decline">Decline</a>
                                        </div>
                                    </div>
                                </li>
                        @endforeach
                    </div>
                </div>
            </div>
            <br><br>

            @if(auth()->user()->is_hod)
                <div class="card">
                    <div class="card-header" id="headingOne">
                        <h5 class="mb-0">
                            <button class="btn btn-link" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseOne">
                                Waiting for HOD's approval
                            </button>
                        </h5>
                    </div>

                    <div id="collapseTwo" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                        <div class="card-body">
                            @foreach($requestsHod->where('hod_status', 'requested') as $request)
                                <li class="list-group-item">
                                    By {{ $request->leave->user->name }} | {{ $request->date }}
                                    <div class="dropdown">
                                        <button class="btn btn-primary dropdown-toggle" type="button" id="actionMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            Action
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="actionMenuButton">
                                            <a class="dropdown-item" href="/assign/{{ $request->id }}/approvehod">Approve</a>
                                            <a class="dropdown-item" href="/assign/{{ $request-> id }}/declinehod">Decline</a>
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        </div>
                    </div>
                </div>
                <br><br>
            @endif
        </div>
    </div>
</div>
@endsection
