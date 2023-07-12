@php
$item = App\Models\Components\WhyChooseUs::find(1);
$property = optional($item)->properties ? json_decode($item->properties, true)[0] : null;
@endphp

 <!-- Features Start -->
    <div class="container-fluid py-5 wow fadeInUp" data-wow-delay="0.1s">
        <div class="container py-5">
            <div class="section-title text-center position-relative pb-3 mb-5 mx-auto" style="max-width: 600px;">
                <h5 class="fw-bold text-primary text-uppercase">{{ $property['tag_title'] }}</h5>
                <h1 class="mb-0">{{ $property['title'] }}</h1>
            </div>
            <div class="row g-5">
                <div class="col-lg-4">
                    <div class="row g-5">
                        <div class="col-12 wow zoomIn" data-wow-delay="0.2s">
                            <div class="bg-primary rounded d-flex align-items-center justify-content-center mb-3" style="width: 60px; height: 60px;">
                                <i class="{{ $property['icon0'] }} text-white"></i>
                            </div>
                            <h4>{{$property['title0']}}</h4>
                            <p class="mb-0">{{$property['shortDescription0']}}</p>
                        </div>
                        <div class="col-12 wow zoomIn" data-wow-delay="0.6s">
                            <div class="bg-primary rounded d-flex align-items-center justify-content-center mb-3" style="width: 60px; height: 60px;">
                                <i class="{{ $property['icon1'] }} text-white"></i>
                            </div>
                            <h4>{{$property['title1']}}</h4>
                            <p class="mb-0">{{$property['shortDescription1']}}</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4  wow zoomIn" data-wow-delay="0.9s" style="min-height: 350px;">
                    <div class="position-relative h-100">
                        <img class="position-absolute w-100 rounded wow zoomIn" data-wow-delay="0.1s" src="{{url('https://d26ttzql3lait9.cloudfront.net/ttsiraq/why-us/'.$property['img'])}}" >
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="row g-5">
                        <div class="col-12 wow zoomIn" data-wow-delay="0.4s">
                            <div class="bg-primary rounded d-flex align-items-center justify-content-center mb-3" style="width: 60px; height: 60px;">
                                <i class="{{ $property['icon2'] }} text-white"></i>
                            </div>
                            <h4>{{$property['title2']}}</h4>
                            <p class="mb-0">{{$property['shortDescription2']}}</p>
                        </div>
                        <div class="col-12 wow zoomIn" data-wow-delay="0.8s">
                            <div class="bg-primary rounded d-flex align-items-center justify-content-center mb-3" style="width: 60px; height: 60px;">
                                <i class="{{ $property['icon3'] }} text-white"></i>
                            </div>
                            <h4>{{$property['title3']}}</h4>
                            <p class="mb-0">{{$property['shortDescription3']}}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Features Start -->