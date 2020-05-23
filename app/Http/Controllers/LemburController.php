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
        $assigned = DB::table('users')->where('code_jabatan', '!=', 'STAFF')->get();
        return view('lembur.request', ['assigned' => $assigned]);
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
            DB::table('lembur')->insert(
                [
                    'username' => $user->username,
                    'user_id' => $user->id,
                    'time_from' => $body['insert_date'].' '.$body['startTime'],
                    'time_until' => $body['insert_date'].' '.$body['endTime'],
                    'description' => $activity,
                    'insert_date' => $body['insert_date'],
                    'status' => '0',
                    'result' => $body['result'],
                    'kpi' => $body['kpi'],
                    'created_at' => $dateNow,
                    'approved_id' => $body['assigned'],
                ]
            );
        }
        return redirect('home');
    }
}
