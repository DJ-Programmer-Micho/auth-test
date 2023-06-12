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
                    <h2 id="heading">First Generate DataBaset</h2>
                    <p>Check The Requirments To Start</p>
                    <div id="msform">
                        <!-- progressbar -->
                        <ul id="progressbar">
                            <li class="active" id="account"><strong>Requirments</strong></li>
                            <li id="personal"><strong>Database</strong></li>
                        </ul>
                        <div class="progress">
                            <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <br>
                        <!-- fieldsets -->
                        <fieldset>
                            <div class="form-card">
                                <div class="row">
                                    <div class="col-7">
                                        <h2 class="fs-title">Requirments:</h2>
                                    </div>
                                    <div class="col-5">
                                        <h2 class="steps">Step 1 - 4</h2>
                                    </div>
                                </div>
                                @if ($phpReturnCode === 0)
                                <div class="alert alert-success d-flex align-items-center" role="alert">
                                    <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:"><use xlink:href="#check-circle-fill"/></svg>
                                    <div>
                                        PHP is installed.
                                    </div>
                                  </div>
                                @else
                                <div class="alert alert-danger d-flex align-items-center" role="alert">
                                    <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
                                    <div>
                                        PHP is not installed.
                                    </div>
                                  </div>
                                @endif
                                @if ($composerReturnCode === 0)
                                <div class="alert alert-success d-flex align-items-center" role="alert">
                                    <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:"><use xlink:href="#check-circle-fill"/></svg>
                                    <div>
                                        Composer is installed.
                                    </div>
                                  </div>
                                @else
                                <div class="alert alert-danger d-flex align-items-center" role="alert">
                                    <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
                                    <div>
                                        Composer is not installed.
                                    </div>
                                  </div>
                                @endif
                                @if ($nodeReturnCode === 0)
                                <div class="alert alert-success d-flex align-items-center" role="alert">
                                    <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:"><use xlink:href="#check-circle-fill"/></svg>
                                    <div>
                                        Node.js is installed.
                                    </div>
                                  </div>
                                @else
                                <div class="alert alert-danger d-flex align-items-center" role="alert">
                                    <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
                                    <div>
                                        Node.js is not installed.
                                    </div>
                                  </div>
                                @endif
                            </div>
                            <input type="button" id="firstNextButton" name="next" class="next action-button" value="Next"/>
                        </fieldset>
                        <fieldset>
                            <form id="" method="post" action="{{route('setup.createdb')}}">
                                @csrf
                            <div class="form-card">
                                <div class="row">
                                    <div class="col-7">
                                        <h2 class="fs-title">Create Database:</h2>
                                    </div>
                                    <div class="col-5">
                                        <h2 class="steps">Step 2 - 4</h2>
                                    </div>
                                </div>
                                    <div class="row p-0">
                                        <div class="col-6">
                                            <label class="fieldlabels">Connection Name:</label>
                                            <input type="text" name="DB_CONNECTION" id="DB_CONNECTION" placeholder="mysql or mysqli"/>
                                        </div>
                                        <div class="col-6">
                                            <label class="fieldlabels">Host</label>
                                            <input type="text" name="DB_HOST" id="DB_HOST" placeholder="127.0.0.1"/>
                                        </div>
                                        <div class="col-6">
                                            <label class="fieldlabels">Port</label>
                                            <input type="text" name="DB_PORT" id="DB_PORT" placeholder="3306"/>
                                        </div>
                                        <div class="col-6">
                                            <label class="fieldlabels">Databse Name</label>
                                            <input type="text" name="DB_DATABASE" id="DB_DATABASE" placeholder="db_name"/>
                                        </div>
                                        <div class="col-6">
                                            <label class="fieldlabels">Username</label>
                                            <input type="text" name="DB_USERNAME" id="DB_USERNAME" placeholder="root"/>
                                        </div>
                                        <div class="col-6">
                                            <label class="fieldlabels">Password</label>
                                            <input type="text" name="DB_PASSWORD" id="DB_PASSWORD" placeholder="********"/>
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="next action-button btn btn-success w-auto">Submit Database</button>
                                {{-- <input type="button" name="next" class="next action-button" value="Next" disabled/> --}}
                            </form>
                                <input type="button" name="previous" class="previous action-button-previous" value="Previous"/>
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
    <!-- Custom scripts for all pages-->
    <script src="{{asset('admin/assets/js/main/sb-admin-2.min.js')}}"></script>
    <script src="{{asset('admin/assets/js/main/setup.js')}}"></script>

    <script>
    $(document).ready(function() {
        // Check the return codes and enable/disable the "Next" button accordingly
        var phpReturnCode = {{ $phpReturnCode }};
        var composerReturnCode = {{ $composerReturnCode }};
        var nodeReturnCode = {{ $nodeReturnCode }};
        
        if (phpReturnCode === 0 && composerReturnCode === 0 && nodeReturnCode === 0) {
            $('#firstNextButton').prop('disabled', false);
        } else {
            $('#firstNextButton').prop('disabled', true);
        }
    });

    $(document).ready(function() {
    $('#createDBForm').on('submit', function() {
        // Enable the "Next" button
        $('#nextButton').prop('disabled', false);
    });
});
    </script>

</body>

</html>
