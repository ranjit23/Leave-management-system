@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Add hours</div>

                    <div class="card-body">
                        <form id="form" class="form-horizontal" method="POST" action="{{ url('/timetable') }}" enctype="multipart/form-data">
                            {{ csrf_field() }}

                            <div class="form-group{{ $errors->has('day') ? ' has-error' : '' }}">
                                <label for="day" class="col-md-4 control-label">Day</label>

                                <div class="col-md-6">
                                    <select id="day" class="form-control" name="day" required autofocus>
                                        @foreach($datePeriod as $datePeriodRow)
                                            <option value="{{ $datePeriodRow->format('l') }}">{{ $datePeriodRow->format('l') }}</option>
                                        @endforeach
                                    </select>

                                    @if ($errors->has('day'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('day') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('time') ? ' has-error' : '' }}">
                                <label for="time" class="col-md-4 control-label">Time</label>

                                <div class="col-md-6">
                                    <select id="time" class="form-control" name="time" required autofocus>
                                        @foreach($hourPeriod as $hourPeriodRow)
                                            <option value="{{ $hourPeriodRow->format('h:i A') }}">{{ $hourPeriodRow->format('h:i A') }}</option>
                                        @endforeach
                                    </select>

                                    @if ($errors->has('time'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('time') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('department') ? ' has-error' : '' }}">
                                <label for="department" class="col-md-4 control-label">Department</label>

                                <div class="col-md-6">
                                    <input id="department" type="text" class="form-control" name="department" required>

                                    @if ($errors->has('day'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('day') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        Submit
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection