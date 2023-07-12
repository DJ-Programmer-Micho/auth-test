@extends('admin.layouts.master')

@section('content')
    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{asset('main/assets/css/bootstrap.min.css')}}" rel="stylesheet">
    <!-- Template Stylesheet -->
    <link href="{{asset('main/assets/css/style.css')}}" rel="stylesheet">
    <div id="header-carousel" class="carousel slide carousel-fade m-4" data-bs-ride="carousel">
        <div class="carousel-inner">
            @foreach($properties as $index => $property)
                <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                    {{-- <img class="w-100" src="{{ url('admin/slider/'.$property['img']) }}" alt="Slide Image"> --}}
                    <img class="w-100" src="{{ 'https://d26ttzql3lait9.cloudfront.net/ttsiraq/homeSlider/'.$property['img'] }}" alt="{{$property['img']}}">
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
    <div class="text-center">
        <a href="{{route('home.create')}}" class="btn btn-danger text-white px-3">Edit Slider</a>
    </div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="{{asset('main/assets/js/main.js')}}"></script>
@endsection