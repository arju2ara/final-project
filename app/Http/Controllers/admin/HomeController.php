<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\category;
use App\Models\Parcel;
use App\Models\Staff;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; 
class HomeController extends Controller
{
    public function index(){
        $totalBranch= category::count();
        $totalStaff= Staff::count();
        $totalUser= User::where('role',1)->count();
        $totalrevenue= Parcel::sum('price');
        $totalParcel= Parcel::count();
        $totalCollectedParcels= Parcel::where('status', 'collected')->count();
        $totalPendingParcels = Parcel::where('status', 'Pending')->count();
        $totalAcceptedParcels = Parcel::where('status', 'Item Accepted by Courier')->count();
        $totalShippedParcels = Parcel::where('status', 'Shipped')->count();
        $totalInTransitParcels = Parcel::where('status', 'In-transit')->count();
        $totalPickedUpParcels = Parcel::where('status', 'Picked-up')->count();
        $totalReadyToPickupParcels = Parcel::where('status', 'Ready to pickup')->count();
        $totalOutForDeliveryParcels = Parcel::where('status', 'Out for delivery')->count();
        $totalArrivedParcels = Parcel::where('status', 'Arrived at Destination')->count();
        $totalUnsuccessfulDeliveryParcels = Parcel::where('status', 'Unsuccessful Delivery Attempt')->count();
        $totalDeliveredParcels = Parcel::where('status', 'Delivered')->count();
        return view('admin.dashboard',[
           'totalBranch'=>$totalBranch,
           'totalStaff'=>$totalStaff,
           'totalUser'=>$totalUser,
           'totalParcel'=>$totalParcel,
           'totalrevenue'=>$totalrevenue,
           'totalCollectedParcels'=>$totalCollectedParcels,
           'totalPendingParcels'=>$totalPendingParcels,
            'totalAcceptedParcels'=>$totalAcceptedParcels,
            'totalShippedParcels'=>$totalShippedParcels,
            'totalInTransitParcels'=>$totalInTransitParcels,
            'totalPickedUpParcels'=>$totalPickedUpParcels,
            'totalReadyToPickupParcels'=>$totalReadyToPickupParcels,
            'totalOutForDeliveryParcels'=>$totalOutForDeliveryParcels,
            'totalArrivedParcels'=>$totalArrivedParcels,
            'totalUnsuccessfulDeliveryParcels'=>$totalUnsuccessfulDeliveryParcels,
            'totalDeliveredParcels'=>$totalDeliveredParcels
        ]);
       // $admin= Auth::guard('admin')->user();
       // echo 'Welcome'.$admin->name.'<a href="'.route('admin.logout').'">Logout</a>';
    }
    public function logout(){
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login');
    }
}
