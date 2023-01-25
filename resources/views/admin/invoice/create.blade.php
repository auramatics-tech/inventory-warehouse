@extends('admin.layouts.master')
@section('css')
<link href="//cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<style>
    .cancel_row {
        position: absolute;
        right: 28px;
        width: 24px;
        padding: 2px 4px;
        border: 0;
        border-radius: 4px;
        margin-top: -23px;
    }

    #country-list,
    #fat_scrt_list li {
        padding: 10px;
        background: #f0f0f0;
        font: normal normal normal 14px/21px Poppins;
        border-bottom: #bbb9b9 1px solid;
    }

    #country-list,
    #fat_scrt_list li:hover {
        background: #e4e6ef;
        cursor: pointer;
    }

    #country-list {
        list-style: none;
        margin-top: 5px;
        padding: 8px;
        width: 23%;
        position: absolute;
        z-index: 999999;
    }

    .error {
        color: red;
    }

    .plusbutton {
        padding: 0 !important;
        margin-left: 10px;
    }

    .plusbutton:hover {
        background: transparent !important;
    }
    .cancel_row{
        position: absolute;
        right:28px;
        width: 24px;
        padding: 2px 4px;
        border: 0;
        border-radius: 4px;
        margin-top:-15px;
    }
</style>

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
                    <!--open::modal-->

                    <!--begin::Form-->
                    <form method="post" action="{{ route('admin.store_invoice') }}" id="user_form">

                        <input type="hidden" value="{{ csrf_token() }}" name="_token">

                        <input type="hidden" value="{{ isset($invoice->id) ? $invoice->id : '' }}" name="id">

                        <div class="col-md-12 p-9">
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                <div class="row">
                                    <div class="form-group col-md-4 mb-3">
                                        <label for="" class="mb-3">Supplier Name</label>
                                        <input value="{{isset($invoice->supplier_name) ? $invoice->supplier_name : ''}}" type="text" class="form-control" name="supplier_name" id="supplier_name" placeholder="Supplier Name" required>
                                    </div>
                                    <div class="form-group col-md-4 mb-3">
                                        <label for="" class="mb-3">Supplier Invoice Number</label>
                                        <input value="{{isset($invoice->supplier_invoice_number) ? $invoice->supplier_invoice_number : ''}}" type="text" class="form-control" name="supplier_invoice_number" id="name" placeholder="Supplier invoice number" required>
                                    </div>
                                    <div class="form-group col-md-4 ">
                                        <label for="" class="mb-3">Invoice Date</label>
                                        <input value="{{isset($invoice->invoice_date) ? date('Y-m-d',strtotime($invoice->invoice_date)) : ''}}" type="date" class="form-control" name="invoice_date" id="invoice_date" placeholder="Date" required>
                                    </div>
                                </div>
                                <hr style="border-top: 1px solid #eff2f5;opacity: 1;">
                                <div id="itemRows">
                                    <div class="d-flex justify-content-end">
                                        <input onclick="addRow(this.form);" type="button" class="btn btn-primary py-2" value=" + Add row" />
                                    </div>
                                    @if(isset($invoice_product) && count($invoice_product))
                                    @foreach($invoice_product as $key => $val)
                                    <div class="row mt-5" id="rowNum{{$key}}">
                                        <div class="form-group  col-md-3 mb-3">
                                            <input type="hidden" name="p_id[]" id="p_id_{{$key}}" value="{{$val->product_id}}">
                                            <label for="" class="mb-3">Product Code <button data-bs-toggle="modal" data-bs-target="#add_new_product_modal" class="btn btn-outline-success plusbutton new_product_btn" id="new_product_btn_{{$key}}" data-id="{{$key}}" type="button"><i class="fas fa-plus"></i></button></label>
                                            <input data-id="{{$key}}" value="{{isset($val->product_code) ? $val->product_code : ''}}" type="text" class="form-control search-box" name="product_code[]" id="search_box_{{$key}}" placeholder="Product Code" required>
                                            <span class="error" id="empty_msg_{{$key}}"></span>
                                            <div id="suggesstion-box_{{$key}}"></div>
                                        </div>
                                        <div class="form-group col-md-3 mb-3">
                                            <label for="" class="mb-3">Product Name</label>
                                            <input value="{{isset($val->product_name) ? $val->product_name : ''}}" type="text" class="form-control" name="product_name[]" id="product_name_{{$key}}" placeholder="Product Name" required>
                                        </div>
                                        <div class="form-group col-md-3 mb-3">
                                            <label for="branch" class="mb-3">Branch</label>
                                            <select name="branch[]" id="branch_{{$key}}" class="form-control">
                                                <option value="">Select Branch</option>
                                                @if(count($branches))
                                                @foreach($branches as $branch)
                                                <option value="{{$branch->id}}" @if(isset($val->branch) && $val->branch == $branch->id) selected
                                                    @endif >{{$branch->name}}
                                                </option>
                                                @endforeach
                                                @endif
                                            </select>
                                        </div>
                                        <div class="form-group col-md-2 mb-3">
                                            <label for="" class="mb-3"> Master Qty</label>
                                            <input value="{{isset($val->master_qty) ? $val->master_qty : ''}}" type="text" class="form-control " name="master_qty[]" id="master_qty_{{$key}}" placeholder="Master Qty" required>
                                        </div>
                                        <div class="form-group col-md-2 mb-3">
                                            <label for="" class="mb-3">Qty</label>
                                            <input value="{{isset($val->qty) ? $val->qty : ''}}" type="number" class="form-control " name="qty[]" id="qty_input_{{$key}}" placeholder="Qty" onkeyup="add_number_m({{$key}})" required>
                                        </div>
                                        <div class="form-group col-md-2 mb-3">
                                            <label for="" class="mb-3">Price/item</label>
                                            <input value="{{isset($val->price) ? $val->price : ''}}" type="number" class="form-control price_input" name="price[]" id="price_input_{{$key}}" placeholder="Price " onkeyup="add_number_m({{$key}})" required>
                                        </div>
                                        <div class="form-group col-md-2 mb-3">
                                            <label for="" class="mb-3">Total Price</label>
                                            <input value="{{isset($val->total_price) ? $val->total_price : ''}}" type="number" class="form-control total_input" name="total_price[]" id="total_price_{{$key}}" placeholder="Total Price" required>
                                        </div>
                                        @if($key)
                                    <input type="button" class="text-white bg-danger cancel_row " value="X" onclick="removeRow('{{$key}}')">
                                    @endif
                                    </div>
                                    @endforeach
                                    @else
                                    <div class="row mt-5">
                                        <div class="form-group  col-md-3 mb-3">
                                            <input type="hidden" name="p_id[]" id="p_id_0" value="">
                                            <label for="" class="mb-3">Product Number <button data-bs-toggle="modal" data-bs-target="#add_new_product_modal" class="btn btn-outline-success plusbutton new_product_btn" id="new_product_btn_0" data-id="0" type="button"><i class="fas fa-plus"></i></button></label>
                                            <input data-id="0" value="" type="text" class="form-control search-box" name="product_code[]" id="search_box_0" placeholder="Product Number" required>
                                            <span class="error" id="empty_msg_0"></span>
                                            <div id="suggesstion-box_0"></div>
                                        </div>
                                        <div class="form-group col-md-3 mb-3">
                                            <label for="" class="mb-3">Product Name</label>
                                            <input value="" type="text" class="form-control" name="product_name[]" id="product_name_0" placeholder="Product Name" required>
                                        </div>
                                        <div class="form-group col-md-3 mb-3">
                                            <label for="branch" class="mb-3">Branch</label>
                                            <select name="branch[]" id="branch" class="form-control">
                                                <option value="">Select Branch</option>
                                                @if(count($branches))
                                                @foreach($branches as $key => $branch)
                                                <option value="{{$branch->id}}" @if(isset($shelve->branch) && $shelve->branch == $branch->id) selected
                                                    @endif >{{$branch->name}}
                                                </option>
                                                @endforeach
                                                @endif
                                            </select>
                                        </div>
                                        <div class="form-group col-md-2 mb-3">
                                            <label for="" class="mb-3"> Master Qty</label>
                                            <input value="" type="text" class="form-control " name="master_qty[]" id="master_qty" placeholder="Master Qty" required>
                                        </div>
                                        <div class="form-group col-md-2 mb-3">
                                            <label for="" class="mb-3">Qty</label>
                                            <input value="" type="number" class="form-control " name="qty[]" id="qty_input" placeholder="Qty" onkeyup="add_number()" required>
                                        </div>
                                        <div class="form-group col-md-2 mb-3">
                                            <label for="" class="mb-3">Price/item</label>
                                            <input value="" type="number" class="form-control price_input" name="price[]" id="price_input" placeholder="Price " onkeyup="add_number()" required>
                                        </div>
                                        <div class="form-group col-md-2 mb-3">
                                            <label for="" class="mb-3">Total Price</label>
                                            <input value="" type="number" class="form-control total_input" name="total_price[]" id="total_price" placeholder="Total Price" required>
                                        </div>
                                    </div>
                                    @endif
                                </div>
                                <hr style="border-top: 1px solid #eff2f5;opacity: 1;">
                                <div class="row mt-5">
                                    <div class="form-group col-md-2 mb-3 ms-auto">
                                        <label for="" class="mb-3">Invoice Total</label>
                                        <br>
                                        <span><b id="invoice_total">{{isset($data['total_price']) ? array_sum($data['total_price']) : ""}}</b></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" id="user_submit" class="btn btn-primary me-3">Submit</button>
                            <a href="{{ route('admin.invoice') }}" class="btn btn-secondary">Cancel</a>
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
<!-- open modal add product -->
<div class="modal fade" id="add_new_product_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Product</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="post" action="{{ route('admin.store_product') }}" id="add_product_from">
                    <input type="hidden" value="{{ csrf_token() }}" name="_token">
                    <input type="hidden" name="row_no" id="row_no">
                    <div class="row">
                        <div class="error_div">
                            @if (count($errors) > 0)
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                            @endif
                        </div>
                        <div class="form-group col-md-6 mb-3">
                            <label for="" class="mb-3">Product Name <span class="alert text-danger">*</span></label>
                            <input type="text" class="form-control" name="name" id="name" placeholder="Product name">
                            <span class="invalid-feedback" role="alert">
                                <strong id="error_first_name">{{ $errors->first('name') }}</strong>
                            </span>
                        </div>
                        <div class="form-group col-md-6 mb-3">
                            <label for="category" class="mb-3"> Category <span class="alert text-danger">*</span></label>
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
                            <label for="" class="mb-3">Product Code <span class="alert text-danger">*</span></label>
                            <input value="" type="text" class="form-control" name="product_code" id="product_code" placeholder="Product code">
                            <span class="invalid-feedback" role="alert">
                                <strong id="error_first_name">{{ $errors->first('product_code') }}</strong>
                            </span>
                        </div>
                        <div class="form-group col-md-6 ">
                            <label for="" class="mb-3">Product Code From Supplier <span class="alert text-danger">*</span></label>
                            <input value="" type="text" class="form-control" name="product_code_supplier" id="product_code_supplier" placeholder="Product code from supplier">
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
                            <input value="" type="text" class="form-control" name="manufacturer" id="manufacturer" placeholder="Manufacturer">
                            <span class="invalid-feedback" role="alert">
                                <strong id="error_first_name">{{ $errors->first('manufacturer') }}</strong>
                            </span>
                        </div>
                        <div class="form-group col-md-6 ">
                            <label for="" class="mb-3">Product Color</label>
                            <input value="" type="text" class="form-control" name="product_color" id="product_color" placeholder="Product color">
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
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" id="product_submit_btn" class="btn btn-primary me-3">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- close modal  -->
    @endsection
    @section('script')
    <!--begin::Page Scripts(used by this page)-->
    <script src="{{ asset('backend/assets/js/pages/crud/ktdatatable/base/html-table.js') }}"></script>
    <!--end::Page Scripts-->
    <script>
        @if(isset($data['product_id']) && count($data['product_id']))
        var rowNum = "{{(count($invoice_product)-1)}}";
        @else
        var rowNum = 0;
        @endif

        function addRow(frm) {
            rowNum++;
            var row = '<div id="rowNum' + rowNum + '" class="row mt-10"><div class="form-group col-md-3 mb-3"><input type="hidden" name="p_id[]" id="p_id_' + rowNum + '"><label for="" class="mb-3">Product Number  <button data-bs-toggle="modal" data-bs-target="#add_new_product_modal" class="btn btn-outline-success plusbutton new_product_btn" id="new_product_btn_' + rowNum + '" data-id="' + rowNum + '" type="button"><i class="fas fa-plus"></i></button></label><input value="" type="text" class="form-control search-box" data-id="' + rowNum + '" name="product_code[]" id="search_box_' + rowNum + '" placeholder="Product Number" required><span class="error" id="empty_msg_' + rowNum + '"></span><div id="suggesstion-box_' + rowNum + '"></div></div><div class="form-group col-md-3 mb-3"><label for="" class="mb-3">Product Name</label><input value="" type="text" class="form-control" name="product_name[]" id="product_name_' + rowNum + '" placeholder="Product Name"></div> <div class="form-group col-md-3 mb-3"><label for="branch"  class="mb-3">Branch</label><select name="branch[]" id="branch_' + rowNum + '" class="form-control"> <option value="">Select Branch</option>@if(count($branches)) @foreach($branches as $key => $branch) <option value="{{$branch->id}}" @if(isset($shelve->branch) && $shelve->branch == $branch->id) selected  @endif >{{$branch->name}} </option>  @endforeach @endif  </select> </div><div class="form-group col-md-2 mb-3"><label for="" class="mb-3"> Master Qty</label><input type="text" class="form-control " name="master_qty[]" id="master_qty_' + rowNum + '" placeholder="Master Qty" required></div><div class="form-group col-md-2 mb-3"><label for="" class="mb-3">Qty</label><input value="" type="number" class="form-control qty_input" name="qty[]" id="qty_input_' + rowNum + '" placeholder="Qty"  onkeyup="add_number_m(' + rowNum + ')"></div><div class="form-group col-md-2 mb-3"><label for="" class="mb-3">Price/item</label><input value="" type="number" class="form-control price_input" name="price[]" id="price_input_' + rowNum + '" placeholder="Price "  onkeyup="add_number_m(' + rowNum + ')"></div><div class="form-group col-md-2 mb-3"><label for="" class="mb-3">Total Price</label><input value="" type="number" class="form-control" name="total_price[]" id="total_price_' + rowNum + '" placeholder="Total Price" onclick="final_sum()"></div><input type="button" class="text-white bg-danger cancel_row" value="X" onclick="removeRow(' + rowNum + ');"></div>'
            jQuery('#itemRows').append(row);
            // frm.product_id.value = '';
            // frm.product_name.value = '';
            // frm.qty.value = '';
            // frm.price.value = '';
            // frm.total_price.value = '';
        }

        function removeRow(rnum) {
            jQuery('#rowNum' + rnum).remove();
        }
        var mytotal;

        function add_number() {
            var first_number = parseFloat(document.getElementById("qty_input").value);
            if (isNaN(first_number)) first_number = 0;
            var second_number = parseFloat(document.getElementById("price_input").value);
            if (isNaN(second_number)) second_number = 0;
            var result = first_number * second_number;
            document.getElementById("total_price").value = result;
            var mytotal_ = parseFloat("{{isset($data['total_price']) ? array_sum($data['total_price']) : 0}}");
            mytotal = mytotal_+result;
            document.getElementById("invoice_total").innerHTML = mytotal;
        }
        function add_number_m(rnum) {
            var first_number = parseFloat(document.getElementById("qty_input_" + rnum).value);
            if (isNaN(first_number)) first_number = 0;
            var second_number = parseFloat(document.getElementById("price_input_" + rnum).value);
            if (isNaN(second_number)) second_number = 0;
            var result = first_number * second_number;
            document.getElementById("total_price_" + rnum).value = result;
            var invoice_total =  mytotal+result;
            document.getElementById("invoice_total").innerHTML = invoice_total;
        }
       
    </script>
    <script>
        $(document).on("keyup", ".search-box", function() {
            var input_val = $(this).val();
            var input_id = $(this).attr('data-id');
            if (input_val.length >= 2)
                $.ajax({
                    type: "POST",
                    url: "{{route('admin.get_product_code')}}",
                    data: {
                        'keyword': input_val,
                        "_token": "{{csrf_token()}}"
                    },
                    beforeSend: function() {
                        $("#search-box_" + input_id).css("background", "#FFF url({{asset('images/LoaderIcon.gif')}}) no-repeat 165px");
                    },
                    success: function(data) {
                        $("#suggesstion-box_" + input_id).html('');
                        $("#empty_msg_" + input_id).html('');
                        var html = '<ul id="country-list">';
                        if (data == '') {
                            $("#empty_msg_" + input_id).html('Not Found! Click on Plus to add in list.');
                            // $('#new_food_btn_'+input_id).prop('disabled', false);
                        } else {
                            $.each(data, function(k, v) {
                                html += '<li class="product_val" data-input="' + input_id + '"data-id="' + v.id + '" data-val="' + v.product_code + '" data-name="' + v.name + '">' + v.product_code + '</li>'
                            });
                            html += '</ul>';
                            $("#suggesstion-box_" + input_id).show();
                            $("#suggesstion-box_" + input_id).html(html);
                            if (input_val == '') {
                                $("#suggesstion-box_" + input_id).hide();
                                $("#food_id_" + input_id).hide('');
                            }
                        }
                        $("#search-box_" + input_id).css("background", "#FFF");
                    }
                });
        });
    </script>
    <script>
        $(document).on('click', '.product_val', function() {
            $("#search_box_" + $(this).attr('data-input')).val($(this).attr('data-val'));
            $("#p_id_" + $(this).attr('data-input')).val($(this).attr('data-id'));
            $("#product_name_" + $(this).attr('data-input')).val($(this).attr('data-name'));
            $("#suggesstion-box_" + $(this).attr('data-input')).hide();
        })
        $(document).ready(function() {
            @if(count($errors) > 0)
            $('#add_new_product_modal').modal('show');
            @endif
        })
        $(document).on('click', '.new_product_btn', function() {
            $('.alert-danger').remove();
            $('.error_div').html('');
            $('#row_no').val($(this).attr('data-id'))
        })
        $(document).on('click', '#product_submit_btn', function() {
            var row_no = $('#row_no').val();
            $.ajax({
                method: "POST",
                url: "{{ route('admin.store_product') }}",
                data: $('#add_product_from').serialize(),
                success: function(data) {
                    $('#search_box_' + row_no).val(data.product_code)
                    $('#product_name_' + row_no).val(data.name)
                    $('#p_id_' + row_no).val(data.id)
                    var html = ' <div class="alert alert-success">\n\
                            <ul class="mb-0">\n\
                                <li>Product Added successfully</li>\n\
                            </ul>\n\
                        </div>';
                    $('.error_div').html(html);
                    $('.btn-close').trigger('click');
                },
                error: function(data) {
                    var html = ' <div class="alert alert-danger">\n\
                            <ul class="mb-0">\n\
                                <li>* Fields are required</li>\n\
                            </ul>\n\
                        </div>';
                    $('.error_div').html(html);
                }
            })
        })
    </script>
    @endsection