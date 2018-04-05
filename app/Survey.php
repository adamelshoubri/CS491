<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Survey extends Model
{
    public function user() {
        return $this->belongsTo('App\User');
    }

    public function questions() {
        return $this->morphMany('App\Question', 'questionable');
    }
}
