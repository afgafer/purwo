<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    public function user(){
        return $this->belongsTo('App\user','user_id');
    }
    public function getStatus($status){
        if ($status==0) {
            $text="pending";
        }else if($status==1) {
            $text="processing";
        }else if($status==2) {
            $text="abort";
        }else if($status==3) {
            $text="complete";
        }
        return $text;
    }
}
