<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
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
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $user = Auth::user();
        $todo = $riwayat = $assign = $staff = $staffId = [];
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
                    ->leftJoin('users', 'lembur.user_id', '=', 'users.id')
                    ->leftJoin('jobs_extra', 'lembur.job', '=', 'jobs_extra.id')
                    ->leftJoin('status_task', 'lembur.status', '=', 'status_task.id')
                    ->where("lembur.approved_id",$user->id)
                    ->select('lembur.*','lembur.approved_id as approver_id', 'users.id as app_id','users.username as username', 'users.code_jabatan', 'jobs_extra.jobs_name as jobs_name', 'jobs_extra.id as job_id', 'status_task.id as status_id', 'status_task.label as label')
                    ->get();
            foreach ($lembur as $key => $v) {
                if(in_array($v->user_id, $staffId) || $v->user_id == $user->id) continue;
                    array_push($staffId, $v->user_id);
                    array_push($staff, $v);
            }
            return view('supervisior.dashboard', [
                    'lembur' => $lembur,
                    'content' => $content,
                    'todo' => count($todo),
                    'riwayat' => count($riwayat),
                    'assign' => count($assign),
                    'staff'=> $staff,
                    'user' => $user
                ]);
        } else {
            foreach ($notif as $key => $value) {
                if($value->status == '6') {
                    array_push($riwayat, $value);
                } else {
                    array_push($todo, $value);
                }
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
                    'assign' => count($assign),
                    'user' => $user
                ]);
        }
    }

    public function feedbackrating(Request $request)
    {
        $body = $request->input();
        $dateNow = date("Y-m-d H:i:s");
        $data = DB::table('lembur')->find($body['id']);
        $data = DB::table('users')->find($data->user_id);
        DB::table('lembur')->where('id' , $body['id'])->update([
            'feedback' => $body['feedback'],
            'rating' => $body['rating'],
            'achievement' => $body['achievement'],
            'poin' => $body['points'],
            'status' => 6,
            'updated_at' => $dateNow
        ]);

        DB::table('users')->where('id' , $data->id)->update([
            'poin' => $body['points']+ $data->poin,
        ]);
        return redirect('home');
    }
}
