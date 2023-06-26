@extends('main.layouts.master')

@section('content')

{{-- @include('main.components.slider')
@include('main.components.fact')
@include('main.components.about')
@include('main.components.whyus')
@include('main.components.services')
@include('main.components.pricing')
@include('main.components.qoute')
@include('main.components.testimonial')
@include('main.components.team')
@include('main.components.blog')
@include('main.components.brand') --}}

@php
    $items = App\Models\Page::where('name', 'home')->first();
    $data['items'] = $items;

    // dd($items['properties']);
@endphp
 @foreach(json_decode($items['properties']) as $property)

 @include('main.components.' . $property)
         {{-- <h3 class="px-1"><span class="badge bg-success">{{ $property }}</span></h3> --}}
@endforeach
{{-- 
@foreach($components as $component)
    
@endforeach --}}

@endsection