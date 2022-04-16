<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Advertisement extends Model
{
    use HasFactory, SoftDeletes;

    public const MAX_CHARACTERS_NAME = 200;
    public const MAX_CHARACTERS_DESCRIPTION = 1000;
    protected $perPage = 10;

    protected $fillable = [
        'description', 'name', 'price'
    ];
    protected $guarded = ['id'];

    public function photo() {
        //return $this->hasOne(AdvertisementPhoto::class)->oldest();
        return $this->hasOne(AdvertisementPhoto::class)->where(['is_main' => true]);
    }

    public function allPhotos() {
        return $this->hasMany(AdvertisementPhoto::class);
    }
}
