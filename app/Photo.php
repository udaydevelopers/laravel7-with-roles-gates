<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    public function getImageAttribute()
    {
        return url("uploads/thumbnail/".$this->image_path);
    }
}
