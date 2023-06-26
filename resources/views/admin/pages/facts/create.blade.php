@extends('admin.layouts.master')

@section('content')
<script src="{{asset('admin/assets/vendor/jquery/jquery.min.js')}}"></script>
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.2/jquery.min.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
 --}}

<script src="{{asset('admin/assets/js/main/met-icon.js')}}"></script>
<link rel="stylesheet" href="{{asset('admin/assets/css/met-icon.css')}}">

<div class="m-4 p-0">
    <form action="{{route('fact.store')}}" method="POST">
        @csrf

        <div class="row mb-5">
            @for ($i = 0; $i < 3; $i++)
                <div class="col-12 col-lg-4">
                    <div class="card bg-card-dark rounded border-4 mb-2 p-1 text-white">
                        <h1>Fact No.{{$i+1}}</h1>
                        @for ($j = 0; $j < 1; $j++)
                            <div class="col-12 mb-3">
                                <label for="title{{ $i }}">Title {{ $i+1 }}:</label>
                                <input type="text" name="title{{ $i }}" id="title{{ $i }}" class="form-control" value="{{ $properties[$i]['title'] ?? '' }}">
                                <small class="text-danger"><b>(Required)</b></small>
                            </div>
                            <div class="row col-12 p-0 m-0 mb-3">
                                <div class="col-12">
                                    <label for="count{{ $i }}">Counter {{ $i+1 }}:</label>
                                    <input type="number" name="count{{ $i }}" id="count{{ $i }}" class="form-control" value="{{ $properties[$i]['count'] ?? '' }}">
                                    <small class="text-danger"><b>(Required)</b></small>
                                </div>
                                <div class="col-6">
                                    <label for="count{{ $i }}">Sym L {{ $i+1 }}:</label>
                                    <input type="text" name="synmbolL{{ $i }}" id="synmbolL{{ $i }}" class="form-control" value="{{ $properties[$i]['symbolL'] ?? '' }}">
                                    <small class="text-info"><b>(Optional)</b></small>
                                </div>
                                <div class="col-6">
                                    <label for="count{{ $i }}">Sym R {{ $i+1 }}:</label>
                                    <input type="text" name="synmbolR{{ $i }}" id="synmbolR{{ $i }}" class="form-control" value="{{ $properties[$i]['symbolR'] ?? '' }}">
                                    <small class="text-info"><b>(Optional)</b></small>
                                </div>

                            </div>
                            <div class="col-12 mb-3">
                                <label for="count{{ $i }}">Counter {{ $i+1 }}:</label>
                                <select id="iconSelect{{ $i }}" class="js-example-basic-single form-control" name="icon{{ $i }}">
                                    <option class="d-block" selected disabled>{{ $properties[$i]['icon'] ?? 'Select an Icon' }}</option>
                                </select>
                                <small class="text-danger"><b>(Required)</b></small>
                            </div>
                        @endfor
                    </div>
                </div>
            @endfor
        </div>

        <div class="text-center">
            <button type="submit" class="btn btn-info px-5">Update Fact</button>
        </div>
    </form>

</div>


@push('iconscript')
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        $('.js-example-basic-single').select2();
    });
</script>  

<script>
    $(document).ready(function() {
        // Load the icons from the JSON file
        $.getJSON('{{ asset("admin/icons.json") }}', function(icons) {
            @for ($i = 0; $i < 3; $i++)
                var select{{ $i }} = $('#iconSelect{{ $i }}');

                icons.forEach(function(icon) {
                    // Create an <option> element with the icon's name and unicode
                    var option = $('<option>').val(icon.iconName).text(icon.iconName).attr('data-icon-name', icon.iconName).addClass('hidden-option');
                    select{{ $i }}.append(option);

                });

                // Initialize Select2 on the select elements
                select{{ $i }}.select2({
                    escapeMarkup: function(markup) {
                        return markup;
                    },
                    templateResult: function(icon) {
                        if (!icon.id) {
                            return icon.text;
                        }

                        var $icon = $('<i>').addClass('fas ' + icon.id);
                        var $text = $('<span>').text(' ' + icon.text);
                        return $('<span>').append($icon).append($text);
                    },
                    templateSelection: function(icon) {
                        if (!icon.id) {
                            return icon.text;
                        }

                        var $icon = $('<i>').addClass('fas ' + icon.id);
                        return $('<span>').append($icon);
                    }
                });
            @endfor
        });
    });
</script>
@endpush

@endsection