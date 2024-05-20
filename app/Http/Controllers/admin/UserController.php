<?php

namespace App\Http\Controllers\admin;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
class UserController extends Controller
{
    
   public function index(Request $request){
    $users= User::latest();
    if(!empty($request->get('keyword'))){
        $users= $users->where('name','like','%'.$request->get('keyword').'%');
        $users= $users->orwhere('email','like','%'.$request->get('keyword').'%');
        $users= $users->orwhere('phone','like','%'.$request->get('keyword').'%');
        $users= $users->orwhere('id','like','%'.$request->get('keyword').'%');
    }

    $users=  $users->paginate(10);
    return view('admin.users.list',[
        'users'=>$users
    ]);

   } 

   
   public function create(){

    return view('admin.users.create');
    

}

public function store(Request $request){

    try {
        // Debug: Log request data
        Log::info('Request data:', $request->all());

        // Validate the request data
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password'=>'required|min:5',
            'phone' => 'required',
        ]);

        // Check if validation fails
        if ($validator->fails()) {
            // If validation fails, return error response
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ], 422); // Use 422 Unprocessable Entity status code for validation errors
        }

        // If validation passes, proceed to save data
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->phone = $request->phone;
        $user->status = $request->status;
        $user->save();

        session()->flash('success','User added successfully');
        // If data is saved successfully, return success response
        return response()->json([
            'status' => true,
            'message' => 'User added successfully'
        ]);
    } catch (\Exception $e) {
        // Log any exceptions
        Log::error('Exception in store method: ' . $e->getMessage());

        // Return an error response
        return response()->json([
            'status' => false,
            'message' => 'Internal Server Error'
        ], 500);
    }

   }

   
   public function edit($userId,Request $request){

    $user = User::find($userId);
    if(empty($user )){
        $message= 'User not found';
        session()->flash('error',$message);
        return redirect()->route('users.index');
    }

 

    return view('admin.users.edit',compact('user'));
   }


   public function update($userId,Request $request){
    try {

        $user = User::find($userId);
        if(empty($user)){
            session()->flash('error','User not found');

            return response()->json([
                'status'=>false,
                'notFound'=>true,
                'message'=>'User not found'
            ]);
        }

        // Debug: Log request data
        Log::info('Request data:', $request->all());

        // Validate the request data
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$userId.',id',
            
            'phone' => 'required',
        ]);

        // Check if validation fails
        if ($validator->fails()) {
            // If validation fails, return error response
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ], 422); // Use 422 Unprocessable Entity status code for validation errors
        }

        // If validation passes, proceed to save data
       
        $user->name = $request->name;
        $user->email = $request->email;
        if($request->password !=''){
            $user->password = Hash::make($request->password);
        }
        $user->status = $request->status;
        $user->phone = $request->phone;
        $user->save();

        session()->flash('success','User updated successfully');

        // If data is saved successfully, return success response
        return response()->json([
            'status' => true,
            'message' => 'User updated successfully'
        ]);
    } catch (\Exception $e) {
        // Log any exceptions
        Log::error('Exception in store method: ' . $e->getMessage());

        // Return an error response
        return response()->json([
            'status' => false,
            'message' => 'Internal Server Error'
        ], 500);
    }
   }

   public function destroy($userId,Request $request){
        
    $user = User::find($userId);
    if(empty( $user)){
        session()->flash('error','User not found!!');
        return response()->json([
            'status'=>true,
            'message'=>'User not found!'
        ]);
      
        // return redirect()->route('categories.index');
    }

    $user->delete();
    session()->flash('success','User deleted successfully!');
    return response()->json([
        'status'=>true,
        'message'=>'User deleted successfully!'
    ]);

}



}