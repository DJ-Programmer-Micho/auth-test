<?php

namespace App\Models\Other;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fact extends Model
{
    use HasFactory;

    protected $fillable = ['properties', /* other fillable fields */];
}
