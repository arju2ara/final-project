<?php

use App\Http\Controllers\admin\AdminLoginController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ParcelController;
use App\Http\Controllers\admin\ShippedController;
use App\Http\Controllers\admin\StaffController;

use App\Http\Controllers\admin\AcceptItemController;
use App\Http\Controllers\admin\CollectedController;
use App\Http\Controllers\admin\PendingController;
use App\Http\Controllers\admin\OutOfController;
use App\Http\Controllers\admin\HomeController;

use App\Http\Controllers\admin\DeliverController;
use App\Http\Controllers\admin\InTransitController;
use App\Http\Controllers\admin\ReportController;
use App\Http\Controllers\admin\ArrivedController;
use App\Http\Controllers\admin\PickedupController;
use App\Http\Controllers\admin\UnsuccessfullController;
use App\Http\Controllers\admin\ReadyToPickController;
use App\Http\Controllers\admin\SettingController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\FrontController;
use Illuminate\Testing\PendingCommand;
use App\Http\Controllers\admin\UserController;
use App\Http\Controllers\admin\CategoryController;

Route::get('/', function () {
// return view('admin.login');


});

Route::get('/',[FrontController::class,'index'])->name('front.home');





Route::get('/forgot-password',[AuthController::class,'forgotPassword'])->name('front.forgotPassword');
Route::post('/process-forgot-password',[AuthController::class,'processForgotPassword'])->name('front.processForgotPassword');
Route::get('/reset-password/{token}',[AuthController::class,'resetPassword'])->name('front.resetPassword');
Route::post('/process-reset-password',[AuthController::class,'processResetPassword'])->name('front.processResetPassword');


Route::group(['prefix'=>'account'],function(){
  Route::group(['middleware'=>'guest'],function(){
    Route::get('/login',[AuthController::class,'login'])->name('account.login');
    Route::post('/login',[AuthController::class,'authenticate'])->name('account.authenticate');
    Route::get('/register',[AuthController::class,'register'])->name('account.register');

    Route::post('/process-register',[AuthController::class,'processRegister'])->name('account.processRegister');

    
  });

  Route::group(['middleware'=>'auth'],function(){
    Route::get('/profile',[AuthController::class,'profile'])->name('account.profile');
    Route::post('/update-profile', [AuthController::class, 'updateProfile'])->name('account.updateProfile');

    Route::get('/logout',[AuthController::class,'logout'])->name('account.logout');
    Route::get('/change-password',[AuthController::class,'showChangePasswordForm'])->name('account.changePassword');
    Route::post('/process-change-password',[AuthController::class,'changePassword'])->name('account.processChangePassword');
  });

  });


