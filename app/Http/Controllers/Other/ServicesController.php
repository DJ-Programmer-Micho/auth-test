<?php

namespace App\Http\Controllers\Other;

use Illuminate\Http\Request;
use App\Models\Components\Service;
use App\Models\Components\ServiceInfo;
use App\Http\Controllers\Controller;
use Illuminate\Support\Carbon;

class ServicesController extends Controller
{
    public function index(){
        $items = Service::latest()->get();
        // $properties = optional($item)->properties ? json_decode($item->properties, true) : null;

        return view('admin.pages.services.index', compact('items'));
    } //End Function

    public function create(){
        return view('admin.pages.services.create');
    } //End Function

    public function store(Request $request){
        $request->validate([
            'title' => 'required',
            'short_description' => 'required',
            'description' => 'required',
            'icon' => 'required',
        ]);

        $img = $request->file('croppedImg0');
        $img_theme = $request->file('croppedImg1');

        $imgPath = null;
        $imgPath_theme = null;

        if ($img) {
            $filename = date('YdmHi') .date('v') .$img->getClientOriginalName(). '.jpg';
            $resizedImage = resizeAndCompress($img, 1920/2, 1080/2);
            $resizedImage->save(public_path('admin/slider/' . $filename),60);
            $imgPath = $filename;
        }

        if ($img_theme) {
            $filename = date('YdmHi')  .date('v').$img_theme->getClientOriginalName(). '.jpg';
            $resizedImage = resizeAndCompress($img_theme, 2000, 400);
            $resizedImage->save(public_path('admin/slider/' . $filename),60);
            $imgPath_theme = $filename;
        }
        Service::insert([
            'title' => $request->title,
            'short_description' => $request->short_description,
            'description' => $request->description,
            'icon' => $request->icon,
            'image' => $imgPath,
            'image_theme' => $imgPath_theme,
            'created_at' => Carbon::now()
        ]);

        $notification = array(
            'message' => 'Blog Inserted Successfully',
            'alert-type' => 'success'
        );


        return redirect()->route('service.index')->with($notification);

    } //End Function

    public function edit($id){
        $items = Service::findOrFail($id);
        return view('admin.pages.services.edit', compact('items'));
    } //End Function

    public function update(Request $request){

        $img = $request->file('croppedImg0');
        $img_theme = $request->file('croppedImg1');
        $id = $request->id;

        $imgPath = null;

        if ($img) {
            $previousSlide = Service::where('id', $id)->first();
            $oldImg = $previousSlide->image;
            unlink(public_path('admin/slider/'.$oldImg));

            $filename = date('YdmHi') . date('v') . $img->getClientOriginalName(). '.jpg';
            $resizedImage = resizeAndCompress($img, 1920/2, 1080/2);
            $resizedImage->save(public_path('admin/slider/' . $filename),60);
            $imgPath = $filename;
        } else {
            $previousSlide = Service::where('id', $id)->first();
            $imgPath = $previousSlide->image;
        };

        if ($img_theme) {
            $previousSlide = Service::where('id', $id)->first();
            $oldImg_theme = $previousSlide->image_theme;
            unlink(public_path('admin/slider/'.$oldImg_theme));

            $filename_theme = date('YdmHi') . date('v') . $img_theme->getClientOriginalName(). '.jpg';
            $resizedImage_theme = resizeAndCompress($img_theme, 2000, 400);
            $resizedImage_theme->save(public_path('admin/slider/' . $filename_theme),60);
            $imgPath_theme = $filename_theme;
        } else {
            $previousSlide = Service::where('id', $id)->first();
            $imgPath_theme = $previousSlide->image_theme;
        };

        if(!$request->icon){
            $pv = Service::where('id',$id)->first();
            $icon = $pv->icon;
        }

        Service::findOrFail($id)->update([
            'title' => $request->title,
            'short_description' => $request->short_description,
            'description' => $request->description,
            'icon' => $request->icon ? $request->icon : $icon,
            'image' => $imgPath,
            'image_theme' => $imgPath_theme,
            'updated_at' => Carbon::now()
        ]);

        $notification = array(
            'message' => 'Blog Inserted Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('service.index')->with($notification);
    } //End Function

    public function preview(){
        $item = ServiceInfo::find(1);

        if (!$item) {
            $item = new ServiceInfo();
            $item->id = 1;
            $item->save();
        }

        $properties = optional($item)->properties ? json_decode($item->properties, true) : null;

        return view('admin.pages.services.preview', compact('properties'));
    } //End Function
    
    public function info(){
        $item = ServiceInfo::find(1);
        
        if (!$item) {
            $item = new ServiceInfo();
            $item->id = 1;
            $item->save();
        }

        $properties = optional($item)->properties ? json_decode($item->properties, true)[0] : null;
 
        return view('admin.pages.services.info', compact('properties'));
    } //End Function

    public function add(Request $request){
        $data = [];
        $specificId = 1;

        $data[] = [
            'tag_title' => $request->input('tag_title'), 
            'title' => $request->input('title'),  
            'card_title' => $request->input('card_title'),  
            'card_description' => $request->input('card_description'),  
            'card_text' => $request->input('card_text'),  
        ];

        ServiceInfo::where('id', $specificId)->update([
            'properties' => json_encode($data),
        ]);

        return redirect()->route('service.preview');
    } //End Function

    public function delete($id){
        $item = Service::findOrFail($id);
        $img = $item['image'];
        $img_theme = $item['image_theme'];
        unlink(public_path('admin/slider/'.$img));
        unlink(public_path('admin/slider/'.$img_theme));

        Service::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Blog Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    } //End Function

    // USER SIDE
    public function serviceDetails($id){
        $serviceDetail = Service::findOrFail($id);
        $serviceAll = Service::latest()->get();
        return view('main.pages.subPages.indexServiceDetails', compact('serviceDetail','serviceAll'));
    } //End Function
}