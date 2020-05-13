<?php

namespace App\Exports;

use App\models\Order;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Support\Facades\DB;

//class OrdersExport implements FromCollection
class OrdersExport implements FromView
{
    // public function collection()
    // {
    //     return Order::selectRaw("id, name, cin, bill")->whereRaw("month(cin)=4 AND status=2")->get();
    // }
    public function view(): View
    {
        $where="hotel_id=".auth()->user()->admin->hotel->id;
        //dd($where);
        $orders=Order::orderBy('cin','desc')->whereRaw($where)->get();
        return view('order.index',compact('orders'));
    }
}