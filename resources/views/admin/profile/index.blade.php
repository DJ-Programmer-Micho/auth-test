@extends('admin.layouts.master')

@section('content')
<div class="container p-0" style="max-width: 600px">
        <div class="row justify-content-center p-0 m-0">
            <!-- Start FORM -->
            <div class="col-12">
                <div class="card bg-card-dark rounded border-4 mb-2 p-1 text-white" >
                    <div class="mb-4 text-start">
                        <h4>Your Profile</h4>
                    </div>
                    <div class="mb-3 text-center">
                        <img src="{{ (!empty($adminData->profile_image))? url('admin/avatars/'.$adminData->profile_image):url('admin/avatars/empty.svg')}}" width="90" class="img-thumbnail rounded">
                    </div>
                    <table>
                        <tr class="mb-3">
                            <td><b>Full Name:</b></td>
                            <td class="w-75">{{$adminData->name}}</td>
                        </tr>
                        <tr class="mb-3">
                            <td><b>Username:</b></td>
                            <td class="w-75">{{$adminData->username}}</td>
                        </tr>
                        <tr class="mb-3">
                            <td><b>Email:</b></td>
                            <td class="w-75">{{$adminData->email}}</td>
                        </tr>
                    </table>
                    <a href="{{route('edit.profile')}}" class="btn btn-info m-2">
                        Edit
                    </a>
                </div>
            </div>
            <!-- END FORM -->
    
                            {{-- <div class="mb-3">
                        <label class="form-label"
                            >Product Description:</label
                        >
                        <textarea
                            type="text"
                            name="descen"
                            rows="5"
                            class="form-control"
                            placeholder="Lorem ipsum dolor sit, amet consectetur adipisicing elit. Error reiciendis commodi tempora accusamus laboriosam omnis recusandae earum, ipsa voluptate blanditiis eius adipisci saepe, quam veritatis culpa cumque excepturi. Natus, quod?"
                        ></textarea>
                     
                    </div> --}}
        </div>

</div>

@endsection