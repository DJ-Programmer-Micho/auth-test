<?php

namespace App\Http\Controllers\Other;

use App\Http\Controllers\Controller;
use App\Models\Other\Fact;
use Illuminate\Http\Request;

class FactController extends Controller
{
    public function index()
    {
        $item = Fact::find(1);
        $properties = optional($item)->properties ? json_decode($item->properties, true) : null;

        return view('admin.pages.facts.index', compact('properties'));
    } //End Method

    public function create()
    {
        $item = Fact::find(1);

        if (!$item) {
            $item = new Fact();
            $item->id = 1;
            $item->save();
        }

        $properties = optional($item)->properties ? json_decode($item->properties, true) : null;
 
        return view('admin.pages.facts.create', compact('properties'));
    } //End Method

    public function store(Request $request)
    {
        $data = [];
        $specificId = 1;
       

        for ($i = 0; $i < 3; $i++) {
            $title = $request->input('title' . $i);
            $symbolL = $request->input('synmbolL' . $i);
            $count = $request->input('count' . $i);
            $symbolR = $request->input('synmbolR' . $i);
            $icon = $request->filled('icon' . $i) ? $request->input('icon' . $i) : ($previousData[0]['icon'] ?? null);
            
            $data[] = [
                'title' => $title, 
                'symbolL' => $symbolL,
                'count' => $count,
                'symbolR' => $symbolR,
                'icon' => $icon,
            ];
        }

            Fact::where('id', $specificId)->update([
                'properties' => json_encode($data),
            ]);

        return redirect()->route('fact.index');
    } //End Method
}
