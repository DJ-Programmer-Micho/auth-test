<?php

namespace App\Http\Controllers\Home;

use App\Models\Components\HomeSlide;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use App\Helpers\ImageCompAndResize;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage; //NEW Facade

class HomeSliderController extends Controller
{
    public function index()
    {
        //Fixed Function Var
        $specificId = 1;
        $item = HomeSlide::find($specificId);

        // One Shot Condition if Data is Empty
        if (!$item) {
            $item = new HomeSlide();
            $item->id = 1;
            $item->save();
            $data = [ 
                [
                    'id' => $specificId, 
                    'short_title' => 'MET IRAQ', 
                    'title' => 'This Is The #1 Slide', 
                    'button_txt1' => 'Company',
                    'button_url1' => 'https://metiraq.com',
                    'button_txt2' => 'Email Us',
                    'button_url2' => 'mailto:support@metiraq.com',
                    'img' => 'slide1-demo.jpg',
                ],
                [
                    'id' => $specificId, 
                    'short_title' => 'Laravel', 
                    'title' => 'This Is The #2 Slide', 
                    'button_txt1' => 'About Us',
                    'button_url1' => 'https://metiraq.com/html/about.html',
                    'button_txt2' => 'Call Us',
                    'button_url2' => 'tel:+9647501903720',
                    'img' => 'slide2-demo.png',
                ],
                [
                    'id' => $specificId, 
                    'short_title' => 'CSM', 
                    'title' => 'This Is The #3 Slide', 
                    'button_txt1' => 'Register',
                    'button_url1' => '/register',
                    'button_txt2' => 'Dashboard',
                    'button_url2' => '/dashbord',
                    'img' => 'slide3-demo.png',
                ],

            ];
            $get_file_data_slide1 = file_get_contents(public_path('admin/demo/slide1-demo.jpg'));
            $get_file_data_slide2 = file_get_contents(public_path('admin/demo/slide2-demo.png'));
            $get_file_data_slide3 = file_get_contents(public_path('admin/demo/slide3-demo.png'));
            Storage::disk('s3')->put('ttsiraq/homeSlider/slide1-demo.jpg', $get_file_data_slide1, 'public');
            Storage::disk('s3')->put('ttsiraq/homeSlider/slide2-demo.png', $get_file_data_slide2, 'public');
            Storage::disk('s3')->put('ttsiraq/homeSlider/slide3-demo.png', $get_file_data_slide3, 'public');

            $item->properties = json_encode($data);
            $item->save();

            $properties = optional($item)->properties ? json_decode($item->properties, true) : null;
            return view('admin.pages.homeSlider.index', compact('properties'));
        }// End of One Shot Condition if Data is Empty
        $properties = optional($item)->properties ? json_decode($item->properties, true) : null;
        return view('admin.pages.homeSlider.index', compact('properties'));
    } //End Function

    public function create()
    {
        //Fixed Function Var
        $specificId = 1;
        $item = HomeSlide::find($specificId);

        // One Shot Condition if Data is Empty
        if (!$item) {
            $item = new HomeSlide();
            $item->id = $specificId;
            $item->save();
            $data = [ 
                [
                    'id' => $specificId, 
                    'short_title' => 'MET IRAQ', 
                    'title' => 'This Is The #1 Slide', 
                    'button_txt1' => 'Company',
                    'button_url1' => 'https://metiraq.com',
                    'button_txt2' => 'Email Us',
                    'button_url2' => 'mailto:support@metiraq.com',
                    'img' => 'slide1-demo.jpg',
                ],
                [
                    'id' => $specificId, 
                    'short_title' => 'Laravel', 
                    'title' => 'This Is The #2 Slide', 
                    'button_txt1' => 'About Us',
                    'button_url1' => 'https://metiraq.com/html/about.html',
                    'button_txt2' => 'Call Us',
                    'button_url2' => 'tel:+9647501903720',
                    'img' => 'slide2-demo.png',
                ],
                [
                    'id' => $specificId, 
                    'short_title' => 'CSM', 
                    'title' => 'This Is The #3 Slide', 
                    'button_txt1' => 'Register',
                    'button_url1' => '/register',
                    'button_txt2' => 'Dashboard',
                    'button_url2' => '/dashbord',
                    'img' => 'slide3-demo.png',
                ],

            ];
            $get_file_data_slide1 = file_get_contents(public_path('admin/demo/slide1-demo.jpg'));
            $get_file_data_slide2 = file_get_contents(public_path('admin/demo/slide2-demo.png'));
            $get_file_data_slide3 = file_get_contents(public_path('admin/demo/slide3-demo.png'));
            Storage::disk('s3')->put('ttsiraq/homeSlider/slide1-demo.jpg', $get_file_data_slide1, 'public');
            Storage::disk('s3')->put('ttsiraq/homeSlider/slide2-demo.png', $get_file_data_slide2, 'public');
            Storage::disk('s3')->put('ttsiraq/homeSlider/slide3-demo.png', $get_file_data_slide3, 'public');

            $item->properties = json_encode($data);
            $item->save();

            $properties = optional($item)->properties ? json_decode($item->properties, true) : null;
            return view('admin.pages.homeSlider.create', compact('properties'));
        }// End of One Shot Condition if Data is Empty
        $properties = optional($item)->properties ? json_decode($item->properties, true) : null;
        return view('admin.pages.homeSlider.create', compact('properties'));
    } //End Function

    public function store(Request $request)
    {
        $data = [];
        $specificId = 1;

        for ($i = 0; $i < 3; $i++) {
            $short_title = $request->input('head_title' . $i);
            $title = $request->input('title' . $i);
            $btx1 = $request->input('button_txt1' . $i);
            $btu1 = $request->input('button_url1' . $i);
            $btx2 = $request->input('button_txt2' . $i);
            $btu2 = $request->input('button_url2' . $i);
            $img = $request->file('croppedImg' . $i);
            
            if($request->hasFile('croppedImg' . $i)){
                $find = HomeSlide::find(1);
                $imgFound = json_decode($find->properties, true)[$i]['img'];
                Storage::disk('s3')->delete('ttsiraq/homeSlider/' . $imgFound );
            }

            $imgPath = null;

            if ($img) {
                $filename = date('YdmHi') .date('v') .$img->getClientOriginalName(). '.jpg';
                $resizedImage = resizeAndCompress($img, 1280, 480);
                $compressedImageData = $resizedImage->encode('jpg', 60)->__toString();
                Storage::disk('s3')->put('ttsiraq/homeSlider/' . $filename, $compressedImageData, 'public');
                $imgPath = $filename;
            } else {
                $previousSlide = HomeSlide::where('id', $specificId)->first();
                $previousData = json_decode($previousSlide->properties, true);
                $imgPath = $previousData[$i]['img'] ?? null;
            }

            $data[] = [
                'id' => $specificId, 
                'short_title' => $short_title, 
                'title' => $title, 
                'button_txt1' => $btx1,
                'button_url1' => $btu1,
                'button_txt2' => $btx2,
                'button_url2' => $btu2,
                'img' => $imgPath,
            
            ];
        }

        HomeSlide::where('id', $specificId)->update([
            'properties' => json_encode($data),
        ]);
  
        $notification = array(
            'message' => 'Blog Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('home.index')->with($notification);
    } //End Function
}
