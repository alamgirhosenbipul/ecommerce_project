<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Illuminate\Support\Facades\Hash;



class AdminController extends Controller
{
    public function index(){
        return view('admin.home');
    }


    //profile update
    
    public function ProfileHome(){
        return view('admin.profile.home');
    }

    public function updateProfile(Request $request){

        $request->validate([
            'name'=>'required',
            'email'=>'required',
          
        ]);

        User::findOrFail(Auth::id())->update([

            'name'=>$request->name,
            'email'=>$request->email,
      
        ]);

        $notification = array(
            'message'=>'Profile update successfully!',
            'alert-type'=>'success',
        );
        return redirect()->back()->with($notification);
    }

//show admin image
    public function showImage(){
        return view('admin.profile.showImage');
    }
//admin image update
    public function updateImage(Request $request){

        $old_image = $request->old_image;

        if(Auth::user()->image == 'frontend/media/image1.jpg'){


            if($request->file('image')){
                $image = $request->file('image');
                $manager = new ImageManager(new Driver());
                $name_gen = rand(9999,8888).'.'.$image->getClientOriginalExtension();
                $img = $manager->read($image);
                $img = $img->resize(100,100);
                $img->toJpeg(80)->save(base_path('public/frontend/media/'.$name_gen));
                $save_url= 'frontend/media/'.$name_gen;



                User::findOrFail(Auth::id())->update([

                    'image' => $save_url,
                    
                ]);
    
                 $notification = array(
                'message'=>'Image update successfully!',
                'alert-type'=>'success',
            );
            return redirect()->back()->with($notification);

            }
            
        }


        if($request->file('image')){

                  unlink($old_image);
                  $image = $request->file('image');
                  $manager = new ImageManager(new Driver());
                  $name_gen = rand(9999,8888).'.'.$image->getClientOriginalExtension();
                  $img = $manager->read($image);
                  $img = $img->resize(100,100);
                  $img->toJpeg(80)->save(base_path('public/frontend/media/'.$name_gen));
                  $save_url= 'frontend/media/'.$name_gen;
  
  
  
                  User::findOrFail(Auth::id())->update([
  
                      'image' => $save_url,
                      
                  ]);
      
                   $notification = array(
                  'message'=>'Image update successfully!',
                  'alert-type'=>'success',
              );
              return redirect()->back()->with($notification);

            }
      
    }


    //show password
    public function showPassword(){
        return view('admin.profile.showPassword');
    }

    //update password

    public function updatePassword(Request $request){

        $db_pass = Auth::user()->password;

        $old_pass = $request->oldPassword;
        $new_pass = $request->newPassword;
        $confirm_pass = $request->password_confirmation;

        if(Hash::check($old_pass,$db_pass)){
            if($new_pass === $confirm_pass){

                User::findOrFail(Auth::id())->update([

                    'password'=>Hash::make($new_pass)
                ]);

                Auth::logout();

                $notification = array(
                    'message'=>'Password change sucessfully!',
                    'alert-type'=>'success',
                );
                return redirect()->route('login')->with($notification);  

            }else{
                $notification = array(
                    'message'=>'Confirm password does not match!',
                    'alert-type'=>'error',
                );
                return redirect()->back()->with($notification);  
            }
        }else{
            $notification = array(
                'message'=>'old password do not match!',
                'alert-type'=>'error',
            );
            return redirect()->back()->with($notification);
        }

    }

}
