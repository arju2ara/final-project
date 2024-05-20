@extends('front.layouts.app')

@section('content')
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

<section class=" section-11 ">
    <div class="container  mt-5">
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
                        <h2 class="h5 mb-0 pt-2 pb-2">Personal Information</h2>
                    </div>
                    <form action="{{route('account.updateProfile')}}" method="POST" name="profileForm" id="profileForm">
                   @csrf
                        <div class="card-body p-4">
                        <div class="row">
                            <div class="mb-3">               
                                <label for="name">Name</label>
                                <input value="{{$user->name}}" type="text" name="name" id="name" placeholder="Enter Your Name" class="form-control">
                           <p></p>
                            </div>
                            <div class="mb-3">            
                                <label for="email">Email</label>
                                <input  value="{{$user->email}}" type="text" name="email" id="email" placeholder="Enter Your Email" class="form-control">
                            <p></p>
                            </div>
                            <div class="mb-3">                                    
                                <label for="phone">Phone</label>
                                <input  value="{{$user->phone}}" type="text" name="phone" id="phone" placeholder="Enter Your Phone" class="form-control">
                            <p></p>
                            </div>

                            

                            <div class="d-flex">
                                <button type="submit" class="btn btn-dark">Update</button>
                            </div>
                        </div>
                    </div>
                </form>
                </div>
            </div>
        </div>
    </div>
</section>
    
@endsection

@section('customJs')


<script>
    $(document).ready(function() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $("#profileForm").submit(function(event) {
        event.preventDefault(); // Stop form from submitting normally

        // AJAX call for form submission
        $.ajax({
            url: '{{ route("account.updateProfile") }}',
            type: 'POST',
            data: $(this).serialize(),
            dataType: 'json',
            success: function(response) {
                if (response.status) {
                    window.location.href = '{{ route("account.profile") }}'; // Redirect on success
                } else if (response.errors) {
                    $.each(response.errors, function(key, error) {
                        $('#' + key).addClass('is-invalid').next('p').html(error[0]).addClass('invalid-feedback');
                    });
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.error('Error: ' + textStatus, errorThrown);
                alert('Something went wrong. Please try again.'); // User-friendly message
            }
        });
    });
});


</script>



@endsection