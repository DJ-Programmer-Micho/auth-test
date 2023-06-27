<?php

namespace App\Http\Controllers\Other;

use App\Http\Controllers\Controller;
use App\Models\Other\WhyChooseUs;
use Illuminate\Http\Request;

class WhyChooseUsController extends Controller
{

    public function index() {
        $item = WhyChooseUs::find(1);
        $properties = optional($item)->properties ? json_decode($item->properties, true) : null;

        return view('admin.pages.whyChooseUs.index', compact('properties'));
    } //End Method

    public function create(){
        $item = WhyChooseUs::find(1);
        
        if (!$item) {
            $item = new WhyChooseUs();
            $item->id = 1;
            $item->save();
        }

        $properties = optional($item)->properties ? json_decode($item->properties, true)[0] : null;
 
        return view('admin.pages.whyChooseUs.create', compact('properties'));
    } //End Function

    public function store(Request $request){
        $data = [];
        $specificId = 1;
        $img = $request->file('croppedImg');
        
        $imgPath = null;

        if ($img) {
            $filename = date('YdmHi')  .$img->getClientOriginalName(). '.jpg';
            $resizedImage = resizeAndCompress($img, 1080, 1080);
            $resizedImage->save(public_path('admin/slider/' . $filename),60);
            $imgPath = $filename;
        } else {
            $previousSlide = WhyChooseUs::where('id', $specificId)->first();
            $previousData = json_decode($previousSlide->properties, true);
            $imgPath = $previousData[0]['img'] ?? null;
        };

        $data[] = [
            'tag_title' => $request->input('tag_title'), 
            'title' => $request->input('title'),  
            'title0' => $request->input('title0'), 
            'shortDescription0' => $request->input('shortDescription0'), 
            'icon0' => $request->filled('icon0') ? $request->input('icon0') : $previousData[0]['icon0'] ?? null,
            'title1' => $request->input('title1'), 
            'shortDescription1' => $request->input('shortDescription1'), 
            'icon1' => $request->filled('icon1') ? $request->input('icon1') : $previousData[0]['icon1'] ?? null, 
            'title2' => $request->input('title2'), 
            'shortDescription2' => $request->input('shortDescription2'), 
            'icon2' => $request->filled('icon2') ? $request->input('icon2') : $previousData[0]['icon2'] ?? null,
            'title3' => $request->input('title3'), 
            'shortDescription3' => $request->input('shortDescription3'), 
            'icon3' => $request->filled('icon3') ? $request->input('icon3') : $previousData[0]['icon3'] ?? null,   
            'img' => $imgPath,
        ];

        WhyChooseUs::where('id', $specificId)->update([
            'properties' => json_encode($data),
        ]);

        return redirect()->route('wcu.index');
    } //End Function
}
