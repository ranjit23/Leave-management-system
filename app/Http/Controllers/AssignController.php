<?php

namespace App\Http\Controllers;

use App\Assign;
use App\Leave;
use App\Timetable;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AssignController extends Controller
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

    public function index(Leave $leave)
    {
        $assigns = Assign::where('leave_id', $leave->id)->get();
        return view('assign.index', compact('assigns'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Assign $assign)
    {
        $assignment = Assign::find($assign);
        foreach($assignment as $ass)
        {
            $faculty = Timetable::where('day', $ass->day)->where('time', $ass->time)->where('is_available', 1)->get();
        }
        return view('assign.create', compact('assignment','faculty'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Leave $leave)
    {
        //
        $schedules = Timetable::where('user_id', $leave->user_id)->where('day', Carbon::parse($leave->date)->format('l'))->where('is_available', false)->get();

        foreach($schedules as $schedule){
            Assign::create([
                'date' => $leave->date,
                'leave_id' => $leave->id,
                'day' => $schedule->day,
                'time' => $schedule->time
            ]);
        }

        return redirect('/leave/'.$leave->id.'/assign/');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Assign  $assign
     * @return \Illuminate\Http\Response
     */
    public function show(Assign $assign)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Assign  $assign
     * @return \Illuminate\Http\Response
     */
    public function edit(Assign $assign)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Assign  $assign
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Assign $assign)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Assign  $assign
     * @return \Illuminate\Http\Response
     */
    public function destroy(Assign $assign)
    {
        //
    }

    public function request(Assign $assign, Leave $leave, User $user)
    {
        Assign::where('id', $assign->id )->update(['assignee'=>$user->id,'assignee_status'=>'requested']);
        $assigned = Assign::find($assign);
        foreach ($assigned as $ass)
        {
            $ass;
        }
        return redirect('/leave/'.$ass->leave_id.'/assign');
    }

    public function approve(Assign $assign)
    {
        Assign::where('id', $assign->id)->update(['assignee_status'=>'approved','hod_status'=>'requested']);
        return redirect('/home');
    }

    public function decline(Assign $assign)
    {
        Assign::where('id', $assign->id)->update(['assignee_status'=>'declined']);
        return redirect('/home');
    }

    public function approveHod(Assign $assign)
    {
        Assign::where('id', $assign->id)->update(['hod_status'=>'approved', 'is_assigned'=>true]);
        return redirect('/home');
    }

    public function declineHod(Assign $assign)
    {
        Assign::where('id', $assign->id)->update(['hod_status'=>'declined']);
        return redirect('/home');
    }
}
