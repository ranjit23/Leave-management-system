@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Load balance</div>

                    <div class="card-body">
                        <ul class="list-group list-group-flush">
                            @foreach($assigns as $assign)
                                <li class="list-group-item"><a href="/assign/{{$assign->id}}" class="card-link">{{ $assign->time }}</a></li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection