<?php

namespace App\Http\Controllers\Admin;

use App\Models\City;
use App\Models\Order;
use App\Models\Status;
use App\Models\Product;
use App\Models\Servant;
use App\Models\Governorate;
use Illuminate\Http\Request;
use App\Models\OrderDetailes;
use App\Http\Controllers\Controller;
use App\Http\Requests\productSearchReuest;

class orderDetailesController extends Controller
{
     public function create()
    {
        $governorates = Governorate::all();
        $servants = Servant::all();
       
        return \view('admin.orderDetailes.create',compact('governorates','servants'));
    }

    public function cities($id)
    {
        $city = City::where('governorate_id',$id)->get();
        return \response()->json($city);
    }

    public function search(productSearchReuest $request)
    {
        // return $request;
        $productsReturend = Product::with('supplier','cities','status')->where('city_id',$request->city_id)->get();
        // return [$productsReturend,$request->shipping_price];
        return \response()->json($productsReturend);
    }

    public function forceDelete($id)      // DELETE ITEMS FROM ORDER DETAILES TABLE IF I DON,T CREATED NEW ORDER 
    {
        // GET ITEM FROM ORDER DETAILES TABLE  TO DELETE IT
            $item = OrderDetailes::withTrashed()->find($id);

        // CHECK IF ITEM IN ORDER DETAILES TABLE NOT HAVE ORDER_ID
            if(!$item->order_id == null)
            {
                return \redirect()->back()->with(['error' => 'هذه الشحنة لا يمكن مسحها لانها لدي اوردر']);
            }else
            {

        // RESTORE ITEM TO PRODUCTS TABLE 
            $item->product->restore();

        // CHANGE STATUS OF ITEM RESTORING TO PENDING 
            $update = $item->product->update(['status_id' => 1]);                

        // FORCE DELETE FOR THIS ITEM FROM ORDER DETAILES TABLE 
                $item->forceDelete();
                return \redirect()->back()->with(['success' => 'تم مسح الشحنة بنجاح من الاوردر و اعادتها الي جدول الشحنات']);
            }

    }

    public function addToCart(Request $request)     // TO ADD PRODUCT TO ORDER DETAILES PAGE AND DELETE IT FROM PRODUCTS PAGE
    {
        // DELETE ROW FROM PRODUCTS TABLE 
        $product_delete = Product::find($request->id);
        
        $product_delete->delete();
      
          // ADD PRODUCT TO ORDER DETAILES TABLE 
        $createOrderDetailes = OrderDetailes::create(
        [
            'product_id' => $product_delete->id,
            'product_status' => $product_delete->status_id,
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
        $orderDetailes = OrderDetailes::with('product')->where('order_id',null)->get();

        // GET LAST ROW IN STATUS TABLE 
        $lastStatus = Status::latest()->first();

        // GET ALL ROWS WITH OUT LAST ROW AND ROW OF NAME تاجيل AND تم رفضه IN STATUS TABLE 
        $allStatus = Status::where('id','<>',$lastStatus->id)->where('name','<>','تم رفضه')->where('name','<>','تاجيل')->get(); 

        $servants = Servant::where('deleted_at',null)->get();
        $orders = Order::get()->last();

        $items = OrderDetailes::where('order_id',null)->get();
        $totalPrice = $items->sum('total_price');
        // return $totalPrice;

        return view('admin.orderDetailes.submit_new_order',\compact('orderDetailes','allStatus','totalPrice','servants','orders'));
    }

    public function changeStatus(Request $request)
    {
     
        $prderDetailesRow = OrderDetailes::with('product')->find($request->id);

        // UPDATE STATUS ROW IN ORDER DETAILES TABLE 
        $updateStatusOrder = $prderDetailesRow->update(
            [
                'product_status' => $request->product_status
            ]);

                               
        // UPDATE STATUS ROW IN PRODUCTS  TABLE 
            $product = $prderDetailesRow->product->update(['status_id' => $request->product_status]);
            return \response()->json(
                [
                    'status' => true,
                    'msg' => 'تم تعديل حالة الشحنة الخاصة بخط السير و تم تعديل حالتها في جدول الشحنات بنجاح',
               ]);
    }

    public function changeShippingPrice(Request $request)
    {
        
        // UPDATE CHIPPING PRICE FOR ORDERS
        $price = OrderDetailes::with('product')->find($request->id);
        $price->update(
            [
                'shipping_price' => $request->price
            ]);
            

                // GET TOTAL PRICE FOR PRODUCT 
            $totalPrice = $price->product->product_price + $price->shipping_price;

            // return back();
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
}
