@extends('front.layouts.app')

@section('content')
    


<section class="section-1">
    <div id="carouselExampleIndicators" class="carousel slide carousel-fade" data-bs-ride="carousel" data-bs-interval="false">
        <div class="carousel-inner">
            <div class="carousel-item active">
              

                <picture>
                    <source media="(max-width: 799px)" srcset="{{asset('front-assets/images/6.jpg')}}" />
                    <source media="(min-width: 800px)" srcset="{{asset('front-assets/images/6.jpg')}}" />
                    <img src="{{asset('front-assets/images/6.jpg')}}" alt="" class="responsive-img" />
                </picture>
                

                <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                    <div class="p-3">
                        <h1 class="display-4 text-white mb-3">Our Valued Services</h1>
                        <p class="mx-md-5 px-5">
                            
                           
                            Thanks for staying at our courier service.<br>We hope to have the pleasure of doing business with you in the future.
                        </p>
                        
                    </div>
                </div>
            </div>
            <div class="carousel-item">
               
                <style>
                    img.responsive-img {
                        width: 100%;    /* makes the image responsive */
                        height: auto;   /* maintains the aspect ratio */
                    }
                </style>
                
                

                <picture>
                    <source media="(max-width: 799px)" srcset="{{asset('front-assets/images/6.jpg')}}" />
                    <source media="(min-width: 800px)" srcset="{{asset('front-assets/images/6.jpg')}}" />
                    <img src="{{asset('front-assets/images/6.jpg')}}" alt="" class="responsive-img" />
                </picture>
                

                <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                    <div class="p-3">
                        <h1 class="display-4 text-white mb-3">Our Valued Services</h1>
                        <p class="mx-md-5 px-5">
                            
                           
                            Thanks for staying at our courier service.<br>We hope to have the pleasure of doing business with you in the future.
                        </p>
                        
                    </div>
                </div>
            </div>
            <div class="carousel-item">


                <style>
                    img.responsive-img {
                        width: 100%;    
                        height: auto;   
                    }
                </style>
                <picture>
                    <source media="(max-width: 799px)" srcset="{{asset('front-assets/images/6.jpg')}}" />
                    <source media="(min-width: 800px)" srcset="{{asset('front-assets/images/6.jpg')}}" />
                    <img src="{{asset('front-assets/images/6.jpg')}}" alt="" class="responsive-img" />
                </picture>
                
                

              

                <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                    <div class="p-3">
                        <h1 class="display-4 text-white mb-3">Our Valued Services</h1>
                        <p class="mx-md-5 px-5">
                            
                           
                            Thanks for staying at our courier service.<br>We hope to have the pleasure of doing business with you in the future.
                        </p>
                        
                    </div>
                </div>
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
</section>
<section class="section-2">
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <div class="box shadow-lg">
                    <div class="fa icon fas fa-calendar-check text-primary m-0 mr-3"></div>
                    <h2 class="font-weight-semi-bold m-0">Booking</h5>
                </div>                    
            </div>
            <div class="col-lg-3 ">
                <div class="box shadow-lg">
                    <div class="fa icon fas fa-box text-primary m-0 mr-3"></div>
                    <h2 class="font-weight-semi-bold m-0">Packing</h2>
                </div>                    
            </div>
            <div class="col-lg-3">
                <div class="box shadow-lg">
                    <div class="fa icon fa-shipping-fast text-primary m-0 mr-3"></div>
                    <h2 class="font-weight-semi-bold m-0">Transportation</h2>
                </div>                    
            </div>
            <div class="col-lg-3 ">
                <div class="box shadow-lg">
                    <div class="fa icon fas fa-check-circle text-success"></div>
                    <h2 class="font-weight-semi-bold m-0">Delivery</h5>
                </div>                    
            </div>
        </div>
    </div>
</section>
                   
                </div>                                               
            </div>               
        </div>
    </div>
</section>

@endsection