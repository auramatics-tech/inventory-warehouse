@extends('admin.layouts.master')
@section('css')
<link href="//cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endsection
@section('content')

<!--begin::Content-->
    <div class="d-flex flex-column-fluid">
        <!--begin::Container-->
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <!--begin::Card-->
                    <div class="card card-custom gutter-b example example-compact">
                        <form method="post" action="{{ route('admin.store_technician') }}" id="technician_form">

                            <input type="hidden" value="{{ csrf_token() }}" name="_token">

                            <input type="hidden" value="{{ isset($technician->id) ? $technician->id : '' }}" name="id">
                            <div class="col-md-12 p-9">

                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                    <div class="row mt-3">
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
                                            <input value="{{ isset($technician->name) ? $technician->name: old('name') }}" type="text" class="form-control" name="name" id="name" placeholder="Name">
                                            <span class="invalid-feedback" role="alert">
                                                <strong id="error_first_name">{{ $errors->first('name') }}</strong>
                                            </span>
                                        </div>
                                        <div class="form-group col-md-6 mb-3">
                                            <label for="branch"  class="mb-3">Branch</label>
                                            <select name="branch" id="branch" class="form-control">
                                                <option value="">Select Branch</option>
                                                @if(count($branches))
                                                @foreach($branches as $key => $branch)
                                                <option value="{{$branch->id}}" @if(isset($technician->branch) && $technician->branch == $branch->id) selected @endif > {{$branch->name}}
                                                </option>
                                                @endforeach
                                                @endif
                                            </select>
                                            <span class="invalid-feedback" role="alert">
                                                <strong id="error_first_name">{{ $errors->first('branch') }}</strong>
                                            </span>
                                        </div>
                                        <div class="form-group col-md-6 mb-3">
                                            <label for=""  class="mb-3">Phone No.</label>
                                            <input value="{{ isset($technician->phone_no) ? $technician->phone_no: old('phone_no') }}" type="number" class="form-control" name="phone_no" id="phone_no" placeholder="Phone no.">
                                            <span class="invalid-feedback" role="alert">
                                                <strong id="error_first_name">{{ $errors->first('phone_no') }}</strong>
                                            </span>
                                        </div>
                                        <div class="form-group col-md-6 mb-3">
                                            <label for=""  class="mb-3">Address</label>
                                            <input value="{{ isset($technician->address) ? $technician->address: old('address') }}" type="text" class="form-control" name="address" id="address" placeholder="Address">
                                            <span class="invalid-feedback" role="alert">
                                                <strong id="error_first_name">{{ $errors->first('address') }}</strong>
                                            </span>
                                        </div>
                                        <div class="form-group col-md-6 mb-3">
                                            <label for=""  class="mb-3">City</label>
                                            <input value="{{ isset($technician->city) ? $technician->city: old('city') }}" type="text" class="form-control" name="city" id="city" placeholder="City">
                                            <span class="invalid-feedback" role="alert">
                                                <strong id="error_first_name">{{ $errors->first('city') }}</strong>
                                            </span>
                                        </div>
                                        <div class="form-group col-md-6 mb-3">
                                            <label for=""  class="mb-3">State</label>
                                            <input value="{{ isset($technician->state) ? $technician->state: old('state') }}" type="text" class="form-control" name="state" id="state" placeholder="State">
                                            <span class="invalid-feedback" role="alert">
                                                <strong id="error_first_name">{{ $errors->first('state') }}</strong>
                                            </span>
                                        </div>
                                        <div class="form-group col-md-6 ">
                                            <label for=""  class="mb-3">Country</label>
                                            <input value="{{ isset($technician->country) ? $technician->country: old('country') }}" type="text" class="form-control" name="country" id="country" placeholder="Country">
                                            <span class="invalid-feedback" role="alert">
                                                <strong id="error_first_name">{{ $errors->first('country') }}</strong>
                                            </span>
                                        </div>
                                        <div class="form-group col-md-6 ">
                                            <label for="" class="mb-3">ZIP Code</label>
                                            <input value="{{ isset($technician->zip_code) ? $technician->zip_code: ('zip_code') }}" type="number" class="form-control" name="zip_code" id="zip_code" placeholder="ZIP Code">
                                            <span class="invalid-feedback" role="alert">
                                                <strong id="error_first_name">{{ $errors->first('zip_code') }}</strong>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" id="technician_submit" class="btn btn-primary me-3">Submit</button>
                                <a href="{{ route('admin.technician') }}" class="btn btn-secondary">Cancel</a>
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
