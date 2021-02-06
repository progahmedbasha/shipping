<?php

namespace App\Http\Controllers\Admin;

use App\Models\Status;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StatusRequest;

class StatusController extends Controller
{
    public function index()
    {
        $allStatus = Status::all();
        return \view('admin.status.index',\compact('allStatus'));
    }

    public function store(StatusRequest $request)
    {
        try
        {
            // CREATE DATA ON DATABASE 
            $create = Status::create(
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
            return \redirect()->route('status.index')->with(['error' => 'هناك خطا ما برجاء المحاولة فيما بعد']);
        }
    }

    public function edit($id)
    {
        try
        {
            $status = Status::find($id);
            if($status)
            {
                return \view('admin.status.edit',\compact('status'));
            }else
            {
                return \redirect()->route('status.index')->with(['error' => 'هذه الحالة غير موجودة']);
            }
        }catch (\Throwable $th) 
        {
    
            // return $th;
            return \redirect()->route('status.index')->with(['error' => 'هناك خطا ما برجاء المحاولة فيما بعد']);
        }
    }

    public function update($id,StatusRequest $request)
    {
        try
        {
            $status = Status::find($id);
            if(!$status)
            {
                return \redirect()->route('status.index')->with(['error' => 'هذه الحالة غير موجودة']);
            }else
            {
                $update = $status->update(
                    [
                        'name'      => $request->name,
                        
                    ]);

                    return \redirect()->route('status.index')->with(['success' => 'تم التعديل بنجاح']);
            }
        }catch (\Throwable $th) 
        {
    
            return $th;
            return \redirect()->route('status.index')->with(['error' => 'هناك خطا ما برجاء المحاولة فيما بعد']);
        }
    }

    public function destroy(Request $request)
    {
        $status_delete = Status::find($request->id);
        $status_delete->delete();

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
            $allStatus = Status::onlyTrashed()->get();
            // return $servants;
            if($allStatus)
            {
                return \view('admin.status.softDeelte',\compact('allStatus'));
            }else
            {
                return \redirect()->route('status.index')->with(['error' => 'لا يوجد حالات محزوفة ']);
            }
        }catch (\Throwable $th) 
        {
    
            return $th;
            return \redirect()->route('status.index')->with(['error' => 'هناك خطا ما برجاء المحاولة فيما بعد']);
        }
    }

    public function restore(Request $request)
    {
        $status_restore = Status::withTrashed()->where('id',$request->id);
        // return $servant_restore;
        $status_restore->restore();

        return \response()->json(
            [
                'status' => true,
                'msg' => 'تم التفعيل بنجاح',
                'id' => $request->id
            ]);
    }

}
