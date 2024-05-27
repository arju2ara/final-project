<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use App\Models\Staff;
class StaffController extends Controller
{
   public function index(Request $request){
    $staffs= Staff::latest();

    if(!empty($request->get('keyword'))){
        $staffs= $staffs->where('staff','like','%'.$request->get('keyword').'%');
        $staffs= $staffs->orwhere('email','like','%'.$request->get('keyword').'%');
        $staffs= $staffs->orwhere('branch','like','%'.$request->get('keyword').'%');
      
    }
    $staffs=   $staffs->paginate(10);


return view('admin.staff.list',compact('staffs'));

   }

   public function create(){
    return view('admin.staff.create');

   }

   public function store(Request $request){

    try {
        // Debug: Log request data
        Log::info('Request data:', $request->all());

        // Validate the request data
        $validator = Validator::make($request->all(), [
            'staff' => 'required',
            'email' => 'required|unique:staffs,email',
            'password' => 'required',
            'branch' => 'required',
        ]);

        // Check if validation fails
        if ($validator->fails()) {
            // If validation fails, return error response
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ], 422); 
        }

        
        $staff = new Staff();
        $staff->staff = $request->staff;
        $staff->email = $request->email;
        $staff->password = $request->password;
        $staff->branch = $request->branch;
        $staff->save();

        session()->flash('success','Staff added successfully');

        return response()->json([
            'status' => true,
            'message' => 'Staff added successfully'
        ]);
    } catch (\Exception $e) {
       
        Log::error('Exception in store method: ' . $e->getMessage());

        
        return response()->json([
            'status' => false,
            'message' => 'Internal Server Error'
        ], 500);
    }

   }
   public function edit($staffId,Request $request){

    $staff = Staff::find($staffId);
    if(empty($staff )){
        return redirect()->route('staffs.index');
    }

 

    return view('admin.staff.edit',compact('staff'));
   }
   public function update($staffId, Request $request){
    try {
        $staff = Staff::find($staffId);
        if(empty($staff)){
            session()->flash('error','Staff not found');
            return response()->json([
                'status' => false,
                'notFound' => true,
                'message' => 'Staff not found'
            ]);
        }

        
        Log::info('Request data:', $request->all());

       
        $validator = Validator::make($request->all(), [
            'staff' => 'required',
            'email' => 'required|unique:staffs,email,' . $staffId,
            'password' => 'required',
            'branch' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        // Update staff data
        $staff->staff = $request->staff;
        $staff->email = $request->email;
        $staff->password = $request->password;
        $staff->branch = $request->branch;
        $staff->save();

        session()->flash('success','Staff updated successfully');

        return response()->json([
            'status' => true,
            'message' => 'Staff updated successfully'
        ]);
    } catch (\Exception $e) {
        Log::error('Exception in update method: ' . $e->getMessage());
        return response()->json([
            'status' => false,
            'message' => 'Internal Server Error'
        ], 500);
    }
}


   public function destroy($staffId,Request $request){
        
    $staff = Staff::find($staffId);
    if(empty($staff)){
        session()->flash('error','Staff not found!!');
        return response()->json([
            'status'=>true,
            'message'=>'Staff not found!'
        ]);
      

    }

    $staff->delete();
    session()->flash('success','Staff deleted successfully!');
    return response()->json([
        'status'=>true,
        'message'=>'Staff deleted successfully!'
    ]);

}
}
