@extends('admin.layouts.master')
@section('css')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
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

    .cancel_row {
        position: absolute;
        right: 28px;
        width: 24px;
        padding: 2px 4px;
        border: 0;
        border-radius: 4px;
        margin-top: -15px;
    }

    .select2-container .select2-selection--single {
        height: 42px;
        border: 1px solid #e4e6ef !important;
        background: #fff;
    }

    .select2.select2-container.select2-container--classic {
        width: 100% !important;
    }

    .select2-container--classic .select2-selection--single .select2-selection__arrow {
        height: 42px;
    }

    .select2-selection__arrow {
        display: none !important;
    }

    .select2-container--classic .select2-selection--single .select2-selection__rendered {
        line-height: 22px;
    }
    .error {
        color: red;
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
                        <form action="" method="post" id="transfer_form">
                        <input type="hidden" value="{{ csrf_token() }}" name="_token">
                            <div class="col-md-12 p-9">
                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                <div class="content_data">
                                    <div class="d-flex justify-content-end">
                                        <input onclick="addRow();" type="button" class="btn btn-primary py-2 add_row_btn" value=" + Add row" />
                                    </div>
                                        <div id="itemRows_0">
                                            <div class="row mt-5">
                                                <div class="form-group col-md-4 mb-3">
                                                    <label for="">Product Name</label>
                                                    <select class="form-control product_dropdown" name="product_name[]" id="product_dropdown_0" data-id="0">
                                                        <option value="">Select Product</option>
                                                        @if(count($products))
                                                        @foreach($products as $key => $product)
                                                        <option value="{{$product->id}}">{{$product->name}}
                                                        </option>
                                                        @endforeach
                                                        @endif
                                                    </select>
                                                </div>
                                                <div class="form-group col-md-4 mb-3">
                                                    <label for="">From Branch</label>
                                                    <select name="from_branch[]" id="branch_dropdown_0" class="form-control from_branch" data-id="0">
                                                        <option value="">From Branch</option>
                                                    </select>
                                                </div>
                                                <div class="form-group col-md-4 mb-3">
                                                    <label for="">To Branch</label>
                                                    <select name="to_branch[]" id="to_branch_0" class="form-control to_branch" data-id="0">
                                                        <option value="">To Branch</option>
                                                        @if(count($branches))
                                                        @foreach($branches as $key => $branch)
                                                        <option value="{{$branch->id}}" @if(isset($shelve->branch) && $shelve->branch == $branch->id) selected
                                                            @endif >{{$branch->name}}
                                                        </option>
                                                        @endforeach
                                                        @endif
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row mt-3" id="to_branch_data">
                                                <div class="form-group col-md-4 mb-3">
                                                    <label for="">Shelves Name</label>
                                                    <select name="shelve[]" id="shelves_dropdown_0" class="form-control shelves_dropdown" data-id="0">
                                                        <option value="">Shelves Branch</option>
                                                    </select>
                                                </div>
                                                <div class="form-group col-md-4 mb-3">
                                                    <label for="">Quantity</label>
                                                    <input type="number" name="quantity[]" class="form-control quantity" id="quantity_0" placeholder="Qty" data-id="0">
                                                </div>
                                                {{--<div class="form-group col-md-4 mb-3 d-flex align-items-center">
                                                    <button type="button" id="transfer_btn_0" data-type="transfer" class="btn transfer_btn btn-primary py-2 mt-4 status_change" data-id="0">Transfer</button>
                                                </div> --}}                                                                             
                                            </div>
                                            <span id="success_msg_0" class="alert-success success_msg"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <div class="card-footer">
                        <button type="button" id="transfer_btn_0" data-type="transfer" class="btn transfer_btn btn-primary py-2 mt-4" data-id="0">Transfer All</button>
                           <a href="{{route('admin.transfer_product_history')}}" class="btn btn-secondary py-2 mt-4">Cancel</a>
                        </div>
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
<!-- close modal  -->
@endsection
@section('script')
<script src="{{ asset('backend/assets/js/pages/crud/ktdatatable/base/html-table.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(".product_dropdown").select2({
        theme: "classic",
    });
    $(document).on('change', '.product_dropdown', function() {
        get_branch($(this).attr('data-id'))
    })

    function get_branch(input_id) {
        $.ajax({
            method: "GET",
            url: "{{route('admin.get_branches')}}",
            data: {
                product_id: $('#product_dropdown_' + input_id).val(),
            },
            success: function(data) {
                var branch_html = '<option value="">Select Branch</option>';
                $.each(data, function(k, v) {
                    if ($('#branch_dropdown').val() && $('#branch_dropdown').val() == v.id) {
                        branch_html += "<option selected value='" + v.id + "'>" + v.name + "</option>"
                    } else {
                        branch_html += "<option value='" + v.id + "'>" + v.name + "</option>"
                    }
                })
                $('#branch_dropdown_' + input_id).html(branch_html)
            }
        });
    }
</script>
<script>
     $(document).on('change', '.from_branch', function() {
        get_qty($(this).attr('data-id'))
    })

    function get_qty(input_id) {
        $.ajax({
            method: "GET",
            url: "{{route('admin.get_quantity')}}",
            data: {
                branch_id: $('#branch_dropdown_' + input_id).val(),
                product_id: $('#product_dropdown_' + input_id).val(),
            },
            success: function(data) {
                $('#quantity_' + input_id).val(data)
                $('#quantity_' + input_id).attr('max',data)
            }
        });
    }
