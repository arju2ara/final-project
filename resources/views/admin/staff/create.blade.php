@extends('admin.layouts.app')
@section('content')
    
<!-- Content Header (Page header) -->
<section class="content-header">					
    <div class="container-fluid my-2">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Edit Staff </h1>
            </div>
            <div class="col-sm-6 text-right">
                <a href="{{route('staffs.index')}}" class="btn btn-primary">Back</a>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->
</section>
<!-- Main content -->
<section class="content">
    <!-- Default box -->
    <div class="container-fluid">
        <form action="{{ route('staffs.store') }}" method="POST" id="categoryForm" name="categoryForm">
        @csrf
            <div class="card">
            <div class="card-body">								
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="staff">Staff</label>
                            <input type="text" name="staff" id="staff" class="form-control" placeholder="Name">	
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

                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="branch">Branch</label>
                            <input type="text" name="branch" id="branch" class="form-control" placeholder="Branch">	
                       <p></p>
                        </div>
                    </div>

                </div>
            </div>							
        </div>
        <div class="pb-5 pt-3">
            <button  type="submit" class="btn btn-primary">Create</button>
            <a href="{{route('staffs.index')}}" class="btn btn-outline-dark ml-3">Cancel</a>
        </div>
    </form>
    </div>
    <!-- /.card -->
</section>
<!-- /.content -->

@endsection

@section('customJs')
    <script>
 $("#categoryForm").submit(function(event){
        event.preventDefault();
        var element= $(this);
        $("button[type=submit]").prop('disabled',true);
        $.ajax({
            url:'{{route('staffs.store')}}',
            type:'POST',
            data:element.serialize(),
            dataType: 'json',


        
           success: function(response){
            $("button[type=submit]").prop('disabled',false);

                    if(response["status"]== true){

                        window.location.href="{{route('staffs.index')}}";
                        $("#staff").removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html("");
                        $("#email").removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html("");
                        $("#password").removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html("");
                        $("#branch").removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html("");
                    } else{


                  

                    var errors= response['errors'];
                if(errors['staff']){
                    $("#staff").addClass('is-invalid').siblings('p').addClass('invalid-feedback').html(errors['staff']);
                }
                 if(errors['email']){
                    $("#email").addClass('is-invalid').siblings('p').addClass('invalid-feedback').html(errors['email']);
                }
                if(errors['password']){
                    $("#password").addClass('is-invalid').siblings('p').addClass('invalid-feedback').html(errors['password']);
                }

                if(errors['branch']){
                    $("#branch").addClass('is-invalid').siblings('p').addClass('invalid-feedback').html(errors['branch']);
                }

            }


            }, error:function(jqXHR,exception){
              console.log("Something went wrong") ; 

            }
        }); 

       }); 

 



    </script>
@endsection