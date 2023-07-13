@php
$ServiceInfoData = App\Models\Components\ServiceInfo::find(1);
$ServiceInfoItem = optional($ServiceInfoData)->properties ? json_decode($ServiceInfoData->properties, true)[0] : null;
$items = App\Models\Components\Service::latest()->limit(5)->get();
@endphp
    
    <!-- Service Start -->
    <div class="container-fluid py-5 wow fadeInUp" data-wow-delay="0.1s">
        <div class="container py-5">
            <div class="section-title text-center position-relative pb-3 mb-5 mx-auto" style="max-width: 600px;">
                <h5 class="fw-bold text-primary text-uppercase">{{$ServiceInfoItem['tag_title']}}</h5>
                <h1 class="mb-0">{{$ServiceInfoItem['title']}}</h1>
            </div>
            <div class="row g-5">
                @foreach ($items as $item)
                <div class="col-lg-4 col-md-6 wow zoomIn" data-wow-delay="0.3s">
                    <div class="service-item bg-light rounded d-flex flex-column align-items-center justify-content-center text-center">
                        <div class="service-icon">
                            <i class="{{$item['icon']}} text-white"></i>
                        </div>
                        <h4 class="mb-3">{{$item['title']}}</h4>
                        <p class="m-0">{{$item['short_description']}}</p>
                        <a class="btn btn-lg btn-primary rounded" href="{{route('service.details',$item['id'])}}">
                            <i class="fa-solid fa-arrow-right"></i>
                        </a>
                    </div>
                </div>
                @endforeach
                <div class="col-lg-4 col-md-6 wow zoomIn" data-wow-delay="0.9s">
                    <div class="position-relative bg-primary rounded h-100 d-flex flex-column align-items-center justify-content-center text-center p-5">
                        <h3 class="text-white mb-3">{{$ServiceInfoItem['card_title']}}</h3>
                        <p class="text-white mb-3">{{$ServiceInfoItem['card_description']}}</p>
                        <h2 class="text-white mb-0">{{$ServiceInfoItem['card_text']}}</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Service End -->