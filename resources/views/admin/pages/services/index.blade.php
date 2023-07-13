@extends('admin.layouts.master')

@section('content')
<link href="{{asset('admin/assets/vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
<style>
    .bg-dark{
        background-color: #5a5c69 !important
    }
</style>

<!-- Begin Page Content -->
<div class="container-fluid">

<!-- Page Heading -->
<div class="d-flex justify-content-between">
    <h1 class="h3 mb-2 text-white">Add Service</h1>
    <a href="{{route('service.create')}}" class="btn btn-success mb-2"><i class="fa-solid fa-plus fa-lg"></i> Add New Service </a>
</div>
<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Service Table</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>#ID</th>
                        <th>Title</th>
                        <th>Short Description</th>
                        <th>Icon</th>
                        <th>image</th>
                        <th>Created Date</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @php($i=1)
                    @foreach($items as $item)
                    <tr>
                    <td>{{$i++}}</td>
                    <td>{{$item['title']}}</td>
                    <td>{{$item->short_description}}</td>
                    <td><i class="fa-solid {{$item['icon']}}"></i></td>
                    <td><img src="{{url('https://d26ttzql3lait9.cloudfront.net/ttsiraq/services/'.$item['image'])}}" width="100px" alt=""></td>
                    <td>{{$item['created_at']}}</td>
                    <td>
                        <a href="{{route('service.edit',$item['id'])}}" class="btn btn-info"><i class="fa-regular fa-pen-to-square"></i></a>
                        <a href="{{route('service.delete',$item['id'])}}" id="delete"  class="btn btn-danger"><i class="fa-regular fa-trash-can"></i></a>
                    </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

</div>
<!-- /.container-fluid -->

@push('tablescript')
<script src="{{asset('admin/assets/vendor/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('admin/assets/vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('admin/assets/js/main/datatables-demo.js')}}"></script>
@endpush
@endsection