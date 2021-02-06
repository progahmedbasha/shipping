<?php

namespace App\Http\Controllers\Admin;

use App\Models\Servant;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ServantRequest;

class ServantsController extends Controller
{
    public function index()
    {
        $servants = Servant::all();
        return view('admin.servants.index',\compact('servants'));
    }

    public function store(ServantRequest $request)
    {
        try
        {
            // CREATE DATA ON DATABASE 
            $create = Servant::create(
                [
                    'name'      => $request->name,
                    'adress'    => $request->adress,
                    'phone'     => $request->phone,
                    'age'       => $request->age,
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
                    //  return back();
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
            return \redirect()->route('admins.index')->with(['error' => 'Something Error Please Try Again Later']);
        }
    }

    public function edit($id)
    {
        try
        {
            $servant = Servant::find($id);
            if($servant)
            {
                return \view('admin.servants.edit',\compact('servant'));
            }else
            {
                return \redirect()->route('servants.index')->with(['error' => 'هذا المندوب غير موجود']);
            }
        }catch (\Throwable $th) 
        {
    
            // return $th;
            return \redirect()->route('servants.index')->with(['error' => 'هناك خطا ما برجاء المحاولة فيما بعد']);
        }
    }

    public function update($id,ServantRequest $request)
    {
        try
        {
            $servant = Servant::find($id);
            if(!$servant)
            {
                return \redirect()->route('servants.index')->with(['error' => 'هذا المندوب غير موجود']);
            }else
            {
                $update = $servant->update(
                    [
                        'name'      => $request->name,
                        'adress'    => $request->adress,
                        'phone'     => $request->phone,
                        'age'       => $request->age,
                    ]);

                    return \redirect()->route('servants.index')->with(['success' => 'تم التعديل بنجاح']);
            }
        }catch (\Throwable $th) 
        {
    
            // return $th;
            return \redirect()->route('servants.index')->with(['error' => 'هناك خطا ما برجاء المحاولة فيما بعد']);
        }
    }

    public function destroy(Request $request)
    {
        $servant_delete = Servant::find($request->id);
        $servant_delete->delete();

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
            $servants = Servant::onlyTrashed()->get();
            // return $servants;
            if($servants)
            {
                return \view('admin.servants.softDelete',\compact('servants'));
            }else
            {
                return \redirect()->route('servants.index')->with(['error' => 'لا يوجد مناديب محزوفة ']);
            }
        }catch (\Throwable $th) 
        {
    
            // return $th;
            return \redirect()->route('servants.index')->with(['error' => 'هناك خطا ما برجاء المحاولة فيما بعد']);
        }
    }

    public function restore(Request $request)
    {
        $servant_restore = Servant::withTrashed()->where('id',$request->id);
        // return $servant_restore;
        $servant_restore->restore();

        return \response()->json(
            [
                'status' => true,
                'msg' => 'تم التفعيل بنجاح',
                'id' => $request->id
            ]);
    }
}
