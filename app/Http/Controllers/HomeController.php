<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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
        $todo = $extra = $riwayat = $assign = $staff = $staffId = [];
        $notif = DB::table('notifications')
                ->where('to_user_id', $user->id)
                ->where('read', 0)
                ->get();
        if($user->grade == 'I' || $user->grade == 'II' || $user->grade == 'III') {
            foreach ($notif as $key => $value) {
                if($value->status == 5) {
                    array_push($todo, $value);
                }
            }
            $content = isset($_GET['content']) ? $_GET['content'] : '';
            $lembur = DB::table('lembur')
                    ->leftJoin('users', 'lembur.user_id', '=', 'users.id')
                    ->leftJoin('files', 'lembur.id', '=', 'files.lembur_id')
                    ->leftJoin('jobs_extra', 'lembur.job', '=', 'jobs_extra.id')
                    ->leftJoin('status_task', 'lembur.status', '=', 'status_task.id')
                    ->where("lembur.approved_id",$user->id)
                    ->select('lembur.*','lembur.approved_id as approver_id', 'users.id as app_id','users.full_name as username', 'users.jabatan as jabatan_baru', 'users.nik as user_nik', 'jobs_extra.jobs_name as jobs_name', 'jobs_extra.id as job_id', 'status_task.id as status_id', 'status_task.label as label', 'files.path as path', 'files.name as path_name', 'files.id as file_id')
                    ->get();
            foreach ($lembur as $key => $v) {
                if(in_array($v->user_id, $staffId) || $v->user_id == $user->id || $v->status != 6) continue;
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
                    'user' => $user,
                    'all_notif' => count($notif)
                ]);
        } else {
            foreach ($notif as $key => $value) {
                if($value->status == '6') {
                    array_push($riwayat, $value);
                } else if($value->status == '7') {
                    array_push($extra, $value);
                } else {
                    array_push($todo, $value);
                }
            }
            $content = isset($_GET['content']) ? $_GET['content'] : '';
            $lembur = DB::table('lembur')
                    ->leftJoin('jobs_extra', 'lembur.job', '=', 'jobs_extra.id')
                    ->leftJoin('files', 'lembur.id', '=', 'files.lembur_id')
                    ->leftJoin('status_task', 'lembur.status', '=', 'status_task.id')
                    ->leftJoin('users', 'lembur.approved_id', '=', 'users.id')
                    ->where("user_id",$user->id)
                    ->select('lembur.*','users.id as app_id','users.username as username', 'users.code_jabatan','users.jabatan as jabatan_baru', 'jobs_extra.jobs_name as jobs_name', 'jobs_extra.id as job_id', 'status_task.id as status_id', 'status_task.label as label', 'files.path as path', 'files.name as path_name', 'files.id as file_id')->get();
            return view('layouts.custome_view.dashboard', [
                    'lembur' => $lembur,
                    'content' => $content,
                    'super' => false,
                    'todo' => count($todo),
                    'riwayat' => count($riwayat),
                    'assign' => count($assign),
                    'extra' => count($extra),
                    'user' => $user,
                    'all_notif' => count($notif)
                ]);
        }
    }

    public function feedbackrating(Request $request)
    {
        $body = $request->input();
        $user = Auth::user();
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
        $this->sendNotifications($user->id, $data->id, "Lembur telah di beri rating", $body['id'], '6');
        return redirect('home');
    }

    public function sendNotifications($from_id, $to_id, $desc, $lastId, $status)
    {
        DB::table('notifications')->insert(
            [
                "task_id" => $lastId,
                "category" => 1,
                "from_user_id" => $from_id,
                "to_user_id" => $to_id,
                "read" => "0",
                "status" => $status,
                "descriptions" => $desc,
                "created_at" => date("Y-m-d H:i:s")
            ]
        );
    }

    public function uploadfile(Request $request) {
        $this->validate($request, [
			'file' => 'max:500000'
		]);
        // menyimpan data file yang diupload ke variabel $file
        $file = $request->file('file');
        $body = $request->input();
        echo 'File Name: '.$file->getClientOriginalName();
        echo '<br>';

                // ekstensi file
        echo 'File Extension: '.$file->getClientOriginalExtension();
        echo '<br>';

        // real path
        echo 'File Real Path: '.$file->getRealPath();
        echo '<br>';

                // ukuran file
        echo 'File Size: '.$file->getSize();
        echo '<br>';

        $mime = $file->getMimeType();
        $path_folder = env('FOLDER_PATH');
        $name = $body['lembur_id'].'-'.$file->getClientOriginalName();
        $path = $path_folder.'/'.$name;
        // upload file
        $file->move($path_folder, $name);
        $lastId = DB::table('files')->insertGetId(
            [
                "lembur_id" => $body['lembur_id'],
                "path" => $path,
                "name" => $name,
                "mime" => $mime,
                "comment" => $body['comment'],
                "created_at" => date("Y-m-d H:i:s")
            ]
        );
        return \Redirect::route('home')->with('success', 'File berhasil di Upload'); 
        //return redirect('home');
    }

    public function downloadfile($fileId) {
        $data = DB::table('files')->find($fileId);
        return response()->download($data->path, $data
                    ->name, ['Content-Type' => $data->mime]);
    }
}
