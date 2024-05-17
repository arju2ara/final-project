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


   /* public function update($parcelId,Request $request){
        try {
    
            $parcel = Parcel::find($parcelId);
            if(empty($parcel)){
                session()->flash('error','Parcel not found');
    
                return response()->json([
                    'status'=>false,
                    'notFound'=>true,
                    'message'=>'Parcel not found'
                ]);
            }
    
            // Debug: Log request data
            Log::info('Request data:', $request->all());
    
            // Validate the request data
            $validator = Validator::make($request->all(), [
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
           
            $parcel->sender_name = $request->sender_name;
            $parcel->sender_address = $request->sender_address;
            $parcel->sender_contact = $request->sender_contact;
            $parcel->recipient_name = $request->recipient_name;
            $parcel->recipient_address = $request->recipient_address;
            $parcel->recipient_contact  = $request->recipient_contact ;
            $parcel->weight = $request->weight;
            $parcel->height = $request->height;
            $parcel->length = $request->length;
            $parcel->width = $request->width;  
            $parcel->price = $request->price;
            $parcel->save();
    
            session()->flash('success','Parcel updated successfully');
    
            // If data is saved successfully, return success response
            return response()->json([
                'status' => true,
                'message' => 'Parcel updated successfully'
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
       } */

   // public function destroy(Parcel $parcel)
   
   public function destroy($parcelId,Request $request){

        $parcel = Parcel::find($parcelId);
        if(empty($parcel)){
            session()->flash('error','Parcel not found!!');
            return response()->json([
                'status'=>true,
                'message'=>'Parcel  not found!'
            ]);
          
            // return redirect()->route('categories.index');
        }

        $parcel ->delete();
        session()->flash('success','Parcel deleted successfully!');
        return response()->json([
            'status'=>true,
            'message'=>'Parcel deleted successfully!'
        ]);
       // $parcel->delete();
       // return redirect()->route('parcels.index')->with('success', 'Parcel deleted successfully.');
    }


    public function detail($parcelId) {
        $parcel = Parcel::where('id', $parcelId)->first();
        if (!$parcel) {
            // If no parcel is found, redirect back or to another page with a message
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
       // $parcel->status= $request->status;
       // $parcel->shipped_date= $request->shipped_date;
        $parcel->save();
         session()->flash('success','Parcel Status Changed successfully!');
       return response()->json([
            'status'=>true,
            'redirectUrl' => route('parcels.detail', $parcel->id) 
           // 'message'=>'Parcel Status Changed successfully!'
        ]);
    }
     

    
    public function trackParcel(Request $request)
{
    // Check if the request contains 'ref_no'
    if ($request->has('ref_no') && $request->filled('ref_no')) {
        $keyword = $request->ref_no;
        $parcel = Parcel::where('id', $keyword)->first();

        if (!$parcel) {
            // If no parcel found, return view with an error message but do not pass a null parcel
            $error = "No parcel found with that ID.";
            return view('admin.track.track', compact('error'));
        }

        // If a parcel is found, return the view with the parcel data
        return view('admin.track.track', compact('parcel'));
    }

    // For initial load or if no ID is provided, just return the view without any parcel or error message
    return view('admin.track.track');
}


public function report(Request $request)
{
    $startDate = $request->startDate;
    $endDate = $request->endDate;

    $parcels = Parcel::whereDate('created_at', '>=', $startDate)
                     ->whereDate('created_at', '<=', $endDate)
                     ->get();

    return view('admin.report.report', compact('parcels'));
}
    

}