@extends('admin.layouts.master')

@section('content')
<div class="container p-0" style="max-width: 610px; color:#fff">
    <form action="{{route('home.create')}}" method="POST">
        @csrf
        
        @for ($i = 0; $i < 3; $i++)
        <h1>INDEX {{$i}}</h1>
        @for ($j = 0; $j < 1; $j++)
        <div class="row mb-5">
            <div class="col-12">
                <label for="head_title{{ $i }}">Head Title{{ $i }}</label>
                <input type="text" name="head_title{{ $i }}" id="head_title{{ $i }}">
            </div>
            <div class="col-12">
                <label for="title{{ $i }}">Title {{ $i }}</label>
                <input type="text" name="title{{ $i }}" id="title{{ $i }}">
            </div>
            <div class="col-12">
                <label for="button_txt1{{ $i }}">Button Text 1 {{ $i }}</label>
                <input type="text" name="button_txt1{{ $i }}" id="button_txt1{{ $i }}">
            </div>
            <div class="col-12">
                <label for="button_url1{{ $i }}">Button URL 1 {{ $i }}</label>
                <input type="text" name="button_url1{{ $i }}" id="button_url1{{ $i }}">
            </div>
            <div class="col-12">
                <label for="button_txt2{{ $i }}">Button Text 2 {{ $i }}</label>
                <input type="text" name="button_txt2{{ $i }}" id="button_txt2{{ $i }}">
            </div>
            <div class="col-12">
                <label for="button_url2{{ $i }}">Button URL 2 {{ $i }}</label>
                <input type="text" name="button_url2{{ $i }}" id="button_url2{{ $i }}">
            </div>
            <div class="col-12">
                <label for="img{{ $i }}">Image {{ $i }}</label>
                <input type="text" name="img{{ $i }}" id="img{{ $i }}">
            </div>
        </div>
        @endfor
        @endfor
        
        <button type="submit">Submit</button>
    </form>
   
</div>
@endsection