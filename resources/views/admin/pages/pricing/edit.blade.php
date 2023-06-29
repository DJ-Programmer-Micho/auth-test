@extends('admin.layouts.master')

@section('content')
<div class="m-4 p-0" style="color:#fff">
    <form action="{{route('price.update')}}" method="POST">
        @csrf
        <input type="hidden" name="id" value={{$items['id']}}>
        <div class="row mb-5">
            <div class="col-6">
                <div class="card bg-card-dark rounded border-4 mb-2 p-1 text-white">
                    <h1 class="mx-2">Pricing</h1>
                    <hr class="bg-white">
                    <div class="col-12 mb-3">
                        <label for="name">Name:</label>
                        <input type="text" name="name" id="name" class="form-control" value="{{ $items['name'] ?? '' }}">
                        <small class="text-danger"><b>(Required)</b></small>
                    </div>
                    <div class="col-12 mb-3">
                        <label for="small_text">Small Text:</label>
                        <textarea name="small_text" id="small_text"
                            class="form-control">{{ $items['exp'] ?? '' }}</textarea>
                        <small class="text-danger"><b>(Required)</b></small>
                    </div>
                    <div class="col-12 mb-3">
                        <label for="price">Price:</label>
                        <input name="price" id="price" class="form-control" value="{{ $items['price'] ?? '' }}"></input>
                        <small class="text-danger"><b>(Required)</b></small>
                    </div>
                    <div class="col-12 mb-3">
                        <label for="button_txt">Button Text:</label>
                        <input name="button_txt" id="button_txt" class="form-control" value="{{ $items['btn_txt'] ?? '' }}"></input>
                        <small class="text-danger"><b>(Required)</b></small>
                    </div>
                    <div class="col-12 mb-3">
                        <label for="button_url">Button URL:</label>
                        <input name="button_url" id="button_url" class="form-control" value="{{ $items['btn_url'] ?? '' }}"></input>
                        <small class="text-danger"><b>(Required)</b></small>
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="card bg-card-dark rounded border-4 mb-2 p-1 text-white">
                    <h1 class="mx-2">Pricing</h1>
                    <hr class="bg-white">
                    <div class="border">
                        <small class="text-info mx-3"><i class="fa-solid fa-circle-info"></i> <b>You can add and remove
                                services QTY</b></small><br>
                        <small class="text-warning mx-3"><i class="fa-solid fa-triangle-exclamation"></i> <b>It Prefer 4
                                Services</b></small>
                                <div class="col-12 row mb-1 added-field-container">
                                    @foreach(json_decode($items['info'],true) as $rowIndex => $service)
                                        <div class="col-12 row mb-1 added-field">
                                            <div class="col-6">
                                                <label for="service">Contain {{ $rowIndex + 1 }}:</label>
                                                <input name="service[{{ $rowIndex }}][text]" class="form-control" value="{{ $service['text'] ?? '' }}">
                                                <div class="form-check form-check-inline mt-3">
                                                    <input class="form-check-input" type="radio" name="service[{{ $rowIndex }}][icon]" id="inlineRadio{{ ($rowIndex * 2) + 1 }}" value="fa-check" {{ isset($service['icon']) && $service['icon'] === 'fa-check' ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="inlineRadio{{ ($rowIndex * 2) + 1 }}"><i class="fa-solid fa-check"></i></label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="service[{{ $rowIndex }}][icon]" id="inlineRadio{{ ($rowIndex * 2) + 2 }}" value="fa-xmark" {{ isset($service['icon']) && $service['icon'] === 'fa-xmark' ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="inlineRadio{{ ($rowIndex * 2) + 2 }}"><i class="fa-solid fa-xmark"></i></label>
                                                </div>
                                                <hr style="background-color:#fff">
                                            </div>
                                            <div class="col-6">
                                                <label>&nbsp;</label><br>
                                                @if($rowIndex === count(json_decode($items['info'],true)) - 1)
                                                    <a href="javascript:void(0);" class="btn btn-success addButton">Add new</a>
                                                @else
                                                    <a href="javascript:void(0);" class="btn btn-danger remove-button">Remove Old</a>
                                                @endif
                                            </div>
                                        </div>
                                    @endforeach
                                </div>                                
                    </div>
                </div>
            </div>
        </div>
        <div class="text-center">
            <button type="submit" class="btn btn-info px-5">Add Service</button>
        </div>
    </form>
</div>
@endsection

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    // Add button click event
    $(document).on('click', '.addButton', function() {
        var index = $('.added-field').length;
        var inputField = '<div class="col-12 row mb-1 added-field">' +
            '<div class="col-6">' +
            '<input name="service[' + index + '][text]" class="form-control" value="">' +
            '<div class="form-check form-check-inline mt-3">' +
            '<input class="form-check-input" type="radio" name="service[' + index + '][icon]" id="inlineRadio' + (index * 2) + '" value="fa-check">' +
            '<label class="form-check-label" for="inlineRadio' + (index * 2) + '"><i class="fa-solid fa-check"></i></label>' +
            '</div>' +
            '<div class="form-check form-check-inline">' +
            '<input class="form-check-input" type="radio" name="service[' + index + '][icon]" id="inlineRadio' + ((index * 2) + 1) + '" value="fa-xmark">' +
            '<label class="form-check-label" for="inlineRadio' + ((index * 2) + 1) + '"><i class="fa-solid fa-xmark"></i></label>' +
            '</div>' +
            '<hr style="background-color:#fff">' +
            '</div>' +
            '<div class="col-6">' +
            '<a href="javascript:void(0);" class="btn btn-danger remove-button">Remove</a>' +
            '</div>' +
            '</div>';

        $('.added-field-container').append(inputField);
    });

    // Remove button click event
    $(document).on('click', '.remove-button', function() {
        var row = $(this).closest('.added-field');
        row.remove();
    });
});

</script>   