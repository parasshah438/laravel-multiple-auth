<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use Auth;
use App\Teacher;
use Image;
use Hash;

class TeacherDashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:teachers');
    }

    public function index()
    {
        return view('teacher.dashboard');
    }

    public function profile()
    {
        return view('teacher.profile');
    }

    public function update_profile(Request $request)
    {

        $id = Auth::guard('teachers')->user()->id; 
        $data = Teacher::find($id);
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
            $destinationPath = public_path('/teacher_profile');
            $thumb_img = Image::make($image->getRealPath())->resize(100, 100);
            $thumb_img->save($destinationPath.'/'.$imagename,80);  
            $data->image = $imagename;  
        }
        $data->save();
        return redirect('teacher/profile')->with('success','Profile updated successfully');
    }

    public function logout()
    {	
    	Auth::guard('teachers')->logout();
    	//Session::flush();
  		return redirect('/teacher')->with('success','You have successfully logged out');
    }
}
