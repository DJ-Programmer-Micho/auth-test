<?php

namespace App\Http\Controllers\About;

use App\Http\Controllers\Controller;
use App\Models\About;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function index()
    {
        $item = About::find(1);
        $properties = optional($item)->properties ? json_decode($item->properties, true) : null;

        return view('admin.pages.aboutUs.index', compact('properties'));
    } //End Method

    public function create()
    {
        $item = About::find(1);

        if (!$item) {
            $item = new About();
            $item->id = 1;
            $item->save();
        }

        $properties = optional($item)->properties ? json_decode($item->properties, true)[0] : null;

        return view('admin.pages.aboutUs.create', compact('properties'));
    } //End Function

    public function store(Request $request)
    {
        $data = [];
        $specificId = 1;
        $img = $request->file('croppedImg');
        
        $imgPath = null;

        if ($img) {
            $filename = date('YdmHi') .date('v') .$img->getClientOriginalName(). '.jpg';
            $resizedImage = resizeAndCompress($img, 1080, 1080);
            $resizedImage->save(public_path('admin/slider/' . $filename),60);
            $imgPath = $filename;
        } else {
            $previousSlide = About::where('id', $specificId)->first();
            $previousData = json_decode($previousSlide->properties, true);
            $imgPath = $previousData[0]['img'] ?? null;
        };

        $data[] = [
            'tag_title' => $request->input('tag_title'), 
            'title' => $request->input('title'), 
            'description' => $request->input('description'), 
            'action_title' => $request->input('action_title'), 
            'action_text' => $request->input('action_text'), 
            'button_txt' => $request->input('button_txt'), 
            'button_url' => $request->input('button_url'), 
            'service1' => $request->input('service1'), 
            'service2' => $request->input('service2'), 
            'service3' => $request->input('service3'), 
            'service4' => $request->input('service4'), 
            'icon' => $request->filled('icon') ? $request->input('icon') : $previousData[0]['icon'] ?? null,
            'button_url' => $request->input('button_url'), 
            'img' => $imgPath,
        ];

        About::where('id', $specificId)->update([
            'properties' => json_encode($data),
        ]);

        return redirect()->route('about.index');
    }}
