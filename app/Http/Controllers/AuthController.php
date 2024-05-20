<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Dflydev\DotAccessData\Data;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB; 
use App\Mail\ResetPasswordEmail;

class AuthController extends Controller
{
    public function login(){
        return view('front.account.login');
    }
    public function register(){
 return view('front.account.register');
    }

    public function processRegister(Request $request){

$validator= Validator::make($request->all(),[
    'name'=>'required|min:3',
    'email'=>'required|email|unique:users',
    'password'=>'required|min:5|confirmed'

]);
if($validator->passes()){
    $user= new User;
    $user->name= $request->name;
    $user->email= $request->email;
    $user->phone= $request->phone;
    $user->password= Hash::make($request->password);
    $user->save();

    session()->flash('success','You have been registered successfully!');

    return redirect()->route('account.login');
   /* return response()->json([

        'status'=>true,

    ]);*/

} else{

return response()->json([

    'status'=>false,
    'errors'=> $validator->errors()

]);

}

    }


public function authenticate(Request $request){


    $validator= Validator::make($request->all(),[
        
        'email'=>'required|email',
        'password'=>'required',
    
    ]);
    if($validator->passes()){
        
        if(Auth::attempt(['email'=> $request->email,'password'=>$request->password],$request->get('remember'))){
            return redirect()->route('account.profile');

        } else{
           // session()->flash('error','Either email/passworrd is incorrect.');
            return redirect()->route('account.login')->withInput($request->only('email'))->with('error','Either email/passworrd is incorrect.');
        }



    }else{
        return redirect()->route('account.login')->withErrors($validator)->withInput($request->only('email'));

    }

}

public function profile(){
    $user=User::where('id',Auth::user()->id)->first();
return view('front.account.profile',[
    'user'=>$user
]);

}

public function updateProfile(Request $request){
    Log::info('Accessing URL: ' . $request->fullUrl() . ' with method: ' . $request->method());

$userId= Auth::user()->id;
    $validator= Validator::make($request->all(),[
        'name'=>'required',
        'email' => 'required|email|unique:users,email,' . $userId,

        'phone'=>'required',
    
    ]);
    if($validator->passes()){
        $user= User::find($userId);
        $user->name= $request->name;
        $user->email= $request->email;
        $user->phone= $request->phone;
        $user->save();

        session()->flash('success','Profile Updated successfully');

        return response()->json([
            'status'=>true,
            'message'=>'Profile Updated successfully'

        ]);

    }else{
        return response()->json([
            'status'=>false,
            'errors'=>$validator->errors()

        ]);

    }

}

public function logout(){
    Auth::logout();
    return redirect()->route('account.login')->with('success','You successfully logged out!');
}


public function showChangePasswordForm(){
    return view('front.account.change-password');
}

public function changePassword(Request $request){
    Log::info('Request method: ' . request()->method()); // Good for debugging

    $validator = Validator::make($request->all(), [
        'old_password' => 'required',
        'new_password' => 'required|min:5',
        'confirm_password' => 'required|same:new_password',
    ]);

    if ($validator->passes()) {
        $user = User::select('id', 'password')->where('id', Auth::user()->id)->first();

        if (!Hash::check($request->old_password, $user->password)) {
            session()->flash('error', 'Your old password is incorrect. Please try again.');
            return redirect()->route('account.changePassword');
        }

        User::where('id', $user->id)->update([
            'password' => Hash::make($request->new_password)
        ]);

        session()->flash('success', 'Your password has been successfully changed.');
        return redirect()->route('account.profile'); // Redirecting to a safer page, such as the profile page
    } else {
        return response()->json([
            'status' => false,
            'errors' => $validator->errors()
        ]);
    }
}


public function forgotPassword(){

    return view('front.account.forgot-password');
}

public function processForgotPassword(Request $request){
$validator= Validator::make($request->all(),[
'email'=>'required|email|exists:users,email'
]);
if($validator->fails()){
    return redirect()->route('front.forgotPassword')->withInput()->withErrors($validator);

}
$token=Str::random(60);
DB::table('password_reset_tokens')->where('email',$request->email)->delete();
DB::table('password_reset_tokens')->insert([
'email'=>$request->email,
'token'=>$token,
'created_at'=>now()

]);

//send email here
$user = User::where('email',$request->email)->first();
$formData=[
    'token'=>$token,
    'user'=>$user,
    'mailSubject'=>'You have requested to reset your password'
];
Mail::to($request->email)->send(new ResetPasswordEmail($formData));

return redirect()->route('front.forgotPassword')->with('success','Please check ypur inbox to reset your password.');
}

public function resetPassword($token){
  $tokenExist=  DB::table('password_reset_tokens')->where('token',$token)->first();
if($tokenExist== null){
    return redirect()->route('front.forgotPassword')->with('error','Invalid request');
}

  return view('front.account.reset-password',[
    'token'=>$token
  ]);


}

public function processResetPassword(Request $request){

$token = $request->token;

$tokenObj=  DB::table('password_reset_tokens')->where('token',$token)->first();
if($tokenObj== null){
    return redirect()->route('front.forgotPassword')->with('error','Invalid request');
}
$user= User::where('email',$tokenObj->email)->first();

$validator= Validator::make($request->all(),[
    'new_password'=>'required|min:5',
    'confirm_password'=>'required|same:new_password'
    ]);
    if($validator->fails()){
        return redirect()->route('front.resetPassword',$token)->withErrors($validator);
    
    }

    User::where('id',$user->id)->update([
        'password'=>Hash::make($request->new_password)
    ]);

    DB::table('password_reset_tokens')->where('email',$user->email)->delete();
    return redirect()->route('account.login')->with('success','you have successfully updated your password.');


}


}
