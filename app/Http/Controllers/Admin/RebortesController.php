<?php

namespace App\Http\Controllers\Admin;

use App\Models\Order;
use App\Models\OrderDetailes;
use App\Models\Servant;
use App\Models\Supplier;
use App\Models\Governorate;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RebortesController extends Controller
{
    public function index()
    {
        $governorates = Governorate::all();
        $servants = Servant::all();
        $suppliers = Supplier::all();
        $orders = Order::all();
        $ordersdetails = OrderDetailes::all();
  	  	$sumorderdetails=$ordersdetails->sum('shipping_price');
  	 
        return \view('admin.reborts.index',\compact('governorates','servants','suppliers','ordersdetails' , 'orders','sumorderdetails'));
    }



         public function setday(Request $request)
       {
 
        $from =$request['date'];
        $to =$request['date2'];
    	  $datas = 
                 OrderDetailes::where('created_at', '>=', $from)
                     ->where('created_at', '<=', $to)

        ->get();
        $sum=$datas->sum('shipping_price');
       return view('admin.reborts.testorder',compact('datas','sum'));


        }

        public function oneday(Request $request)
    		{


    	 $datas = 
      			 OrderDetailes::where('created_at', $request['date'])
               
        			->get();
        $sum=$datas->sum('shipping_price');
       return view('admin.reborts.testorder',compact('datas','sum'));


    }

      public function servantindex()
    {
        $governorates = Governorate::all();
        $servants = Servant::all();
        $suppliers = Supplier::all();
        $orders = Order::all();
        $ordersdetails = OrderDetailes::all();
        $sumorderdetails=$ordersdetails->sum('shipping_price');
     
        return \view('admin.reborts.servantindex',\compact('governorates','servants','suppliers','ordersdetails' , 'orders','sumorderdetails'));
    }
    
    public function servantname(Request $request)
        {


       $datas = 
             Order::where('servant_id', $request['date'])
               
              ->get();
        $sum=$datas->sum('total_prices');
       return view('admin.reborts.servantordername',compact('datas','sum'));


    }


     public function oneservdate(Request $request)
       {
 
        $from =$request['date'];
        $to =$request['date2'];
        $datas = 
                 Order::where('created_at', '>=', $from)
                     ->where('created_at', '<=', $to)

        ->get();
        $sum=$datas->sum('total_prices');
       return view('admin.reborts.oneservdat',compact('datas','sum'));


        }

        public function oneservday(Request $request)
        {


       $datas = 
             Order::where('created_at', $request['date'])
               
              ->get();
        $sum=$datas->sum('total_prices');
       return view('admin.reborts.oneservdat',compact('datas','sum'));


    }

}
