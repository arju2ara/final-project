@extends('admin.layouts.app')
@section('content')
    

<!-- Content Header (Page header) -->
<section class="content-header">					
    <div class="container-fluid my-2">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Parcel List</h1>
            </div>
            <div class="col-sm-6 text-right">
                <a href="{{route('parcels.create')}}" class="btn btn-primary">+Add New</a>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->
</section>
<!-- Main content -->
<section class="content">
    <!-- Default box -->
    <div class="container-fluid">
        @include('admin.message')
        <div class="card">
            <form action="" method="GET">
            <div class="card-header">
                <div class="card-title">
                    <button type="button" onclick="window.location.href='{{route('parcels.index')}}'" class="btn btn-default btn-sm">Reset</button>
                </div>
                <div class="card-tools">
                    <div class="input-group input-group" style="width: 250px;">
                        <input  value="{{Request::get('keyword')}}" type="text" name="keyword" class="form-control float-right" placeholder="Search">
    
                        <div class="input-group-append">
                          <button type="submit" class="btn btn-default">
                            <i class="fas fa-search"></i>
                          </button>
                        </div>
                      </div>
                </div>
          
            </div>
        </form>
            <div class="card-body table-responsive p-0">								
                <table class="table table-hover text-nowrap">
                    <thead>
                        <tr>
                            <th width="60"> Reference ID#</th>
                            <th>Sender Name</th>
                            <th>Recipient Name</th>
                           <th>Status</th>
                            
                            
                            <th width="100">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if($parcels->isNotEmpty())
                            @foreach ($parcels as $parcel)
                        <tr>     
                            <td>{{$parcel->id}}</td>
                            <td>{{$parcel->sender_name}}</td>
                            <td>{{$parcel->recipient_name}}</td>  
                          <td>
                           
                            @if($parcel->status == "Unsuccessfull Delivery Attempt")
                            <span class="badge bg-danger">Unsuccessfull Delivery Attempt</span>
                            @endif
                            
                          </td> 
                      
                            <td>

                                <a href="{{route('parcels.detail',$parcel->id)}}">
                                    <button type="button" class="btn btn-info btn-flat view_parcel" data-id="">
                                        <i class="fas fa-eye"></i>
                                      </button>
                                </a>
                                

                                
                                  <a  href="{{route('parcels.edit',$parcel->id)}}" class="btn btn-primary btn-flat ">
                                    <i class="fas fa-edit"></i>
                                  </a>
                                  <button type="button"  href="#" onclick="deleteParcel({{$parcel->id}})" class="btn btn-danger btn-flat delete_parcel" data-id="">
                                    <i class="fas fa-trash"></i>
                                  </button>



                                
                               
                            </td>
                        </tr>
                            @endforeach
                        
                         @else
                         <tr>
                            <td colspan="4"> Records not found</td>
                         </tr>
                            
                        @endif

                        
                      
                        
                         
                    </tbody>
                </table>										
            </div>
            <div class="card-footer clearfix">

                {{$parcels->links()}}
            
            </div>
        </div>
    </div>
    <!-- /.card -->
</section>
<!-- /.content -->
@endsection

@section('customJs')
 <script>

function deleteParcel(id){

    var url ='{{route('parcels.delete',"ID")}}';
    var newUrl= url.replace("ID",id)
    
    if(confirm("Are you sure ? you want to delete! ")){
        $.ajax({
            url:newUrl,
            type:'delete',
            data:{},
            dataType: 'json',
            headers:{
		'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
	},

        
           success: function(response){
           if(response["status"]){
                        window.location.href="{{route('parcels.index')}}";
                    }

        }
    });
    }



    }

 </script>
@endsection