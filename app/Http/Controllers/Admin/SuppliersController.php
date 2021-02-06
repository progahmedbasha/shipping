<?php

namespace App\Http\Controllers\Admin;

use App\Models\City;
use App\Models\Supplier;
use App\Models\Governorate;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SuppliersController extends Controller
{
    public function index()
    {
        $governorates = Governorate::all();
        $suppliers = Supplier::all();
        return \view('admin.suppliers.index',\compact('suppliers','governorates'));
    }

    public function cities($id)
    {
        $city = City::where('governorate_id',$id)->get();
        return \response()->json($city);
    }

    public function store(Request $request)
    {
        try
        {
            // CREATE DATA ON DATABASE 
            $create = Supplier::create(
                [
                    'name'              => $request->name,
                    'adress'            => $request->adress,
                    'phone'             => $request->phone,
                    'city_id'           => $request->city_id,
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
            return \redirect()->route('suppliers.index')->with(['error' => 'هناك خطا ما برجاء المحاولة فيما بعد']);
        }
    }

    public function edit($id)
    {
        try
        {
            $supplier = Supplier::find($id);
            if($supplier)
            {
                $governorates = Governorate::whereHas('cities')->get();
                $gover_id = City::where('id',$supplier->city_id)->with('governorate')->get();
                // return $city;
                return \view('admin.suppliers.edit',\compact('supplier','governorates','gover_id'));
            }else
            {
                return \redirect()->route('suppliers.index')->with(['error' => 'هذا المورد غير موجود']);
            }
        }catch (\Throwable $th) 
        {
    
            // return $th;
            return \redirect()->route('suppliers.index')->with(['error' => 'هناك خطا ما برجاء المحاولة فيما بعد']);
        }
    }

    public function update($id,Request $request)
    {
        try
        {
            $Ssupplier = Supplier::find($id);
            if(!$Ssupplier)
            {
                return \redirect()->route('supliers.index')->with(['error' => 'هذه المدينة غير موجودة']);
            }else
            {
                $update = $Ssupplier->update(
                    [
                        'name'              => $request->name,
                        'adress'            => $request->adress,
                        'phone'             => $request->phone,
                        'city_id'           => $request->city_id,                       
                    ]);

                    return \redirect()->route('suppliers.index')->with(['success' => 'تم التعديل بنجاح']);
            }
        }catch (\Throwable $th) 
        {
    
            return $th;
            return \redirect()->route('suppliers.index')->with(['error' => 'هناك خطا ما برجاء المحاولة فيما بعد']);
        }
    }

    public function destroy(Request $request)
    {
        $supplier_delete = Supplier::find($request->id);
        $supplier_delete->delete();

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
            $suppliers = Supplier::onlyTrashed()->get();
            // return $servants;
            if($suppliers)
            {
                return \view('admin.suppliers.softDelete',\compact('suppliers'));
            }else
            {
                return \redirect()->route('suppliers.index')->with(['error' => 'لا يوجد موردين محزوفين ']);
            }
        }catch (\Throwable $th) 
        {
    
            return $th;
            return \redirect()->route('suppliers.index')->with(['error' => 'هناك خطا ما برجاء المحاولة فيما بعد']);
        }
    }

    public function restore(Request $request)
    {
        $supplier_restore = Supplier::withTrashed()->where('id',$request->id);

        $supplier_restore->restore();

        return \response()->json(
            [
                'status' => true,
                'msg' => 'تم التفعيل بنجاح',
                'id' => $request->id
            ]);
    }


}
