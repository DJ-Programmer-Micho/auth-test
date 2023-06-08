@extends('admin.layouts.master')

@section('content')
<form @submit="handleSubmit" :validation-schema="schema">
    <div class="row">
        <!-- Start FORM -->
        <div class="col-12 col-lg-6">
            <div class="card bg-card-dark rounded border-4 mb-2 p-1 text-white" >
                <div class="mb-4 text-start">
                    <h4>Profile</h4>
                </div>
                <div class="mb-3">
                    <label class="form-label">Full Name:</label>
                    <input type="text" name="name" class="form-control" placeholder="Full Name" value="{{$adminData->name}}"/>
                </div>
                <div class="mb-3">
                    <label class="form-label">Username:</label>
                    <input type="text" name="username" class="form-control" placeholder="Username" value="{{$adminData->username}}" />
                </div>
                <div class="mb-3">
                    <label class="form-label">Email:</label>
                    <input type="email" name="email" class="form-control" placeholder="Email" value="{{$adminData->email}}"/>
                </div>

            </div>
        </div>
        <!-- END FORM -->
        <!-- Start FORM -->
        <div class="col-12 col-lg-6">
            <div class="card bg-card-dark rounded border-4 mb-2 p-1 text-white" >
                <div class="mb-4 text-start">
                    <h4>Password</h4>
                </div>
                <div class="mb-3">
                    <label class="form-label">Full Name:</label>
                    <input type="text" name="name" class="form-control" placeholder="Full Name" value="{{$adminData->name}}"/>
                </div>
                <div class="mb-3">
                    <label class="form-label">Username:</label>
                    <input type="text" name="username" class="form-control" placeholder="Username" value="{{$adminData->username}}"/>
                </div>
                <div class="mb-3">
                    <label class="form-label">Email:</label>
                    <input type="email" name="email" class="form-control" placeholder="Email" value="{{$adminData->email}}"/>
                </div>

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
    <div class="d-flex justify-content-center">
        <button type="submit" class="btn btn-primary m-2">
            Submit
        </button>
        <a
            type="button"
            href="/admin/products/"
            class="btn btn-danger m-2"
        >
            Cancel
        </a>
    </div>
</form>
@endsection