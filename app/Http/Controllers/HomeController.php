<?php

namespace App\Http\Controllers;

use App\Leave;
use App\Assign;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $requests = Assign::where('assignee', auth()->id())->get();

        if(auth()->user()->is_hod)
        {
            $requestsHod = Assign::where('assignee_status', 'approved')->where('hod_status', 'requested')->get();

            return view('home', compact('leaves', 'requests','requestsHod'));
        }

        return view('home', compact('leaves','requests','requestsHod'));
    }
}
