<?php

namespace App\Http\Controllers\admin;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\category;
use Illuminate\Support\Facades\Log;


class CategoryController extends Controller
{
    public function index(Request $request){
        $categories= Category::latest();

        if(!empty($request->get('keyword'))){
            $categories= $categories->where('Street','like','%'.$request->get('keyword').'%');
            $categories= $categories->orwhere('Contract','like','%'.$request->get('keyword').'%');
            $categories= $categories->orwhere('Country','like','%'.$request->get('keyword').'%');
            $categories= $categories->orwhere('City','like','%'.$request->get('keyword').'%');
        }
$categories=  $categories->paginate(10);


 return view('admin.category.list',compact('categories'));

    }


    public function create(){

return view('admin.category.create');
    }




    public function store(Request $request){
        try {
            // Debug: Log request data
            Log::info('Request data:', $request->all());
    
            // Validate the request data
            $validator = Validator::make($request->all(), [
                'Street' => 'required',
                'City' => 'required',
                'Country' => 'required',
                'Contract' => 'required',
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
            $category = new Category();
            $category->Street = $request->Street;
            $category->City = $request->City;
            $category->Country = $request->Country;
            $category->Contract = $request->Contract;
            $category->save();
    
            session()->flash('success','Branch added successfully');
            // If data is saved successfully, return success response
            return response()->json([
                'status' => true,
                'message' => 'Branch added successfully'
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
    
    

    public function edit($categoryId,Request $request){
        $category = Category::find($categoryId);
            if(empty($category)){
                return redirect()->route('categories.index');
            }

         

            return view('admin.category.edit',compact('category'));

    }




    
           
    
            
    public function update($categoryId,Request $request){

        try {
           

            $category = Category::find($categoryId);
            if(empty($category)){
                session()->flash('error','Branch not found');

                return response()->json([
                    'status'=>false,
                    'notFound'=>true,
                    'message'=>'Branch not found'
                ]);
            }

            // Debug: Log request data
            Log::info('Request data:', $request->all());
    
            // Validate the request data
            $validator = Validator::make($request->all(), [
                'Street' => 'required',
                'City' => 'required',
                'Country' => 'required',
                'Contract' => 'required',
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
           
            $category->Street = $request->Street;
            $category->City = $request->City;
            $category->Country = $request->Country;
            $category->Contract = $request->Contract;
            $category->save();

            session()->flash('success','Branch updated successfully');
    
            // If data is saved successfully, return success response
            return response()->json([
                'status' => true,
                'message' => 'Branch updated successfully'
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

  public function destroy($categoryId,Request $request){
        
        $category = Category::find($categoryId);
        if(empty($category)){
            session()->flash('error','Branch not found!!');
            return response()->json([
                'status'=>true,
                'message'=>'Branch not found!'
            ]);
          
            // return redirect()->route('categories.index');
        }

        $category->delete();
        session()->flash('success','Branch deleted successfully!');
        return response()->json([
            'status'=>true,
            'message'=>'Branch deleted successfully!'
        ]);

    } 
    
}
