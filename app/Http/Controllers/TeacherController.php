<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Hash;
use App\Teacher;
use Illuminate\Http\Request;
use Auth;

class TeacherController extends Controller
{   
    use AuthenticatesUsers;

    protected $maxAttempts = 3; 
    protected $decayMinutes = 1;

    public function __construct()
    {
        $this->middleware('guest:teachers', ['except' => ['logout']]);
    }

    public function create()
    {
        return view('teacher.register');
    }

    public function login()
    {
        return view('teacher.login');
    }

    public function dologin(Request $request)
    {   
        $this->validate($request,
        [
            'email'=>'required',
            'password' => 'required'
        ],
        [
            'email.required'=>'Email is required',
            'password.required'=>'Password is required'
        ]);

        $data =
        [
          'email' => $request->input("email"),
          'password' => $request->input('password')
        ];

         //check if the user has too many login attempts.
        if ($this->hasTooManyLoginAttempts($request)){
            //Fire the lockout event.
            $this->fireLockoutEvent($request);
            //redirect the user back after lockout.
            return $this->sendLockoutResponse($request);
        }

        if(Auth::guard('teachers')->attempt($data)){
            if(Auth::guard('teachers')->check()){
                return redirect('teacher/dashboard')->with('success', 'You are successfully logged in');
            }
        }
        else{
            $this->incrementLoginAttempts($request);
            return redirect('teacher')->with("error",'These credentials do not match our records.');

        }
    }
    public function store(Request $request)
    {
        $this->validate($request,
        [
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
            'cpassword' => 'required',
        ]);

        $email = $request->input('email');

        $checkemail = Teacher::where('email',$email)->count();
        if($checkemail > 0)
        {
            echo "email_exists";
            exit;
        }
        else
        {
            $data = new Teacher;
            $data->name = $request->input('name');
            $data->email = $request->input('email');
            $data->password = Hash::make($request->input('password'));
            $data->save();
            $data->save();
        }
        return response()->json(array('success'=>'Successfully register with us'));    
    }

    public function checkemail(Request $request)
    {

        $email = $request->input('email');
        $checkemail = Teacher::where('email',$email)->count();
        if($checkemail > 0)
        {
           echo "not_unique";
        }
        else{
            echo "unique";
        }    
    }   
}
