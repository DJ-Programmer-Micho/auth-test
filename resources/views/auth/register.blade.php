{{-- <x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Name -->
        <div>
            <x-input-label for="username" :value="__('Username')" />
            <x-text-input id="username" class="block mt-1 w-full" type="text" name="username" :value="old('username')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('username')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
            <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ml-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
 --}}
 <!DOCTYPE html>
 <html lang="en">
 <head>
     <meta charset="utf-8">
     <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
     <meta name="description" content="">
     <meta name="author" content="">
     <title>Register</title>
     <!-- Custom fonts for this template-->
     <link href="{{asset('admin/assets/vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
     <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
     <!-- Custom styles for this template-->
     <link href="{{asset('admin/assets/css/sb-admin-2.css')}}" rel="stylesheet">
 
 </head>
 <body class="bg-gradient-dark">
     <div class="container">
         <div class="card o-hidden border-0 shadow-lg my-5">
             <div class="card-body p-0">
                 <!-- Nested Row within Card Body -->
                 <div class="row">
                     <div class="col-lg-5 d-none d-lg-block bg-register-image"></div>
                     <div class="col-lg-7">
                         <div class="p-5">
                             <div class="text-center">
                                 <img src="{{asset('logo/met_pwa.png')}}" width="60" class="d-lg-none"alt="">
                                 <h1 class="h4 text-gray-900 mb-4">Create an Account!</h1>
                             </div>
                             <form method="POST" action="{{ route('register') }}" class="user">
                                 @csrf
                                 <div class="form-group row">
                                     <div class="col-sm-6 mb-3 mb-sm-0">
                                         <input id="name" class="form-control form-control-user" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" placeholder="Full Name">
                                     </div>
                                     <div class="col-sm-6">
                                         <input id="username" class="form-control form-control-user" type="text" name="username" :value="old('username')" required autofocus autocomplete="username" placeholder="username">
                                     </div>
                                 </div>
                                 <div class="form-group">
                                     <input id="email" class="form-control form-control-user" type="email" name="email" :value="old('email')" required autocomplete="username" placeholder="Email Address">
                                 </div>
                                 <div class="form-group row">
                                     <div class="col-sm-6 mb-3 mb-sm-0">
                                         <input id="password" class="form-control form-control-user" type="password" name="password" required autocomplete="new-password" placeholder="Password">
                                     </div>
                                     <div class="col-sm-6">
                                         <input id="password" class="form-control form-control-user" type="password" name="password_confirmation" required autocomplete="new-password" placeholder="Repeat Password">
                                     </div>
                                 </div>
                                 <button type="submit" class="btn btn-primary btn-user btn-block">
                                     {{__('Register Account')}}
                                 </button>
                                 {{-- <hr> --}}
                                 {{-- <a href="index.html" class="btn btn-google btn-user btn-block">
                                     <i class="fab fa-google fa-fw"></i> Register with Google
                                 </a>
                                 <a href="index.html" class="btn btn-facebook btn-user btn-block">
                                     <i class="fab fa-facebook-f fa-fw"></i> Register with Facebook
                                 </a> --}}
                             </form>
                             <hr>
                             {{-- <div class="text-center">
                                 <a class="small" href="{{route('password.email')}}">{{__('Forgot Password?')}}</a>
                             </div> --}}
                             <div class="text-center">
                                 <a class="small" href="{{route('login')}}">{{__('Already have an account? Login!')}}</a>
                             </div>
                         </div>
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
     <script src="{{asset('admin/assets/js/sb-admin-2.min.js')}}"></script>
 </body>
 </html>