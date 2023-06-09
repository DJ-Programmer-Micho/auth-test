@extends('admin.layouts.master')

@section('content')
{{-- <script src="{{asset('admin/assets/vendor/jquery/jquery.min.js')}}"></script> --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.2/jquery.min.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.5/cropper.min.css" rel="stylesheet"/>
<script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.5/cropper.min.js"></script>
<script src="{{asset('admin/assets/js/main/met-icon.js')}}"></script>
<link rel="stylesheet" href="{{asset('admin/assets/css/met-icon.css')}}">
{{-- inline style for modal --}}
<style>
    .image_area {
      position: relative;
    }

    img {
        display: block;
        max-width: 100%;
    }

    .preview {
        overflow: hidden;
        width: 160px; 
        height: 160px;
        margin: 10px;
        border: 1px solid red;
    }

    .modal-lg{
        max-width: 1000px !important;
    }

    .overlay {
      position: absolute;
      bottom: 10px;
      left: 0;
      right: 0;
      background-color: rgba(255, 255, 255, 0.5);
      overflow: hidden;
      height: 0;
      transition: .5s ease;
      width: 100%;
    }

    .image_area:hover .overlay {
      height: 50%;
      cursor: pointer;
    }

    .text {
      color: #333;
      font-size: 20px;
      position: absolute;
      top: 50%;
      left: 50%;
      -webkit-transform: translate(-50%, -50%);
      -ms-transform: translate(-50%, -50%);
      transform: translate(-50%, -50%);
      text-align: center;
    }
</style>
<div class="m-4 p-0" style="color:#fff">
    <form action="{{route('wcu.store')}}" method="POST" enctype="multipart/form-data">
        @csrf
        
        <div class="row mb-5">

            <div class="col-6">
            <div class="card bg-card-dark rounded border-4 mb-2 p-1 text-white">
                <h1 class="mx-2">Why Choose Us</h1>
                <hr class="bg-white">
                <div class="row m-0 p-1">
                    <div class="col">
                        <div class="mb-3">
                            <label for="tag_title" class="form-label">Head Title:</label>
                            <input type="text" name="tag_title" id="tag_title"  class="form-control" value="{{ $properties['tag_title'] ?? 'not found' }}">
                            <small class="text-danger"><b>(Required)</b></small>
                        </div>
                        <div class="mb-3">
                            <label for="title">Title:</label>
                            <input type="text" name="title" id="title" class="form-control" value="{{ $properties['title'] ?? '' }}">
                            <small class="text-danger"><b>(Required)</b></small>
                        </div>
                    </div>
                    <div class="col">
                        <div class="mb-3 d-flex justify-content-center mt-1">
                            <img id="showImg" src="{{ (!empty($properties['img']))? url('admin/slider/'.$properties['img'] ):url('admin/avatars/empty.svg')}}" width="250" class="img-thumbnail rounded">
                        </div>
                    </div>
                </div>
            </div>
            <div class="card bg-card-dark rounded border-4 mb-2 p-1 text-white">
                <div class="col-12 mb-3">
                    <h1 class="mx-2">Image</h1>
                    <hr class="bg-white">
                    <label for="img">Upload Image</label>
                    <input type="file" name="img"  id="avatarImg" class="form-control metControl" style="height: auto" value="{{ $properties['img'] ?? '' }}" for="">
                    <small class="text-danger"><b>(Required)</b></small>
                    <input type="file" name="croppedImg" id="croppedImg" style="display: none;">
                </div>
                </div>
            </div>
            <div class="col-6">
                <div class="card bg-card-dark rounded border-4 mb-2 p-1 text-white">
                    <h1 class="mx-2">Services Or Skills</h1>
                    <hr class="bg-white">
                    <div class="border mb-3">
                        <small class="text-info mx-2 mb-3"><i class="fa-solid fa-circle-info"></i></i> Service No.1</small>
                    <div class="col-12 mb-3">
                        <label for="title0">Title:</label>
                        <input type="text" name="title0" id="title0" class="form-control" value="{{ $properties['title0'] ?? '' }}">
                        <small class="text-info"><b>(optional)</b></small>
                    </div>
                    <div class="col-12 mb-3">
                        <label for="shortDescription0">Short Description:</label>
                        <input type="text" name="shortDescription0" id="shortDescription0" class="form-control" value="{{ $properties['shortDescription0'] ?? '' }}">
                        <small class="text-info"><b>(optional)</b></small>
                    </div>
                    <div class="col-12 mb-3">
                        <label for="icon">Icon:</label>
                        <select id="iconSelect0" class="js-example-basic-single form-control" name="icon0">
                            <option class="d-block" selected disabled>{{ $properties['icon0'] ?? 'Select an Icon' }}</option>
                        </select>
                        <small class="text-danger"><b>(Required)</b></small>
                    </div>
                    </div>
                    <div class="border mb-3">
                        <small class="text-info mx-2 mb-3"><i class="fa-solid fa-circle-info"></i></i> Service No.2</small>
                    <div class="col-12 mb-3">
                        <label for="title1">Title:</label>
                        <input type="text" name="title1" id="title1" class="form-control" value="{{ $properties['title1'] ?? '' }}">
                        <small class="text-info"><b>(optional)</b></small>
                    </div>
                    <div class="col-12 mb-3">
                        <label for="shortDescription1">Short Description:</label>
                        <input type="text" name="shortDescription1" id="shortDescription0" class="form-control" value="{{ $properties['shortDescription1'] ?? '' }}">
                        <small class="text-info"><b>(optional)</b></small>
                    </div>
                    <div class="col-12 mb-3">
                        <label for="icon1">Icon:</label>
                        <select id="iconSelect1" class="js-example-basic-single form-control" name="icon1">
                            <option class="d-block" selected disabled>{{ $properties['icon1'] ?? 'Select an Icon' }}</option>
                        </select>
                        <small class="text-danger"><b>(Required)</b></small>
                    </div>
                    </div>
                    <div class="border mb-3">
                        <small class="text-info mx-2 mb-3"><i class="fa-solid fa-circle-info"></i></i> Service No.3</small>
                    <div class="col-12 mb-3">
                        <label for="title2">Title:</label>
                        <input type="text" name="title2" id="title2" class="form-control" value="{{ $properties['title2'] ?? '' }}">
                        <small class="text-info"><b>(optional)</b></small>
                    </div>
                    <div class="col-12 mb-3">
                        <label for="shortDescription0">Short Description:</label>
                        <input type="text" name="shortDescription2" id="shortDescription2" class="form-control" value="{{ $properties['shortDescription2'] ?? '' }}">
                        <small class="text-info"><b>(optional)</b></small>
                    </div>
                    <div class="col-12 mb-3">
                        <label for="icon2">Icon:</label>
                        <select id="iconSelect2" class="js-example-basic-single form-control" name="icon2">
                            <option class="d-block" selected disabled>{{ $properties['icon2'] ?? 'Select an Icon' }}</option>
                        </select>
                        <small class="text-danger"><b>(Required)</b></small>
                    </div>
                    </div>
                    <div class="border mb-3">
                        <small class="text-info mx-2 mb-3"><i class="fa-solid fa-circle-info"></i></i> Service No.4</small>
                    <div class="col-12 mb-3">
                        <label for="title3">Title:</label>
                        <input type="text" name="title3" id="title3" class="form-control" value="{{ $properties['title3'] ?? '' }}">
                        <small class="text-info"><b>(optional)</b></small>
                    </div>
                    <div class="col-12 mb-3">
                        <label for="shortDescription0">Short Description:</label>
                        <input type="text" name="shortDescription3" id="shortDescription3" class="form-control" value="{{ $properties['shortDescription3'] ?? '' }}">
                        <small class="text-info"><b>(optional)</b></small>
                    </div>
                    <div class="col-12 mb-3">
                        <label for="icon3">Icon:</label>
                        <select id="iconSelect3" class="js-example-basic-single form-control" name="icon3">
                            <option class="d-block" selected disabled>{{ $properties['icon3'] ?? 'Select an Icon' }}</option>
                        </select>
                        <small class="text-danger"><b>(Required)</b></small>
                    </div>
                    </div>
                </div>

                </div>
        </div>
        
        <div class="text-center">
            <button type="submit" class="btn btn-info px-5">Update Slider</button>
        </div>
    </form>
   
</div>
{{-- //MODAL --}}
<div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Crop Image Before Upload</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="img-container">
                    <div class="row">
                        <div class="col-md-8">
                            <img src="" id="sample_image" />
                        </div>
                        <div class="col-md-4">
                            <div class="preview"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                {{-- <button type="button" id="crop" class="btn btn-primary">Crop</button> --}}
                <button type="button" class="btn btn-primary crop-btn" data-index="">Crop</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div> 

    @push('iconscript')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.js-example-basic-single').select2();
        });
    </script>  
    
    <script>
        $(document).ready(function() {
            // Load the icons from the JSON file
            $.getJSON('{{ asset("admin/icons.json") }}', function(icons) {
            @for ($i = 0; $i < 4; $i++)
                var select{{ $i }} = $('#iconSelect{{ $i }}');

                icons.forEach(function(icon) {
                    // Create an <option> element with the icon's name and unicode
                    var option = $('<option>').val(icon.iconName).text(icon.iconName).attr('data-icon-name', icon.iconName).addClass('hidden-option');
                    select{{ $i }}.append(option);

                });

                // Initialize Select2 on the select elements
                select{{ $i }}.select2({
                    escapeMarkup: function(markup) {
                        return markup;
                    },
                    templateResult: function(icon) {
                        if (!icon.id) {
                            return icon.text;
                        }

                        var $icon = $('<i>').addClass('fas ' + icon.id);
                        var $text = $('<span>').text(' ' + icon.text);
                        return $('<span>').append($icon).append($text);
                    },
                    templateSelection: function(icon) {
                        if (!icon.id) {
                            return icon.text;
                        }

                        var $icon = $('<i>').addClass('fas ' + icon.id);
                        return $('<span>').append($icon);
                    }
                });
            @endfor
        });
        });
    </script>
    @endpush
    <script>
        $(document).ready(function() {
            var modal = new bootstrap.Modal(document.getElementById('modal'));
            var cropper
            
                $('#avatarImg').change(function(event) {
                    var image = document.getElementById('sample_image');
                    var files = event.target.files;
                    var done = function(url) {
                        image.src = url;
                        modal.show();
                    };
                    if (files && files.length > 0) {
                        var reader = new FileReader();
                        reader.onload = function(event) {
                            done(reader.result);
                        };
                        reader.readAsDataURL(files[0]);
                    }
                    handleCropButtonClick(image);
                });


            function handleCropButtonClick(image) {
                $('#modal').on('shown.bs.modal', function() {
                    if (cropper) {
                        cropper.destroy();
                    }
                    cropper = new Cropper(image, {
                        aspectRatio: 1/1,
                        viewMode: 1,
                        preview: '.preview'
                    });
                });

                $('.crop-btn').off('click').on('click', function() {
                    var canvas = cropper.getCroppedCanvas({
                        width: 1080,
                        height: 1080
                    });

                    canvas.toBlob(function(blob) {
                        var url = URL.createObjectURL(blob);

                        var reader = new FileReader();
                        reader.onloadend = function() {
                            var base64data = reader.result;
                            modal.hide();
                            $('#showImg').attr('src', base64data);
                        };
                        reader.readAsDataURL(blob);

                        var file = new File([blob], `met_about.jpg`, { type: "image/jpeg" });
                        var fileInput = document.getElementById('croppedImg');
                        var dataTransfer = new DataTransfer();
                        dataTransfer.items.add(file);
                        fileInput.files = dataTransfer.files;

                        modal.hide();
                    }, "image/jpeg");
                });
            }
        });
    </script>
    
@endsection