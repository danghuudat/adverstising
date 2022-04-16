<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Advertisement extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'description', 'name', 'price'
    ];
    protected $guarded = ['id'];

    public function photo() {
        return $this->hasOne(AdvertisementPhoto::class)->oldest();
    }

    public function allPhoto() {
        return $this->hasMany(AdvertisementPhoto::class);
    }
}
