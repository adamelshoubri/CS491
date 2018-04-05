<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SkipLogic extends Model
{
    public $timestamps = false;

    public function survey() {
        return $this->belongsTo('App\Survey');
    }

    public function questions() {
        return $this->morphMany('App\Question', 'questionable');
    }
}
