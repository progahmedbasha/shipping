<?php

namespace App\Http\Controllers\Admin;

use App\Models\Order;
use App\Models\Status;
use App\Models\Product;
use App\Models\Returns;
use App\Models\Servant;
use App\Models\Supplier;
use App\Models\Governorate;
use Illuminate\Http\Request;
use App\Models\OrderDetailes;
use App\Http\Controllers\Controller;
use App\Http\Requests\ordersRequest;
use App\Http\Requests\productSearchReuest;

class ordersController extends Controller
{
    public function store(ordersRequest $request)
    {
        // return $request;
        if($request->total_price > 0)
        {
            $create = Order::create(
                [
                    'status_id' => 1,
                    'servant_id' => $request->servant_id,
                    'total_prices' => $request->total_price
                ]);

                // CREATE ORDER ID IN ORDER DETAILES TABLE 
            $orderDetailes = OrderDetailes::where('order_id',null)->get();
            $order_id = $create->id;
                foreach($orderDetailes as $item)
                {
                    $item->update(
                        [
                            'order_id' => $order_id
                        ]);
                }
            return \redirect()->route('orderDetailes.submit_new_order')->with(['success' => 'تم حفظ الاوردر بنجاح']);
        }else
        {
            return \redirect()->route('orders.index')->with(['error' => 'لا يمكن اضافة اوردر جديد بدون اضافة شحنات داخله']);
        }
       
            
        
    }

   public function index()
   {
        $orders = Order::with('status')->get();
        // $emptyOrder = Order::with('ordersDetailes')->where('ordersDetailes',null)->get();
        $emptyOrder = Order::whereDoesntHave('ordersDetailes')->get();
         foreach($emptyOrder as $empty)
         {
             $empty->forceDelete();
         }
       return view('admin.orders.index',\compact('orders'));
   }

   public function edit($id)
   {
        try
        {
            $order = Order::find($id);
            if(!$order)
            {
                return \redirect()->route('orders.index')->with(['error' => 'هذا العنصر غير موجود']);

            }else
            {
                $allStatus = Status::where('name','<>','تم رفضه')->where('name','<>','تاجيل')->get(); 
                return \view('admin.orders.edit',\compact('order','allStatus'));
            }
        }catch (\Throwable $th) 
        {
            return $th;
            return \redirect()->route('orders.index')->with(['error' => 'هناك خطا ما برجاء المحاولة فيما بعد']);
        }
   }

   public function update(Request $request,$id)
   {
        try
        {
            // GET ORDER WITH HIS PRODUCTS
                $order = Order::withTrashed()->with('ordersDetailes')->find($id);
                $last_status_id = Status::where('deleted_at',null)->get()->last()->id;

            // CHECK IF ORDER IS FOUND IND DATA BASE 
                if(!$order)
                {
                    return \redirect()->route('orders.index')->with(['error' => 'هذا العنصر غير موجود']);

                }else
                {

            // UPDATE ORDER STATUS IN ORDERS TABLE 
                    $update = $order->update(
                        [
                            'status_id' => $request->status_id,
                            'notes' => $request->notes,
                        ]);

            // DELETE ORDER IF WAS COMPLETED 
                    if($order->status_id  == $last_status_id)
                    {
                        $order->delete();
                    }
                    

                    
            // CHECK IF USER SELECT STATUS COMPLETED 
                    if($request->status_id ==  $last_status_id)
                    {
                        $orderItems = $order->ordersDetailes;

            // CHANGE ORDER PRODUCTS STATUS TO COMPLETED LIKE ORDER STATUS
                        foreach($orderItems as $item)
                        {
                            $item->update(
                                [
                                    'product_status' => $request->status_id
                                ]);

            // UPDATE ORDER PRODUCTS STATUS IN PRODUCTS TABLE 
                        $item->product->update(
                            [
                                'status_id' => $request->status_id
                            ]);

            // MAKE SOFT DELETE FOR ORDER PRODUCTS  WHEN ITS STATUS COMPLETED IN ORDER DETAILES TABLE
                            $item->delete();
                            $item->save();
                        }
                        return \redirect()->route('orders.index')->with(['success' => 'تم تعديل حالة الاوردر و الشحنات الخاصة به بنجاح']);
                    }else
                    {
            // CHECK IF ORDER PRODUCTS IN SOFT DELETED PAGE 
                        $orderItems = $order->ordersDetailes;
                        foreach($orderItems as $item)
                        {
                            if($item->deleted_at != null)
                            {

            // RETURN ORDER PRODUCT TO ORDER DETAILES TABLE IF ORDER PRODUCTS IN SOFT DELETED PAGE AND ORDER STATUS CHANGED TO ANY VALUE WITHOUT COMPLETED
                                $item->restore();
                                $item->update(
                                    [
                                        'product_status' => 1
                                    ]);
                                    
                // CHANGE ORDER PRODUCTS STATUS IN PRODUCTS TABEL TO PENDING WHEN STATUS OF ORDER HAS CHANGED FORM COMPLETED IN ORDERS TABLE  
                                $item->product->update(
                                    [
                                        'status_id' => 1
                                    ]);
                    

            // CHANGE STATUS IN PRODUCTS TABLE 
                                

                            }else
                            {
            // IF ORDER PRODUCTS NOT FOUND IN SOFT DELETE TABLE AND ORDER STATUS HAS CHANGED TO ANY STATUS WITHOUT COMPLETED DON,T DO ANY THING AND RETUN FLASH MESSAGE /
                            return \redirect()->route('orders.index')->with(['success' => 'تم تعديل الحالة بنجاح']);
                        }
                    }
                    return \redirect()->route('orders.index')->with(['success' => 'تم تعديل حالة الاوردر بنجاح']);
                }
            }
        }catch (\Throwable $th) 
        {
            return $th;
            return \redirect()->route('orders.index')->with(['error' => 'هناك خطا ما برجاء المحاولة فيما بعد']);
        }
   }

