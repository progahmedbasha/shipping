<?php

namespace App\Http\Controllers\Admin;

use App\Models\City;
use App\Models\Governorate;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CitiesController extends Controller
{
    public function index()
    {
        $cities = City::all();
        $governorates = Governorate::all();
        // return $governorates;
        return \view('admin.cities.index',\compact('cities','governorates'));
    }

    public function store(Request $request)
    {
        try
        {
            // CREATE DATA ON DATABASE 
            $create = City::create(
                [
                    'name'              => $request->name,
                    'governorate_id'    => $request->governorate_id,
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
            return \redirect()->route('cities.index')->with(['error' => 'هناك خطا ما برجاء المحاولة فيما بعد']);
        }
    }

    public function edit($id)
    {
        try
        {
            $city = City::find($id);
            if($city)
            {
                $governorates = Governorate::all();
                return \view('admin.cities.edit',\compact('city','governorates'));
            }else
            {
                return \redirect()->route('cities.index')->with(['error' => 'هذه المدينة غير موجودة']);
            }
        }catch (\Throwable $th) 
        {
    
            return $th;
            return \redirect()->route('cities.index')->with(['error' => 'هناك خطا ما برجاء المحاولة فيما بعد']);
        }
    }

    public function update($id,Request $request)
    {
        try
        {
            $city = City::find($id);
            if(!$city)
            {
                return \redirect()->route('cities.index')->with(['error' => 'هذه المدينة غير موجودة']);
            }else
            {
                $update = $city->update(
                    [
                        'name'              => $request->name,
                        'governorate_id'    => $request->governorate_id,                        
                    ]);

                    return \redirect()->route('cities.index')->with(['success' => 'تم التعديل بنجاح']);
            }
        }catch (\Throwable $th) 
        {
    
            return $th;
            return \redirect()->route('cities.index')->with(['error' => 'هناك خطا ما برجاء المحاولة فيما بعد']);
        }
    }

    public function destroy(Request $request)
    {
        $city_delete = City::find($request->id);
        $city_delete->delete();

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
            $cities = City::onlyTrashed()->get();
            // return $servants;
            if($cities)
            {
                return \view('admin.cities.softDelete',\compact('cities'));
            }else
            {
                return \redirect()->route('cities.index')->with(['error' => 'لا يوجد مدن محزوفة ']);
            }
        }catch (\Throwable $th) 
        {
    
            return $th;
            return \redirect()->route('cities.index')->with(['error' => 'هناك خطا ما برجاء المحاولة فيما بعد']);
        }
    }

    public function restore(Request $request)
    {
        $city_restore = City::withTrashed()->where('id',$request->id);

        $city_restore->restore();

        return \response()->json(
            [
                'status' => true,
                'msg' => 'تم التفعيل بنجاح',
                'id' => $request->id
            ]);
    }

}
