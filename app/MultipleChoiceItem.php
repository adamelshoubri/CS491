<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MultipleChoiceItem extends Model
{
    public $timestamps = false;

    public function question() {
        return $this->belongsTo('App\Question');
    }
}
