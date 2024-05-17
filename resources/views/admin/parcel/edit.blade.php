@extends('admin.layouts.app')

@section('content')
<div class="container">
    <h1>Edit Parcel</h1>
    <div class="col-sm-12 text-right">
        <a href="{{route('parcels.index')}}" class="btn btn-primary">Back</a>
    </div>
    <form action="{{ route('parcels.update', $parcel->id) }}" method="POST" id="categoryForm" name="categoryForm">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-md-6">
                <h3>Sender Information</h3>
                <div class="form-group">
                    <label for="sender_name">Sender Name</label>
                    <input type="text" class="form-control" id="sender_name" name="sender_name" value="{{ $parcel->sender_name}}" required>
                    <p></p>
                </div>
                <div class="form-group">
                    <label for="sender_address">Address</label>
                    <input type="text" class="form-control" id="sender_address" name="sender_address" value="{{ $parcel->sender_address }}" required>
                    <p></p>
                </div>
                <div class="form-group">
                    <label for="sender_contact">Contact #</label>
                    <input type="text" class="form-control" id="sender_contact" name="sender_contact" value="{{ $parcel->sender_contact }}" required>
                    <p></p>
                </div>
            </div>
            <div class="col-md-6">
                <h3>Recipient Information</h3>
                <div class="form-group">
                    <label for="recipient_name">Recipient Name</label>
                    <input type="text" class="form-control" id="recipient_name" name="recipient_name" value="{{ $parcel->recipient_name }}" required>
                    <p></p>
                </div>
                <div class="form-group">
                    <label for="recipient_address">Address</label>
                    <input type="text" class="form-control" id="recipient_address" name="recipient_address" value="{{ $parcel->recipient_address }}" required>
                    <p></p>
                </div>
                <div class="form-group">
                    <label for="recipient_contact">Contact #</label>
                    <input type="text" class="form-control" id="recipient_contact" name="recipient_contact" value="{{ $parcel->recipient_contact }}" required>
                    <p></p>
                </div>
            </div>
        </div>

        <hr>
        <div class="col-md-6">
            <div class="mb-3">
                <label for="status">Status</label>
                <select id="status" name="status">
                
                <option  {{($parcel->status == 'Pending') ? 'selected' : ''}}  value="Pending">Pending</option>
                <option  {{($parcel->status == 'Item Accepted by Courier') ? 'selected' : ''}}  value="Item Accepted by Courier">Item Accepted by Courier</option>

                <option  {{($parcel->status == 'Collected') ? 'selected' : ''}}   value="Collected">Collected</option>
                <option  {{($parcel->status == 'Delivered') ? 'selected' : ''}}   value="Delivered">Delivered</option>
                <option  {{($parcel->status == 'Shipped') ? 'selected' : ''}}   value="Shipped">Shipped</option>
                <option {{($parcel->status == 'In-transit') ? 'selected' : ''}}   value="In-transit">In-transit</option>
                <option {{($parcel->status == 'Picked-up') ? 'selected' : ''}}   value="Picked-up">Picked-up</option>
                <option {{($parcel->status == 'Ready to pickup') ? 'selected' : ''}}   value="Ready to pickup">Ready to pickup</option>
                <option {{($parcel->status == 'Out for delivery') ? 'selected' : ''}}   value="Out for delivery">Out for delivery</option>
                <option {{($parcel->status == 'Arrived at Destination') ? 'selected' : ''}}   value="Arrived at Destination">Arrived at Destination</option>
                <option {{($parcel->status == 'Unsuccessfull Delivery Attempt') ? 'selected' : ''}}   value="Unsuccessfull Delivery Attempt">Unsuccessfull Delivery Attempt</option>
            
            </select>
            </div>
        </div>


        <div class="form-group">
            <label for="dtype">Delivery Type</label>
            <select id="dtype" class="form-control" name="type">
                <option value="1" {{ $parcel->type == 1 ? 'selected' : '' }}>Deliver</option>
                <option value="0" {{ $parcel->type == 0 ? 'selected' : '' }}>Pickup</option>
            </select>
            <p></p>
        </div>

        <div class="form-group">
            <label for="from_branch_id">Branch Processed</label>
            <select name="from_branch_id" id="from_branch_id" class="form-control">
              @if(isset($categories) && $categories->isNotEmpty())
              <option value="">Select Branch</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ $parcel->from_branch_id == $category->id ? 'selected' : '' }}>{{ $category->Street }}, {{ $category->City }}, {{ $category->Country }}</option>
                @endforeach
                @else
                <!-- Optionally, you can provide a message or a default option when there are no categories -->
                <p>No categories available.</p>
            @endif
            </select>
            <p></p>
        </div>

        <div class="form-group" id="to_branch_field" style="{{ $parcel->type== 1 ? 'display:none;' : '' }}">
            <label for="to_branch_id">Pickup Branch</label>
            <select name="to_branch_id" id="to_branch_id" class="form-control">
              @if(isset($categories) && $categories->isNotEmpty())
              <option value="">Select Branch</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ $parcel->to_branch_id== $category->id ? 'selected' : '' }}>{{ $category->Street }}, {{ $category->City }}, {{ $category->Country }}</option>
                @endforeach
                @else
    <!-- Optionally, you can provide a message or a default option when there are no categories -->
    <p>No categories available.</p>
@endif
            </select>
            <p></p>
        </div>

        <hr>

        <h3>Parcel Information</h3>
        <div class="form-group">
            <label for="weight">Weight</label>
            <input type="number" class="form-control" id="weight" name="weight" value="{{ $parcel->weight}}" required>
            <p></p>
        </div>
        <div class="form-group">
            <label for="height">Height</label>
            <input type="number" class="form-control" id="height" name="height" value="{{ $parcel->height}}" required>
            <p></p>
        </div>
        <div class="form-group">
            <label for="length">Length</label>
            <input type="number" class="form-control" id="length" name="length" value="{{ $parcel->length}}" required>
            <p></p>
        </div>
        <div class="form-group">
            <label for="width">Width</label>
            <input type="number" class="form-control" id="width" name="width" value="{{ $parcel->width }}" required>
            <p></p>
        </div>
        <div class="form-group">
            <label for="price">Price</label>
            <input type="number" class="form-control" id="price" name="price" value="{{ $parcel->price}}" required>
            <p></p>
        </div>

        <div class="pb-5 pt-3">
            <button  type="submit" class="btn btn-primary">Update</button>
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
    var formData = $(this).serialize() + '&_method=PUT';
    $.ajax({
        url: $(this).attr('action'), // Use form's action attribute
        type: 'POST', // POST must be used here due to browser limitations with PUT
        data: formData,
        dataType: 'json',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(response){
            if(response.status) {
                window.location.href = "{{ route('parcels.index') }}";
            } else {
                console.error('Error:', response.message);
                // Handle error
            }
        },
        error: function(jqXHR){
            console.error('AJAX error:', jqXHR.statusText);
        }
    });
});

      

</script>
@endpush
