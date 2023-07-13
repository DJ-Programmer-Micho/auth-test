<?php

namespace App\Http\Controllers\Other;

use App\Models\Components\Price;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use App\Models\Components\PriceDetail;

class PriceController extends Controller
{
    public function index(){
        $items = Price::latest()->get();
        // One Shot Condition if Data is Empty
        if ($items->isEmpty()) {
            $data = [ 
                [
                    'name' => 'Bundle 1', 
                    'exp' => 'Begin',
                    'price' => '$100 / Month',
                    'info' => '{"0":{"text":"Service 1","icon":"fa-check"},"1":{"text":"Service 2","icon":"fa-check"},"6":{"text":"Service 3","icon":"fa-xmark"},"3":{"text":"Service 4","icon":"fa-xmark"}}',
                    'btn_txt' => 'Let\'s Start',
                    'btn_url' => 'https://metiraq.com',
                    'created_at' => Carbon::now(),
                ],
                [
                    'name' => 'Bundle 2', 
                    'exp' => 'Super',
                    'price' => '$150 / Month',
                    'info' => '{"0":{"text":"Service 1","icon":"fa-check"},"1":{"text":"Service 2","icon":"fa-check"},"6":{"text":"Service 3","icon":"fa-check"},"3":{"text":"Service 4","icon":"fa-xmark"}}',
                    'btn_txt' => 'Let\'s Go',
                    'btn_url' => 'https://metiraq.com',
                    'created_at' => Carbon::now(),
                ],
                [
                    'name' => 'Bundle 3', 
                    'exp' => 'Enterprise',
                    'price' => '$250 / Month',
                    'info' => '{"0":{"text":"Service 1","icon":"fa-check"},"1":{"text":"Service 2","icon":"fa-check"},"6":{"text":"Service 3","icon":"fa-check"},"3":{"text":"Service 4","icon":"fa-check"}}',
                    'btn_txt' => 'Best Deal',
                    'btn_url' => 'https://metiraq.com',
                    'created_at' => Carbon::now(),
                ],
            ];
            for($i =0;$i<=2;$i++){
                Price::insert([$data[$i]]);
            }
            return view('admin.pages.pricing.index', compact('items'));
        }// End of One Shot Condition if Data is Empty

        return view('admin.pages.pricing.index', compact('items'));
    } //End Function

    public function create(){
        $rowCheck = Price::count();
        if($rowCheck >= 3){
            $notification = array(
                'message' => 'Cannot add new item. Maximum limit reached.',
                'alert-type' => 'warning'
            );
            return redirect()->route('price.index')->with($notification);
        }
        return view('admin.pages.pricing.create');
    } //End Function

