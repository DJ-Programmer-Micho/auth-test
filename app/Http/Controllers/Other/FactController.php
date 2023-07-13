<?php

namespace App\Http\Controllers\Other;

use App\Http\Controllers\Controller;
use App\Models\Components\Fact;
use Illuminate\Http\Request;

class FactController extends Controller
{
    public function index()
    {
        //Fixed Function variable
        $specificId = 1;
        $item = Fact::find($specificId);
        //One Shot Condition if Data is Empty
        if (!$item) {
            $item = new Fact();
            $item->id = $specificId;
            $item->save();

            $data = [ 
                [
                    'title' => 'Projects', 
                    'synmbolL' => '',
                    'count' => '53',
                    'symbolR' => '+',
                    'icon' => 'fas fa-project-diagram',
                ],
                [
                    'title' => 'Happy Clients', 
                    'synmbolL' => '%',
                    'count' => '98',
                    'symbolR' => '',
                    'icon' => 'fas far fa-smile-beam',
                ],
                [
                    'title' => 'Employee', 
                    'synmbolL' => '',
                    'count' => '25',
                    'symbolR' => '+',
                    'icon' => 'fas fa-users',
                ],

            ];
            $item->properties = json_encode($data);
            $item->save();

            $properties = optional($item)->properties ? json_decode($item->properties, true) : null;
            return view('admin.pages.facts.index', compact('properties'));
        }

        $properties = optional($item)->properties ? json_decode($item->properties, true) : null;
        return view('admin.pages.facts.index', compact('properties'));
    } //End Method

    public function create()
    {
        //Fixed Function variable
        $specificId = 1;
        $item = Fact::find($specificId);
        // One Shot Condition if Data is Empty
        if (!$item) {
            $item = new Fact();
            $item->id = $specificId;
            $item->save();

            $data = [ 
                [
                    'title' => 'Projects', 
                    'synmbolL' => '',
                    'count' => '53',
                    'symbolR' => '+',
                    'icon' => 'fas fa-project-diagram',
                ],
                [
                    'title' => 'Happy Clients', 
                    'synmbolL' => '%',
                    'count' => '98',
                    'symbolR' => '',
                    'icon' => 'fas far fa-smile-beam',
                ],
                [
                    'title' => 'Employee', 
                    'synmbolL' => '',
                    'count' => '25',
                    'symbolR' => '+',
                    'icon' => 'fas fa-users',
                ],

            ];
            $item->properties = json_encode($data);
            $item->save();

            $properties = optional($item)->properties ? json_decode($item->properties, true) : null;
            return view('admin.pages.facts.create', compact('properties'));
        }// End of One Shot Condition if Data is Empty
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

            $notification = array(
                'message' => 'Blog Inserted Successfully',
                'alert-type' => 'success'
            );

        return redirect()->route('fact.index')->with($notification);
    } //End Method
}
