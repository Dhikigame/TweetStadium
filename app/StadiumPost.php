<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StadiumPost extends Model
{
    //
    protected $fillable = ['stadium', 'latitude', 'longitude', 'league', 'address'];

    public function comments() {
        return $this->hasMany('App\Comment');
    }
}
