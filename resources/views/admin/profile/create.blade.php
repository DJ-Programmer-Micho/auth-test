@extends('admin.layouts.master')

@section('content')

@php
 $id = Auth::user()->id;
 $adminData = App\Models\User::find($id)   
@endphp

<script src="{{asset('admin/assets/vendor/jquery/jquery.min.js')}}"></script>
<div class="container p-0" style="max-width: 600px">
<form method="post" action="{{route('store.profile')}}" enctype="multipart/form-data">
    @csrf
    <div class="row m-4 p-0">
        <!-- Start FORM -->
        <div class="col-12">
            <div class="card bg-card-dark rounded border-4 mb-2 p-1 text-white" >
                <div class="mb-4 text-start">
                    <h4>Profile</h4>
                </div>
                <div class="mb-3 text-center">
                    <img id="showImg" src="{{ (!empty($adminData->profile_image))? url('admin/avatars/'.$adminData->profile_image):url('admin/avatars/empty.svg')}}" width="90" class="img-thumbnail rounded">
                </div>
                <div class="mb-3">
                    <label for="formFile" class="form-label m-0 p-0">AVATAR</label>
                    <input class="form-control" name="profile_image_file" type="file" id="avatarImg" style="height: auto">
                  </div>
                <div class="mb-3">
                    <label class="form-label">Full Name:</label>
                    <input type="text" name="name" class="form-control" placeholder="Full Name" value="{{$editData->name}}"/>
                </div>
                <div class="mb-3">
                    <label class="form-label">Username:</label>
                    <input type="text" name="username" class="form-control" placeholder="Username" value="{{$editData->username}}" />
                </div>
                <div class="mb-3">
                    <label class="form-label">Email:</label>
                    <input type="email" name="email" class="form-control" placeholder="Email" value="{{$editData->email}}"/>
                </div>

            </div>
        </div>
        <!-- END FORM -->
    </div>
    <div class="d-flex justify-content-center">
        <button type="submit" class="btn btn-primary m-2">
            Submit
        </button>
        <a
            type="button"
            href="/admin/products/"
            class="btn btn-danger m-2"
        >
            Cancel
        </a>
    </div>
</form>
</div>

<script>
    $(document).ready(function(){
        $('#avatarImg').change(function(e){
            var reader = new FileReader();
            reader.onload = function(e){
                $('#showImg').attr('src',e.target.result);
            }
            reader.readAsDataURL(e.target.files['0']);
        });
    });
</script>
@endsection