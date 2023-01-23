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
                        <form method="post" action="{{ route('admin.store_product') }}" id="user_form">

                            <input type="hidden" value="{{ csrf_token() }}" name="_token">

                            <input type="hidden" value="{{ isset($product->id) ? $product->id : '' }}" name="id">

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
                                        <div class="form-group col-md-6 mb-3">
                                            <label for="" class="mb-3">Product Name</label>
                                            <input value="{{ isset($product->name) ? $product->name: old('name') }}" type="text" class="form-control" name="name" id="name" placeholder="Product name">
                                            <span class="invalid-feedback" role="alert">
                                                <strong id="error_first_name">{{ $errors->first('name') }}</strong>
                                            </span>
                                        </div>
                                        <div class="form-group col-md-6 mb-3">
                                            <label for="category" class="mb-3"> Category</label>
                                            <select name="category" id="category" class="form-control">
                                                <option value="">Select Category</option>
                                                @if(count($categories))
                                                @foreach($categories as $key => $category)
                                                <option value="{{$category->id}}" @if(isset($product->category) && $product->category == $category->id) selected

                                                    @endif > <td>{{$category->name}}</td>
                                                </option>
                                                @endforeach
                                                @endif
                                            </select>
                                            <span class="invalid-feedback" role="alert">
                                                <strong id="error_first_name">{{ $errors->first('category') }}</strong>
                                            </span>
                                        </div>
                                        <div class="form-group col-md-6 ">
                                            <label for="" class="mb-3">Product Code</label>
                                            <input value="{{ isset($product->product_code	) ? $product->product_code	: old('product_code') }}" type="text" class="form-control" name="product_code" id="product_code" placeholder="Product code">
                                            <span class="invalid-feedback" role="alert">
                                                <strong id="error_first_name">{{ $errors->first('product_code') }}</strong>
                                            </span>
                                        </div>
                                        <div class="form-group col-md-6 ">
                                            <label for="" class="mb-3">Product Code From Supplier</label>
                                            <input value="{{ isset($product->product_code_supplier	) ? $product->product_code_supplier	: old('product_code_supplier') }}" type="text" class="form-control" name="product_code_supplier" id="product_code_supplier" placeholder="Product code from supplier">
                                            <span class="invalid-feedback" role="alert">
                                                <strong id="error_first_name">{{ $errors->first('product_code_supplier') }}</strong>
                                            </span>
                                        </div>
                                        <div class="form-group col-md-6 mb-3">
                                            <label for="supplier" class="mb-3"> Supplier</label>
                                            <select name="supplier_id" id="supplier" class="form-control">
                                                <option value="">Select Supplier</option>
                                                @if(count($suppliers))
                                                @foreach($suppliers as $key => $supplier)
                                                <option value="{{$supplier->id}}" @if(isset($product->supplier_id) && $product->supplier_id == $supplier->id) selected
                                                    @endif >{{$supplier->name}}
                                                </option>
                                                @endforeach
                                                @endif
                                            </select>
                                        </div>
                                        <div class="form-group col-md-6 ">
                                            <label for="" class="mb-3">Manufacturer</label>
                                            <input value="{{ isset($product->manufacturer	) ? $product->manufacturer	: old('manufacturer') }}" type="text" class="form-control" name="manufacturer" id="manufacturer" placeholder="Manufacturer">
                                            <span class="invalid-feedback" role="alert">
                                                <strong id="error_first_name">{{ $errors->first('manufacturer') }}</strong>
                                            </span>
                                        </div>
                                        <div class="form-group col-md-6 ">
                                            <label for="" class="mb-3">Product Color</label>
                                            <input value="{{ isset($product->product_color	) ? $product-> product_color	: old('product_color') }}" type="text" class="form-control" name="product_color" id="product_color" placeholder="Product color">
                                            <span class="invalid-feedback" role="alert">
                                                <strong id="error_first_name">{{ $errors->first('product_color') }}</strong>
                                            </span>
                                        </div>
                                        <div class="form-group col-md-6 ">
                                            <label for="" class="mb-3">Active</label>
                                            <div class="d-flex align-items-center">
                                            <input type="checkbox" name="active" @if(isset($product->active) && $product->active == 1) checked @endif>
                                        </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" id="user_submit" class="btn btn-primary me-3">Submit</button>
                                <a href="{{ route('admin.product') }}" class="btn btn-secondary">Cancel</a>
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