@extends('admin.layouts.master')
@section('css')
<link href="//cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endsection
@section('content')

<!--begin::Content-->

<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <!--begin::Subheader-->
    <div class="subheader py-2 py-lg-6 subheader-solid" id="kt_subheader">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <!--begin::Info-->
            <div class="d-flex align-items-center flex-wrap mr-1">
                <!--begin::Page Heading-->
                <div class="d-flex align-items-baseline flex-wrap mr-5">
                    <!--begin::Page Title-->
                    <h5 class="text-dark font-weight-bold my-1 mr-5">
                    Category Management
                    </h5>
                    <!--end::Page Title-->
                </div>
                <!--end::Page Heading-->
            </div>
            <!--end::Info-->
        </div>
    </div>
    <!--end::Subheader-->
    <!--begin::Entry-->
    <div class="d-flex flex-column-fluid">
        <!--begin::Container-->
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <!--begin::Card-->
                    <div class="card card-custom gutter-b example example-compact">
                        <div class="card-header">
                            @if(isset($category->id))
                            <h3 class="card-title">Update Category Details</h3>
                            @else
                            <h3 class="card-title">Add Category
                            </h3>
                            @endif
                        </div>
                        <!--begin::Form-->
                        <form method="post" action="{{ route('admin.store_category') }}" id="user_form">

                            <input type="hidden" value="{{ csrf_token() }}" name="_token">

                            <input type="hidden" value="{{ isset($category->id) ? $category->id : '' }}" name="id">

                            <div class="col-md-12">

                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 mb-5">
                                    <div class="row">
                                        <div class="form-group col-md-6 ">
                                            <label for="">Category Name</label>
                                            <input value="{{ isset($category->name) ? $category->name: '' }}" type="text" class="form-control" name="name" id="name" placeholder="Category Name" required>
                                            <span class="invalid-feedback" role="alert">
                                                <strong id="error_first_name">{{ $errors->first('name') }}</strong>
                                            </span>
                                        </div>
                                        <div class="form-group col-md-6 mt-5">
                                            <label for="">Active</label>
                                            <input type="checkbox" name="active" @if(isset($category->active) && $category->active == 1) checked @endif>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" id="user_submit" class="btn btn-primary mr-2">Submit</button>
                                <a href="{{ route('admin.category') }}" class="btn btn-secondary">Cancel</a>
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
    <!--end::Entry-->
</div>
<!--end::Content-->
@endsection
@section('script')
<!--begin::Page Scripts(used by this page)-->
<script src="{{ asset('backend/assets/js/pages/crud/ktdatatable/base/html-table.js') }}"></script>
<!--end::Page Scripts-->
@endsection