    public function show($id)
    {
        try
        {
            $order = Order::with('ordersDetailes')->find($id);
            $order2 = Order::with('returnsDetailes')->find($id);
            // return $order2;

            // return $order;
            if(!$order)
            {
                return \redirect()->route('orders.index')->with(['error' => 'هذا العنصر غير موجود']);

            }else
            {
                $allStatus = Status::where('deleted_at',null)->get();
                $statusReturns = Status::where('deleted_at',null)->where('name','<>','تم رفضه')->where('name','<>','تاجيل')->get();
                
                return \view('admin.orders.show',\compact('order','allStatus','order2','statusReturns'));
            }
        }catch (\Throwable $th) 
        {
            return $th;
            return \redirect()->route('orders.index')->with(['error' => 'هناك خطا ما برجاء المحاولة فيما بعد']);
        }
    }

    public function changeStatusItems(Request $request)
    {

        $prderDetailesRow = OrderDetailes::withTrashed()->find($request->id);
        $last_status_id = Status::where('deleted_at',null)->get()->last()->id;

        
        
        // لو حالة الاوردر تم التحصيل لا يمكن مسح اي عنصر داخله
        if($prderDetailesRow->order->status_id == $last_status_id)
        {
            return \response()->json(
                [
                    'status' => false,
                    'msg' => 'لا يمكن تعديل حالة الشحنة لان الاوردر تم تسليمه',
               ]);

        }else
        {
            // UPDATE STATUS ROW IN ORDER DETAILES TABLE 
            
            if($request->item_status == 3 || $request->item_status == 4)
            {
                  
            //UPDATE STATUS ROW IN PRODUCTS  TABLE 
                $product = $prderDetailesRow->product->update(['status_id' => $request->item_status]);
               
            
                // STORE ITEM ROW IN RETURNS TABLE 
                    $create = Returns::create(
                        [
                            'resever_name' => $prderDetailesRow->product->resever_name,
                            'resver_phone' => $prderDetailesRow->product->resver_phone,
                            'supplier_id' => $prderDetailesRow->product->supplier_id,
                            'city_id' => $prderDetailesRow->product->city_id,
                            'adress' => $prderDetailesRow->product->adress,
                            'product_price' => $prderDetailesRow->product->product_price,
                            'status_id' => $prderDetailesRow->product->status_id,
                            'notes' => $prderDetailesRow->product->notes,
                        ]);

                // MAKE HARD DELETE FOR THIS ROW FROM ORDER DETAILES TABLE 
                    $delete = $prderDetailesRow->forceDelete();   

                // MAKE HARD DELETE FOR THIS ROW FROM PRODUCTS TABLE 
                    $delete = $prderDetailesRow->product->forceDelete();   
                    
            }else
            {   
                //    UPDATE ITEM ROW IN ORDER DETAILES TABLE 
                    $prderDetailesRow->update(
                        [
                        
                            'product_status' => $request->item_status
                        ]);

                //  UPDATE STATUS ROW IN PRODUCTS  TABLE 
                $product = $prderDetailesRow->product->update(['status_id' => $request->item_status]);
                return \response()->json(
                    [
                        'status' => true,
                        'msg' => 'تم تعديل الشحنة في  المخزن و الاوردر بنجاح',
                ]);
            }
            return back();
        }
        
       
    }


    public function softDelete()
    {
        try
        {
            $orders = Order::onlyTrashed()->get();
            // return $servants;
            if($orders)
            {
                return \view('admin.orders.softDelete',\compact('orders'));
            }else
            {
                return \redirect()->route('orders.index')->with(['error' => 'لا يوجد اوردرات محزوفة ']);
            }
        }catch (\Throwable $th) 
        {
    
            return $th;
            return \redirect()->route('orders.index')->with(['error' => 'هناك خطا ما برجاء المحاولة فيما بعد']);
        }
    }

    public function restore(Request $request)
    {
        $order_restore = Order::withTrashed()->with('ordersDetailes')->where('id',$request->id);
        $order_restore2 = Order::withTrashed()->with('ordersDetailes')->where('id',$request->id)->get();
        $last_status_id = Status::where('deleted_at',null)->get()->last()->id;
        
        // $items_id =  $order_restore2->pluck('id')->implode(', ');
        // $items = OrderDetailes::withTrashed()->where('order_id',$items_id)->get();

        
        // RESTORE ORDER 
        $order_restore->restore();

        // CHANGE ORDER STATUS TO PENDING
        $order_restore->update(
            [
                'status_id' => 1
            ]);

        // // RESTORE ORDER ITEMS IN ORDER DETAILES
        
        // foreach($items as $item)
        // {
        //     $item->restore();
        // }

        return \response()->json(
            [
                'status' => true,
                'msg' => 'تم التفعيل بنجاح',
                'id' => $request->id
            ]);
    }
    
}
