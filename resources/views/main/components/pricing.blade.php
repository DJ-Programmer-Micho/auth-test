@php
$ServiceInfoData = App\Models\Other\PriceDetail::find(1);
$ServiceInfoItem = optional($ServiceInfoData)->properties ? json_decode($ServiceInfoData->properties, true)[0] : null;
$items = App\Models\Other\Price::latest()->limit(3)->get();
@endphp

<style>
    .pricing-plan-card-button {
        position: absolute;
        bottom: 0;
        left: 0;
        width: 100%;
        text-align: start;
        padding: 20px;
    }
</style>

<!-- Pricing Plan Start -->
    <div class="container-fluid py-5 wow fadeInUp" data-wow-delay="0.1s">
        <div class="container py-5">
            <div class="section-title text-center position-relative pb-3 mb-5 mx-auto" style="max-width: 600px;">
                <h5 class="fw-bold text-primary text-uppercase">{{$ServiceInfoItem['tag_title']}}</h5>
                <h1 class="mb-0">{{$ServiceInfoItem['title']}}</h1>
            </div>
            <div class="row g-0">
                @foreach ($items as $index => $item)    
                <div class="col-lg-4 wow slideInUp" data-wow-delay="0.6s">
                    <div class="h-100 bg-{{ $index === 1 ? 'white' : 'light' }} rounded{{ $index === 1 ? ' shadow position-relative' : '' }}" style="z-index: {{ $index === 1 ? '1' : '' }}">
                        <div class="border-bottom py-4 px-5 mb-4">
                            <h4 class="text-primary mb-1">{{$item['name']}}</h4>
                            <small class="text-uppercase">{{$item['exp']}}</small>
                        </div>
                        <div class="p-5 pt-0 mb-5">
                            <h1 class="display-5 mb-3">
                                <small class="align-top" style="font-size: 22px; line-height: 45px;">$</small>{{$item['price']}}<small
                                    class="align-bottom" style="font-size: 16px; line-height: 40px;">/ Month</small>
                            </h1>
                            @foreach (json_decode($item['info'],true) as $index => $property)
                                <div class="d-flex justify-content-between mb-3"><span>{{$property['text']}}</span><i class="fa {{$property['icon']}} {{ $property['icon'] == "fa-check"  ? 'text-primary' : 'text-danger' }} pt-1"></i></div>
                            @endforeach
                            <div class="pricing-plan-card-button">
                                <a href="{{$item['btn_url']}}" class="btn btn-primary py-2 px-4">{{$item['btn_txt']}}</a>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    <!-- Pricing Plan End -->