<?php

namespace App\Http\Controllers\Other;

use App\Http\Controllers\Controller;
use App\Models\Components\WhyChooseUs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage; //NEW Facade

class WhyChooseUsController extends Controller
{

    public function index() {
        //Fixed Function Var
        $specificId = 1;
        $item = WhyChooseUs::find($specificId);
        // One Shot Condition if Data is Empty
        if (!$item) {
            $item = new WhyChooseUs();
            $item->id = 1;
            $item->save();
            $data = [ 
                [
                    'tag_title' => 'Why Us?', 
                    'title' => 'MET IRAQ, Has the Only Services you need in iraq', 
                    'title0' => 'Amazon Web Services (AWS)',
                    'shortDescription0' => 'Amazon Elastic Compute Cloud (Amazon EC2) is a web service that provides resizable compute capacity in the cloud.',
                    'icon0' => 'fab fa-amazon',
                    'title1' => 'Virtual Private Server (VPS)',
                    'shortDescription1' => ' It is a type of hosting service that provides a virtualized server environment within a physical server.',
                    'icon1' => 'fas fa-server ',
                    'title2' => 'Content Management System (CMS)',
                    'shortDescription2' => 'tools that allows website owners and administrators to create, manage, and modify digital content on their websites.',
                    'icon2' => 'fas fa-expand-arrows-alt',
                    'title3' => 'Secure Sockets Layer (SSL)',
                    'shortDescription3' => 'is a cryptographic protocol that provides secure communication over the internet.',
                    'icon3' => 'fas fa-shield-alt',
                    'img' => 'why-us.png',
                ]
            ];
            $get_file_data_slide1 = file_get_contents(public_path('admin/demo/why-us.png'));
            Storage::disk('s3')->put('ttsiraq/why-us/why-us.png', $get_file_data_slide1, 'public');

            $item->properties = json_encode($data);
            $item->save();

            $properties = optional($item)->properties ? json_decode($item->properties, true)[0] : null;
            return view('admin.pages.whyChooseUs.index', compact('properties'));
        }// End of One Shot Condition if Data is Empty
        $properties = optional($item)->properties ? json_decode($item->properties, true) : null;

        return view('admin.pages.whyChooseUs.index', compact('properties'));
    } //End Method

    public function create(){
        //Fixed Function Var
        $specificId = 1;
        $item = WhyChooseUs::find($specificId);
        // One Shot Condition if Data is Empty
        if (!$item) {
            $item = new WhyChooseUs();
            $item->id = 1;
            $item->save();
            $data = [ 
                [
                    'tag_title' => 'Why Us?', 
                    'title' => 'MET IRAQ, Has the Only Services you need in iraq', 
                    'title0' => 'Amazon Web Services (AWS)',
                    'shortDescription0' => 'Amazon Elastic Compute Cloud (Amazon EC2) is a web service that provides resizable compute capacity in the cloud.',
                    'icon0' => 'fab fa-amazon',
                    'title1' => 'Virtual Private Server (VPS)',
                    'shortDescription1' => ' It is a type of hosting service that provides a virtualized server environment within a physical server.',
                    'icon1' => 'fas fa-server ',
                    'title2' => 'Content Management System (CMS)',
                    'shortDescription2' => 'tools that allows website owners and administrators to create, manage, and modify digital content on their websites.',
                    'icon2' => 'fas fa-expand-arrows-alt',
                    'title3' => 'Secure Sockets Layer (SSL)',
                    'shortDescription3' => 'is a cryptographic protocol that provides secure communication over the internet.',
                    'icon3' => 'fas fa-shield-alt',
                    'img' => 'why-us.png',
                ]
            ];
            $get_file_data_slide1 = file_get_contents(public_path('admin/demo/why-us.png'));
            Storage::disk('s3')->put('ttsiraq/why-us/why-us.png', $get_file_data_slide1, 'public');

            $item->properties = json_encode($data);
            $item->save();

            $properties = optional($item)->properties ? json_decode($item->properties, true)[0] : null;
            return view('admin.pages.whyChooseUs.create', compact('properties'));
        }// End of One Shot Condition if Data is Empty
        $properties = optional($item)->properties ? json_decode($item->properties, true)[0] : null;
        return view('admin.pages.whyChooseUs.create', compact('properties'));
    } //End Function

    public function store(Request $request){
        $data = [];
        $specificId = 1;
        $img = $request->file('croppedImg');
        
        $imgPath = null;

        if ($img) {
            $filename = date('YdmHi')  .date('v').$img->getClientOriginalName(). '.jpg';
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

        $notification = array(
            'message' => 'Blog Inserted Successfully',
            'alert-type' => 'success'
        );
        
        return redirect()->route('wcu.index')->with($notification);
    } //End Function
}