    public function store(Request $request){
        Price::insert([
            'name' => $request->name,
            'exp' => $request->small_text,
            'price' => $request->Price,
            'info' => json_encode($request->service),
            'btn_txt' => $request->button_txt,
            'btn_url' => $request->button_url,
            'created_at' => Carbon::now()
        ]);

        $notification = array(
            'message' => 'New Price Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('price.index')->with($notification);
    } //End Function

    public function info(){
        //Fixed Function Var
        $specificId = 1;
        $item = PriceDetail::find($specificId);

        // One Shot Condition if Data is Empty
        if (!$item) {
            $item = new PriceDetail();
            $item->id = $specificId;
            $item->save();
            $data = [ 
                [
                    'tag_title' => 'Price', 
                    'title' => 'MET IRAQ, Best Price Of Each Service', 
                ]
            ];
            $item->properties = json_encode($data);
            $item->save();

            $properties = optional($item)->properties ? json_decode($item->properties, true)[0] : null;
            return view('admin.pages.pricing.info', compact('properties'));
        }// End of One Shot Condition if Data is Empty

        $properties = optional($item)->properties ? json_decode($item->properties, true)[0] : null;
        return view('admin.pages.pricing.info', compact('properties'));
    } //End Function

    public function add(Request $request){
        $data = [];
        $specificId = 1;

        $data[] = [
            'tag_title' => $request->input('tag_title'), 
            'title' => $request->input('title'),  
        ];

        PriceDetail::where('id', $specificId)->update([
            'properties' => json_encode($data),
        ]);

        return redirect()->route('price.preview');
    } //End Function

    public function preview(){
        //Fixed Function Var
        $specificId = 1;
        $item = PriceDetail::find($specificId);

        // One Shot Condition if Data is Empty
        if (!$item) {
            $item = new PriceDetail();
            $item->id = $specificId;
            $item->save();
            $data = [ 
                [
                    'tag_title' => 'Price', 
                    'title' => 'MET IRAQ, Best Price Of Each Service', 
                ]
            ];
            $item->properties = json_encode($data);
            $item->save();

            $properties = optional($item)->properties ? json_decode($item->properties, true)[0] : null;
            return view('admin.pages.pricing.preview', compact('properties'));
        }// End of One Shot Condition if Data is Empty


        $items = Price::latest()->get();
        // One Shot Condition if Data is Empty
        if ($items->isEmpty()) {
            $data = [ 
                [
                    'name' => 'Bundle 1', 
                    'exp' => 'Begin',
                    'price' => '$100 / Month',
                    'info' => '{"0":{"text":"Service 1","icon":"fa-check"},"1":{"text":"Service 2","icon":"fa-check"},"6":{"text":"Service 3","icon":"fa-xmark"},"3":{"text":"Service 4","icon":"fa-xmark"}}',
                    'btn_txt' => 'Let\'s Start',
                    'btn_url' => 'https://metiraq.com',
                    'created_at' => Carbon::now(),
                ],
                [
                    'name' => 'Bundle 2', 
                    'exp' => 'Super',
                    'price' => '$150 / Month',
                    'info' => '{"0":{"text":"Service 1","icon":"fa-check"},"1":{"text":"Service 2","icon":"fa-check"},"6":{"text":"Service 3","icon":"fa-check"},"3":{"text":"Service 4","icon":"fa-xmark"}}',
                    'btn_txt' => 'Let\'s Go',
                    'btn_url' => 'https://metiraq.com',
                    'created_at' => Carbon::now(),
                ],
                [
                    'name' => 'Bundle 3', 
                    'exp' => 'Enterprise',
                    'price' => '$250 / Month',
                    'info' => '{"0":{"text":"Service 1","icon":"fa-check"},"1":{"text":"Service 2","icon":"fa-check"},"6":{"text":"Service 3","icon":"fa-check"},"3":{"text":"Service 4","icon":"fa-check"}}',
                    'btn_txt' => 'Best Deal',
                    'btn_url' => 'https://metiraq.com',
                    'created_at' => Carbon::now(),
                ],

            ];
            for($i =0;$i<=2;$i++){
                Price::insert([$data[$i]]);
            }
            return view('admin.pages.pricing.preview', compact('items'));
        }// End of One Shot Condition if Data is Empty
        $properties = optional($item)->properties ? json_decode($item->properties, true) : null;

        return view('admin.pages.pricing.preview', compact('properties'));
    } //End Function

    public function edit($id){
        $items = Price::findOrFail($id);
        return view('admin.pages.pricing.edit', compact('items'));
    } //End Function

    public function update(Request $request){
        $id = $request->id;

        Price::findOrFail($id)->update([
            'name' => $request->name,
            'exp' => $request->small_text,
            'price' => $request->price,
            'info' => json_encode($request->service),
            'btn_txt' => $request->button_txt,
            'btn_url' => $request->button_url,
            'updated_at' => Carbon::now()
        ]);

        $notification = array(
            'message' => 'Price Updated Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('price.index')->with($notification);
    } //End Function

    public function delete($id){
        Price::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Price Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    } //End Function
}
