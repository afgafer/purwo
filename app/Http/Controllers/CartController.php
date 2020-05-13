<?php

namespace App\Http\Controllers;

use App\models\Kamar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Session;
use App\models\Cart;

class CartController extends Controller
{   
    //~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
    public function drop(){
        Session::forget('cart');
        Session::forget('customer');
        Session::forget('cin');
        Session::forget('cout');
        //return view('cart.search');
        return redirect()->route('order.form');
    }
    public function destroy($id){
        $oldC=Session::has('cart')?Session::get('cart'):null;
        $cart=new Cart($oldC);
        $cart->rItem($id);

        if (count($cart->items)>0) {
            Session::put('cart',$cart);
        }else{
            Session::forget('cart');
        }
        return redirect()->route('cart.index');
    }
    public function index(){
        if (!Session::has('cart')) {
             return redirect()->route('order.choice',session()->get('hotel_id'));
        }
        $oldC=Session::get('cart');
        $cart=new Cart($oldC);
        return view('cart.index',['cart'=>$cart->items, 'bill'=>$cart->tPrice, 'count'=>$cart->tQty]);
    }
    public function search(){
        if (Session::has('cart')) {
            $oldC=Session::get('cart');
            $cart=new Cart($oldC);
            return view('cart.index',['dKamar'=>$cart->items, 'bill'=>$cart->tPrice, 'count'=>$cart->tQty]);
        }else{
            return view('cart.search');
        }
        //return 'af';
    }
    // public function create(Request $request){
    //     if(!Session::get('namaPemesan')){
    //         session()->put('namaPemesan',$request->namaPemesan);
    //         session()->put('jumlah',$request->jumlah);
    //         session()->put('masuk',$request->masuk);
    //         session()->put('keluar',$request->keluar);
    //     }
    //     $where="id NOT IN(SELECT d_pesan.id_kamar FROM pesan inner join d_pesan on pesan.id=d_pesan.id_pesan where (masuk BETWEEN '".session()->get('masuk')."' and '".session()->get('keluar')."') OR ('".session()->get('masuk')."' BETWEEN masuk and keluar)) and id_dest=1";
    //     $kamar=  DB::table('kamar')
    //     ->select('*')
    //     ->whereRaw($where)
    //     ->orderBy('kamar.id')
    //     ->get();
    //     // dd($kamar);
    //     return view('cart.create', compact('kamar'));
    // }
    // public function show($id){
    //     $kamar= Kamar::findOrFail($id);
    //     return view('cart.show', compact('kamar'));
    // }
    public function take($id){
        //$id=5;
        $cin=session()->get('cin');
        $cout=session()->get('cout');
        $dCin=date_create($cin);
        $dCout=date_create($cout);
        $end=date('Y-m-d', strtotime("-1 days", strtotime(session()->get('cout'))));
        $duration=date_diff($dCin,$dCout);
        $hotel_id=session()->get('hotel_id');;
       
        $end=date('Y-m-d', strtotime("-1 days", strtotime(session()->get('cout'))));
        $where="order_room.id IN(SELECT order_room.id FROM orders inner join order_room on orders.id=order_room.order_id where (('".session()->get('cin')."' BETWEEN cin and subdate(cout,1)) OR (cin BETWEEN '".session()->get('cin')."' AND '".$end."')) AND (status!='4')) AND hotel_id=$hotel_id AND rooms.id=$id";
        $where2="rooms.id NOT IN(SELECT order_room.room_id FROM orders inner join order_room on orders.id=order_room.order_id where (('".session()->get('cin')."' BETWEEN cin and subdate(cout,1)) OR (cin BETWEEN '".session()->get('cin')."' AND '".$end." ')) AND (status!='4')) AND hotel_id=$hotel_id AND rooms.id=$id";
        $union= DB::table('rooms')->selectRaw('rooms.*,slot-SUM(qty) AS quota')
        ->join('order_room','rooms.id','=','order_room.room_id')
        ->whereRaw($where)
        ->groupBy('rooms.id')
        ->havingRaw("slot-SUM(qty)>0");
        //->get();
        $room=  DB::table('rooms')->selectRaw("*, slot as quota")
        //->join('order_room','rooms.id','=','order_room.room_id')
        ->whereRaw($where2)
        ->groupBy('rooms.id')
        ->union($union)
        ->first();
                
        $oldC=Session::has('cart')?Session::get('cart'):null;
    
        $cart=new Cart($oldC);
        $result=$cart->add($room, $room->id,$duration->days);
        if ($result) {
            $msg="succses, have been added";
        }else{
            $msg="failed, haven't been added";
        }
       // dd($result);
        session()->put('cart',$cart);
        // $oldC=Session::get('cart');
        // $cart=new Cart($oldC);

        // return view('cart.index',['cart'=>$cart->items, 'bill'=>$cart->tPrice, 'count'=>$cart->tQty]);
        return redirect()->route('cart.index')->with("msg",$msg);
    }
    public function remove($id){
        $cin=session()->get('cin');
        $cout=session()->get('cout');
        $dCin=date_create($cin);
        $dCout=date_create($cout);
        $duration=date_diff($dCin,$dCout);
        
        $oldC=Session::has('cart')?Session::get('cart'):null;
        $cart=new Cart($oldC);
        $cart->rOne($id, $duration->days);

        if (count($cart->items)>0) {
            Session::put('cart',$cart);
        }else{
            Session::forget('cart');
        }
        return redirect()->route('cart.index');
    }
}
