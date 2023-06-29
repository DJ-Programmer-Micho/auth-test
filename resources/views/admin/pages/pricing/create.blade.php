@extends('admin.layouts.master')

@section('content')
<div class="m-4 p-0" style="color:#fff">
    <form action="{{route('price.store')}}" method="POST">
        @csrf
        <div class="row mb-5">
            <div class="col-6">
                <div class="card bg-card-dark rounded border-4 mb-2 p-1 text-white">
                    <h1 class="mx-2">Pricing</h1>
                    <hr class="bg-white">
                    <div class="col-12 mb-3">
                        <label for="name">Name:</label>
                        <input type="text" name="name" id="name" class="form-control"
                            value="{{ $properties['name'] ?? '' }}">
                        <small class="text-danger"><b>(Required)</b></small>
                    </div>
                    <div class="col-12 mb-3">
                        <label for="small_text">Small Text:</label>
                        <textarea name="small_text" id="small_text"
                            class="form-control">{{ $properties['small_text'] ?? '' }}</textarea>
                        <small class="text-danger"><b>(Required)</b></small>
                    </div>
                    <div class="col-12 mb-3">
                        <label for="Price">Price:</label>
                        <input name="Price" id="Price" class="form-control">{{ $properties['Price'] ?? '' }}</input>
                        <small class="text-danger"><b>(Required)</b></small>
                    </div>
                    <div class="col-12 mb-3">
                        <label for="button_txt">Button Text:</label>
                        <input name="button_txt" id="button_txt"
                            class="form-control">{{ $properties['button_txt'] ?? '' }}</input>
                        <small class="text-danger"><b>(Required)</b></small>
                    </div>
                    <div class="col-12 mb-3">
                        <label for="button_url">Button URL:</label>
                        <input name="button_url" id="button_url"
                            class="form-control">{{ $properties['button_url'] ?? '' }}</input>
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
                                <div class="col-12 row mb-1 added-field">
                                    <div class="col-6">
                                        <label for="service">Contain 1:</label>
                                        <input name="service[0][text]" class="form-control" value="{{ $properties['service'][0]['text'] ?? '' }}">
                                        <div class="form-check form-check-inline mt-3">
                                            <input class="form-check-input" type="radio" name="service[0][icon]" id="inlineRadio1" value="fa-check" {{ isset($properties['service'][0]['icon']) && $properties['service'][0]['icon'] === 'fa-check' ? 'checked' : '' }}>
                                            <label class="form-check-label" for="inlineRadio1"><i class="fa-solid fa-check"></i></label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="service[0][icon]" id="inlineRadio2" value="fa-xmark" {{ isset($properties['service'][0]['icon']) && $properties['service'][0]['icon'] === 'fa-xmark' ? 'checked' : '' }}>
                                            <label class="form-check-label" for="inlineRadio2"><i class="fa-solid fa-xmark"></i></label>
                                        </div>
                                        <hr style="background-color:#fff">
                                    </div>
                                    <div class="col-6">
                                        <label>&nbsp;</label><br>
                                        <a href="javascript:void(0);" class="btn btn-success" id="addButton">Add</a>
                                    </div>
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
        $('#addButton').click(function() {
            var index = $('.added-field').length;
            var inputField = '<div class="col-12 row mb-1 added-field">' +
                '<div class="col-6">' +
                '<input name="service[' + index + '][text]" class="form-control" value="">' +
                '<div class="form-check form-check-inline mt-3">' +
                '<input class="form-check-input" type="radio" name="service[' + index + '][icon]" id="inlineRadio' + (index + 1) + '" value="fa-check">' +
                '<label class="form-check-label" for="inlineRadio' + (index + 1) + '"><i class="fa-solid fa-check"></i></label>' +
                '</div>' +
                '<div class="form-check form-check-inline">' +
                '<input class="form-check-input" type="radio" name="service[' + index + '][icon]" id="inlineRadio' + (index + 2) + '" value="fa-xmark">' +
                '<label class="form-check-label" for="inlineRadio' + (index + 2) + '"><i class="fa-solid fa-xmark"></i></label>' +
                '</div>' +
                '<hr style="background-color:#fff">'+
                '</div>' +
                '<div class="col-6">' +
                '<a href="javascript:void(0);" class="btn btn-danger remove-button">Remove</a>' +
                '</div>' +
                '</div>';
            $('.added-field:last').after(inputField);
        });
        // Remove button click event
        $(document).on('click', '.remove-button', function() {
            $(this).closest('.added-field').remove();
        });
    });
</script>   