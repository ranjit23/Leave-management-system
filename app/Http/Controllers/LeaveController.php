<?php

namespace App\Http\Controllers;

use App\Leave;
use App\Timetable;
use App\User;
use App\Assign;
use Carbon\Carbon;
use Illuminate\Http\Request;

class LeaveController extends Controller
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
        $leaves = auth()->user()->leaves()->latest()->get();

        return view('leave.index', compact('leaves'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('leave.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $leave = Leave::create([
            'user_id' => auth()->id(),
            'date' => Carbon::parse($request->date)->toDateString()
        ]);

        return redirect('/assign/'.$leave->id.'/store');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Leave  $leave
     * @return \Illuminate\Http\Response
     */
    public function show(Leave $leave)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Leave  $leave
     * @return \Illuminate\Http\Response
     */
    public function edit(Leave $leave)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Leave  $leave
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Leave $leave)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Leave  $leave
     * @return \Illuminate\Http\Response
     */
    public function destroy(Leave $leave)
    {
        //
    }

    public function approve(Leave $leave)
    {
        $leave->update(['status'=>'approved']);

        User::where('id', $leave->user_id )->update(['remaining_leaves'=>$leave->user->remaining_leaves - 1]);

        return redirect('/leave');
    }

    public function decline(Leave $leave)
    {
        $leave->update(['status'=>'declined']);

        return redirect('/leave');
    }
}
