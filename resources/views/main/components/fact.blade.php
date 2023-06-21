@php
$item = App\Models\Other\Fact::find(1);
$properties = optional($item)->properties ? json_decode($item->properties, true) : null;
@endphp
    
<!-- Facts Start -->
<div class="container-fluid facts py-5 pt-lg-0">
    <div class="container py-5 pt-lg-0">
        <div class="row gx-0">
            @foreach($properties as $index => $property)
            <div class="col-lg-4 wow zoomIn" data-wow-delay="0.1s">
                <div class="{{ $index === 1 ? 'bg-light' : 'bg-primary' }} shadow d-flex align-items-center justify-content-center p-4" style="height: 150px;">
                    <div class="{{ $index === 1 ? 'bg-primary' : 'bg-light' }} d-flex align-items-center justify-content-center rounded mb-2" style="width: 60px; height: 60px;">
                        <i class="{{ $property['icon'] }} {{ $index === 1 ? 'text-white' : 'text-primary' }}"></i>
                    </div>
                    <div class="ps-4">
                        <h5 class="{{ $index === 1 ? 'text-primary' : 'text-white' }} mb-0">{{ $property['title'] }}</h5>
                        <h1 >
                            <span class="{{ $index === 1 ? '' : 'text-white' }} m-0 p-0">{{ $property['symbolL'] }}</span>
                            <span class="{{ $index === 1 ? '' : 'text-white' }} mb-0" data-toggle="counter-up">{{ $property['count'] }}</span>
                            <span class="{{ $index === 1 ? '' : 'text-white' }} m-0 p-0">{{ $property['symbolR'] }}</span>
                            
                        </h1>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
<!-- Facts Start -->