<?php

namespace App\Models\Other;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceInfo extends Model
{
    use HasFactory;
    protected $table = 'services_infos';
    protected $fillable = ['properties', /* other fillable fields */];
}
