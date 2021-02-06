<?php

namespace App\Http\Controllers\Admin;

use App\Models\Governorate;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\governoratesRequest;

class governoratesController extends Controller
{
    public function index()
    {
        $governorates = Governorate::all();
        return \view('admin.governorates.index',\compact('governorates'));
    }

    public function store(governoratesRequest $request)
    {
        try
        {
            // CREATE DATA ON DATABASE 
            $create = Governorate::create(
                [
                    'name'      => $request->name,
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
            return \redirect()->route('governorates.index')->with(['error' => 'هناك خطا ما برجاء المحاولة فيما بعد']);
        }
    }

    public function edit($id)
    {
        try
        {
            $governorate = Governorate::find($id);
            if($governorate)
            {
                return \view('admin.governorates.edit',\compact('governorate'));
            }else
            {
                return \redirect()->route('governorates.index')->with(['error' => 'هذه المحافظة غير موجودة']);
            }
        }catch (\Throwable $th) 
        {
    
            return $th;
            return \redirect()->route('governorates.index')->with(['error' => 'هناك خطا ما برجاء المحاولة فيما بعد']);
        }
    }

    public function update($id,governoratesRequest $request)
    {
        try
        {
            $governorate = Governorate::find($id);
            if(!$governorate)
            {
                return \redirect()->route('governorates.index')->with(['error' => 'هذه المحافظة غير موجودة']);
            }else
            {
                $update = $governorate->update(
                    [
                        'name'      => $request->name,
                        
                    ]);

                    return \redirect()->route('governorates.index')->with(['success' => 'تم التعديل بنجاح']);
            }
        }catch (\Throwable $th) 
        {
    
            return $th;
            return \redirect()->route('governorates.index')->with(['error' => 'هناك خطا ما برجاء المحاولة فيما بعد']);
        }
    }

    public function destroy(Request $request)
    {
        $gov_delete = Governorate::find($request->id);
        $gov_delete->delete();

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
            $governorates = Governorate::onlyTrashed()->get();
            // return $servants;
            if($governorates)
            {
                return \view('admin.governorates.softDelete',\compact('governorates'));
            }else
            {
                return \redirect()->route('governorates.index')->with(['error' => 'لا يوجد محافظات محزوفة ']);
            }
        }catch (\Throwable $th) 
        {
    
            return $th;
            return \redirect()->route('governorates.index')->with(['error' => 'هناك خطا ما برجاء المحاولة فيما بعد']);
        }
    }

    public function restore(Request $request)
    {
        $gov_restore = Governorate::withTrashed()->where('id',$request->id);

        $gov_restore->restore();

        return \response()->json(
            [
                'status' => true,
                'msg' => 'تم التفعيل بنجاح',
                'id' => $request->id
            ]);
    }

}
