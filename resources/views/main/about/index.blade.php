@php
$item = App\Models\About::find(1);
$property = optional($item)->properties ? json_decode($item->properties, true)[0] : null;
@endphp
    
     
     <!-- About Start -->
     <div class="container-fluid py-5 wow fadeInUp" data-wow-delay="0.1s">
        <div class="container py-5">
            <div class="row g-5">
                <div class="col-lg-7">
                    <div class="section-title position-relative pb-3 mb-5">
                        <h5 class="fw-bold text-primary text-uppercase">{{ $property['tag_title'] }}</h5>
                        <h1 class="mb-0">{{ $property['title'] }}</h1>
                    </div>
                    <p class="mb-4">{{ $property['description'] }}</p>
                    <div class="row g-0 mb-3">
                        <div class="col-sm-6 wow zoomIn" data-wow-delay="0.2s">
                            <h5 class="mb-3"><i class="fa fa-check text-primary me-3"></i>{{ $property['service1'] }}</h5>
                            <h5 class="mb-3"><i class="fa fa-check text-primary me-3"></i>{{ $property['service2'] }}</h5>
                        </div>
                        <div class="col-sm-6 wow zoomIn" data-wow-delay="0.4s">
                            <h5 class="mb-3"><i class="fa fa-check text-primary me-3"></i>{{ $property['service3'] }}</h5>
                            <h5 class="mb-3"><i class="fa fa-check text-primary me-3"></i>{{ $property['service4'] }}</h5>
                        </div>
                    </div>
                    <div class="d-flex align-items-center mb-4 wow fadeIn" data-wow-delay="0.6s">
                        <div class="bg-primary d-flex align-items-center justify-content-center rounded" style="width: 60px; height: 60px;">
                            <i class="fa fa-phone-alt text-white"></i>
                        </div>
                        <div class="ps-4">
                            <h5 class="mb-2">{{ $property['action_title'] }}</h5>
                            <h4 class="text-primary mb-0">{{ $property['action_text'] }}</h4>
                        </div>
                    </div>
                    <a href="{{ $property['button_url'] }}" class="btn btn-primary py-3 px-5 mt-3 wow zoomIn" data-wow-delay="0.9s">{{ $property['button_txt'] }}</a>
                </div>
                <div class="col-lg-5" style="min-height: 500px;">
                    <div class="position-relative h-100">
                        <img class="position-absolute w-100 h-100 rounded wow zoomIn" data-wow-delay="0.9s" src="{{url('admin/slider/'.$property['img'])}}" style="object-fit: cover;">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- About End -->