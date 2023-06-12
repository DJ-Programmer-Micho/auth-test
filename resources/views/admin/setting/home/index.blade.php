@extends('admin.layouts.master')

@section('content')
<div class="container p-0" style="max-width: 600px; color:#fff">
    {{-- @foreach($properties as $item) --}}
        
        {{-- <ul>
            @foreach($properties as $key => $value)
                <li>{{ $key }}: {{ $value }}</li>
            @endforeach
        </ul>

        <h1>{{$properties['title'] }}</h1>
        <h1>{{$properties['img'] }}</h1>
        <h1>{{$properties['title-2'] }}</h1>
        <h1>{{$properties['img-2'] }}</h1> --}}
    {{-- @endforeach --}}
    {{-- @foreach($properties as $object)
        <ul>
            @foreach($object as $key => $value)
                <li>{{ $key }}: {{ $value }}</li>
            @endforeach
        </ul>
    @endforeach --}}
    @foreach($properties as $index => $property)
    <h1>Index: {{ $index }}</h1>
        {{-- @foreach($property as $key => $value) --}}
            <p>{{ $property['short_title'] }}</p>
            <p>{{ $property['title'] }}</p>
            <button>{{ $property['button_txt1'] }}</button>
            <button>{{ $property['button_txt2'] }}</button>
            <img src="{{ $property['img'] }}"></img>
        {{-- @endforeach --}}
    @endforeach





   
</div>
@endsection