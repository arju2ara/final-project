
 @extends('front.layouts.app')

 @section('content')
 <style>
    .timeline-item {
    position: relative;
    margin: 10px 0;
    padding-left: 20px;
}

.timeline-item .bg-blue {
    position: absolute;
    top: 0;
    left: 0;
    background-color: #007bff;
    color: white;
    padding: 10px;
    border-radius: 50%;
}

.timeline-item .timeline-content {
    padding-left: 40px;
}

.timeline-item .time {
    display: block;
    color: #6c757d;
}

.timeline-item .timeline-body {
    font-size: 16px;
    font-weight: bold;
}

 </style>
 <section class="section-5 pt-3 pb-3 mb-3 bg-white">
     <div class="container">
         <div class="light-font">
             <ol class="breadcrumb primary-color mb-0">
                 <li class="breadcrumb-item"><a class="white-text" href="#">My Account</a></li>
                 <li class="breadcrumb-item">Settings</li>
             </ol>
         </div>
     </div>
 </section>
 
 <section class="section-11">
     <div class="container mt-5">
         <div class="row">
             <div class="col-md-12">
                 @include('front.account.common.message')
             </div>
 
             <div class="col-md-3">
                 @include('front.account.common.sidebar')
             </div>
             <div class="col-md-9">
                 <div class="card">
                     <div class="card-header">
                         <h2 class="h5 mb-0 pt-2 pb-2">Track Your Parcel</h2>
                     </div>
                     <div class="container">
                         <form action="{{ route('account.track_parcel') }}" method="POST">
                             @csrf
                             <div class="card card-outline card-primary">
                                 <div class="card-body">
                                     <div class="d-flex w-100 px-1 py-2 justify-content-center align-items-center">
                                         <label for="ref_no" class="mr-2">Enter Tracking Number</label>
                                         <div class="input-group col-sm-5">
                                             <input type="text" id="ref_no" name="ref_no" class="form-control float-right" placeholder="Search" value="{{ request('ref_no') }}">
                                             <div class="input-group-append">
                                                 <button type="submit" id="track-btn" class="btn btn-primary btn-gradient-primary">
                                                     <i class="fa fa-search"></i>
                                                 </button>
                                             </div>
                                         </div>
                                     </div>
                                 </div>
                             </div>
                         </form>
                         
                         <div class="row">
                             <div class="col-md-8 offset-md-2">
                                 <div class="timeline" id="parcel_history">
                                     @if(isset($parcel))
                                         <div class="timeline-item">
                                             <i class="fas fa-box bg-blue"></i>
                                             <div class="timeline-content">
                                                 <span class="time"><i class="fas fa-clock"></i> {{ $parcel->created_at->format('Y-m-d H:i:s') }}</span>
                                                 <div class="timeline-body">Status: {{ $parcel->status }}</div>
                                             </div>
                                         </div>
                                     @elseif(isset($error))
                                         <div class="timeline-item">
                                             <i class="fas fa-box bg-blue"></i>
                                             <div class="timeline-content">
                                                 <p>{{ $error }}</p>
                                             </div>
                                         </div>
                                     @endif
                                 </div>
                             </div>
                         </div>
                     </div>
                 </div>
             </div>
         </div>
     </div>
 </section>
 @endsection
 
 @push('scripts')
 <script>
 $(document).ready(function(){
     $('form').on('submit', function(e) {
         e.preventDefault();
         var tracking_num = $('#ref_no').val();
         if (tracking_num === '') {
             $('#parcel_history').html('');
             alert('Please enter a tracking number.');
             return;
         }
 
         $.ajax({
             url: $(this).attr('action'),
             method: 'POST',
             data: $(this).serialize(),
             success: function(resp) {
                 console.log("Success response:", resp);
                 var content = `
                     <div class="timeline-item">
                         <i class="fas fa-box bg-blue"></i>
                         <div class="timeline-content">
                             <span class="time"><i class="fas fa-clock"></i> ${resp.date_created}</span>
                             <div class="timeline-body">Status: ${resp.status}</div>
                         </div>
                     </div>
                 `;
                 $('#parcel_history').html(content); // This will clear any previous content and add the new content
             },
             error: function(xhr) {
                 console.error("Error response:", xhr.responseText);
             }
         });
     });
 });
 </script>
 @endpush
 