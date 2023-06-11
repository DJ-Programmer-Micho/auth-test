@extends('admin.layouts.master')

@section('content')
<script src="{{ asset('admin/assets/vendor/jquery/jquery.min.js') }}"></script>
<div class="container p-0" style="max-width: 600px">
    <form method="post" action="{{ route('update.smtp') }}">
        @csrf
        <div class="row m-4 p-0">
            <!-- Start FORM -->
            <div class="col-12">
                <div class="card bg-card-dark rounded border-4 mb-2 p-1 text-white">
                    <div class="mb-4 text-start">
                        <h4>Update SMTP</h4>
                    </div>
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <div class="mb-3">
                        <label class="form-label">Mailer:</label>
                        <input type="text" id="MAIL_MAILER" name="MAIL_MAILER" class="form-control" placeholder="smtp"
                            value="{{ $envVariables['MAIL_MAILER'] ?? '' }}" />
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Host:</label>
                        <input type="text" id="MAIL_HOST" name="MAIL_HOST" class="form-control"
                            placeholder="sandbox.smtp.mailtrap.io" value="{{ $envVariables['MAIL_HOST'] ?? '' }}" />
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Port:</label>
                        <input type="number" id="MAIL_PORT" name="MAIL_PORT" class="form-control" placeholder="587"
                            value="{{ $envVariables['MAIL_PORT'] ?? '' }}" />
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Username:</label>
                        <input type="text" id="MAIL_USERNAME" name="MAIL_USERNAME" class="form-control"
                            placeholder="info@metiraq.com or 91f92854"
                            value="{{ $envVariables['MAIL_USERNAME'] ?? '' }}" />
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Password:</label>
                        <input type="password" id="MAIL_PASSWORD" name="MAIL_PASSWORD" class="form-control"
                            placeholder="********" value="{{ $envVariables['MAIL_PASSWORD'] ?? '' }}" />
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Encryption Type:</label>
                        <input type="text" id="MAIL_ENCRYPTION" name="MAIL_ENCRYPTION" class="form-control" placeholder="tls or ssl"
                            value="{{ $envVariables['MAIL_ENCRYPTION'] ?? '' }}" />
                    </div>
                    <div class="mb-3">
                        <label class="form-label">From Address:</label>
                        <input type="text" id="MAIL_FROM_ADDRESS" name="MAIL_FROM_ADDRESS" class="form-control"
                            placeholder="info@metiraq.com" value="{{ $envVariables['MAIL_FROM_ADDRESS'] ?? '' }}" />
                    </div>
                    <div class="mb-3">
                        <label class="form-label">From Name:</label>
                        <input type="text" id="MAIL_FROM_NAME" name="MAIL_FROM_NAME" class="form-control"
                            placeholder="App Name or nothing" value="{{ $envVariables['MAIL_FROM_NAME'] ?? '' }}" />
                    </div>
                    <button type="submit" class="btn btn-info m-2">
                        Update SMTP
                    </button>
                </div>
            </div>
            <!-- END FORM -->
        </div>
    </form>
</div>
@endsection
