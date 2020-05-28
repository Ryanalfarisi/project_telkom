<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function showRegistrationForm()
    {
        $jabatan = DB::table('jabatan')->get();
        $ask = DB::table('pertanyaan')->get();
        $grade = [
            "I" =>"I",
            "II" => "II",
            "III" => "III",
            "IV" => "IV",
            "V" => "V",
            "VI" => "VI"
        ];
        return view('auth.register', ['jabatan' => $jabatan, 'grade' => $grade, 'ask' => $ask]);
    }
    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'username' => ['required', 'string', 'max:255', 'unique:users'],
            'nik' => ['required', 'string', 'max:255', 'unique:users'],
            // 'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $grade_staff = config('global.grade_staff');
        $grade_manager = config('global.grade_manager');
        $trimJawaban = strtolower($data['jawaban']);
        $realJawaban = preg_replace('/\s+/', '', $trimJawaban);
        if(in_array($data['grade'], $grade_staff)) {
            $code_jabatan = "SM";
        } elseif(in_array($data['grade'], $grade_manager)) {
            $code_jabatan = "OFF_1";
        }
        $created = [
            'username' => $data['username'],
            'pertanyaan_id' => $data['ask'],
            'jawaban' => $realJawaban,
            'nik' => $data['nik'],
            'code_jabatan' => $code_jabatan,
            'jabatan' => $data['jabatan'],
            'grade' => $data['grade'],
            'password' => Hash::make($data['password']),
        ];
        return User::create($created);
    }
}
