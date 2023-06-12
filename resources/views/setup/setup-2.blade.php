<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="metiraq">
    <meta name="author" content="metiraq">
    <title>MET IRAQ | SETUP</title>
    <!-- Custom fonts for this template-->
    <link href="{{asset('admin/assets/vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <!-- Custom styles for this Toaster-->
    <link href="{{asset('admin/assets/css/toster.css')}}" rel="stylesheet" type="text/css">
    <!-- Custom styles for this template-->
    <link href="{{asset('admin/assets/css/sb-admin-2.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('admin/assets/css/setup.css')}}" rel="stylesheet" type="text/css">
</head>
<body>
    {{-- @include ('setup.stepOne') --}}
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-11 col-sm-9 col-md-7 col-lg-6 col-xl-5 text-center p-0 mt-3 mb-2">
                <div class="card px-0 pt-4 pb-0 mt-3 mb-3">
                    <h2 id="heading">Create Super Admin User</h2>
                    <p>Fill all form field to go to install</p>
                    <div id="msform">
                        <!-- progressbar -->
                        <ul id="progressbar">
                            <li class="active" id="payment"><strong>Database Created</strong></li>
                            <li id="confirm"><strong>Add Admin</strong></li>
                        </ul>
                        <div class="progress">
                            <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <br>
                        <fieldset>
                            <div class="form-card">
                                <div class="row">
                                    <div class="col-7">
                                        <h2 class="fs-title">Database Installed:</h2>
                                    </div>
                                    <div class="col-5">
                                        <h2 class="steps">Step 3 - 4</h2>
                                    </div>
                                </div>
                                <br><br>
                                <h2 class="purple-text text-center"><strong>SUCCESS!</strong></h2>
                                <br>
                                <div class="row justify-content-center">
                                    <div class="col-1" style="color: var(--success)">
                                        <i class="fa-solid fa-database fa-bounce" style="font-size: 4em"></i>
                                    </div>
                                </div>
                                <br><br>
                                <div class="row justify-content-center">
                                    <div class="col-7 text-center">
                                        <h5 class="text-white text-center">You Have Successfully Create Batabase</h5>
                                    </div>
                                </div>
                            </div>
                            <input type="button" id="firstNextButton" name="next" class="next action-button" value="Next"/>

                        </fieldset>
                        <fieldset>
                            <form id="" method="post" action="{{route('setup.createuser')}}">
                                @csrf
                                <div class="form-card">
                                    <div class="row">
                                        <div class="col-7">
                                            <h2 class="fs-title">Image Upload:</h2>
                                        </div>
                                        <div class="col-5">
                                            <h2 class="steps">Step 4 - 4</h2>
                                        </div>
                                    </div>
                                    <div class="row p-0">
                                        <div class="col-12">
                                            <label class="fieldlabels">Full Name:*</label>
                                            <input type="text" name="name" id="name" placeholder="First Last Name" required/>
                                        </div>
                                        <div class="col-12">
                                            <label class="fieldlabels">Admin Name:*</label>
                                            <input type="text" name="username" id="username" placeholder="Admin" required/>
                                        </div>
                                        <div class="col-12">
                                            <label class="fieldlabels">Admin Email:*</label>
                                            <input type="email" name="email" id="email" placeholder="admin@admin.com" required/>
                                        </div>
                                        <div class="col-12">
                                            <label class="fieldlabels">Password:*</label>
                                            <input type="password" name="password" id="password" placeholder="********" required/>
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class=" action-button btn btn-success w-auto">Finish</button>
                             </form>
                        </fieldset>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="{{asset('admin/assets/vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('admin/assets/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <!-- Core plugin JavaScript-->
    <script src="{{asset('admin/assets/vendor/jquery-easing/jquery.easing.min.js')}}"></script>
    {{-- TOSTER --}}
    <script src="{{asset('admin/assets/js/main/toster.js')}}"></script>
    <!-- Custom scripts for all pages-->
    <script src="{{asset('admin/assets/js/main/sb-admin-2.min.js')}}"></script>
    <script src="{{asset('admin/assets/js/main/setup.js')}}"></script>

    {{-- STYLE JS --}}
    <script>
        @if(Session::has('message'))
        var type = "{{ Session::get('alert-type','info') }}"
        switch(type){
            case 'info':
            toastr.info(" {{ Session::get('message') }} ");
            break;
            case 'success':
            toastr.success(" {{ Session::get('message') }} ");
            break;
            case 'warning':
            toastr.warning(" {{ Session::get('message') }} ");
            break;
            case 'error':
            toastr.error(" {{ Session::get('message') }} ");
            break; 
        }
        @endif 
    </script>
</body>

</html>
