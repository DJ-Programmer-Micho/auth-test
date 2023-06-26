<?php

namespace App\Http\Controllers;

use App\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class PageController extends Controller
{
    public function index(){
        return view('admin.page.index');
    }
    public function edit(){
    $items = Page::all();

    if ($items->isEmpty()) {
        $items = new Page();
        $items->id = 1;
        $items->save();
    } else {
        $data['items'] = $items;
    }

    return view('admin.page.edit', compact('data'));
    }

    public function create()
{
    $items = Page::all();
    $properties = [];

    if ($items->isEmpty()) {
        $item = new Page();
        $item->id = 1;
        $item->save();
    } else {
        $data['name'] = $items[0]->name;
        $data['properties'] = json_decode($items[0]->properties, true);
    }

    return view('admin.setting.about.create', compact('properties'));
}

public function store(Request $request)
{
    $itemId = $request->input('itemId');
    $updatedProperties = $request->input('properties');

    Page::where('id', $itemId)->update([
        'properties' => json_encode($updatedProperties),
    ]);

    $items = Page::all();
    $data['items'] = $items;
    return View::make('admin.components.pagesTable',['data' => $data])->render();
    
}

}
