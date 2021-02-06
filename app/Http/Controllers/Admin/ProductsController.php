<?php

namespace App\Http\Controllers\Admin;

use App\Models\City;
use App\Models\Status;
use App\Models\Product;
use App\Models\Supplier;
use App\Models\Governorate;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\productsRequest;

class ProductsController extends Controller
{
    public function index()
    {
        $governorates = Governorate::all();
        $suppliers = Supplier::all();
        $products = Product::all();
        $status = Status::all();
        return \view('admin.products.index',\compact('products','governorates','suppliers','status'));
    }

    public function cities($id)
    {
        $city = City::where('governorate_id',$id)->get();
        return \response()->json($city);
    }

    public function store(productsRequest $request)
    {
        try
        {
           
            // CREATE DATA ON DATABASE 
            $create = Product::create(
                [
                    'supplier_id'        => $request->supplier_id,
                    'resever_name'       => $request->resever_name,
                    'resver_phone'       => $request->resver_phone,
                    'city_id'            => $request->city_id,
                    'adress'             => $request->adress,
                    'product_price'      => $request->product_price,
                    // 'status_id'          => $request->status_id,
                    'status_id'          => 1,
                    'notes'              => $request->notes,
                ]);

                // RETURN FLASH MESSAGE 
                if($create)
				{
	 
				 return response()->json(
					 [
						 'status'   => true,
                         'msg'      => 'تم الحفظ بنجاح',
                         'id'       => $create->id
					 ]);
				}else
				{
				 return response()->json(
					 [
						 'error' => 'هناك خطا ما برجاءالمحاولة فيما بعد'
					 ]);
				}
        }catch (\Throwable $th) 
        {
    
            return $th;
            return \redirect()->route('products.index')->with(['error' => 'هناك خطا ما برجاء المحاولة فيما بعد']);
        }
    }

    public function edit($id)
    {
        try
        {
            $product = Product::find($id);
            if($product)
            {
                $suppliers = Supplier::all();
                $status = Status::all();
                $governorates = Governorate::whereHas('cities')->get();
                $gover_id = City::where('id',$product->city_id)->with('governorate')->get();
                // return $city;
                return \view('admin.products.edit',\compact('product','governorates','gover_id','suppliers','status'));
            }else
            {
                return \redirect()->route('products.index')->with(['error' => 'هذا المورد غير موجود']);
            }
        }catch (\Throwable $th) 
        {
    
            // return $th;
            return \redirect()->route('products.index')->with(['error' => 'هناك خطا ما برجاء المحاولة فيما بعد']);
        }
    }

    public function update($id,productsRequest $request)
    {
        try
        {
            $product = Product::find($id);
            if(!$product)
            {
                return \redirect()->route('products.index')->with(['error' => 'هذه الشحنة غير موجودة']);
            }else
            {
                $update = $product->update(
                    [
                        'supplier_id'        => $request->supplier_id,
                        'resever_name'       => $request->resever_name,
                        'resver_phone'       => $request->resver_phone,
                        'city_id'            => $request->city_id,
                        'adress'             => $request->adress,
                        'product_price'      => $request->product_price,
                        'status_id'          => $request->status_id,
                        'notes'              => $request->notes,                  
                    ]);

                    return \redirect()->route('products.index')->with(['success' => 'تم التعديل بنجاح']);
            }
        }catch (\Throwable $th) 
        {
    
            return $th;
            return \redirect()->route('products.index')->with(['error' => 'هناك خطا ما برجاء المحاولة فيما بعد']);
        }
    }

    public function destroy(Request $request)
    {
        $product_delete = Product::find($request->id);
        $product_delete->delete();

        return \response()->json(
            [
                'status' => true,
                'msg' => 'تم الحزف بنجاح',
                'id' => $request->id
            ]);
    }

    public function getSoftDelete()
    {
        try
        {
            $last_status_id = Status::where('deleted_at',null)->get()->last()->id;
            
            // return $last_status_id;
            $products = Product::onlyTrashed()->get();
            // return $servants;
            if($products)
            {
                return \view('admin.products.softDelete',\compact('products','last_status_id'));
            }else
            {
                return \redirect()->route('products.index')->with(['error' => 'لا يوجد شحنات محزوفة ']);
            }
        }catch (\Throwable $th) 
        {
    
            return $th;
            return \redirect()->route('products.index')->with(['error' => 'هناك خطا ما برجاء المحاولة فيما بعد']);
        }
    }

    public function restore(Request $request)
    {
        $product_restore2 = Product::withTrashed()->with('ordersDetailes')->where('id',$request->id)->get();
      
        $product_restore = Product::withTrashed()->where('id',$request->id);
        $orderDetailsCount =  $product_restore2->pluck('ordersDetailes')->count();
        $last_status_id = Status::where('deleted_at',null)->get()->last()->id;
       


        if($orderDetailsCount > 0)
        {
            return \response()->json(
                [
                    'status'    => false,
                    'msg'   => 'لا يمكن تفعيل هذه الشحنة لان تم اضافتها لاوردر من قبل',
                    'id'    => $request->id
                ]);
        }else
        {
            if($product_restore2->pluck('status_id')->implode(', ') == $last_status_id)
            {
                $product_restore->restore();

                $update = $product_restore2->update(
                    [
                            'status_id' => 1
                    ]);
    
                return \response()->json(
                    [
                        'status' => true,
                        'msg' => 'تم التفعيل بنجاح',
                        'id' => $request->id
                    ]);
            }
        }
    }

    public function show($id)
    {
        try
        {
            $product = Product::find($id);
            if(!$product)
            {
                return \redirect()->route('products.index')->with(['error' => 'هذه الشحنة غير موجودة']);

            }else
            {
                return \view('admin.products.show',\compact('product'));
            }
        }catch (\Throwable $th) 
        {
    
            return $th;
            return \redirect()->route('products.index')->with(['error' => 'هناك خطا ما برجاء المحاولة فيما بعد']);
        }
    }

}
