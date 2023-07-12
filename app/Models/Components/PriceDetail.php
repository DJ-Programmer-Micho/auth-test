<?php

namespace App\Models\Other;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PriceDetail extends Model
{
    use HasFactory;
    protected $table = 'price_infos';
    protected $fillable = ['properties', /* other fillable fields */];
}
