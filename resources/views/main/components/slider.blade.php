@php
    $item = App\Models\Components\HomeSlide::find(1);
    $properties = optional($item)->properties ? json_decode($item->properties, true) : null;
@endphp

<div id="header-carousel" class="carousel slide carousel-fade" data-bs-ride="carousel">
    <div class="carousel-inner">
        @foreach($properties as $index => $property)
            <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                <img class="w-100" src="{{ url('https://d26ttzql3lait9.cloudfront.net/ttsiraq/homeSlider/'.$property['img']) }}" alt="Slide Image">
                <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                    <div class="p-3" style="max-width: 900px;">
                        <h5 class="text-white text-uppercase mb-3 animated slideInDown">{{ $property['short_title'] }}</h5>
                        <h1 class="display-1 text-white mb-md-4 animated zoomIn">{{ $property['title'] }}</h1>
                        <a href="{{ $property['button_url1'] }}" class="btn btn-primary py-md-3 px-md-5 me-3 animated slideInLeft">{{ $property['button_txt1'] }}</a>
                        <a href="{{ $property['button_url2'] }}" class="btn btn-outline-light py-md-3 px-md-5 animated slideInRight">{{ $property['button_txt2'] }}</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#header-carousel" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#header-carousel" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div>