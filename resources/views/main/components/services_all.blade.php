@php
$ServiceInfoData = App\Models\Other\ServiceInfo::find(1);
$ServiceInfoItem = optional($ServiceInfoData)->properties ? json_decode($ServiceInfoData->properties, true)[0] : null;
$items = App\Models\Other\Service::latest()->get();
@endphp
    
    <!-- Service Start -->
    <div class="container-fluid py-5 wow fadeIn" data-wow-delay="0.1s">
        <div class="container py-5">
            <div class="section-title text-center position-relative pb-3 mb-5 mx-auto" style="max-width: 600px;">
                <h5 class="fw-bold text-primary text-uppercase">{{$ServiceInfoItem['tag_title']}}</h5>
                <h1 class="mb-0">{{$ServiceInfoItem['title']}}</h1>
            </div>
            <div id="serviceItemsContainer" class="row g-5">
                @foreach ($items->take(6) as $item)
                <div class="col-lg-4 col-md-6 wow fadeIn" data-wow-delay="0.3s">
                    <div class="service-item bg-light rounded d-flex flex-column align-items-center justify-content-center text-center">
                        <div class="service-icon">
                            <i class="{{$item['icon']}} text-white"></i>
                        </div>
                        <h4 class="mb-3">{{$item['title']}}</h4>
                        <p class="m-0">{{$item['short_description']}}</p>
                        <a class="btn btn-lg btn-primary rounded" href="">
                            <i class="fa-solid fa-arrow-right"></i>
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
            <div id="loadMoreBtnContainer" class="text-center mt-5">
                <button id="loadMoreBtn" class="btn btn-primary mt-5">Load More</button>
            </div>
        </div>
    </div>
    <!-- Service End -->

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
    $(document).ready(function() {
        var items = @json($items);
        var currentIndex = 6; // Initial index to start loading additional items
        var batchSize = 3; // Number of items to load at a time
    
        $('#loadMoreBtn').click(function() {
            var remainingItems = items.slice(currentIndex, currentIndex + batchSize);
    
            if (remainingItems.length > 0) {
                $.each(remainingItems, function(index, item) {
                    var serviceItem = `
                    <div class="col-lg-4 col-md-6 wow zoomIn" data-wow-delay="0.3s">
                    <div class="service-item bg-light rounded d-flex flex-column align-items-center justify-content-center text-center">
                        <div class="service-icon">
                            <i class="${item.icon} text-white"></i>
                        </div>
                        <h4 class="mb-3">${item.title}</h4>
                        <p class="m-0">${item.short_description}</p>
                        <a class="btn btn-lg btn-primary rounded" href="{{ route('service.details',${item.id})}}">
                            <i class="fa-solid fa-arrow-right"></i>
                        </a>
                    </div>
                </div>
                    `;
                    $('#serviceItemsContainer').append(serviceItem);
                });
    
                currentIndex += batchSize;
    
                if (currentIndex >= items.length) {
                    $('#loadMoreBtnContainer').hide(); // Hide the "Load More" button when all items are loaded
                }
            }
        });
    });
    </script>
