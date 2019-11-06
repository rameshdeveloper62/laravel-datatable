<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Article extends Model
{
    protected $guarded = ['id'];

    public function user()
    {
    	return $this->belongsTo(User::class);
    }

    public function getImageUrlAttribute($value)
    {
    	if(Storage::exists('images/'.$value))
    		return Storage::url('images/'.$value);
    	else
    		return Storage::url('storage/images/default.jpg');

    }
}