Route::group(['prefix'=>'admin'],function(){
Route::group(['middleware'=>'admin.guest'],function(){

    Route::get('/login',[AdminLoginController::class,'index'])->name('admin.login');
    Route::post('/authenticate',[AdminLoginController::class,'authenticate'])->name('admin.authenticate');
});


Route::group(['middleware'=>'admin.auth'],function(){
    Route::get('/dashboard',[HomeController::class,'index'])->name('admin.dashboard');
    Route::get('/logout',[HomeController::class,'logout'])->name('admin.logout');
    //Category Routes
    Route::get('/categories',[CategoryController::class,'index'])->name('categories.index');
    Route::get('/categories/create',[CategoryController::class,'create'])->name('categories.create');
    Route::post('/categories/store',[CategoryController::class,'store'])->name('categories.store');
    Route::get('/categories/{category}/edit',[CategoryController::class,'edit'])->name('categories.edit');
    Route::put('/categories/{category}',[CategoryController::class,'update'])->name('categories.update');
    Route::delete('/categories/{category}',[CategoryController::class,'destroy'])->name('categories.delete');
    Route::delete('/categories/{id}', [CategoryController::class,'destroy'])->name('categories.destroy');

  

    //staff Routes
   Route::get('/staffs',[StaffController::class,'index'])->name('staffs.index');
    Route::get('/staffs/create',[StaffController::class,'create'])->name('staffs.create');
   Route::post('/staffs/store',[StaffController::class,'store'])->name('staffs.store');
 Route::get('/staffs/{staff}/edit',[StaffController::class,'edit'])->name('staffs.edit');
  Route::put('/staffs/{staff}',[StaffController::class,'update'])->name('staffs.update');
   Route::delete('/staffs/{staff}',[StaffController::class,'destroy'])->name('staffs.delete');

   //track
   Route::post('/track', [ParcelController::class, 'trackParcel'])->name('track_parcel');
  // Route::get('/track', [ParcelController::class, 'trackParcel'])->name('track_parcel');
  Route::match(['get', 'post'], '/track', [ParcelController::class, 'trackParcel'])->name('track_parcel');

//report

//Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');
//Route::post('/reports/fetch', [ReportController::class, 'fetchReport'])->name('reports.fetch');
//Route::post('/reports/fetch', [ReportController::class, 'fetchReport'])->name('reports.fetch');
//Route::get('/report', 'ReportController@showReports')->name('report.show');
//Route::post('/admin/reports/fetch', 'App\Http\Controllers\admin\ReportController@fetchReport')->name('reports.fetch');
//Route::post('/fetch-reports', 'ReportController@fetch')->name('reports.fetch');

//Route::get('/reports', 'ReportController@index')->name('reports');


   //parcel
   Route::get('/parcels/create', [ParcelController::class, 'create'])->name('parcels.create');
   Route::resource('parcels', ParcelController::class);
   Route::get('/parcels/{parcel}/edit', [ParcelController::class, 'edit'])->name('parcels.edit');;
   Route::post('admin/parcels/store', [ParcelController::class, 'store'])->name('parcels.store');
   Route::put('admin/parcels/{parcel}',[ParcelController::class,'update'])->name('parcels.update');
  Route::delete('admin/parcels/{parcel}',[ParcelController::class,'destroy'])->name('parcels.delete');

  Route::get('admin/parcels/{id}', [ParcelController::class, 'detail'])->name('parcels.detail');
 
  Route::put('/parcels/{id}/change-status', [ParcelController::class, 'changeParcelStatus'])->name('parcels.changeParcelStatus');

//Accepted parcel
Route::get('/accepted-parcels', [AcceptItemController::class, 'index'])->name('accepted.parcels.index');
 
//Collected parcel
Route::get('/collected-parcels', [CollectedController::class, 'index'])->name('collected.parcels.index');

//pending
Route::get('/pending-parcels', [PendingController::class, 'index'])->name('pending.parcels.index');
//shipped
Route::get('/shipped-parcels', [ShippedController::class, 'index'])->name('shipped.parcels.index');
// intransit
Route::get('/intransit-parcels', [InTransitController::class, 'index'])->name('intransit.parcels.index');
//arrived
Route::get('/arrived-parcels', [ArrivedController::class, 'index'])->name('arrived.parcels.index');
//out of delivery
Route::get('/outof-parcels', [OutOfController::class, 'index'])->name('outof.parcels.index');
//ready to pickp
Route::get('/readyto-parcels', [ReadyToPickController::class, 'index'])->name('readyto.parcels.index');

//pickedup
Route::get('/pick-parcels', [PickedupController::class, 'index'])->name('pick.parcels.index');
//unsuccessfull attempt
Route::get('/unsuccess-parcels', [UnsuccessfullController::class, 'index'])->name('unsuccess.parcels.index');

//Deliver
Route::get('/deliver-parcels', [DeliverController::class, 'index'])->name('deliver.parcels.index');


//report
Route::post('/admin/parcels/report', [ParcelController::class , 'report'])->name('parcels.report');
Route::get('/parcel-report', [ParcelController::class , 'reportView'])->name('reportView');
//Route::get('/login',[AuthController::class,'login'])->name('account.login');

Route::get('/parcel/report/{id}', [ParcelController::class, 'reportView'])->name('parcel.reportView');
//users
Route::get('/users',[UserController::class,'index'])->name('users.index');

Route::get('/users/create',[UserController::class,'create'])->name('users.create');
Route::post('/users/store',[UserController::class,'store'])->name('users.store');
Route::get('/users/{user}/edit',[UserController::class,'edit'])->name('users.edit');
Route::put('/users/{user}',[UserController::class,'update'])->name('users.update');
Route::delete('/users/{user}',[UserController::class,'destroy'])->name('users.delete');
Route::delete('/users/{id}', 'UserController@destroy')->name('users.destroy');

//setting routes
Route::get('/change-password',[SettingController::class,'showChangePasswordForm'])->name('admin.showChangePasswordForm');
Route::post('/process-change-password',[SettingController::class,'processChangePassword'])->name('admin.processChangePassword');

});

});