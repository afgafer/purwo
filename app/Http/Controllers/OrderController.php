<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\models\Order;
use App\models\OrderRoom;
use App\models\Hotel;
use App\models\Room;
use Session;
use File;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\OrdersExport;

class OrderController extends Controller
{
    public function index(){
        $date1=date('Y-m-01');
        $date2=date('Y-m-d');
        $where="(status='3') AND (cin BETWEEN'$date1' AND '$date2') AND (hotel_id=".auth()->user()->admin->hotel->id.")";
        $orders=Order::whereRaw($where)->orderByRaw("TIMESTAMPDIFF(day,cin, CURRENT_TIMESTAMP) ASC")->get();
        return view('order.index',compact('orders'));
    }
    public function store(Request $request){
        if (!Session::has('cart')) {
            return redirect()->route('order.form');
        }
        $cart=Session::get('cart');
        $order=new Order();
        //dd($request->name);
        $order->name=$request->name;
        $order->member_id=auth()->user()->member->id;
        $order->hotel_id=session()->get('hotel_id');
        $order->cin=$request->cin;
        $order->cout=$request->cout;
        $order->count=$cart->tQty;
        $order->bill=$cart->tPrice;
        $order->status='0';
        $result=$order->save();
        //dd($result);
        
        if($result){
            foreach($cart->items as $i){
                //dd($i['item']->name);
                $oRoom=new OrderRoom();
                $oRoom->order_id=$order->id;
                $oRoom->room_id=$i['item']->id;
                $oRoom->name=$i['item']->name;
                $oRoom->qty=$i['qty'];
                $oRoom->cost=$i['cost'];
                $oRoom->save();
            }
        }
        Session::forget('cart');
        Session::forget('cim');
        Session::forget('cin');
        return redirect()->route('order.indexA');
    }

    public function show($id){
        $order=Order::findOrFail($id);
        return view('order.show',compact('order'));
    }
    public function showA($id){
        $order=Order::findOrFail($id);
        return view('auth.order.show',compact('order'));
    }

    public function indexA(){
         DB::table('orders')->whereRaw("timestampdiff(minute,CURRENT_TIMESTAMP,updated_at) <= -416 AND file is null AND (status='1' or status='0')") 
         ->update(['status' => '4']);
        $orders=Order::where('member_id',auth()->user()->member->id)->get();
        return view('auth.order.index',compact('orders'));
    }

    public function form(){
        return view('auth.order.form');
    }

    public function select(Request $request){
        $this->validate($request, [
            'name' => 'required',
            'cin' => 'required|date|after:now',
            'duration' => 'required|integer|min:1',
            ]);
        session()->forget('name');
        session()->forget('cin');
        session()->forget('cout');
        session()->forget('cart');
        session()->forget('hotel_id');
        session()->forget('hotel');

        if(!session()->has('name')) {
        session()->put('name',$request->name);
        $duration="+".$request->duration."days";
        session()->put('cin',$request->cin);
        $cout=date('Y-m-d', strtotime($duration, strtotime($request->cin)));
        session()->put('cout',$cout);
        }

        $hotels=Hotel::orderBy("name",'DESC')->get();
        return view('auth.order.select',compact('hotels'));
    }

    public function choice(Request $request,$hotel_id){
        $hotel=Hotel::findOrFail($hotel_id);
        session()->put('hotel_id',$hotel_id);
        session()->put('hotel',$hotel->name);
        $end=date('Y-m-d', strtotime("-1 days", strtotime(session()->get('cout'))));
        $where="order_room.id IN(SELECT order_room.id FROM orders inner join order_room on orders.id=order_room.order_id where (('".session()->get('cin')."' BETWEEN cin and subdate(cout,1)) OR (cin BETWEEN '".session()->get('cin')."' AND '".$end."')) AND (status!='4')) AND hotel_id=$hotel_id";
        $where2="rooms.id NOT IN(SELECT order_room.room_id FROM orders inner join order_room on orders.id=order_room.order_id where (('".session()->get('cin')."' BETWEEN cin and subdate(cout,1)) OR (cin BETWEEN '".session()->get('cin')."' AND '".$end." ')) AND (status!='4')) AND hotel_id=$hotel_id";
        $union= DB::table('rooms')->selectRaw('rooms.*,slot-SUM(qty) AS quota')
        ->join('order_room','rooms.id','=','order_room.room_id')
        ->whereRaw($where)
        ->groupBy('rooms.id')
        ->havingRaw("slot-SUM(qty)>0");
        //->get();
        $rooms=  DB::table('rooms')->selectRaw("*, slot as quota")
        //->join('order_room','rooms.id','=','order_room.room_id')
        ->whereRaw($where2)
        ->groupBy('rooms.id')
        ->union($union)
        ->get();
        //dd($rooms);
        return view('auth.order.choice',compact('rooms'));
    }
    // select * from `rooms` where id NOT IN(SELECT order_room.room_id FROM orders inner join order_room on orders.id=order_room.order_id where ('2020-04-03' BETWEEN cin and subdate(cout,1)) OR (cin BETWEEN '2020-04-03' ANd '2020-04-03')) order by `rooms`.`id` asc
    // SELECT *, sum(qty) AS ordered, slot - SUM(qty) AS remainded from rooms left JOIN order_room on rooms.id=order_room.room_id 

