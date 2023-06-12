<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\HomeSlide;
use Illuminate\Http\Request;

class HomeSliderController extends Controller
{
    public function index()
    {
        // $item = HomeSlide::find(2);
        // $properties = $item->properties;
        // return view('admin.setting.home.index', compact('properties'));
        $item = HomeSlide::find(8);
        $properties = json_decode($item->properties, true);

        return view('admin.setting.home.index', compact('properties'));
    }
    public function create()
    {
        return view('admin.setting.home.create');
    }
    
    // public function store(Request $request)
    // {
    // $data = $request->validate([
    //     'name' => 'required|string',
    //     'properties' => 'nullable|array',
    // ]);
    // $data['properties'] = $data['properties'] ? json_encode($data['properties']) : null;
    // HomeSlide::create($data);
    // return redirect()->route('your_route');
    // }

    public function store(Request $request)
{
    $data = [];
    
    for ($i = 0; $i < 3; $i++) {
        $short_title = $request->input('head_title' . $i);
        $title = $request->input('title' . $i);
        $btx1 = $request->input('button_txt1' . $i);
        $btu1 = $request->input('button_url1' . $i);
        $btx2 = $request->input('button_txt2' . $i);
        $btu2 = $request->input('button_url2' . $i);
        $img = $request->input('img' . $i);
        
        $data[] = [
            'short_title' => $short_title, 
            'title' => $title, 
            'button_txt1' => $btx1,
            'button_url1' => $btu1,
            'button_txt2' => $btx2,
            'button_url2' => $btu2,
            'img' => $img,
        
        ];
    }
    
    // Store the data in the database as a JSON column
    HomeSlide::create([
        'properties' => json_encode($data),
    ]);
    
    // Redirect or perform any additional actions
    return redirect()->route('home.index');
}


    public function update(Request $request, $id)
    {
    $data = $request->validate([
        'name' => 'required|string',
        'properties' => 'nullable|array',
    ]);
    $data['properties'] = $data['properties'] ? json_encode($data['properties']) : null;
    $item = HomeSlide::find($id);
    $item->update($data);
    return redirect()->route('your_route');
    }


}
