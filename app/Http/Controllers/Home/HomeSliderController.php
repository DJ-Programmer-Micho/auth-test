<?php

namespace App\Http\Controllers\Home;

use App\Models\HomeSlide;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use App\Helpers\ImageCompAndResize;
use App\Http\Controllers\Controller;

class HomeSliderController extends Controller
{
    public function index()
    {
        $item = HomeSlide::find(1);

        $properties = optional($item)->properties ? json_decode($item->properties, true) : null;
        return view('admin.pages.homeSlider.index', compact('properties'));
    } //End Function

    public function create()
    {
        $item = HomeSlide::find(1);

        if (!$item) {
            $item = new HomeSlide();
            $item->id = 1;
            $item->save();
        }

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
            // dd($request->file('croppedImg0'),$request->file('croppedImg1'),$request->file('croppedImg2'));
            
            $imgPath = null;

            if ($img) {
                $filename = date('YdmHi')  .$img->getClientOriginalName(). '.jpg';
                $resizedImage = resizeAndCompress($img, 1280, 480);
                $resizedImage->save(public_path('admin/slider/' . $filename),60);
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
  
        return redirect()->route('home.index');
    } //End Function
}
