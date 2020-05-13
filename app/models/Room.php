<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    // public function admin(){
    //     return $this->belongsTo('App\models\Admin','admin_id');
    // }
    public function hotel(){
        return $this->belongsTo('App\models\Hotel','hotel_id');
    }
    public function oleh($id){
        //$room=\App\models\Room::findOrFail($id);
        return 'as';
    }
}
