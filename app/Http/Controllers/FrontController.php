<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\models\Article;
use App\models\Image;
use App\models\Event;
use App\models\Room;
use Illuminate\Support\Facades\DB;

class FrontController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function welcome()
    {   
        //DB::table('orders')->whereRaw("TIMESTAMPDIFF(MINUTE,created_at,CURRENT_TIMESTAMP)>30 AND proof IS NULL")->delete();
        // $rooms=DB::table('orders')->whereRaw("TIMESTAMPDIFF(MINUTE,created_at,CURRENT_TIMESTAMP)>30 AND proof IS NULL")->get();
        // dd($rooms);
        
        $dest=\App\models\Dest::where('name','demang')->first();
        $rooms=Room::orderBy('created_at','desc')->limit(4)->get();
        $event=Event::selectRaw("*")->whereRaw("datediff(date,CURRENT_DATE)>-1")->orderByRaw("datediff(date,CURRENT_DATE) ASC")->first();
        $articles=Article::orderBy('created_at','desc')->limit(5)->get();
        $images=Image::orderBy('created_at','desc')->where('status','=','1')->limit(5)->get();
        return view('welcome',compact('images','event','articles','rooms','dest'));
    }
}

