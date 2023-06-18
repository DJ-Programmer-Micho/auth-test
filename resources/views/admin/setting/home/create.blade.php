@extends('admin.layouts.master')

@section('content')
{{-- <script src="{{asset('admin/assets/vendor/jquery/jquery.min.js')}}"></script> --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.2/jquery.min.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.5/cropper.min.css" rel="stylesheet"/>
<script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.5/cropper.min.js"></script>
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
    <form action="{{route('home.create')}}" method="POST" enctype="multipart/form-data">
        @csrf
        
        <div class="row mb-5">
            @for ($i = 0; $i < 3; $i++)
            <div class="col-12 col-lg-4">
            <div class="card bg-card-dark rounded border-4 mb-2 p-1 text-white">
        <h1>Slide No.{{$i+1}}</h1>
        @for ($j = 0; $j < 1; $j++)
                <div class="col-12 mb-3">
                    <label for="head_title{{ $i }}" class="form-label">Head Title {{ $i+1 }}:</label>
                    <input type="text" name="head_title{{ $i }}" id="head_title{{ $i }}"  class="form-control" value="{{ $properties[$i]['short_title'] ?? '' }}">
                    <small class="text-danger"><b>(Required)</b></small>
                </div>
                <div class="col-12 mb-3">
                    <label for="title{{ $i }}">Title {{ $i+1 }}:</label>
                    <input type="text" name="title{{ $i }}" id="title{{ $i }}" class="form-control" value="{{ $properties[$i]['title'] ?? '' }}">
                    <small class="text-danger"><b>(Required)</b></small>
                </div>
                <div class="col-12 mb-3">
                    <label for="button_txt1{{ $i }}">First Button Text {{ $i+1 }}:</label>
                    <input type="text" name="button_txt1{{ $i }}" id="button_txt1{{ $i }}" class="form-control" value="{{ $properties[$i]['button_txt1'] ?? '' }}">
                    <small class="text-info"><b>(optional)</b></small>
                </div>
                <div class="col-12 mb-3">
                    <label for="button_url1{{ $i }}">First Button URL {{ $i+1 }}</label>
                    <input type="text" name="button_url1{{ $i }}" id="button_url1{{ $i }}" class="form-control" value="{{ $properties[$i]['button_url1'] ?? '' }}">
                    <small class="text-info"><b>(optional)</b></small>
                </div>
                <div class="col-12 mb-3">
                    <label for="button_txt2{{ $i }}">Second Button Text {{ $i+1 }}</label>
                    <input type="text" name="button_txt2{{ $i }}" id="button_txt2{{ $i }}" class="form-control" value="{{ $properties[$i]['button_txt2'] ?? '' }}">
                    <small class="text-info"><b>(optional)</b></small>
                </div>
                <div class="col-12 mb-3">
                    <label for="button_url2{{ $i }}">Second Button URL {{ $i+1 }}</label>
                    <input type="text" name="button_url2{{ $i }}" id="button_url2{{ $i }}" class="form-control" value="{{ $properties[$i]['button_url2'] ?? '' }}">
                    <small class="text-info"><b>(optional)</b></small>
                </div>
                {{-- <div class="col-12 mb-3">
                    <label for="img{{ $i }}">Image {{ $i }}</label>
                    <input type="text" name="img{{ $i }}" id="img{{ $i }}" class="form-control" value="{{ $properties[$i]['img'] ?? '' }}">
                </div> --}}
                <div class="col-12 mb-3">
                    <label for="img{{ $i }}">Image {{ $i+1 }}</label>
                    <input type="file" name="img{{ $i }}"  id="avatarImg{{ $i }}" class="form-control metControl" style="height: auto" value="{{ $properties[$i]['img'] ?? '' }}" for="{{$i}}">
                    <small class="text-danger"><b>(Required)</b></small>
                    <input type="file" name="croppedImg{{ $i }}" id="croppedImg{{ $i }}" style="display: none;">
                </div>
                <div class="col-12 mb-3 text-center">
                    <img id="showImg{{$i}}" src="{{ (!empty($properties[$i]['img']))? url('admin/slider/'.$properties[$i]['img'] ):url('admin/avatars/empty.svg')}}" width="90" class="img-thumbnail rounded">
                </div>
                <input type="hidden" id="asd{{$i}}" value="{{$i}}">
                @endfor
            </div>
            </div>
            @endfor
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

    {{-- $(document).ready(function(){
        @for ($i = 0; $i < 3; $i++)
        $('#avatarImg{{ $i }}').change(function(e){
            var reader = new FileReader();
            reader.onload = function(e){
                $('#showImg{{ $i }}').attr('src', e.target.result);
            }
            reader.readAsDataURL(e.target.files[0]);
        });
        @endfor
    }); --}}

    <script>
        $(document).ready(function() {
            var modal = new bootstrap.Modal(document.getElementById('modal'));
            var cropper
            
            @for ($i = 0; $i < 3; $i++)
            (function(i) {
                $('#avatarImg{{$i}}').change(function(event) {
                    var image = document.getElementById('sample_image');
                    console.log('Clicked on #avatarImg' + i);
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
                    handleCropButtonClick(i, image);
                    console.log('clicked ID'+i)
                });
    
            })({{$i}});
            @endfor

            function handleCropButtonClick(i,image) {
                $('#modal').on('shown.bs.modal', function() {
                    if (cropper) {
                        cropper.destroy();
                    }
                    cropper = new Cropper(image, {
                        aspectRatio: 1280/480,
                        viewMode: 1,
                        preview: '.preview'
                    });
                });

                $('.crop-btn').off('click').on('click', function() {
                    var canvas = cropper.getCroppedCanvas({
                        width: 1280,
                        height: 480
                    });

                    // canvas.toBlob(function(blob) {
                    //     var url = URL.createObjectURL(blob);
                    //     var reader = new FileReader();
                    //     reader.readAsDataURL(blob);
                    //     reader.onloadend = function() {
                    //         var base64data = reader.result;
                    //         modal.hide();
                    //         var currentIndex = i
                    //         console.log()
                    //         $('#showImg'+currentIndex).attr('src', base64data);
                    //         console.log('done');
                    //     }.bind(this);
                    // }.bind(this));

                    // canvas.toBlob(function(blob) {
                    //     var file = new File([blob], `MET${i}.jpg`, { type: "image/jpeg" }); // Create a new File object
                    //     var currentIndex = i;
                    //     var fileInput = document.getElementById('croppedImg' + currentIndex);
                    //     var dataTransfer = new DataTransfer();
                    //     dataTransfer.items.add(file);
                    //     fileInput.files = dataTransfer.files;
                        
                    //     modal.hide();
                    //     console.log('done');
                    // }, "image/jpeg");

                    canvas.toBlob(function(blob) {
                        var url = URL.createObjectURL(blob);

                        var reader = new FileReader();
                        reader.onloadend = function() {
                            var base64data = reader.result;
                            modal.hide();
                            var currentIndex = i;
                            $('#showImg' + currentIndex).attr('src', base64data);
                            console.log('done');
                        };
                        reader.readAsDataURL(blob);

                        var file = new File([blob], `MET${i}.jpg`, { type: "image/jpeg" });
                        var currentIndex = i;
                        var fileInput = document.getElementById('croppedImg' + currentIndex);
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