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
    <h1 class="h3 mb-2 text-white">Add & Edit Price List</h1>
    <a href="{{route('price.create')}}" class="btn btn-success mb-2"><i class="fa-solid fa-plus fa-lg"></i> Add New Price </a>
</div>
<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Allowd Only Three Rows/Bundles</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>#ID</th>
                        <th>Bundle Name</th>
                        <th>EXP.</th>
                        <th>Price</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @php($i=1)
                    @foreach($items as $item)
                    <tr>
                    <td>{{$i++}}</td>
                    <td>{{$item['name']}}</td>
                    <td>{{$item->exp}}</td>
                    <td>{{$item->price}}</td>
                    <td>
                        <a href="{{route('price.edit',$item['id'])}}" class="btn btn-info"><i class="fa-regular fa-pen-to-square"></i></a>
                        <a href="{{route('price.delete',$item['id'])}}" id="delete"  class="btn btn-danger"><i class="fa-regular fa-trash-can"></i></a>
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