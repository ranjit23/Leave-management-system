@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <a class="btn btn-primary" href="{{ url('/timetable/create') }}" role="button">Add hours</a>
                <br><br>

                @foreach($datePeriod as $datePeriodRow)
                    <div class="card">
                        <div class="card-header">{{ $datePeriodRow->format('l') }}</div>

                        <div class="card-body">
                            <ul class="list-group list-group-flush">
                                @foreach($slots as $slot)
                                    @if($slot->day == $datePeriodRow->format('l') && !$slot->is_available)
                                        <li class="list-group-item">{{ $slot->time }}</li>
                                    @endif
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <br><br>
                @endforeach
            </div>
        </div>
    </div>
@endsection