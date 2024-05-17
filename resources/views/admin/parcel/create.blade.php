@extends('admin.layouts.app')

@section('content')
<div class="container">
    <h1>Create Parcel</h1>
    <div class="col-sm-11 text-right">
        <a href="{{route('parcels.index')}}" class="btn btn-primary">Back</a>
    </div>
    <form action="{{ route('parcels.store') }}" method="POST" id="categoryForm" name="categoryForm">
        @csrf
        <div class="row">
            <div class="col-md-6">
                <h3>Sender Information</h3>
                <div class="form-group">
                    <label for="sender_name">Sender Name</label>
                    <input type="text" class="form-control" id="sender_name" name="sender_name" value="{{ old('sender_name') }}" required>
                </div>
                <div class="form-group">
                    <label for="sender_address">Address</label>
                    <input type="text" class="form-control" id="sender_address" name="sender_address" value="{{ old('sender_address') }}" required>
                </div>
                <div class="form-group">
                    <label for="sender_contact">Contact #</label>
                    <input type="text" class="form-control" id="sender_contact" name="sender_contact" value="{{ old('sender_contact') }}" required>
                </div>
            </div>
            <div class="col-md-6">
                <h3>Recipient Information</h3>
                <div class="form-group">
                    <label for="recipient_name">Recipient Name</label>
                    <input type="text" class="form-control" id="recipient_name" name="recipient_name" value="{{ old('recipient_name') }}" required>
                </div>
                <div class="form-group">
                    <label for="recipient_address">Address</label>
                    <input type="text" class="form-control" id="recipient_address" name="recipient_address" value="{{ old('recipient_address') }}" required>
                </div>
                <div class="form-group">
                    <label for="recipient_contact">Contact #</label>
                    <input type="text" class="form-control" id="recipient_contact" name="recipient_contact" value="{{ old('recipient_contact') }}" required>
                </div>
            </div>
        </div>

        <hr>
        <div class="col-md-6">
            <div class="mb-3">
                <label for="status">Status</label>
                <select id="status" name="status">
                
                <option value="Pending">Pending</option>
                <option value="Item Accepted by Courier">Item Accepted by Courier</option>
                <option value="Collected">Collected</option>
                <option value="Delivered">Delivered</option>
                <option value="Shipped">Shipped</option>
                <option value="In-transit">In-transit</option>
                <option value="Picked-up">Picked-up</option>
                <option value="Ready to pickup">Ready to pickup</option>
                <option value="Out for delivery">Out for delivery</option>
                <option value="crrived at Destination">Arrived at Destination</option>
                <option value="Unsuccessfull Delivery Attempt">Unsuccessfull Delivery Attempt</option>
            
            </select>
            </div>
        </div>


        <div class="form-group">
            <label for="dtype">Delivery Type</label>
            <select id="dtype" class="form-control" name="type">
                <option value="1" {{ old('type') == 1 ? 'selected' : '' }}>Deliver</option>
                <option value="0" {{ old('type') == 0 ? 'selected' : '' }}>Pickup</option>
            </select>
        </div>

        <div class="form-group">
            <label for="from_branch_id">Branch Processed</label>
            <select name="from_branch_id" id="from_branch_id" class="form-control">
              @if(isset($categories) && $categories->isNotEmpty())
              <option value="">Select Branch</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ old('from_branch_id') == $category->id ? 'selected' : '' }}>{{ $category->Street }}, {{ $category->City }}, {{ $category->Country }}</option>
                @endforeach
                @else
                <!-- Optionally, you can provide a message or a default option when there are no categories -->
                <p>No categories available.</p>
            @endif
            </select>
        </div>

        <div class="form-group" id="to_branch_field" style="{{ old('type') == 1 ? 'display:none;' : '' }}">
            <label for="to_branch_id">Pickup Branch</label>
            <select name="to_branch_id" id="to_branch_id" class="form-control">
              @if(isset($categories) && $categories->isNotEmpty())
              <option value="">Select Branch</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ old('to_branch_id') == $category->id ? 'selected' : '' }}>{{ $category->Street }}, {{ $category->City }}, {{ $category->Country }}</option>
                @endforeach
                @else
    <!-- Optionally, you can provide a message or a default option when there are no categories -->
    <p>No categories available.</p>
@endif
            </select>
        </div>

        <hr>

        <h3>Parcel Information</h3>
        <div class="form-group">
            <label for="weight">Weight</label>
            <input type="number" class="form-control" id="weight" name="weight" value="{{ old('weight') }}" required>
        </div>
        <div class="form-group">
            <label for="height">Height</label>
            <input type="number" class="form-control" id="height" name="height" value="{{ old('height') }}" required>
        </div>
        <div class="form-group">
            <label for="length">Length</label>
            <input type="number" class="form-control" id="length" name="length" value="{{ old('length') }}" required>
        </div>
        <div class="form-group">
            <label for="width">Width</label>
            <input type="number" class="form-control" id="width" name="width" value="{{ old('width') }}" required>
        </div>
        <div class="form-group">
            <label for="price">Price</label>
            <input type="number" class="form-control" id="price" name="price" value="{{ old('price') }}" required>
        </div>

        <div class="pb-5 pt-3">
            <button  type="submit" class="btn btn-primary">Create</button>
            <a href="{{route('parcels.index')}}" class="btn btn-outline-dark ml-3">Cancel</a>
        </div>

    </form>
</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        $('#dtype').change(function() {
            if ($(this).val() == '1') {
                $('#to_branch_field').hide();
            } else {
                $('#to_branch_field').show();
            }
        });
    });

    $("#categoryForm").submit(function(event){
        event.preventDefault();
        var element= $(this);
        $("button[type=submit]").prop('disabled',true);
        $.ajax({
            url:'{{route('parcels.store')}}',
            type:'POST',
            data:element.serialize(),
            dataType: 'json',


        
           success: function(response){
            $("button[type=submit]").prop('disabled',false);

                    if(response["status"]== true){

                        window.location.href="{{route('parcels.index')}}";
                       // $("#staff").removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html("");
                       // $("#email").removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html("");
                       // $("#password").removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html("");
                       // $("#branch").removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html("");
                    } else{


                  

                    var errors= response['errors'];
                if(errors['staff']){
                  //  $("#staff").addClass('is-invalid').siblings('p').addClass('invalid-feedback').html(errors['staff']);
                }
                 if(errors['email']){
                   // $("#email").addClass('is-invalid').siblings('p').addClass('invalid-feedback').html(errors['email']);
                }
                if(errors['password']){
                  //  $("#password").addClass('is-invalid').siblings('p').addClass('invalid-feedback').html(errors['password']);
                }

                if(errors['branch']){
                  //  $("#branch").addClass('is-invalid').siblings('p').addClass('invalid-feedback').html(errors['branch']);
                }

            }


            }, error:function(jqXHR,exception){
              console.log("Something went wrong") ; 

            }
        }); 

       }); 

 

</script>
@endpush
