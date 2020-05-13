<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public function getORoom(){
        return $this->hasMany('App\models\OrderRoom','order_id');
    }
    public function getMember(){
        return $this->belongsTo('App\models\Member','members_id');
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
        }else if($status==4) {
            $text="canceled";
        }
        return $text;
    }
}
