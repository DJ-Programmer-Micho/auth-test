@extends('admin.layouts.master')

@section('content')

<div class="m-4 p-0" style="color:#fff">
    <form action="{{route('about.create')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row mb-5">
            <div class="col-12">
                <div class="card bg-card-dark rounded border-4 mb-2 p-1 text-white">
                    <table class="table table-dark table-striped">
                        <thead>
                          <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Pages</th>
                            <th scope="col">Actions</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <th scope="row">1</th>
                            <td>Home</td>
                            <td>
                                <span class="badge bg-success">Slider</span>
                                <span class="badge bg-success">Facts</span>
                                <span class="badge bg-success">About Us</span>
                                <span class="badge bg-success">Services</span>
                                <span class="badge bg-success">Brand</span>
                            </td>
                            <td>
                                <a class="btn btn-primary" href="#" role="button"><i class="fa-solid fa-pen-to-square"></i></a>
                                <a class="btn btn-danger" href="#" role="button"><i class="fa-regular fa-trash-can"></i></a>
                            </td>
                          </tr>
                          <tr>
                            <th scope="row">2</th>
                            <td>About</td>
                            <td>
                                <span class="badge bg-success">Header</span>
                                <span class="badge bg-success">About Us</span>
                                <span class="badge bg-success">Why Choose Us</span>
                                <span class="badge bg-success">Brand</span>
                            </td>
                            <td>
                                <a class="btn btn-primary" href="#" role="button"><i class="fa-solid fa-pen-to-square"></i></a>
                                <a class="btn btn-danger" href="#" role="button"><i class="fa-regular fa-trash-can"></i></a>
                            </td>
                          </tr>
                          <tr>
                            <th scope="row">3</th>
                            <td>Services</td>
                            <td>
                                <span class="badge bg-success">Header</span>
                                <span class="badge bg-success">Services</span>
                                <span class="badge bg-success">Our Work</span>
                                <span class="badge bg-success">Contact Us</span>
                                <span class="badge bg-success">Brand</span>
                            </td>
                            <td>
                                <a class="btn btn-primary" href="#" role="button"><i class="fa-solid fa-pen-to-square"></i></a>
                                <a class="btn btn-danger" href="#" role="button"><i class="fa-regular fa-trash-can"></i></a>
                            </td>
                          </tr>
                        </tbody>
                    </table>
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

{{-- $(document).ready(function(){
        @for ($i = 0; $i < 3; $i++)
        $('#avatarImg').change(function(e){
            var reader = new FileReader();
            reader.onload = function(e){
                $('#showImg').attr('src', e.target.result);
            }
            reader.readAsDataURL(e.target.files[0]);
        });
        @endfor
    }); --}}
@push('iconscript')

@endpush

@endsection
