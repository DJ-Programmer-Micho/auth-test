@extends('main.layouts.master')

@section('content')

@php
    $items = App\Models\Page::where('name', 'about')->first();
    $data['items'] = $items;

    // dd($items['properties']);
@endphp
 @foreach(json_decode($items['properties']) as $property)

 @include('main.components.' . $property)
         {{-- <h3 class="px-1"><span class="badge bg-success">{{ $property }}</span></h3> --}}
@endforeach

@endsection