<?php

namespace App\Http\Controllers;

use App\User;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Arr;

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
        $user = Auth::user();
        $assigned = DB::table('users')
                    ->leftJoin('jabatan', 'users.code_jabatan', '=', 'jabatan.code_jabatan')
                    ->whereIn('users.grade', ['I', 'II', 'III'])
                    ->select('users.*','users.jabatan as jabatan','jabatan.code_jabatan as code_jabatan', 'jabatan.grade as grade')
                    ->get();
        $jobs = DB::table('jobs_extra')->get();

        $notif = DB::table('notifications')
        ->where('to_user_id', $user->id)
        ->where('read', 0)
        ->get();
        return view('lembur.request', [
            'assigned' => $assigned,
            'jobs' => $jobs,
            'user' => $user,
            'all_notif' => count($notif)
        ]);
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
            if($lastId) {
                $payload['log_id'] = $lastId;
                $payload['user_edit'] = $user->id;
                DB::table('lembur_log')->insert($payload);
            }
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
        if($user->grade == 'I' || $user->grade == 'II' || $user->grade == 'III') {
            $super = true;
        } else {
            $super = false;
        }
        $locations = [
            "Office", "Home", "Site", "FWA"
        ];
        $lembur = DB::table('lembur')->find($id);
        $assigned = DB::table('users')
                    ->leftJoin('jabatan', 'users.code_jabatan', '=', 'jabatan.code_jabatan')
                    ->whereIn('users.grade', ['I', 'II', 'III'])
                    ->select('users.*','users.jabatan as jabatan','jabatan.code_jabatan as code_jabatan', 'jabatan.grade as grade')->get();
        $jobs = DB::table('jobs_extra')->get();
        $notif = DB::table('notifications')
        ->where('to_user_id', $user->id)
        ->where('read', 0)
        ->get();
        return view('lembur.edit', ['assigned' => $assigned, 'jobs' => $jobs, 'lembur' => $lembur,  'super' => $super, 'user' => $user, 'all_notif' => count($notif), 'locations' =>$locations]);

    }

    public function doEdit(Request $request)
    {
        $user = Auth::user();
        $body = $request->input();
        $dateNow = date("Y-m-d H:i:s");
        if(isset($body['status_lembur']) && isset($body['super_user'])) {
            DB::table('lembur')->where('id' , $body['lembur_id'])->update([
                'status' => $body['status_lembur'],
                'reason' => isset($body['reason']) && $body['status_lembur'] =='7' ? $body['reason'] : null,
                'updated_at' => $dateNow
            ]);
            $lembur = DB::table('lembur')->find($body['lembur_id']);
            $lembur->log_id = $body['lembur_id'];
            $lembur->user_edit = $user->id;
            $lembur = (array)$lembur;
            $lembur = Arr::except($lembur, ['id']);
            DB::table("lembur_log")->insert($lembur);
            if($body['status_lembur'] == '3') {
                $desc = "Lembur telah di approved";
            } else if($body['status_lembur'] == '7') {
                $desc = $body['reason'];
            } else {
                $desc = "tidak teridentifikasi";
            }
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
                if($body['draft'] == 1) {
                    $this->sendNotifications($user->id, $body['assigned'], "Pengajuan lembur", $body['lembur_id'], '5');
                }
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
                $lastId = DB::table('lembur')->insertGetId($payload);
                if($body['draft'] == 1) {
                    $this->sendNotifications($payload['user_id'], $payload['approved_id'], "Pengajuan lemburt", $lastId, '5');
                }
            }
        }
        if(isset($body['super_user'])) {
            return \Redirect::route('lembur.edit', $body['lembur_id'])->with('success', 'Data berhasil di edit');
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

    public function notification(Request $request)
    {
        $body = $request->input();
        $dateNow = date("Y-m-d H:i:s");
        DB::table('notifications')
            ->where('to_user_id' , $body['to_user_id'])
            ->update([
            'read' => 1,
            'updated_at' => $dateNow
        ]);
        return response()->json(['status' => 200, 'message' => 'berhasil'], 200);
    }
}
