<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Auth;
use App\Admin;
use Hash;

class AdminController extends Controller
{
    use AuthenticatesUsers;

    protected $maxAttempts = 3; 
    protected $decayMinutes = 1;

    public function __construct()
    {
        $this->middleware('guest:admins', ['except' => ['logout']]);
    }

    public function login()
    {
        return view('admin.login');
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

        $data = [
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

        if(Auth::guard('admins')->attempt($data)){
            if(Auth::guard('admins')->check()){
                return redirect('admin/dashboard')->with('success', 'You are successfully logged in'); 
            }
        }
        else{
            $this->incrementLoginAttempts($request);
            return redirect('admin')->with("error",'These credentials do not match our records.');
        }
}

    public function create()
    {
        return view('admin.register');
    }

    public function checkemail(Request $request){

        $email = $request->input('email');

        $checkemail = Admin::where('email',$email)->count();
        if($checkemail > 0)
        {
           echo "not_unique";
           exit;
        }
        else{
            echo "unique";
        }    
    }

    public function store(Request $request)
    {
        $this->validate($request,
        [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $email = $request->input('email');
        $checkemail = Admin::where('email',$email)->count();
        if($checkemail > 0)
        {
            echo "email_exists";
            exit;
        }
        else
        {
            $data = new Admin;
            $data->name = $request->input('name');
            $data->password = Hash::make($request->input('password'));
            $data->email = $request->input('email');
            $data->save();
        }
        return response()->json(array('success'=>'Successfully register with us'));    
    }
}