</script>
<script>
    $(document).on('change', '.to_branch', function() {
        get_shelves($(this).attr('data-id'))
    })

    function get_shelves(input_id) {
        $.ajax({
            method: "GET",
            url: "{{route('admin.get_shelves')}}",
            data: {
                branch_id: $('#to_branch_' + input_id).val(),
            },
            success: function(data) {
                var shelves_html = '<option value=""> Select Shelve</option>';
                $.each(data, function(k, v) {
                    if ($('#shelves_dropdown').val() && $('#shelves_dropdown').val() == v.id) {
                        shelves_html += "<option selected value='" + v.id + "'>" + v.name + "</option>"
                    } else {
                        shelves_html += "<option value='" + v.id + "'>" + v.name + "</option>"
                    }
                })
                $('#shelves_dropdown_' + input_id).html(shelves_html)
            }
        });
    }
   
    var count = 0;

    function addRow() {
        count++;
        var html = ' <div id="itemRows_' + count + '">\n\
        <hr style="border-top: 1px solid #202224;opacity: 1;">\n\
        <div class="row mt-5">\n\
            <div class="form-group col-md-4 mb-3">\n\
            <label for="">Product Name</label>\n\
                <select class="form-control product_dropdown" name="product_name[]" id="product_dropdown_' + count + '" data-id="' + count + '">\n\
                    <option value="">Select Product</option>';
        @if(count($products))
        @foreach($products as $key => $product)
        html += '<option value="{{$product->id}}">{{$product->name}}</option>';
        @endforeach
        @endif
        html += ' </select>\n\
            </div>\n\
            <div class="form-group col-md-4 mb-3">\n\
            <label for="">From Branch</label>\n\
                <select name="from_branch[]" id="branch_dropdown_' + count + '" class="form-control from_branch" data-id="' + count + '">\n\
                    <option value="">From Branch</option>\n\
                </select>\n\
            </div>\n\
            <div class="form-group col-md-4 mb-3">\n\
            <label for="">To Branch</label>\n\
                <select name="to_branch[]" id="to_branch_' + count + '" class="form-control to_branch" data-id="' + count + '">\n\
                    <option value="">To Branch</option>';
        @if(count($branches))
        @foreach($branches as $key => $branch)
        html += '<option value="{{$branch->id}}">{{$branch->name}}</option>';
        @endforeach
        @endif
        html += '</select>\n\
            </div>\n\
        </div>\n\
        <div class="row mt-3" id="to_branch_data">\n\
        <div class="form-group col-md-4 mb-3">\n\
            <label for="">Shelves Name</label>\n\
                <select name="shelve[]" id="shelves_dropdown_' + count + '" class="form-control shelves_dropdown" data-id="' + count + '">\n\
                    <option value="">Shelves Branch</option>\n\
                </select>\n\
            </div>\n\
            <div class="form-group col-md-4 mb-3">\n\
            <label for="">Qunatity</label>\n\
                <input type="number" name="quantity[]" class="form-control quantity" id="quantity_' + count + '" placeholder="Qty" data-id="' + count + '">\n\
            </div>\n\
            <input type="button" class="text-white bg-danger cancel_row " value="X" onclick="removeRow(' + count + ')">\n\
        </div>\n\
        <span id="success_msg_' + count + '" class="alert-success success_msg"></span>\n\
    </div>';
        $('.content_data').append(html)
        $(".product_dropdown").select2({
            theme: "classic",
        });
    }

    function removeRow(row_count) {
        $('#itemRows_' + row_count).remove()
    }
</script>
<script>
    $(document).on('click', ".transfer_btn", function(e) {
        e.preventDefault();
        var $this = $(this);
        Swal.fire({
            title: 'Are you sure want to transfer this products?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, transfer it!',
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    method:"POST",
                    url: "{{route('admin.store_transfer_products')}}",
                    data:$('#transfer_form').serialize(),
                    success: function(data) {
                        $('.success_msg').html('Data transfer successfully')
                        $('.product_dropdown').prop('disabled',true)
                        $('.from_branch').prop('disabled',true)
                        $('.to_branch').prop('disabled',true)
                        $('.quantity').prop('disabled',true)
                        $('.shelves_dropdown').prop('disabled',true)
                        // $('#transfer_btn_'+input_id).prop('disabled',true)
                    }
                })
            }
        })
    });
</script>
<script>
// $(document).on('click','.transfer_btn',function(){
//     var input_id = $(this).attr('data-id')
//     $.ajax({
//         method:"POST",
//         url: "{{route('admin.store_transfer_products')}}",
//         "_token":"{{csrf_token()}}",
//         data:$('#itemRows_'+input_id).serialize(),
//         success: function(data) {
//             $('#success_msg_'+input_id).html('Data transfer successfully')
//             $('.add_row_btn').prop('disabled',false)
//             $('#product_dropdown_'+input_id).prop('disabled',true)
//             $('#branch_dropdown_'+input_id).prop('disabled',true)
//             $('#to_branch_'+input_id).prop('disabled',true)
//             $('#shelves_dropdown_'+input_id).prop('disabled',true)
//             $('#quantity_'+input_id).prop('disabled',true)
//             $('#transfer_btn_'+input_id).prop('disabled',true)
//         }
//     })
// })
</script>
@endsection