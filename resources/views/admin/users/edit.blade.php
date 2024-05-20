@extends('admin.layouts.app')
@section('content')
    
<!-- Content Header (Page header) -->
<section class="content-header">					
    <div class="container-fluid my-2">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Edit User</h1>
            </div>
            <div class="col-sm-6 text-right">
                <a href="{{route('users.index')}}" class="btn btn-primary">Back</a>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->
</section>
<!-- Main content -->
<section class="content">
    <!-- Default box -->
    <div class="container-fluid">
        <form action="{{ route('users.update', $user->id) }}" method="POST" id="userForm" name="userForm">
        @csrf
        @method('PUT')
            <div class="card">
            <div class="card-body">								
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="name">Name</label>
                            <input type="text" name="name" id="name" class="form-control" placeholder="Name" value="{{$user->name}}">	
                       <p></p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="email">Email</label>
                            <input type="text" name="email" id="email" class="form-control" placeholder="Email" value="{{$user->email}}">	
                        <p></p>
                        </div>
                    </div>	
                    
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="password">Password</label>
                            <input type="password" name="password" id="password" class="form-control" placeholder="Password" >	
                            <span>To change password you have to enter a value,otherwise leave blank.</span>
                            <p></p>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="phone">Phone</label>
                            <input type="text" name="phone" id="phone" class="form-control" placeholder="Phone" value="{{$user->phone}}">	
                       <p></p>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="status">Status</label>
                            <select name="status" id="status" class="form-control">
                                <option {{($user->status==1)? 'select' : ''}} value="1">Active</option>
                                <option {{($user->status==0)? 'select' : ''}} value="0">Block</option>
                            </select>
                           
                            <p></p>
                        </div>
                    </div>

                </div>
            </div>							
        </div>
        <div class="pb-5 pt-3">
            <button  type="submit" class="btn btn-primary">Update</button>
            <a href="{{route('users.index')}}" class="btn btn-outline-dark ml-3">Cancel</a>
        </div>
    </form>
    </div>
    <!-- /.card -->
</section>
<!-- /.content -->

@endsection

@section('customJs')
    <script>
 $("#userForm").submit(function(event){
        event.preventDefault();
        var element= $(this);
        $("button[type=submit]").prop('disabled',true);
        $.ajax({
            url:'{{route('users.update',$user->id)}}',
            type:'PUT',
            data:element.serialize(),
            dataType: 'json',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },

        
           success: function(response){
            $("button[type=submit]").prop('disabled',false);

                    if(response["status"]== true){

                       
                        $("#name").removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html("");
                        $("#email").removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html("");
                        $("#password").removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html("");
                        $("#phone").removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html("");
                        window.location.href="{{route('users.index')}}";
                    } else{

                            if(response['notFound']==true){
                                window.location.href="{{route('users.index')}}";
                            }
                  

                    var errors= response['errors'];
                if(errors['name']){
                    $("#name").addClass('is-invalid').siblings('p').addClass('invalid-feedback').html(errors['name']);
                }
                 if(errors['email']){
                    $("#email").addClass('is-invalid').siblings('p').addClass('invalid-feedback').html(errors['email']);
                }
                if(errors['password']){
                    $("#password").addClass('is-invalid').siblings('p').addClass('invalid-feedback').html(errors['password']);
                }

                if(errors['phone']){
                    $("#phone").addClass('is-invalid').siblings('p').addClass('invalid-feedback').html(errors['phone']);
                }

            }


            }, error:function(jqXHR,exception){
              console.log("Something went wrong") ; 

            }
        }); 

       }); 

  </script>
@endsection