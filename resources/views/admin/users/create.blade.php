@extends('admin.layouts.app')
@section('content')
    
<!-- Content Header (Page header) -->
<section class="content-header">					
    <div class="container-fluid my-2">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1> New User </h1>
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
        <form action="{{ route('users.store') }}" method="POST" id="userForm" name="userForm">
        @csrf
            <div class="card">
            <div class="card-body">								
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="name">Name</label>
                            <input type="text" name="name" id="name" class="form-control" placeholder="Name">	
                       <p></p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="email">Email</label>
                            <input type="text" name="email" id="email" class="form-control" placeholder="Email">	
                        <p></p>
                        </div>
                    </div>	
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="password">Password</label>
                            <input type="password" name="password" id="password" class="form-control" placeholder="Password">	
                        <p></p>
                        </div>
                    </div>
                    
                    <div class="col-md-12">
                        <div class="mb-3">
                            <label for="phone">Phone</label>
                            <input type="text" name="phone" id="phone" class="form-control" placeholder="Phone">	
                       <p></p>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="status">Status</label>
                            <select name="status" id="status" class="form-control">
                                <option value="1">Active</option>
                                <option value="0">Block</option>
                            </select>
                           
                            <p></p>
                        </div>
                    </div>

                </div>
            </div>							
        </div>
        <div class="pb-5 pt-3">
            <button  type="submit" class="btn btn-primary">Create</button>
            <a href="{{route('users.index')}}" class="btn btn-outline-dark ml-3">Cancel</a>
        </div>
    </form>
    </div>
    <!-- /.card -->
</section>
<!-- /.content -->

@endsection

@section('customJs')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <script>
 $("#userForm").submit(function(event){
        event.preventDefault();
        var element= $(this);
        $("button[type=submit]").prop('disabled',true);
        $.ajax({
            headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
            url:'{{route('users.store')}}',
            type:'POST',
            data:element.serialize(),
            dataType: 'json',


        
           success: function(response){
            $("button[type=submit]").prop('disabled',false);

                    if(response["status"]== true){


                        $("#name").removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html("");
                        $("#email").removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html("");
                        $("#phone").removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html("");
                        $("#password").removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html("");
                        window.location.href="{{route('users.index')}}";
                    } else{


                  

                    var errors= response['errors'];
                if(errors['name']){
                    $("#name").addClass('is-invalid').siblings('p').addClass('invalid-feedback').html(errors['name']);
                }
                 if(errors['email']){
                    $("#email").addClass('is-invalid').siblings('p').addClass('invalid-feedback').html(errors['email']);
                }
                if(errors['phone']){
                    $("#phone").addClass('is-invalid').siblings('p').addClass('invalid-feedback').html(errors['phone']);
                }

                if(errors['password']){
                    $("#password").addClass('is-invalid').siblings('p').addClass('invalid-feedback').html(errors['password']);
                }

            }


            }, error:function(jqXHR,exception){
              console.log("Something went wrong") ; 

            }
        }); 

       }); 

 



    </script>
@endsection