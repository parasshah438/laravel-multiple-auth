<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Session;
use App\Students;
use Image;
use Hash;

class StudentDashboardController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth:students');
    }   

    public function index()
    {
        return view('students.dashboard');
    }

    public function profile()
    {
        return view('students.profile');
    }

    public function update_profile(Request $request)
    {

        $id = Auth::guard('students')->user()->id; 
        $data = Students::find($id);
        $data->name = $request->input('name');
        $data->email = $request->input('email');

        if($password = $request->input('password')) {
            if(Hash::check($request->get('password'), Auth::user()->password)) {
                return redirect()->back()->with("error","New Password cannot be same as your current password. Please choose a different password");
            }
            else
            {
                $data->password = Hash::make($request->input('password'));
            }
        }  

        $image = $request->file('image');
        if($image)
        {
            $imagename = $image->getClientOriginalName();  
            $destinationPath = public_path('/student_profile');
            $thumb_img = Image::make($image->getRealPath())->resize(100, 100);
            $thumb_img->save($destinationPath.'/'.$imagename,80);  
            $data->image = $imagename;  
        }
        $data->save();
        return redirect('student/profile')->with('success','Profile updated successfully');
    }

    
    public function logout()
    {
    	Auth::guard('students')->logout();
        //Session::flush();
  		return redirect('/student')->with('success','You have successfully logged out');
    }
}
