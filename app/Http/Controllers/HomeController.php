<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;

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
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $lembur = DB::table('lembur')
                  ->leftJoin('jobs_extra', 'lembur.job', '=', 'jobs_extra.id')
                  ->leftJoin('status_task', 'lembur.status', '=', 'status_task.id')
                  ->leftJoin('users', 'lembur.approved_id', '=', 'users.id')->get();
        return view('layouts.custome_view.dashboard', ['lembur' => $lembur]);
    }
}
