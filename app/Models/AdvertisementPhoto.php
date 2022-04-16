<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AdvertisementPhoto extends Model
{
    protected $table = 'advertisement_photo';
    use HasFactory, SoftDeletes;
}
