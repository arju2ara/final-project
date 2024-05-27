<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Parcel;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;

class ParcelController extends Controller
{
public function index(Request $request)
    {
       // $parcels = Parcel::all();
      
       $parcels= Parcel::latest();

        if(!empty($request->get('keyword'))){
            $parcels= $parcels->where('sender_name','like','%'.$request->get('keyword').'%');
            $parcels= $parcels->orwhere('recipient_name','like','%'.$request->get('keyword').'%');
            $parcels= $parcels->orwhere('id','like','%'.$request->get('keyword').'%');
           $parcels= $parcels->orwhere('status','like','%'.$request->get('keyword').'%');
        }
        $parcels=  $parcels->paginate(10);


        return view('admin.parcel.list', compact('parcels'));
    } 

    

    public function create()
    {
        $categories = Category::all();
       // dd( $categories);
        return view('admin.parcel.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'sender_name' => 'required',
            'sender_address' => 'required',
            'sender_contact' => 'required',
            'recipient_name' => 'required',
            'recipient_address' => 'required',
            'recipient_contact' => 'required',
            'weight' => 'required|numeric',
            'height' => 'required|numeric',
            'length' => 'required|numeric',
            'width' => 'required|numeric',
            'price' => 'required|numeric',
            'status' => 'required|string',
        ]);

        $parcel = new Parcel($request->all());
        $parcel->save();

        return redirect()->route('parcels.index')->with('success', 'Parcel created successfully.');
    }

    public function show(Parcel $parcel)
    {
       // return view('parcels.show', compact('parcel'));
    }

    public function edit(Parcel $parcel)
    {
        $categories = Category::all();
        return view('admin.parcel.edit', compact('parcel', 'categories'));
    }

  public function update(Request $request, Parcel $parcel)
    {
        $request->validate([
            'sender_name' => 'required',
            'sender_address' => 'required',
            'sender_contact' => 'required',
            'recipient_name' => 'required',
            'recipient_address' => 'required',
            'recipient_contact' => 'required',
            'weight' => 'required|numeric',
            'height' => 'required|numeric',
            'length' => 'required|numeric',
            'width' => 'required|numeric',
            'price' => 'required|numeric',
            'status' => 'required|string',
        ]);

        $parcel->update($request->all());

        return redirect()->route('parcels.index')->with('success', 'Parcel updated successfully.');
    }


   public function destroy($parcelId,Request $request){

        $parcel = Parcel::find($parcelId);
        if(empty($parcel)){
            session()->flash('error','Parcel not found!!');
            return response()->json([
                'status'=>true,
                'message'=>'Parcel  not found!'
            ]);
          

        }

        $parcel ->delete();
        session()->flash('success','Parcel deleted successfully!');
        return response()->json([
            'status'=>true,
            'message'=>'Parcel deleted successfully!'
        ]);
       
    }


    public function detail($parcelId) {
        $parcel = Parcel::where('id', $parcelId)->first();
        if (!$parcel) {

            return redirect()->route('parcels.index')->with('error', 'No parcel found with the provided ID.');
        }
        return view('admin.parcel.detail', ['parcel' => $parcel]);
    }


    public function changeParcelstatus(Request $request,$parcelId){
        $parcel= Parcel::find($parcelId);

        if (!$parcel) {
            return response()->json(['status' => false, 'message' => 'Parcel not found']);
        }
        $parcel->status = $request->input('status');
      
        $parcel->save();
         session()->flash('success','Parcel Status Changed successfully!');
     

        return redirect()->route('parcels.detail', $parcel->id);
    }
     

  
    public function accountTrackParcel(Request $request)
{

    if ($request->has('ref_no') && $request->filled('ref_no')) {
        $keyword = $request->ref_no;
        $parcel = Parcel::where('id', $keyword)->first();

        if (!$parcel) {

            $error = "No parcel found with that ID.";
            return view('front.account.track-parcel', compact('error'));
        }


        return view('front.account.track-parcel', compact('parcel'));
    }


    return view('front.account.track-parcel');
}


    
    public function trackParcel(Request $request)
{

    if ($request->has('ref_no') && $request->filled('ref_no')) {
        $keyword = $request->ref_no;
        $parcel = Parcel::where('id', $keyword)->first();

        if (!$parcel) {

            $error = "No parcel found with that ID.";
            return view('admin.track.track', compact('error'));
        }


        return view('admin.track.track', compact('parcel'));
    }


    return view('admin.track.track');
}

public function reportView(){

    return view('admin.report.report');
}
public function report(Request $request)
{
    
    $parcels = collect();

    if ($request->isMethod('post')) {
        $request->validate([
            'startDate' => 'required|date',
            'endDate' => 'required|date|after_or_equal:startDate'
        ]);

        $parcels = Parcel::whereDate('created_at', '>=', $request->startDate)
                         ->whereDate('created_at', '<=', $request->endDate)
                         ->get();
    }

    return view('admin.report.report', ['parcels' => $parcels]);
}


}