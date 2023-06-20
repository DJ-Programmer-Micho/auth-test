<?php

namespace App\Http\Controllers\Other;

use App\Http\Controllers\Controller;
use App\Models\Other\Fact;
use Illuminate\Http\Request;

class FactController extends Controller
{
    // public function index()
    // {

    //     $item = Fact::find(1);
    //     $properties = optional($item)->properties ? json_decode($item->properties, true) : null;

    //     return view('admin.setting.home.index', compact('properties'));
    // }

    public function create()
    {
        $item = Fact::find(1);

        if (!$item) {
            $item = new Fact();
            $item->id = 1;
            $item->save();
        }

        $properties = optional($item)->properties ? json_decode($item->properties, true) : null;
 
        return view('admin.setting.fact.create', compact('properties'));
    }

    public function store(Request $request)
    {
        $data = [];
        $specificId = 1;
       

        for ($i = 0; $i < 3; $i++) {
            $title = $request->input('title' . $i);
            $symbolL = $request->input('synmbolL' . $i);
            $count = $request->input('count' . $i);
            $symbolR = $request->input('synmbolR' . $i);
            $icon = $request->input('icon' . $i);
            
            $data[] = [
                'title' => $title, 
                'symbolL' => $symbolL,
                'count' => $count,
                'symbolR' => $symbolR,
                'icon' => $icon,
            ];
        }

        // foreach ($data as $item) {
            Fact::where('id', $specificId)->update([
                'properties' => json_encode($data),
            ]);
        // }

        return redirect()->route('fact.create');
    }
}

    // dd($request->file('croppedImg0'),$request->file('croppedImg1'),$request->file('croppedImg2'));