<?php

namespace App\Http\Controllers\Demo;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DemoController extends Controller
{
    public function abc(){
        return view('/about');
    }
    public function def(){
        return view('/contact');
    }
}
