<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\models\Image;
use App\models\Room;
use App\models\Hotel;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $type=auth()->user()->type;
        if($type==1){
            $id=auth()->user()->admin->hotel_id;
            $images=Image::orderBy('created_at','desc')->where('status','=','1')->limit(5)->get();
            $hotel=Hotel::findOrFail($id);
            return view('home',compact('images','hotel'));
        }else if($type==0){
            return redirect()->route('welcome');
        }else{
            return "back";
        }
    }
}

