<?php

namespace App\Http\Controllers\Admin;

use App\Models\Order;
use App\Models\Status;
use App\Models\Returns;
use App\Models\Servant;
use App\Models\Governorate;
use Illuminate\Http\Request;
use App\Models\OrderDetailes;
use App\Models\ReturnsDetailes;
use App\Http\Controllers\Controller;

class ReturnsController extends Controller
{
    public function index()
    {
        $allReturns = Returns::all();
        return \view('admin.returns.index',\compact('allReturns'));
    }

    public function create()
    {
        $governorates  = Governorate::all();
        return \view('admin.returns.create',compact('governorates'));
    }

    public function search(Request $request)
    {
        // return $request;
        $productsReturend = Returns::with('supplier','cities','status')->where('city_id',$request->city_id)->get();
        // return [$productsReturend,$request->shipping_price];
        return \response()->json($productsReturend);
    }

    public function addToCart(Request $request)     // TO ADD PRODUCT TO ORDER DETAILES PAGE AND DELETE IT FROM PRODUCTS PAGE
    {
        
        // DELETE ROW FROM RETURNS TABLE 
        $product_delete = Returns::find($request->id);
        $product = Returns::withTrashed()->where('id',$request->id)->get();
        $pro =  $product->pluck('status_id')->implode(', ');
        $product_delete->delete();
      
        
        // ADD PRODUCT TO ORDER DETAILES TABLE 
        $createOrderDetailes = ReturnsDetailes::create(
        [
            'returns_id' => $request->id,
            'product_status' => $pro,
        ]);

        return \response()->json(
            [
                'status' => true,
                'msg' => 'تم حزف الشحنة من المخزن بنجاح',
                'id' => $request->id
            ]); 
    }

    public function submit_new_order()
    {
        $orderDetailes = ReturnsDetailes::with('returns')->where('order_id',null)->get();
        // return $orderDetailes;
        // GET LAST ROW IN STATUS TABLE 
        $lastStatus = Status::latest()->first();

        // GET ALL ROWS WITH OUT LAST ROW AND ROW OF NAME تاجيل AND تم رفضه IN STATUS TABLE 
        $allStatus = Status::where('id','<>',$lastStatus->id)->where('name','<>','تم رفضه')->where('name','<>','تاجيل')->get(); 

        $servants = Servant::where('deleted_at',null)->get();
        $orders = Order::get()->last();

        $items = ReturnsDetailes::with('returns')->where('order_id',null)->get();
        $totalPrice = $items->sum('total_price');
        $count = $orderDetailes->pluck('returns');
        // return $items->pluck('returns');
        // foreach($items->pluck('returns') as $a)
        // {
        //     return sum($a->product_price);
        // }
        
        return view('admin.returns.submit_new_order',\compact('orderDetailes','allStatus','totalPrice','servants','orders'));
    }

     public function changeShippingPrice(Request $request)
    {
        
        // UPDATE CHIPPING PRICE FOR ORDERS
        $price = ReturnsDetailes::with('returns')->find($request->id);
        // return $price;
        $price->update(
            [
                'shipping_price' => $request->price
            ]);

                // GET TOTAL PRICE FOR PRODUCT 
            $totalPrice = $price->returns->product_price + $price->shipping_price;

           
            $price->update(
                [
                    'total_price' => $totalPrice
                ]);

            return \response()->json(
                [
                    'status' => true,
                    'msg' => 'تم حزف الشحنة من المخزن بنجاح',
               ]);

            
    }

    public function changeStatus(Request $request)
    {
     
        $prderDetailesRow = ReturnsDetailes::with('returns')->find($request->id);
        // return $prderDetailesRow;

        // UPDATE STATUS ROW IN ORDER DETAILES TABLE 
        $updateStatusOrder = $prderDetailesRow->update(
            [
                'product_status' => $request->product_status
            ]);

                               
        // UPDATE STATUS ROW IN PRODUCTS  TABLE 
            $product = $prderDetailesRow->returns->update(['status_id' => $request->product_status]);
            return \response()->json(
                [
                    'status' => true,
                    'msg' => 'تم حزف الشحنة من المخزن بنجاح',
               ]);
    }

