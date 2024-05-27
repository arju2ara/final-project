@extends('admin.layouts.app')
@section('content')
    

<section class="content-header">					
    <div class="container-fluid my-2">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1> New Branch </h1>
            </div>
            <div class="col-sm-6 text-right">
                <a href="{{route('categories.index')}}" class="btn btn-primary">Back</a>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->
</section>
<!-- Main content -->
<section class="content">
    <!-- Default box -->
    <div class="container-fluid">
        <form action="{{ route('categories.store') }}" method="POST" id="categoryForm" name="categoryForm">
        @csrf
            <div class="card">
            <div class="card-body">								
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="Street">Street/Building</label>
                            <input type="text" name="Street" id="Street" class="form-control" placeholder="Street/Building">	
                       <p></p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="City">City/State</label>
                            <input type="text" name="City" id="City" class="form-control" placeholder="City/State">	
                        <p></p>
                        </div>
                    </div>	
                    
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="Country">Country</label>
                            <input type="text" name="Country" id="Country" class="form-control" placeholder="Country">	
                       <p></p>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="Contract">Contact</label>
                            <input type="text" name="Contract" id="Contract" class="form-control" placeholder="Contract">	
                       <p></p>
                        </div>
                    </div>

                </div>
            </div>							
        </div>
        <div class="pb-5 pt-3">
            <button  type="submit" class="btn btn-primary">Create</button>
            <a href="{{route('categories.index')}}" class="btn btn-outline-dark ml-3">Cancel</a>
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
            url:'{{route('categories.store')}}',
            type:'POST',
            data:element.serialize(),
            dataType: 'json',


        
           success: function(response){
            $("button[type=submit]").prop('disabled',false);

                    if(response["status"]== true){

                        window.location.href="{{route('categories.index')}}";
                        $("#Street").removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html("");
                        $("#City").removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html("");
                        $("#Country").removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html("");
                        $("#Contract").removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html("");
                    } else{


                  

                    var errors= response['errors'];
                if(errors['Street']){
                    $("#Street").addClass('is-invalid').siblings('p').addClass('invalid-feedback').html(errors['Street']);
                }
                 if(errors['City']){
                    $("#City").addClass('is-invalid').siblings('p').addClass('invalid-feedback').html(errors['City']);
                }
                if(errors['Country']){
                    $("#Country").addClass('is-invalid').siblings('p').addClass('invalid-feedback').html(errors['Country']);
                }

                if(errors['Contract']){
                    $("#Contract").addClass('is-invalid').siblings('p').addClass('invalid-feedback').html(errors['Contract']);
                }

            }


            }, error:function(jqXHR,exception){
              console.log("Something went wrong") ; 

            }
        }); 

       }); 

    </script>
@endsection