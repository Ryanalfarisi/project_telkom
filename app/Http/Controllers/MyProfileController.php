<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileRequest;
use App\Http\Requests\PasswordRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Hashing\BcryptHasher;

class MyProfileController extends Controller
{
    /**
     * Show the form for editing the profile.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $user = Auth::user();
        if($user->grade == 'I' || $user->grade == 'II' || $user->grade == 'III') {
            $super = true;
        } else {
            $super = false;
        }

        $jabatan = DB::table('jabatan')->get();
        $lembur = DB::table('lembur')
                ->where('lembur.poin','!=', 0)
                ->join('jobs_extra', 'lembur.job', '=', 'jobs_extra.id')
                ->join('users', 'lembur.approved_id', '=', 'users.id')
                ->select('lembur.*', 'jobs_extra.jobs_name as jobname', 'users.username as app_name')
                ->where('lembur.user_id', $user->id)->get();
        $grade = [
            "I" =>"I",
            "II" => "II",
            "III" => "III",
            "IV" => "IV",
            "V" => "V",
            "VI" => "VI"
        ];
        $user = DB::table('users')
            ->join('jabatan', 'users.code_jabatan', '=', 'jabatan.code_jabatan')
            ->where('users.id', $user->id)
            ->select('users.*', 'jabatan.jabatan as status_jabatan')
            ->get()->toArray();
        return view('profile.index',[
            "user" => $user[0],
            "jabatan" => $jabatan,
            "grade" => $grade,
            "super" => $super,
            "lembur" => $lembur
        ]);
    }

    public function reset()
    {
        $ask = DB::table('pertanyaan')->get();
        return view('profile.reset', ['ask' =>$ask]);
    }

    public function editProfile(Request $request)
    {
        $input = $request->input();
        if($input['grade'] == 'I' || $input['grade'] == 'II' || $input['grade'] == 'III') {
            $code_jabatan = 'SM';
        } else {
            $code_jabatan = 'OFF_1';
        }
        DB::table('users')
              ->where('username', $input['username'])
              ->where('id', $input['userId'])
              ->update([
                  'nik' => $input['nik'],
                  'jabatan' => $input['jabatan'],
                  'code_jabatan' => $code_jabatan,
                  'grade' => $input['grade'],
                  'lokasi' => $input['lokasi'],
                  'unit' => $input['unit'],
                ]);
        return redirect()->route('home.my_profile')->with('status', 'Profile has been updated');
    }

    public function changePass(Request $request)
    {
        $input = $request->input();
        $user = User::find($input['userId']);
        if (Hash::check($input['current'], $user->password)) {
            if(strlen($input['password']) < 8) {
                return back()->withErrors(['Password  min-length 8']);
            }
            if($input['password'] != $input['repassword']) {
                return back()->withErrors(['Re-type Password not match']);
            }
            DB::table('users')
              ->where('username', $input['username'])
              ->where('id', $input['userId'])
              ->update(['password' => Hash::make($input['password'])]);

            Auth::logout();
            return redirect('/login')->with('status', 'Password successfully updated. Please login with that credentials');
        } else {
            return back()->withErrors(['Your current password incorrect']);
        }
    }

    public function doReset(Request $request)
    {
        $input = $request->input();
        $username = DB::table('users')->where('username', $input['username'])->first();
        if(!$username) {
            return back()->withErrors(['Username dont exist']);
        }
        if(strlen($input['password']) <8) {
            return back()->withErrors(['Password min-length 8']);
        }
        $user = DB::table('users')
            ->join('pertanyaan', 'users.pertanyaan_id', '=', 'pertanyaan.id')
            ->where('users.username', $input['username'])
            ->where('users.pertanyaan_id', $input['ask'])
            ->where('users.jawaban', $input['jawaban'])
            ->get()->toArray();
        if(!$user) {
            return back()->withErrors(['Your question and answer did not match, failed password reset']);
        }
        DB::table('users')
              ->where('username', $input['username'])
              ->update(['password' => Hash::make($input['password'])]);
        return redirect()->back()->with('success', 'Password successfully updated. Please login with that credentials');
    }

    public function edit()
    {
        $ask = DB::table('pertanyaan')->get();
        return view('profile.edit', ['ask' => $ask]);
    }

    /**
     * Update the profile
     *
     * @param  \App\Http\Requests\ProfileRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(ProfileRequest $request)
    {
        auth()->user()->update($request->all());

        return back()->withStatus(__('Profile successfully updated.'));
    }

    /**
     * Change the password
     *
     * @param  \App\Http\Requests\PasswordRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function password(PasswordRequest $request)
    {
        auth()->user()->update(['password' => Hash::make($request->get('password'))]);

        return back()->withStatusPassword(__('Password successfully updated.'));
    }
}
