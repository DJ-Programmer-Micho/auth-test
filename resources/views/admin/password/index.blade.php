@extends('admin.layouts.master')

@section('content')
<script src="{{asset('admin/assets/vendor/jquery/jquery.min.js')}}"></script>
<div class="container p-0" style="max-width: 600px">
<form method="post" action="{{route('edit.save.password')}}">
    @csrf
    <div class="row m-4 p-0">
        <!-- Start FORM -->
        <div class="col-12">
            <div class="card bg-card-dark rounded border-4 mb-2 p-1 text-white" >
                <div class="mb-4 text-start">
                    <h4>Change Password</h4>
                </div>
                @if (count($errors))
                    @foreach ($errors->all() as $error)
                    <div class="alert alert-danger d-flex align-items-center" role="alert">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:">
                          <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                        </svg>
                        <div>
                          {{$error}}
                        </div>
                      </div>
                    @endforeach
                @endif
                <div class="mb-3">
                    <label class="form-label">Old Passwoed:</label>
                    <input type="password" id="oldPassword" name="oldPassword" class="form-control" placeholder="OLD PASSWORD"/>
                </div>
                <div class="mb-3">
                    <label class="form-label">New Password:</label>
                    <input type="password" id="newPassword" name="newPassword" class="form-control" placeholder="NEW PASSWORD"/>
                </div>
                <div class="mb-3">
                    <label class="form-label">Repeat Password:</label>
                    <input type="password" id="rePassword" name="rePassword" class="form-control" placeholder="REPEAT PASSWORD"/>
                </div>

                <button type="submit" class="btn btn-info m-2">
                    Change Password
                </button>
            </div>
        </div>
        <!-- END FORM -->
    </div>
</form>
</div>
@endsection