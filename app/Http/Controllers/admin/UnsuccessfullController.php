<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Parcel;
class UnsuccessfullController extends Controller
{
    public function index(Request $request)
    {
        $parcels = Parcel::where('status', 'Unsuccessfull Delivery Attempt')->paginate(10);

        if(!empty($request->get('keyword'))){
            $parcels= $parcels->where('sender_name','like','%'.$request->get('keyword').'%');
            $parcels= $parcels->orwhere('recipient_name','like','%'.$request->get('keyword').'%');
            $parcels= $parcels->orwhere('id','like','%'.$request->get('keyword').'%');
           $parcels= $parcels->orwhere('status','like','%'.$request->get('keyword').'%');
        }
       

        return view('admin.parcel.unsuccesslist', compact('parcels'));
    } 
}