    //nampilke kamar
    //select rooms.*,slot-SUM(qty) AS remaind from `rooms` inner join `order_room` on `rooms`.`id` = `order_room`.`room_id` where order_room.id IN(SELECT order_room.id FROM orders inner join order_room on orders.id=order_room.order_id where ('2020-04-06' BETWEEN cin and subdate(cout,1)) OR (cin BETWEEN '2020-04-06' AND '2020-04-11')) AND hotel_id=1 group by `rooms`.`id`
    // UNION
    // select rooms.*,slot as remaind from `rooms` where not rooms.id IN(SELECT room_id FROM orders inner join order_room on orders.id=order_room.order_id where ('2020-04-06' BETWEEN cin and subdate(cout,1)) OR (cin BETWEEN '2020-04-06' AND '2020-04-11')) AND hotel_id=1 group by `rooms`.`id`
    public function room($id)
    {
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
        return view('auth.order.room', compact('room'));
        //return $room->id;
    }

    public function cAgain(Request $request){
        $cout=session()->get('cout');
        $end=date('Y-m-d', strtotime("-1 days", strtotime($cout)));
        $where="id NOT IN(SELECT order_room.room_id FROM orders inner join order_room on orders.id=order_room.order_id where ('".session()->get('cin')."' BETWEEN cin and subdate(cout,1)) OR (cin BETWEEN '".session()->get('cin')."' and '".$end."')) ";
        $rooms=  DB::table('rooms')
        ->selectRaw('*')
        ->whereRaw($where)
        ->orderBy('rooms.id')
        ->get();

        return view('auth.order.choice',compact('rooms'));
    }
    public function upload(Request $request, $id){
        $order=Order::findOrfail($id);
        $file=$request->file;
        if($file){
            $oldF='upload/img/'.$order->file;
            File::delete($oldF);
            $nameF = 'order_'.time().'.'.$file->getClientOriginalExtension();    
            $file->move('upload/img',$nameF);
            $order->file=$nameF;
        }
        $order->status='1';
        $order->save();
        $msg="The image has been stored";
        return back()->with('message',$msg);
    }

    public function confirm(Request $request, $id){
        $order=Order::findOrFail($id);
        $order->status=$request->status;
        $order->save();
        $msg="The order has been ".$order->getStatus($order->status)."ed";
        return back()->with('message',$msg);
    }

    public function cancel($id){
        $order=Order::findOrfail($id);
        $order->status='4';
        $order->save();
        $msg="The order has been canceled";
        return back()->with('message',$msg);
    }

    public function dealine($id){
        $order=Order::findOrfail($id);
        $order->status='4';
        $order->save();
        $msg="The order has been canceled";
        ;
    }
//WHERE timestampdiff(hour,CURRENT_TIMESTAMP,created_at) <= 0 AND file is null AND (status='1' or status='0')

    public function ordersEx(){
        return Excel::download(new OrdersExport, 'orders.xlsx');
    }
    public function payment(){
        $where="status='1' AND hotel_id=".auth()->user()->admin->hotel->id;
        $orders=Order::whereRaw($where)->get();
        return view('order.index',compact('orders'));
    }
    public function transaction(){
        $where="hotel_id=".auth()->user()->admin->hotel->id." AND status!='3'";
        //dd($where);
        $orders=Order::orderBy('cin','desc')->whereRaw($where)->get();
        return view('order.index',compact('orders'));
    }
    public function filter(Request $request){
        $where="(status='3') AND (cin BETWEEN'$request->date1' AND '$request->date2') AND (hotel_id=".auth()->user()->admin->hotel->id.")";
        $orders=Order::whereRaw($where)->orderByRaw("TIMESTAMPDIFF(day,cin, CURRENT_TIMESTAMP) ASC")->get();
        return view('order.index',compact('orders'));
    }
    public function search(Request $request){
        $output="";
        if($request->ajax()){
            $query=$request->get('query');
            $date1=$request->get('date1');
            $date2=$request->get('date2');
            if($query!=''){
                $where="(status='3') AND (cin BETWEEN'$date1' AND '$date2') AND (hotel_id=".auth()->user()->admin->hotel->id.") AND ((orders.name like '%$query%') OR (order_room.name like '%$query%'))";
                $orders=Order::selectRaw('orders.*')
                ->whereRaw($where)
                ->join('order_room','orders.id','=','order_room.order_id')
                ->groupBY('orders.id')
                ->orderByRaw("TIMESTAMPDIFF(day,cin, CURRENT_TIMESTAMP) ASC")
                ->get();
                
            }else{
                $where="(status='3') AND (cin BETWEEN'$date1' AND '$date2') AND (hotel_id=".auth()->user()->admin->hotel->id.")";
                $orders=Order::whereRaw($where)->orderByRaw("TIMESTAMPDIFF(day,cin, CURRENT_TIMESTAMP) ASC")->get();
                
            }
            if($orders->count()>0){
                $count=0;
                $bill=0;
                foreach($orders as $o){
                    $count+=$o->count;
                    $bill+=$o->bill;
                    $output.="
                    <tr>
                        <td><a href='".route('order.show',$o->id)."'>$o->id</a></td>
                        <td>$o->name</td>
                        <td>$o->cin</td>
                        <td>$o->count</td>
                        <td>$o->bill</td>
                        <td>".$o->getStatus($o->status)."</td>
                        <td>
                        <form action='".route('order.confirm',$o->id)."' method='post'>
                            <input type='hidden' name='_method' value='PUT'>
                            <input type='hidden' name='_token' id='token' value='".csrf_token()."'>
                            <select name='status' class='form-control' onchange='this.form.submit()'>
                                <option value='' disabled selected>--choice--</option>
                                <option value='3'>accept</option>
                                <option value='2'>abort</option>
                            </select>
                        </form>
                        </td>
                    </tr>";
                }
                $output.="
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>$count</td>
                        <td>$bill</td>
                        <td></td>
                        <td>".method_field('PUT')."</td>
                    </tr>";
            }else{
                $output="
                <tr>
                    <td>empty</td>
                </tr>";
            }
            $data=array(
                'table_data'=>$output
            );
        }
        echo json_encode($data);
    }
}
