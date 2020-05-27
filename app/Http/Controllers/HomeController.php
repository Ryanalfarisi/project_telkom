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
        $content = isset($_GET['content']) ? $_GET['content'] : '';
        $lembur = DB::table('lembur')
                  ->leftJoin('jobs_extra', 'lembur.job', '=', 'jobs_extra.id')
                  ->leftJoin('status_task', 'lembur.status', '=', 'status_task.id')
                  ->leftJoin('users', 'lembur.approved_id', '=', 'users.id')
                  ->select('lembur.*','users.id as app_id','users.username as username', 'users.code_jabatan', 'jobs_extra.jobs_name as jobs_name', 'jobs_extra.id as job_id', 'status_task.id as status_id', 'status_task.label as label')->get();
        return view('layouts.custome_view.dashboard', ['lembur' => $lembur, 'content' => $content]);
    }
}
