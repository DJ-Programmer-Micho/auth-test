@extends('main.layouts.master')

@section('content')

@php
    // $items = App\Models\Page::where('name', 'home')->first();
    // $data['items'] = $items;
@endphp
 {{-- @foreach(json_decode($items['properties']) as $property) --}}

 {{-- <h3 class="px-1"><span class="badge bg-success">{{ $property }}</span></h3> --}}
 {{-- @endforeach --}}
 @include('main.components.services_all')
{{-- 
@foreach($components as $component)
    
@endforeach --}}

@endsection