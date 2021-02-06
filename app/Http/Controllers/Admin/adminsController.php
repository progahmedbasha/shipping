<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin;
use Illuminate\Http\Request;
use App\Http\Requests\AdminRequest;
use App\Http\Controllers\Controller;

class adminsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $admins = Admin::all();
        return \view('admin.admins.index',\compact('admins'));
    }

   

    
    public function store(AdminRequest $request)
    {
        try
        {
            // CREATE DATA ON DATABASE 
            $create = Admin::create(
                [
                    'name'      => $request->name,
                    'email'     => $request->email,
                    'phone'     => $request->phone,
                    'password'  => bcrypt($request->password),
                ]);

                // RETURN FLASH MESSAGE 
                if($create)
				{
	 
				 return response()->json(
					 [
						 'status' => true,
						 'msg' => 'تم الحفظ بنجاح'
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
            return \redirect()->route('admins.index')->with(['error' => 'Something Error Please Try Again Later']);
        }
    }

   

   
    public function update(Request $request)
    {
        $adminUpdate = Admin::find($request->admin_id);
        
       if($adminUpdate)
       {
          return $request;
            $update = $adminUpdate->update(
                [
                    'name'          => $request->name,
                    'email'          => $request->email,
                    'phone'            => $request->phone,
                ]);
            // if($request->has('password'))
            // {
            //     $admin->password = bcrypt($request->password);
            //     $admin->save();   
            // }
                return response()->json(
                    [
                        'status' => true,
                        'msg' => 'تم التعديل بنجاح'
                    ]);
       }else
       {
            return response()->json(
                [
                    'status' => false,
                    'msg' => 'تم  الفشل'
                ]);
       }
    }

    
    public function destroy(Request $request)
    {
        $admin_delete = Admin::find($request->id);
        $admin_delete->delete();

        return \response()->json(
            [
                'status' => true,
                'msg' => 'تم الحزف بنجاح'
            ]);
    }
}
