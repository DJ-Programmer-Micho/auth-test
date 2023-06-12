<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HomeSlide extends Model
{
    use HasFactory;

    // protected $casts = [
    //     'properties' => 'json',
    // ];
protected $fillable = ['properties', /* other fillable fields */];

    // protected $guarded = [];

    // protected $fillable = [
    //     'short_title',
    //     'title',
    //     'btn1_action',
    //     'btn1_action_url',
    //     'btn2_action',
    //     'btn2_action_url',
    //     'image_slide',
    // ];
}
