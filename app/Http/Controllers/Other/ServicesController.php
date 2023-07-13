<?php

namespace App\Http\Controllers\Other;

use Illuminate\Http\Request;
use App\Models\Components\Service;
use App\Models\Components\ServiceInfo;
use App\Http\Controllers\Controller;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage; //S3

use function PHPUnit\Framework\isEmpty;

class ServicesController extends Controller
{
    public function index(){
        $items = Service::latest()->get();
// dd($items);
// dd($items->isEmpty());
        // One Shot Condition if Data is Empty
        if ($items->isEmpty()) {
            
            $data = [ 
                [
                    'title' => 'AI', 
                    'short_description' => 'Artifical Intellegent That Suite To Your Business',
                    'description' => 'Indicates that the AI technology being referred to is designed or adapted to fit well with the particular characteristics, operations, or goals of a business. It implies that the AI solution is tailored to meet the specific requirements or challenges faced by the business, potentially providing benefits and improvements in various aspects of its operations. <br>Overall, the phrase suggests that the described AI solution is customized and optimized to provide valuable and effective support for the business in question.',
                    'icon' => 'fas fa-braille',
                    'image' => 'servicea5.jpg',
                    'image_theme' => 'serviceb5.jpg',
                    'created_at' => Carbon::now(),
                ],
                [
                    'title' => 'Network', 
                    'short_description' => 'Connecting All Together, and Secure',
                    'description' => 'a collection of interconnected devices, such as computers, servers, routers, switches, and other networking equipment, that are linked together to facilitate communication and the sharing of resources. It allows multiple devices to share information, data, and resources, enabling them to work together and exchange data.',
                    'icon' => 'fas fa-network-wired',
                    'image' => 'servicea4.jpg',
                    'image_theme' => 'serviceb4.jpg',
                    'created_at' => Carbon::now(),
                ],
                [
                    'title' => 'Software Development', 
                    'short_description' => 'Flexible and Scalable Softwares',
                    'description' => 'process of designing, coding, testing, and maintaining software systems or applications. It involves a systematic approach to creating software that meets specific requirements and addresses the needs of users or organizations.',
                    'icon' => 'fas fa-save',
                    'image' => 'servicea3.jpg',
                    'image_theme' => 'serviceb3.jpg',
                    'created_at' => Carbon::now(),
                ],
                [
                    'title' => 'Application Development', 
                    'short_description' => 'IOS And Android',
                    'description' => 'process of creating mobile applications specifically designed to run on the iOS and Android operating systems. These platforms dominate the mobile market, with iOS being the operating system used by Apple devices (such as iPhones and iPads) and Android being the operating system used by a wide range of devices from various manufacturers.',
                    'icon' => 'fas fa-mobile-alt',
                    'image' => 'servicea2.jpg',
                    'image_theme' => 'serviceb2.jpg',
                    'created_at' => Carbon::now(),
                ],
                [
                    'title' => 'WEB Development', 
                    'short_description' => 'We Plan, Design, Implement, Test and Host',
                    'description' => 'process of creating websites and web applications that are accessed through the internet. It involves designing, building, and maintaining websites using various technologies, programming languages, and frameworks. Web development encompasses both the front-end (client-side) and back-end (server-side) development aspects of a website.',
                    'icon' => 'fas fab fa-weebly',
                    'image' => 'servicea1.jpg',
                    'image_theme' => 'serviceb1.jpg',
                    'created_at' => Carbon::now(),
                ],
            ];
            for($i =0;$i<=4;$i++){
                Service::insert([$data[$i]]);
                Storage::disk('s3')->put('ttsiraq/services/'.$data[$i]['image'],  file_get_contents(public_path('admin/demo/services/' . $data[$i]['image']), 'public'));
                Storage::disk('s3')->put('ttsiraq/services/'.$data[$i]['image_theme'], file_get_contents(public_path('admin/demo/services/' . $data[$i]['image_theme']), 'public'));
            }
            return view('admin.pages.services.index', compact('items'));
        }// End of One Shot Condition if Data is Empty

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
            $compressedImageData = $resizedImage->encode('jpg', 60)->__toString();
            Storage::disk('s3')->put('ttsiraq/services/' . $filename, $compressedImageData, 'public');
            $imgPath = $filename;
        }

