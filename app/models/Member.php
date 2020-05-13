<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    protected $fillable=['name','file','email','user_id'];
}
