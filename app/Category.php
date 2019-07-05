<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public function cupCakes(){
        return $this->hasMany('App\CupCake');
    }
}
