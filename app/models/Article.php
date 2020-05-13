<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    public function admin(){
        return $this->belongsTo('App\models\Admin','admin_id');
    }
}

