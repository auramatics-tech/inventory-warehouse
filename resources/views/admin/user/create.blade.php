@extends('admin.layouts.master')
@section('css')
<link href="//cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endsection
@section('content')
<div class="d-flex flex-column-fluid">
    <!--begin::Container-->
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <!--begin::Card-->
                <div class="card card-custom gutter-b example example-compact">
                    <form method="post" action="{{ route('admin.store_user') }}" id="user_form">

                        <input type="hidden" value="{{ csrf_token() }}" name="_token">

                        <input type="hidden" value="{{ isset($user->id) ? $user->id : '' }}" name="id">
                        <div class="col-md-12 p-9">

                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 mb-5">
                                <div class="row">
                                    @if (count($errors) > 0)
                                    <div class="alert alert-danger">
                                        <ul class="mb-0">
                                            @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                    @endif
                                    <div class="form-group col-md-6 mb-3">
                                        <label for="" class="mb-3">Name</label>
                                        <input value="{{ isset($user->name) ? $user->name: '' }}" type="text" class="form-control" name="name" id="name" placeholder="Name">
                                        <span class="invalid-feedback" role="alert">
                                            <strong id="error_first_name">{{ $errors->first('name') }}</strong>
                                        </span>
                                    </div>
                                    <div class="form-group col-md-6 mb-3">
                                        <label for="" class="mb-3">User Type</label>
                                        <select name="role" id="role" class="form-control">
                                            <option value="">select user</option>
                                            <option class="role_child" value="1" {{ ( isset($user->role) && $user->role == 1) ? 'selected' : '' }}>Admin</option>
                                            <option class="role_child" value="2" {{ ( isset($user->role) && $user->role == 2) ? 'selected' : '' }}>Inventory Manager</option>
                                        </select>
                                        <span class="invalid-feedback" role="alert">
                                            <strong id="error_first_name">{{ $errors->first('name') }}</strong>
                                        </span>
                                    </div>
                                    <div class="form-group col-md-6 row_dim mb-3">
                                        <label for="" class="mb-3">Email</label>
                                        <input value="{{ isset($user->name) ? $user->email: old('email') }}" type="text" class="form-control" name="email" id="email" placeholder="Email" autocomplete="off">
                                        <span class="invalid-feedback" role="alert">
                                            <strong id="error_first_name">{{ $errors->first('email') }}</strong>
                                        </span>
                                    </div>
                                    <div class="form-group col-md-6 row_dim mb-3">
                                        <label for="" class="mb-3">Password</label>
                                        <input value="" type="password" class="form-control" name="password" id="password" placeholder="Password" autocomplete="off">
                                        <span class="invalid-feedback" role="alert">
                                            <strong id="error_first_name">{{ $errors->first('password') }}</strong>
                                        </span>
                                    </div>
                                    <div class="form-group col-md-6 mb-3">
                                        <label for="" class="mb-3">Phone No.</label>
                                        <input value="{{ isset($user->phone_no) ? $user->phone_no: old('phone_no') }}" type="number" class="form-control" name="phone_no" id="phone_no" placeholder="Phone no.">
                                        <span class="invalid-feedback" role="alert">
                                            <strong id="error_first_name">{{ $errors->first('phone_no') }}</strong>
                                        </span>
                                    </div>
                                    <div class="form-group col-md-6 mb-3">
                                        <label for="" class="mb-3">Address</label>
                                        <input value="{{ isset($user->address) ? $user->address: old('address') }}" type="text" class="form-control" name="address" id="address" placeholder="Address">
                                        <span class="invalid-feedback" role="alert">
                                            <strong id="error_first_name">{{ $errors->first('address') }}</strong>
                                        </span>
                                    </div>
                                    <div class="form-group col-md-6 mb-3">
                                        <label for="" class="mb-3">City</label>
                                        <input value="{{ isset($user->city) ? $user->city: old('city') }}" type="text" class="form-control" name="city" id="city" placeholder="City">
                                        <span class="invalid-feedback" role="alert">
                                            <strong id="error_first_name">{{ $errors->first('city') }}</strong>
                                        </span>
                                    </div>
                                    <div class="form-group col-md-6 mb-3">
                                        <label for="" class="mb-3">State</label>
                                        <input value="{{ isset($user->state) ? $user->state: old('state') }}" type="text" class="form-control" name="state" id="state" placeholder="State">
                                        <span class="invalid-feedback" role="alert">
                                            <strong id="error_first_name">{{ $errors->first('state') }}</strong>
                                        </span>
                                    </div>
                                    <div class="form-group col-md-6 ">
                                        <label for="" class="mb-3">Country</label>
                                        <input value="{{ isset($user->country) ? $user->country: old('country') }}" type="text" class="form-control" name="country" id="country" placeholder="Country">
                                        <span class="invalid-feedback" role="alert">
                                            <strong id="error_first_name">{{ $errors->first('country') }}</strong>
                                        </span>
                                    </div>
                                    <div class="form-group col-md-6 ">
                                        <label for="" class="mb-3">ZIP Code</label>
                                        <input value="{{ isset($user->zip_code) ? $user->zip_code: old('zip_code') }}" type="number" class="form-control" name="zip_code" id="zip_code" placeholder="Zip Code">
                                        <span class="invalid-feedback" role="alert">
                                            <strong id="error_first_name">{{ $errors->first('zip_code') }}</strong>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" id="user_submit" class="btn btn-primary me-3">Submit</button>
                            <a href="{{ route('admin.user') }}" class="btn btn-secondary">Cancel</a>
                        </div>
                    </form>
                    <!--end::Form-->
                </div>
                <!--end::Card-->
            </div>
        </div>
    </div>
    <!--end::Container-->
</div>

<!--end::Content-->
@endsection
@section('script')
<!--begin::Page Scripts(used by this page)-->
<script src="{{ asset('backend/assets/js/pages/crud/ktdatatable/base/html-table.js') }}"></script>
<!--end::Page Scripts-->
@endsection
@section('script')
<script>
    $(document).ready(function() {
        $('#role').on('change', function() {
            var demovalue = $(this).val();
            console.log(demovalue);
            $(".row_dim").hide();
            $("#show" + demovalue).show();
        });
    });
</script>
@endsection