<?php

namespace App\Http\Controllers;

use App\User;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class LemburController extends Controller
{
    /**
     * Display a listing of the users
     *
     * @param  \App\User  $model
     * @return \Illuminate\View\View
     */
    public function index()
    {
    }

    public function request()
    {
        $assigned = DB::table('users')
                    ->leftJoin('jabatan', 'users.code_jabatan', '=', 'jabatan.code_jabatan')
                    ->whereIn('users.grade', ['I', 'II', 'III'])->get();
        $jobs = DB::table('jobs_extra')->get();
        return view('lembur.request', ['assigned' => $assigned, 'jobs' => $jobs]);
    }
    public function history()
    {
        return view('lembur.history');
    }

    public function add(Request $request)
    {
        $body = $request->input();
        $dateNow = date("Y-m-d H:i:s");
        $user = Auth::user();
        foreach ($body['activity'] as $activity) {
            if(is_null($activity) || trim($activity) == '') continue;

            $payload = [
                'username' => $user->username,
                'user_id' => $user->id,
                'time_from' => $body['insert_date'].' '.$body['startTime'],
                'time_until' => $body['insert_date'].' '.$body['endTime'],
                'description' => $activity,
                'insert_date' => $body['insert_date'],
                'status' => '1',
                'result' => $body['result'],
                'kpi' => isset($body['kpi']) ? $body['kpi']: '',
                'type'=> $body['draft'],
                'job' => $body['job'],
                'duration' => $body['duration'],
                'created_at' => $dateNow,
                'approved_id' => $body['assigned'],
            ];
            $lastId = DB::table('lembur')->insertGetId($payload);
            $desc = "Pengajuan lembur dari ". $user->username;
            if($body['draft'] == 1) {
                $this->sendNotifications($payload, $desc, $lastId);
            }
        }
        return redirect('home');
    }

    public function edit($id)
    {
        $lembur = DB::table('lembur')->find($id);
        $assigned = DB::table('users')
                    ->leftJoin('jabatan', 'users.code_jabatan', '=', 'jabatan.code_jabatan')
                    ->whereIn('users.grade', ['I', 'II', 'III'])->get();
        $jobs = DB::table('jobs_extra')->get();
        return view('lembur.edit', ['assigned' => $assigned, 'jobs' => $jobs, 'lembur' => $lembur]);

    }

    public function doEdit(Request $request)
    {
        $user = Auth::user();
        $body = $request->input();
        $dateNow = date("Y-m-d H:i:s");
        foreach ($body['activity'] as $key => $activity) {
            if(is_null($activity) || trim($activity) == '') continue;
            if($key == 0) {
                $payload = [
                    'username' => $user->username,
                    'user_id' => $user->id,
                    'time_from' => $body['insert_date'].' '.$body['startTime'],
                    'time_until' => $body['insert_date'].' '.$body['endTime'],
                    'description' => $activity,
                    'insert_date' => $body['insert_date'],
                    'status' => '1', // inprogress
                    'result' => $body['result'],
                    'kpi' => isset($body['kpi']) ? $body['kpi']: '',
                    'type'=> $body['draft'],
                    'updated_at' => $dateNow,
                    'job' => $body['job'],
                    'duration' => $body['duration'],
                    'approved_id' => $body['assigned'],
                ];
                DB::table('lembur')->where('id' , $body['lembur_id'])->update($payload);
            } else {
                $payload = [
                    'username' => $user->username,
                    'user_id' => $user->id,
                    'time_from' => $body['insert_date'].' '.$body['startTime'],
                    'time_until' => $body['insert_date'].' '.$body['endTime'],
                    'description' => $activity,
                    'insert_date' => $body['insert_date'],
                    'status' => '1', // inprogress
                    'result' => $body['result'],
                    'kpi' => isset($body['kpi']) ? $body['kpi']: '',
                    'type'=> $body['draft'],
                    'job' => $body['job'],
                    'created_at' => $dateNow,
                    'duration' => $body['duration'],
                    'approved_id' => $body['assigned'],
                ];
                DB::table('lembur')->insert($payload);
            }
        }
        return redirect('home');
    }
    public function sendNotifications($payload, $desc, $lastId)
    {
        DB::table('notifications')->insert(
            [
                "task_id" => $lastId,
                "category" => 1,
                "from_user_id" => $payload['user_id'],
                "to_user_id" => $payload['approved_id'],
                "read" => "0",
                "status" => "0",
                "descriptions" => $desc,
                "created_at" => date("Y-m-d H:i:s")
            ]
        );
    }
}
