@extends('admin.layouts.master')

@section('content')
<div class="container mt-10">
<div class="card card-custom mb-5">
        <div class="card-header flex-wrap border-0 pt-6 pb-0">
            <div class="card-title">
                <h3 class="card-label"> Basic Details
                </h3>
            </div>
        </div>
        <div class="card-body pt-2">
            <form action="{{route('admin.update_profile')}}"  method="post">
                @if(session()->has('error'))
                <p class="alert alert-danger">{{session('error')}}</p>
                @endif
                @if(session()->has('success'))
                <p class="alert alert-success">{{session('success')}}</p>
                @endif
                @csrf
                <div class="form-group mb-3">
                    <label class="mb-3">Name
                        <!-- <span class="text-danger">*</span> -->
                    </label>
                    <input type="text" name="name" id="name" class="form-control" placeholder="Name" value="{{ isset($admin->name) ? $admin->name: '' }}" />
                </div>
                <div class="form-group mb-3">
                    <label class="mb-3">Email
                        <!-- <span class="text-danger">*</span> -->
                    </label>
                    <input type="email" name="email" id="email" class="form-control" placeholder="Email" value="{{ isset($admin->email) ? $admin->email: '' }}" />
                </div>
                <div class="form-group mb-3">
                    <label class="mb-3">Phone No.
                        <!-- <span class="text-danger">*</span> -->
                    </label>
                    <input type="number" name="phone_no" id="phone_no" class="form-control" placeholder="Phone No" value="{{ isset($admin->phone_no) ? $admin->phone_no: '' }}"/>
                </div>
                <div class="form-group mb-3">
                    <label class="mb-3">Address
                        <!-- <span class="text-danger">*</span> -->
                    </label>
                    <input type="text" name="address" id="address" class="form-control" placeholder="Address" value="{{ isset($admin->address) ? $admin->address: '' }}"/>
                </div>
                <div class="form-group mb-3">
                    <label class="mb-3">City
                        <!-- <span class="text-danger">*</span> -->
                    </label>
                    <input type="text" name="city" id="city" class="form-control" placeholder="City" value="{{ isset($admin->city) ? $admin->city: '' }}"/>
                </div>
                <div class="form-group mb-3">
                    <label class="mb-3">State
                        <!-- <span class="text-danger">*</span> -->
                    </label>
                    <input type="text" name="state" id="state" class="form-control" placeholder="State" value="{{ isset($admin->state) ? $admin->state: '' }}"/>
                </div>
                <div class="form-group mb-3">
                    <label class="mb-3">Country
                        <!-- <span class="text-danger">*</span> -->
                    </label>
                    <input type="text" name="country" id="country" class="form-control" placeholder="Country" value="{{ isset($admin->country) ? $admin->country: '' }}"/>
                </div>
                <div class="form-group mb-3">
                    <label class="mb-3">ZIP Code
                        <!-- <span class="text-danger">*</span> -->
                    </label>
                    <input type="number" name="zip_code" id="zip_code" class="form-control" placeholder="Zip code" value="{{ isset($admin->zip_code) ? $admin->zip_code: '' }}"/>
                </div>
                <button type="submit" class="btn btn-primary mr-2">Save</button>
            </form>
        </div>
    </div>
    <div class="card card-custom">
        <div class="card-header flex-wrap border-0 pt-6 pb-0">
            <div class="card-title">
                <h3 class="card-label"> Change Password
                </h3>
            </div>
        </div>
        <div class="card-body pt-3">
            <form action="{{route('admin.change_password')}}" method="post">
                @if(session()->has('error'))
                <p class="alert alert-danger">{{session('error')}}</p>
                @endif
                @if(session()->has('success'))
                <p class="alert alert-success">{{session('success')}}</p>
                @endif
                @csrf
                <div class="form-group  mb-3">
                    <label class="mb-3">Current Password
                        <span class="text-danger">*</span></label>
                    <input type="password" name="current_password" id="current_password" class="form-control" placeholder="Current Password" required />
                </div>
                <div class="form-group mb-3">
                    <label class="mb-3">New Password
                        <span class="text-danger">*</span></label>
                    <input type="password" name="new_password" id="new_password" class="form-control" placeholder="New Password" required />
                </div>
                <div class="form-group mb-3">
                    <label class="mb-3">Confirm Password
                        <span class="text-danger">*</span></label>
                    <input type="password" name="confirm_password" id="confirm_password" class="form-control" placeholder="Confirm Password" required />
                </div>
                <button type="submit" class="btn btn-primary mr-2">Save</button>
            </form>
        </div>
    </div>
</div>
</div>

<!--end::Entry-->
</div>
@endsection
