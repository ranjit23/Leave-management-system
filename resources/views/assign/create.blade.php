@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Select any faculty</div>

                    <div class="card-body">
                        <ul class="list-group list-group-flush">
                            @foreach($faculty as $prof)
                                @foreach($assignment as $ass)
                                    <li class="list-group-item"><a href="{{ $ass->id }}/{{ $prof->user->id }}" class="card-link">{{ $prof->user->name }}</a>
                                        <span class="badge badge-secondary">
                                            {{ $ass->assignee_status }}
                                        </span>
                                        <span class="badge badge-warning">
                                            {{ $ass->hod_status }}
                                        </span>

                                    </li>
                                @endforeach
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection