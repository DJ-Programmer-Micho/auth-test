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
    <form action="{{route('service.store')}}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="row mb-5">

            <div class="col-6">
            <div class="card bg-card-dark rounded border-4 mb-2 p-1 text-white">
                <h1 class="mx-2">Service</h1>
                <hr class="bg-white">
                <div class="col-12 mb-3">
                    <label for="title">Title:</label>
                    <input type="text" name="title" id="title" class="form-control" value="{{ $properties['title'] ?? '' }}">
                    <small class="text-danger"><b>(Required)</b></small>
                </div>
                <div class="col-12 mb-3">
                    <label for="short_description">Short Description:</label>
                    <textarea name="short_description" id="short_description" class="form-control">{{ $properties['short_description'] ?? '' }}</textarea>
                    <small class="text-danger"><b>(Required)</b></small>
                </div>
                <div class="col-12 mb-3">
                    <label for="description">Description:</label>
                    <textarea name="description" id="description" class="form-control">{{ $properties['description'] ?? '' }}</textarea>
                    <small class="text-danger"><b>(Required)</b></small>
                </div>
                <div class="col-12 mb-3">
                    <label for="icon">Icon:</label>
                    <select id="iconSelect" class="js-example-basic-single form-control" name="icon">
                        <option class="d-block" selected disabled>{{ $properties['icon'] ?? 'Select an Icon' }}</option>
                    </select>
                    <small class="text-danger"><b>(Required)</b></small>
                </div>
            </div>
            </div>
            <div class="col-6">
                <div class="card bg-card-dark rounded border-4 mb-2 p-1 text-white">
                <div class="col-12 mb-3">
                    <h1 class="mx-2">Image</h1>
                    <hr class="bg-white">
                    <label for="img0">Upload Image</label>
                    <input type="file" name="img0"  id="avatarImg0" class="form-control metControl" style="height: auto" value="{{ $properties['img0'] ?? '' }}" for="">
                    <small class="text-danger"><b>(Required)</b></small>
                    <input type="file" name="croppedImg0" id="croppedImg0" style="display: none;">
                </div>
                <div class="col">
                    <div class="mb-3 d-flex justify-content-center mt-1">
                        <img id="showImg0" src="{{ (!empty($properties['img0']))? url('admin/slider/'.$properties['img0'] ):url('admin/avatars/empty.svg')}}" width="250" class="img-thumbnail rounded">
                    </div>
                </div>
                </div>

                <div class="card bg-card-dark rounded border-4 mb-2 p-1 text-white">
                    <div class="col-12 mb-3">
                        <h1 class="mx-2">Image</h1>
                        <hr class="bg-white">
                        <label for="img1">Upload Image</label>
                        <input type="file" name="img1"  id="avatarImg1" class="form-control metControl" style="height: auto" value="{{ $properties['img1'] ?? '' }}" for="">
                        <small class="text-danger"><b>(Required)</b></small>
                        <input type="file" name="croppedImg1" id="croppedImg1" style="display: none;">
                    </div>
                    <div class="col">
                        <div class="mb-3 d-flex justify-content-center mt-1">
                            <img id="showImg1" src="{{ (!empty($properties['img1']))? url('admin/slider/'.$properties['img1'] ):url('admin/avatars/empty.svg')}}" width="250" class="img-thumbnail rounded">
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

                    var select = $('#iconSelect');
    
                    icons.forEach(function(icon) {
                        // Create an <option> element with the icon's name and unicode
                        var option = $('<option>').val(icon.iconName).text(icon.iconName).attr('data-icon-name', icon.iconName).addClass('hidden-option');
                        select.append(option);
    
                    });
    
                    // Initialize Select2 on the select elements
                    select.select2({
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

            });
        });
    </script>
    @endpush
    <script>
        $(document).ready(function () {
            var modal = new bootstrap.Modal(document.getElementById('modal'));
            var cropper
            @for($i = 0; $i < 2; $i++)
                (function (i) {
                    $('#avatarImg{{$i}}').change(function (event) {
                        var image = document.getElementById('sample_image');
                        console.log('Clicked on #avatarImg' + i);
                        var files = event.target.files;
                        var done = function (url) {
                            image.src = url;
                            modal.show();
                        };
                        if (files && files.length > 0) {
                            var reader = new FileReader();
                            reader.onload = function (event) {
                                done(reader.result);
                            };
                            reader.readAsDataURL(files[0]);
                        }
                        handleCropButtonClick(i, image);
                        console.log('clicked ID' + i)
                    });
                })({{$i}});
            @endfor

            function handleCropButtonClick(i, image) {
                $('#modal').on('shown.bs.modal', function () {
                    if (cropper) {
                        cropper.destroy();
                    }

                    if (i == 0) {
                        cropper = new Cropper(image, {
                            aspectRatio: 1920 / 1080,
                            viewMode: 1,
                            preview: '.preview'
                        });
                    } else {
                        cropper = new Cropper(image, {
                            aspectRatio: 2000 / 400,
                            viewMode: 1,
                            preview: '.preview'
                        });
                    }
                });

                $('.crop-btn').off('click').on('click', function () {
                    var canvas;

                    if (i == 0) {
                        canvas = cropper.getCroppedCanvas({
                            width: 1920,
                            height: 1080
                        });
                    } else {
                        canvas = cropper.getCroppedCanvas({
                            width: 2000,
                            height: 400
                        });
                    }

                    canvas.toBlob(function (blob) {
                        var url = URL.createObjectURL(blob);

                        var reader = new FileReader();
                        reader.onloadend = function () {
                            var base64data = reader.result;
                            modal.hide();
                            $('#showImg' + i).attr('src', base64data);
                            console.log('done');
                        };
                        reader.readAsDataURL(blob);

                        var file = new File([blob], `service${i}.jpg`, {
                            type: "image/jpeg"
                        });
                        var fileInput = document.getElementById('croppedImg' + i);
                        var dataTransfer = new DataTransfer();
                        dataTransfer.items.add(file);
                        fileInput.files = dataTransfer.files;

                        modal.hide();
                        console.log('done');
                    }, "image/jpeg");
                });
            }
        });
    </script>
@endsection