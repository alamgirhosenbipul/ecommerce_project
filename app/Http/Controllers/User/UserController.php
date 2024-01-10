<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;


class UserController extends Controller
{
    public function UserUpdate(Request $request){

        $request->validate([

            'name'=>'required',
            'email'=>'required',
           
        ]);

        User::findOrFail(Auth::id())->update([

            'name'=>$request->name,
            'email'=>$request->email,
            'updated_at'=>Carbon::now(),
        ]);


        $notification = array(
            'message'=>'User profile update successfully!',
            'alert-type'=>'success',
        );

        return redirect()->back()->with($notification);
    }

    //user profile update end

    //user image update start

    public function userImage(){

        return view('user.userImage');
    }

    public function userImageUpdate(Request $request){

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
      //user image update end
      //user password updata

      public function UserPassword(){

        return view('user.showUserPassword');
      }

      public function userPasswordUpdate(Request $request){

        $request->validate([
            
            'oldPassword'=>'required',
            'newPassword'=>'required',
            'password_confirmation'=>'required',
        ]);

        $db_pass = Auth::user()->password;
        $old_pass = $request->oldPassword; 
        $new_pass = $request->newPassword; 
        $con_pass = $request->password_confirmation; 

        if(Hash::check($old_pass,$db_pass)){

            if($new_pass === $con_pass){

                User::findOrFail(Auth::id())->update([

                    'password'=>Hash::make($new_pass),
                ]);
                Auth::logout();

                $notification = array(
                            
                    'message'=>' password changed successfully.Now login with new password!',
                    'alert-type'=>'success',
                );
                return redirect()->route('login')->with($notification); 

            }else{
                $notification = array(
                    'message'=>'Confirm password dosenot match!',
                    'alert-type'=>'error',
                );
                return redirect()->back()->with($notification);  
            }

        }else{
            $notification = array(
                'message'=>'Old password dosenot match!',
                'alert-type'=>'error',
            );
            return redirect()->back()->with($notification);
        }
      }
}
