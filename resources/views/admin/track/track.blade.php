
@extends('admin.layouts.app')

@section('content')
<div class="container"> 
    <form action="{{ route('track_parcel') }}" method="POST">
        @csrf
        <div class="card card-outline card-primary">
            <div class="card-body">
                <div class="d-flex w-100 px-1 py-2 justify-content-center align-items-center">
                    <label for="ref_no">Enter Tracking Number</label>
                    <div class="input-group col-sm-5">
                        <input type="text" id="ref_no" name="ref_no" class="form-control float-right" placeholder="Search" value="{{ request('ref_no') }}">
                        <div class="input-group-append">
                            <button type="submit" id="track-btn" class="btn btn-sm btn-primary btn-gradient-primary">
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
                    <div class="iitem">
                        <i class="fas fa-box bg-blue"></i>
                        <div class="timeline-item">
                            <span class="time"><i class="fas fa-clock"></i> {{ $parcel->created_at->format('Y-m-d H:i:s') }}</span>
                            <div class="timeline-body">{{ $parcel->status }}</div>
                        </div>
                    </div>
                @elseif(isset($error))
                    <div class="iitem">
                        <i class="fas fa-box bg-blue"></i>
                        <div class="timeline-item">
                            <p>{{ $error }}</p>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
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
                        <span class="time"><i class="fas fa-clock"></i> ${resp.date_created}</span>
                        <div class="timeline-body">Status: ${resp.status}</div>
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
