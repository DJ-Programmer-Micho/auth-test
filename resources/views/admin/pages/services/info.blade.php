@extends('admin.layouts.master')

@section('content')

<div class="m-4 p-0" style="color:#fff">
    <form action="{{route('service.info.store')}}" method="POST">
        @csrf
        <div class="row mb-5">
            <div class="col-12 col-md-6">
                <div class="card bg-card-dark rounded border-4 mb-2 p-1 text-white">
                    <h1 class="mx-2">Service Title</h1>
                    <hr class="bg-white">
                    <div class="col-12 mb-3">
                        <label for="tag_title" class="form-label">Head Title:</label>
                        <input type="text" name="tag_title" id="tag_title"  class="form-control" value="{{ $properties['tag_title'] ?? 'not found' }}">
                        <small class="text-danger"><b>(Required)</b></small>
                    </div>
                    <div class="col-12 mb-3">
                        <label for="title">Title:</label>
                        <input type="text" name="title" id="title" class="form-control" value="{{ $properties['title'] ?? '' }}">
                        <small class="text-danger"><b>(Required)</b></small>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="card bg-card-dark rounded border-4 mb-2 p-1 text-white">
                    <h1 class="mx-2">Last Card Info</h1>
                    <hr class="bg-white">
                    <div class="col-12 mb-3">
                        <label for="card_title">Title:</label>
                        <input type="text" name="card_title" id="card_title" class="form-control" value="{{ $properties['card_title'] ?? '' }}">
                        <small class="text-danger"><b>(Required)</b></small>
                    </div>
                    <div class="col-12 mb-3">
                        <label for="card_description">Short Description:</label>
                        <input type="text" name="card_description" id="card_description" class="form-control" value="{{ $properties['card_description'] ?? '' }}">
                        <small class="text-danger"><b>(Required)</b></small>
                    </div>
                    <div class="col-12 mb-3">
                        <label for="card_text">Information:</label>
                        <input type="text" name="card_text" id="card_text" class="form-control" value="{{ $properties['card_text'] ?? '' }}">
                        <small class="text-danger"><b>(Required)</b></small>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="text-center">
            <button type="submit" class="btn btn-info px-5">Update Info</button>
        </div>
    </form>
   
</div>
@endsection