<?php

namespace App\Http\Controllers;

use App\User;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        return view('lembur.request');
    }
    public function history()
    {
        return view('lembur.history');
    }

    public function add(Request $request)
    {
        $body = $request->input();
        $dateNow = date("Y-m-d H:i:s");
        DB::table('lembur')->insert(
            [
                'entry_by' => "admin",
                'time_from' => $dateNow,
                'time_until' => $dateNow,
                'description' => $body['activity'],
                'insertDate' => $dateNow,
                'status' => '0',
                'approved_by' => $body['assigned'],
                'updated_at' => $dateNow
            ]
        );
        return redirect('home');
    }
}