    public function store(Request $request)
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
            $orderDetailes = ReturnsDetailes::where('order_id',null)->get();
            $order_id = $create->id;
                foreach($orderDetailes as $item)
                {
                    $item->update(
                        [
                            'order_id' => $order_id
                        ]);
                }
            return \redirect()->route('returns.submit_new_order')->with(['success' => 'تم حفظ الاوردر بنجاح']);
        }else
        {
            return \redirect()->route('orders.index')->with(['error' => 'لا يمكن اضافة اوردر جديد بدون اضافة شحنات داخله']);
        }
       
            
        
    }

    public function changeStatusItems(Request $request)   //TO CHANGE STATUS OF ITEM ROW IN ORDER TABLE WHERE THIS ITEM COMEING FROM RETURNS TABLE
    {
        // return $request;

        $prderDetailesRow = ReturnsDetailes::withTrashed()->find($request->id);
        // return $prderDetailesRow;
        $last_status_id = Status::where('deleted_at',null)->get()->last()->id;
        
        // CHECK STATUS OF ORDER  ROW IF COMPLETED CAN,T CHANGE STATUS OF RETURNS DETAILES AND PRODUCTS TABLES 
        if($prderDetailesRow->order->status_id == $last_status_id)
        {
            return \response()->json(
                [
                    'status' => false,
                    'msg' => 'لا يمكن تعديل حالة الشحنة لان الاوردر تم تسليمه',
               ]);

        }else
        {
            // UPDATE STATUS ROW IN RETURNS DETAILES TABLE 
            
            if($request->item_status == $last_status_id)
            {
                // return "yes";
                $prderDetailesRow->delete();

            //    UPDATE ITEM ROW IN RETURNS DETAILES TABLE 
                $prderDetailesRow->update(
                    [
                    
                        'product_status' => $request->item_status
                    ]);

            //  UPDATE STATUS ROW IN RETURNS  TABLE 
                $product = $prderDetailesRow->returns->update(['status_id' => $request->item_status]);
                return \response()->json(
                    [
                        'status' => true,
                        'msg' => 'تم تعديل الشحنة في  المخزن و الاوردر بنجاح',
                    ]);

            //MAKE SOFT DELETE FOR THIS ITEM IN RETURNS DETAILES TABLE
                // $prderDetailesRow->delete();

            //MAKE SOFT DELETE FOR THIS ITEM IN RETURNS TABLE
                $prderDetailesRow->returns->delete();

                
            }else
            {   
                //    UPDATE ITEM ROW IN RETURNS DETAILES TABLE 
                    // $prderDetailesRow->update(
                    //     [
                        
                    //         'product_status' => $request->item_status
                    //     ]);

                //  UPDATE STATUS ROW IN RETURNS  TABLE 
                // $product = $prderDetailesRow->returns->update(['status_id' => $request->item_status]);
                // return \response()->json(
                //     [
                //         'status' => true,
                //         'msg' => 'تم تعديل الشحنة في  المخزن و الاوردر بنجاح',
                // ]);
            }


          
            return back();

            // UPDATE STATUS ROW IN PRODUCTS  TABLE 
            // $product = $prderDetailesRow->product->update(['status_id' => $request->item_status]);
            // return \response()->json(
            //     [
            //         'status' => true,
            //         'msg' => 'تم تعديل الشحنة في  المخزن و الاوردر بنجاح',
            //    ]);
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
                return \view('admin.returns.softDelete',\compact('orders'));
            }else
            {
                return \redirect()->route('returns.index')->with(['error' => 'لا يوجد اوردرات محزوفة ']);
            }
        }catch (\Throwable $th) 
        {
    
            return $th;
            return \redirect()->route('returns.index')->with(['error' => 'هناك خطا ما برجاء المحاولة فيما بعد']);
        }
    }

   
}
