<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SliderQuestion extends Model
{
    public $timestamps = false;

    public function question() {
        return $this->belongsTo('App\Question');
    }
}
