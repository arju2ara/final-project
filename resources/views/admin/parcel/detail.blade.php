@extends('admin.layouts.app')
@section('content')


<section class="content-header">					
    <div class="container-fluid my-2">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Reference ID:#{{ $parcel ? $parcel->id : 'N/A' }}</h1>

            </div>
            <div class="col-sm-6 text-right">
                <a href="{{route('parcels.index')}}" class="btn btn-primary">Back</a>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->
</section>
<!-- Main content -->
<section class="content">
    <!-- Default box -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-9">
                @include('admin.message')
                <div class="card">
                    <div class="card-header pt-3">
                        <div class="row invoice-info">
                            <div class="col-sm-4 invoice-col">
                                <label><u>Sender Information</u></label>
                       {{--}} <strong class="h4 mb-3">   Sender Information</strong>  --}}
                            <address>
                                <label for="sender_name"> Name:</label>
                                <p>{{ $parcel ? $parcel->sender_name : 'N/A' }}</p>
                              
                                <label for="sender_address">Address:</label>
                                <p>{{ $parcel ? $parcel->sender_address : 'N/A' }}</p>
                              
                                <label for="sender_contact">Contact:</label>
                                <p>{{ $parcel ? $parcel->sender_contact : 'N/A' }}</p>
                                
                            
                            </address>
                            
                            </div>
                            
                            <div class="col-sm-4 invoice-col">
                                <label><u>Recipient Information</u></label>
                       {{--}} <strong class="h4 mb-3">   Sender Information</strong>  --}}
                            <address>
                                <label for="sender_name">  Name:</label>
                                <p>{{$parcel->recipient_name}}</p>
                              
                                <label for="sender_address">Address:</label>
                                <p>{{ $parcel->recipient_address }}</p>
                              
                                <label for="sender_contact">Contact:</label>
                                <p>{{ $parcel->recipient_contact }}</p>
                                
                            
                            </address>
                            
                            </div>
                            
                            <div class="col-sm-4 invoice-col">
                              {{--}}  <b>Invoice #007612</b><br>--}}
                                <b><u>Parcel details</u></b><br>
                                <b>Weight:</b>{{$parcel->weight}}<br>
                                <b>Height:</b> {{$parcel->height}}<br>
                                <b>Width:</b> {{$parcel->width}}<br>
                                <b>Length:</b> {{$parcel->length}}<br>
                                <b>Price:</b> {{$parcel->price}}<br>
                                <b>Type:</b> {{$parcel->type}}<br>
                                <b>Status:</b>
                                @if ($parcel->status == "Pending")
                                <span class="text-danger">Pending</span>
                            @elseif($parcel->status == "Collected")
                            <span class="text-success">Collected</span>
                            
                            @elseif($parcel->status == "Item Accepted by Courier")
                            <span class="text-info">Item Accepted by Courier</span>
                       
                            @elseif($parcel->status == "Shipped")
                            <span class="text-info">Shipped</span>
                            @elseif($parcel->status == "In-transit")
                            <span class="text-info">In-transit</span>
                            @elseif($parcel->status == "Picked-up")
                            <span class="text-info">Picked-up</span>
                            @elseif($parcel->status == "Ready to pickup")
                            <span class="text-info">Ready to pickup</span>
                            @elseif($parcel->status == "Out for delivery")
                            <span class="text-info">Out for delivery</span>
                            @elseif($parcel->status == "Arrived at Destination")
                            <span class="text-info">Arrived at Destination</span>
                            @elseif($parcel->status == "Unsuccessfull Delivery Attempt")
                            <span class="text-danger">Unsuccessfull Delivery Attempt</span>
                            @else

                            <span class="text-success">Delivered</span>
                            @endif
                                <br>
                                   
                                <br>
                            </div>
                        </div>
                    </div>
                   
                         
                                   
                              
        <div class="col-md-9">
                <div class="card">
                

                <form action="{{ route('parcels.changeParcelStatus', $parcel->id) }}" method="post" name="changeParcelStatusForm" id="changeParcelStatusForm">
                    @csrf
                    @method('PUT')
                    
                       
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
            
            
                   <div class="pb-5 ">
                        <button  type="submit" class="btn btn-primary">Update</button>
                        
                    
                    </div>
                   
              </form>


             </div>
                
            </div>
        </div>
    </div>
    <!-- /.card -->
</section>
<!-- /.content -->


@endsection

@section('customJs')
<script>
 $(document).ready(function() {
    $('#shipped_date').datetimepicker({format: 'Y-m-d', timepicker: false});
    $('#changeParcelStatusForm').submit(function(event) {
    event.preventDefault();
    var formAction = $(this).attr('action');
    var formData = $(this).serialize();
    $.ajax({
        url: formAction,
        type: 'POST',
        data: formData,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(response) {
           // if (response.status) {
                //alert(response.message);  // Displaying the success message from the server
                window.location.href = '{{ route("parcels.detail",$parcel->id) }}'; // Redirecting to the parcels index page
           // } 
        },
        error: function(jqXHR) {
                alert('Error: ' + jqXHR.statusText); // Handle errors
            }
       
    });
});

});
/*$("#categoryForm").submit(function(event){
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
*/

    </script>
    
@endsection
