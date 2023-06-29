@extends('admin.layouts.master')

@section('content')
<link href="{{asset('main/assets/css/bootstrap.min.css')}}" rel="stylesheet">
<link href="{{asset('main/assets/css/style.css')}}" rel="stylesheet">
<style>
    .bg-dark{
        background-color: #fff!important
    }
</style>

    @include('main.components.pricing')


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="{{asset('main/assets/js/main.js')}}"></script>
@endsection