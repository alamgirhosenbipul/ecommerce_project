<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Topslider;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class SliderController extends Controller
{
    public function index(){

        $slider = Topslider::latest()->get();

        return view('admin.slider.index',compact('slider'));
    }


    //slider store

    public function store(Request $request){

        $request->validate([

            'image'=>'required',

        ]);

        if($request->file('image')){

            $image = $request->file('image');
            $manager = new ImageManager(new Driver());
            $name_gen = rand(9999,4444).'.'.$image->getClientOriginalExtension();
            $img = $manager->read($image);
            $img = $img->resize(870,370);
            $img->toJpeg(80)->save(base_path('public/uploads/slider/'.$name_gen));
            $save_url= 'uploads/slider/'.$name_gen;

            Topslider::insert([

                'title_en'=>$request->title_en,
                'title_bn'=>$request->title_bn,
                'description_en'=>$request->description_en,
                'description_bn'=>$request->description_bn,
                'image'=>$save_url,
                'created_at'=>Carbon::now(),
            ]);
    
            $notification = array(
                
                'message'=>'Slider insert success!',
                'alert_type'=>'success',
            );
    
            return redirect()->back()->with($notification);


        }
      
    }
  

    //slider edit

    public function edit($id){

      $slider =  Topslider::findOrFail($id);

      return view('admin.slider.edit',compact('slider'));


    }

    //slider update

    public function update(Request $request,$id){

        $request->validate([

            'image'=>'required',
        ]);

        if($request->file('image')){

            $image = $request->file('image');
            $manager = new ImageManager(new Driver());
            $name_gen = rand(9999,4444).'.'.$image->getClientOriginalExtension();
            $img = $manager->read($image);
            $img = $img->resize(870,370);
            $img->toJpeg(80)->save(base_path('public/uploads/slider/'.$name_gen));
            $save_url= 'uploads/slider/'.$name_gen;
        
        Topslider::findOrFail($id)->update([

            'title_en'=>$request->title_en,
            'title_en'=>$request->title_bn,
            'description_en'=>$request->description_en,
            'description_bn'=>$request->description_bn,
            'image'=>$save_url,
            'updated_at'=>Carbon::now(),
        ]);

        $notification = array(
            'message'=>'Slider updated successfully!',
            'alert-type'=>'success',
        );

        return redirect()->route('slider')->with($notification);
    }

}

    //Slider delete

    public function delete($id){

       $old_image = Topslider::findOrFail($id);

       unlink($old_image->image);

       Topslider::findOrFail($id)->delete();
       
       $notification = array(
        'message' => 'Slider delete success!',
        'alert-type'=>'error',
       );

       return redirect()->back()->with($notification);
    }


   
    //product inactive route

    public function inactive($id){

      Topslider::findOrFail($id)->update([

        'status'=> 0
      ]);

      $notification = array(
        'message'=>'Product inactive successfully!',
        'alert-type'=>'error',
    );
    return redirect()->back()->with($notification);

    }



        //product active route

        public function active($id){

          Topslider::findOrFail($id)->update([
    
            'status'=> 1
          ]);
    
          $notification = array(
            'message'=>'Product active successfully!',
            'alert-type'=>'success',
        );
        return redirect()->back()->with($notification);
    
        }

}