        if ($img_theme) {
            $filename_theme = date('YdmHi')  .date('v').$img_theme->getClientOriginalName(). '.jpg';
            $resizedImage_theme = resizeAndCompress($img_theme, 2000, 400);
            $compressedImageData = $resizedImage_theme->encode('jpg', 60)->__toString();
            Storage::disk('s3')->put('ttsiraq/services/' . $filename_theme, $compressedImageData, 'public');
            $imgPath_theme = $filename_theme;
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
            Storage::disk('s3')->delete('ttsiraq/services/' . $oldImg );

            $filename = date('YdmHi') . date('v') . $img->getClientOriginalName(). '.jpg';
            $resizedImage = resizeAndCompress($img, 1920/2, 1080/2);
            $compressedImageData = $resizedImage->encode('jpg', 60)->__toString();
            Storage::disk('s3')->put('ttsiraq/services/' . $filename, $compressedImageData, 'public');
           
            $imgPath = $filename;
        } else {
            $previousSlide = Service::where('id', $id)->first();
            $imgPath = $previousSlide->image;
        };

        if ($img_theme) {
            $previousSlide = Service::where('id', $id)->first();
            $oldImg_theme = $previousSlide->image_theme;
            Storage::disk('s3')->delete('ttsiraq/services/' . $oldImg_theme );

            $filename_theme = date('YdmHi') . date('v') . $img_theme->getClientOriginalName(). '.jpg';
            $resizedImage_theme = resizeAndCompress($img_theme, 2000, 400);
            $compressedImageData = $resizedImage_theme->encode('jpg', 60)->__toString();
            Storage::disk('s3')->put('ttsiraq/services/' . $filename_theme, $compressedImageData, 'public');
           
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
        //Fixed Function Var
        $specificId = 1;
        $item = ServiceInfo::find($specificId);

        // One Shot Condition if Data is Empty
        if (!$item) {
            $item = new ServiceInfo();
            $item->id = $specificId;
            $item->save();
            $data = [ 
                [
                    'tag_title' => 'Services', 
                    'title' => 'MET IRAQ, All what you need for your business', 
                    'card_title' => 'Call Us',
                    'card_description' => 'For More Information',
                    'card_text' => '+9647501903720',
                ]
            ];
            $item->properties = json_encode($data);
            $item->save();

            $properties = optional($item)->properties ? json_decode($item->properties, true)[0] : null;
            return view('admin.pages.services.preview', compact('properties'));
        }// End of One Shot Condition if Data is Empty

        $properties = optional($item)->properties ? json_decode($item->properties, true) : null;

        return view('admin.pages.services.preview', compact('properties'));
    } //End Function
    
    public function info(){
        //Fixed Function Var
        $specificId = 1;
        $item = ServiceInfo::find($specificId);

        // One Shot Condition if Data is Empty
        if (!$item) {
            $item = new ServiceInfo();
            $item->id = $specificId;
            $item->save();
            $data = [ 
                [
                    'tag_title' => 'Services', 
                    'title' => 'MET IRAQ, All what you need for your business', 
                    'card_title' => 'Call Us',
                    'card_description' => 'For More Information',
                    'card_text' => '+9647501903720',
                ]
            ];
            $item->properties = json_encode($data);
            $item->save();

            $properties = optional($item)->properties ? json_decode($item->properties, true)[0] : null;
            return view('admin.pages.services.preview', compact('properties'));
        }// End of One Shot Condition if Data is Empty

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
        // dd($img, $img_theme);
        Storage::disk('s3')->delete('ttsiraq/services/' . $img );
        Storage::disk('s3')->delete('ttsiraq/services/' . $img_theme );
        // unlink(public_path('admin/slider/'.$img));
        // unlink(public_path('admin/slider/'.$img_theme));

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