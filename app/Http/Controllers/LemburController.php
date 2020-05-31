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
                    ->whereIn('users.grade', ['I', 'II', 'III'])
                    ->select('users.*','jabatan.jabatan as jabatan','jabatan.code_jabatan as code_jabatan', 'jabatan.grade as grade')
                    ->get();
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
            $newDate = $body['insert_date'];
            if($body['is_overtime']) {
                $newDate = date('Y-m-d', strtotime($newDate . ' +1 day'));
            }
            $time_from = $body['insert_date'].' '.$body['startTime'];
            $time_until = $newDate.' '.$body['endTime'];
            $payload = [
                'username' => $user->username,
                'user_id' => $user->id,
                'time_from' => $time_from,
                'time_until' => $time_until,
                'description' => $activity,
                'insert_date' => $body['insert_date'],
                'location' => $body['location'],
                'status' => '5', // sirkulir
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
                $this->sendNotifications($payload['user_id'], $payload['approved_id'], $desc, $lastId, '5');
            }
        }
        return redirect('home');
    }

    public function edit($id)
    {
        $user = Auth::user();
        $super = in_array($user->grade, config('global.grade_manager')) ? true : false;
        $lembur = DB::table('lembur')->find($id);
        $assigned = DB::table('users')
                    ->leftJoin('jabatan', 'users.code_jabatan', '=', 'jabatan.code_jabatan')
                    ->whereIn('users.grade', ['I', 'II', 'III'])
                    ->select('users.*','jabatan.jabatan as jabatan','jabatan.code_jabatan as code_jabatan', 'jabatan.grade as grade')->get();
        $jobs = DB::table('jobs_extra')->get();
        return view('lembur.edit', ['assigned' => $assigned, 'jobs' => $jobs, 'lembur' => $lembur,  'super' => $super]);

    }

    public function doEdit(Request $request)
    {
        $user = Auth::user();
        $body = $request->input();
        $dateNow = date("Y-m-d H:i:s");
        if(isset($body['status_lembur']) && $body['super_user']) {
            DB::table('lembur')->where('id' , $body['lembur_id'])->update([
                'status' => $body['status_lembur'],
                'updated_at' => $dateNow
            ]);
            $desc = "Lembur telah di approved";
            $this->sendNotifications($user->id, $body['user_id'], $desc, $body['lembur_id'], $body['status_lembur']);
            return redirect('home');
        }
        foreach ($body['activity'] as $key => $activity) {
            if(is_null($activity) || trim($activity) == '') continue;
            $newDate = $body['insert_date'];
            if($body['is_overtime']) {
                $newDate = date('Y-m-d', strtotime($newDate . ' +1 day'));
            }
            $time_from = $body['insert_date'].' '.$body['startTime'];
            $time_until = $newDate.' '.$body['endTime'];
            if($key == 0) {
                $payload = [
                    'username' => $user->username,
                    'user_id' => $user->id,
                    'time_from' => $time_from,
                    'time_until' => $time_until,
                    'description' => $activity,
                    'insert_date' => $body['insert_date'],
                    'status' => '5', // sirkulir
                    'location' => $body['location'],
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
                    'time_from' => $time_from,
                    'time_until' => $time_until,
                    'description' => $activity,
                    'insert_date' => $body['insert_date'],
                    'status' => '1', // sirkulir
                    'location' => $body['location'],
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
}
