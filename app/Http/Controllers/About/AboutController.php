<?php

namespace App\Http\Controllers\About;

use App\Http\Controllers\Controller;
use App\Models\Components\About;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage; //NEW Facade

class AboutController extends Controller
{
    public function index()
    {
        //Fixed Function Var
        $specificId = 1;
        $item = About::find($specificId);

        // One Shot Condition if Data is Empty
        if (!$item) {
            $item = new About();
            $item->id = 1;
            $item->save();
            $data = [ 
                [
                    'tag_title' => 'About Us', 
                    'title' => 'MET IRAQ, All what you need for your business', 
                    'description' => 'MET IRAQ is a comprehensive business services provider that offers a range of solutions to support entrepreneurs and companies in Iraq. We assist businesses in various aspects, including company registration, licensing, legal compliance, accounting, tax advisory, and business consulting',
                    'action_title' => 'Call Us',
                    'action_text' => '+9647501903720',
                    'icon' => 'fas fa-phone',
                    'button_txt' => 'MET IRAQ',
                    'button_url' => 'https://metiraq.com',
                    'service1' => 'Website Development',
                    'service2' => 'Audio Distribution',
                    'service3' => 'Mobile Application',
                    'service4' => 'Account Verifications',
                    'img' => 'about-us.png',
                ]
            ];
            $get_file_data_slide1 = file_get_contents(public_path('admin/demo/about-us.png'));
            Storage::disk('s3')->put('ttsiraq/about-us/about-us.png', $get_file_data_slide1, 'public');

            $item->properties = json_encode($data);
            $item->save();

            $properties = optional($item)->properties ? json_decode($item->properties, true)[0] : null;
            return view('admin.pages.aboutUs.index', compact('properties'));
        }// End of One Shot Condition if Data is Empty

        $properties = optional($item)->properties ? json_decode($item->properties, true) : null;
        return view('admin.pages.aboutUs.index', compact('properties'));
    } //End Method

    public function create()
    {
        //Fixed Function Var
        $specificId = 1;
        $item = About::find($specificId);

        // One Shot Condition if Data is Empty
        if (!$item) {
            $item = new About();
            $item->id = $specificId;
            $item->save();
            $data = [ 
                [
                    'tag_title' => 'About Us', 
                    'title' => 'MET IRAQ, All what you need for your business', 
                    'description' => 'MET IRAQ is a comprehensive business services provider that offers a range of solutions to support entrepreneurs and companies in Iraq. We assist businesses in various aspects, including company registration, licensing, legal compliance, accounting, tax advisory, and business consulting',
                    'action_title' => 'Call Us',
                    'action_text' => '+9647501903720',
                    'icon' => 'fas fa-phone',
                    'button_txt' => 'MET IRAQ',
                    'button_url' => 'https://metiraq.com',
                    'service1' => 'Website Development',
                    'service2' => 'Audio Distribution',
                    'service3' => 'Mobile Application',
                    'service4' => 'Account Verifications',
                    'img' => 'about-us.png',
                ]
            ];
            $get_file_data_slide1 = file_get_contents(public_path('admin/demo/about-us.png'));
            Storage::disk('s3')->put('ttsiraq/about-us/about-us.png', $get_file_data_slide1, 'public');

            $item->properties = json_encode($data);
            $item->save();

            $properties = optional($item)->properties ? json_decode($item->properties, true)[0] : null;
            return view('admin.pages.aboutUs.create', compact('properties'));
        }// End of One Shot Condition if Data is Empty

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

        $notification = array(
            'message' => 'Blog Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('about.index')->with($notification);
    }}
