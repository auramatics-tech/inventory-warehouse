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
                    <form method="post" action="{{ route('admin.store_category') }}" id="user_form">

                        <input type="hidden" value="{{ csrf_token() }}" name="_token">

                        <input type="hidden" value="{{ isset($category->id) ? $category->id : '' }}" name="id">

                        <div class="col-md-12 p-9">

                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
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
                                    <div class="form-group col-md-6 ">
                                        <label for="" class="mb-3">Category Name</label>
                                        <input value="{{ isset($category->name) ? $category->name: '' }}" type="text" class="form-control" name="name" id="name" placeholder="Category Name">
                                        <span class="invalid-feedback" role="alert">
                                            <strong id="error_first_name">{{ $errors->first('name') }}</strong>
                                        </span>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="" class="mb-3">Active</label>
                                        <div class="d-flex align-items-center">
                                            <input type="checkbox" name="active" @if(isset($category->active) && $category->active == 1) checked @endif>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" id="user_submit" class="btn btn-primary me-3">Submit</button>
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
<!--end::Content-->
@endsection
@section('script')
<!--begin::Page Scripts(used by this page)-->
<script src="{{ asset('backend/assets/js/pages/crud/ktdatatable/base/html-table.js') }}"></script>
<!--end::Page Scripts-->
@endsection