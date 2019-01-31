@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <a class="btn btn-primary" href="{{ url('/leave/create') }}" role="button">Request a leave</a>
                <br><br>

                <div class="card">
                    <div class="card-header">Remaining leaves</div>

                    <div class="card-body">
                        {{ auth()->user()->remaining_leaves }}
                    </div>
                </div>
                <br><br>

                <div class="card">
                    <div class="card-header">Approved</div>

                    <div class="card-body">
                        @foreach($leaves->where('status', 'approved') as $leave)
                            <li class="list-group-item">
                                {{ $leave->user->name }} | {{ $leave->date }} <span class="badge badge-success">Approved</span>
                            </li>
                        @endforeach
                    </div>
                </div>
                <br><br>

                <div class="card">
                    <div class="card-header">Declined</div>

                    <div class="card-body">
                        @foreach($leaves->where('status', 'declined') as $leave)
                            <li class="list-group-item">
                                {{ $leave->date }} <span class="badge badge-danger">Declined</span>
                            </li>
                        @endforeach
                    </div>
                </div>
                <br><br>

                <div class="card">
                    <div class="card-header">Pending</div>

                    <div class="card-body">
                        @foreach($leaves->where('status', 'pending') as $leave)
                            <li class="list-group-item">
                                <a href="/leave/{{ $leave->id }}/assign" class="card-link">{{ $leave->date }} </a><span class="badge badge-warning">Pending</span>
                            </li>
                        @endforeach
                    </div>
                </div>
                <br><br>
            </div>
        </div>
    </div>
@endsection