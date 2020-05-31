<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

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
        $user = Auth::user();
        $todo = $riwayat = $assign = [];
        $notif = DB::table('notifications')
                ->where('to_user_id', $user->id)
                ->where('read', 0)
                ->get();
        if(in_array($user->grade, config('global.grade_manager'))) {
            foreach ($notif as $key => $value) {
                if($value->status == 5) {
                    array_push($todo, $value);
                }
            }
            $content = isset($_GET['content']) ? $_GET['content'] : '';
            $lembur = DB::table('lembur')
                    ->leftJoin('jobs_extra', 'lembur.job', '=', 'jobs_extra.id')
                    ->leftJoin('status_task', 'lembur.status', '=', 'status_task.id')
                    ->leftJoin('users', 'lembur.user_id', '=', 'users.id')
                    ->where("approved_id",$user->id)
                    ->select('lembur.*','users.id as app_id','users.username as username', 'users.code_jabatan', 'jobs_extra.jobs_name as jobs_name', 'jobs_extra.id as job_id', 'status_task.id as status_id', 'status_task.label as label')->get();
            return view('supervisior.dashboard', [
                    'lembur' => $lembur,
                    'content' => $content,
                    'todo' => count($todo),
                    'riwayat' => count($riwayat),
                    'assign' => count($assign)
                ]);
        } else {
            foreach ($notif as $key => $value) {
                // if($value->status ) {
                    array_push($todo, $value);
                //}
            }
            $content = isset($_GET['content']) ? $_GET['content'] : '';
            $lembur = DB::table('lembur')
                    ->leftJoin('jobs_extra', 'lembur.job', '=', 'jobs_extra.id')
                    ->leftJoin('status_task', 'lembur.status', '=', 'status_task.id')
                    ->leftJoin('users', 'lembur.approved_id', '=', 'users.id')
                    ->where("user_id",$user->id)
                    ->select('lembur.*','users.id as app_id','users.username as username', 'users.code_jabatan', 'jobs_extra.jobs_name as jobs_name', 'jobs_extra.id as job_id', 'status_task.id as status_id', 'status_task.label as label')->get();
            return view('layouts.custome_view.dashboard', [
                    'lembur' => $lembur,
                    'content' => $content,
                    'super' => false,
                    'todo' => count($todo),
                    'riwayat' => count($riwayat),
                    'assign' => count($assign)
                ]);
        }
    }
}
