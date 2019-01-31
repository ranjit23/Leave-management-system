<?php

namespace App\Http\Controllers;

use App\Timetable;
use Illuminate\Http\Request;
use Carbon\Carbon;

class TimetableController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $startDate = Carbon::now()->startOfWeek();
        $endDate = Carbon::now()->endOfWeek();
        $dateInterval = \DateInterval::createFromDateString('1 day');
        $datePeriod = new \DatePeriod($startDate, $dateInterval, $endDate->modify('-1 day'));

        $slots = Timetable::where('user_id', auth()->id())->orderBy('time')->get();

        return view('timetable.index', compact('slots', 'datePeriod'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $startDate = Carbon::now()->startOfWeek();
        $endDate = Carbon::now()->endOfWeek();
        $dateInterval = \DateInterval::createFromDateString('1 day');
        $datePeriod = new \DatePeriod($startDate, $dateInterval, $endDate->modify('-1 day'));

        $startHour = Carbon::now()->hour(9)->minute(0);
        $endHour = Carbon::now()->hour(17)->minute(0);
        $hourInterval = \DateInterval::createFromDateString('1 hour');
        $hourPeriod = new \DatePeriod($startHour, $hourInterval, $endHour);

        return view('timetable.create',compact('datePeriod', 'hourPeriod'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Timetable::where('user_id', auth()->id())->where('day', $request->day)->where('time', $request->time)->update(['is_available'=>false]);

        return redirect('/timetable');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Timetable  $timetable
     * @return \Illuminate\Http\Response
     */
    public function show(Timetable $Timetable)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Timetable  $Timetable
     * @return \Illuminate\Http\Response
     */
    public function edit(Timetable $Timetable)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Timetable  $Timetable
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Timetable $Timetable)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Timetable  $Timetable
     * @return \Illuminate\Http\Response
     */
    public function destroy(Timetable $Timetable)
    {
        //
    }

    public function init(Timetable $Timetable)
    {
        //
        $startDate = Carbon::now()->startOfWeek();
        $endDate = Carbon::now()->endOfWeek();
        $dateInterval = \DateInterval::createFromDateString('1 day');
        $datePeriod = new \DatePeriod($startDate, $dateInterval, $endDate->modify('-1 day'));

        $startHour = Carbon::now()->hour(9)->minute(0);
        $endHour = Carbon::now()->hour(17)->minute(0);
        $hourInterval = \DateInterval::createFromDateString('1 hour');
        $hourPeriod = new \DatePeriod($startHour, $hourInterval, $endHour);

        foreach($datePeriod as $datePeriodRow) {
            foreach($hourPeriod as $hourPeriodRow) {
                Timetable::create([
                    'user_id' => auth()->id(),
                    'day' => $datePeriodRow->format('l'),
                    'time' => $hourPeriodRow->format('h:i A'),
                    'is_available' => true
                ]);
            }
        }

        return redirect('/home');
    }
}
