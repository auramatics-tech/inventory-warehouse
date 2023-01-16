@extends('admin.layouts.master')
@section('css')
<link href="//cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<style>
    .cancel_row{
        position: absolute;
        right:28px;
        width: 24px;
        padding: 2px 4px;
    border: 0;
    border-radius: 4px;
    margin-top:-23px;
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
                    <!--begin::Form-->
                    <form method="post" action="{{ route('admin.store_invoice') }}" id="user_form">

                        <input type="hidden" value="{{ csrf_token() }}" name="_token">

                        <input type="hidden" value="{{ isset($invoice->id) ? $invoice->id : '' }}" name="id">

                        <div class="col-md-12 p-9">
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                <div class="row">
                                    <div class="form-group col-md-4 mb-3">
                                        <label for="" class="mb-3">Supplier Name</label>
                                          <input value="{{ isset($invoice->supplier_name) ? $invoice->supplier_name: '' }}" type="text" class="form-control" name="supplier_name" id="supplier_name" placeholder="Supplier Name">
                                    </div>
                                    <div class="form-group col-md-4 mb-3">
                                        <label for="" class="mb-3">Supplier Invoice Number</label>
                                        <input value="{{ isset($invoice->supplier_invoice_number) ? $invoice->supplier_invoice_number: '' }}" type="text" class="form-control" name="supplier_invoice_number" id="name" placeholder="Supplier invoice number" required>
                                    </div>
                                    <div class="form-group col-md-4 ">
                                        <label for="" class="mb-3">Invoice Date</label>
                                        <input value="{{ isset($invoice->invoice_date) ? $invoice->invoice_date: '' }}" type="date" class="form-control" name="invoice_date" id="invoice_date" placeholder="Date" required>
                                    </div>
                                </div>
                                <hr style="border-top: 1px solid #eff2f5;opacity: 1;">
                                <div id="itemRows">
                                <div class="d-flex justify-content-end" >
                                <input onclick="addRow(this.form);" type="button" class="btn btn-primary py-2" value=" + Add row" />
                                </div>
                                <div class="row mt-5">
                                    <div class="form-group col-md-3 mb-3">
                                        <label for="" class="mb-3">Product Number</label>
                                        <select name="product_id[]" id="product_code" class="form-control">
                                                <option>Select Product Number</option>
                                                @if(count($products))
                                                @foreach($products as $key => $product)
                                                <option value="{{$product->id}}"  @if(isset($invoice->product_id)) selected @endif>{{$product->product_code}}</option>
                                                @endforeach
                                                @endif
                                        </select>
                                    </div>
                                    <div class="form-group col-md-3 mb-3">
                                        <label for="" class="mb-3">Product Name</label>
                                        <input value="{{ isset($invoice->product_name) ? $invoice->product_name: '' }}" type="text" class="form-control" name="product_name" id="product_name" placeholder="Product Name">
                                    </div>
                                    <div class="form-group col-md-2 mb-3">
                                        <label for="" class="mb-3">Qty</label>
                                        <input value="{{ isset($invoice->qty) ? $invoice->qty: '' }}" type="number" class="form-control " name="qty[]" id="qty_input" placeholder="Qty" onkeyup="add_number()" required>
                                    </div>
                                    <div class="form-group col-md-2 mb-3">
                                        <label for="" class="mb-3">Price/item</label>
                                        <input value="{{ isset($invoice->price) ? $invoice->price: '' }}" type="number" class="form-control price_input" name="price[]" id="price_input" placeholder="Price " onkeyup="add_number()" required>
                                    </div>
                                    <div class="form-group col-md-2 mb-3">
                                        <label for="" class="mb-3">Total Price</label>
                                        <input value="{{ isset($invoice->total_price) ? $invoice->total_price: '' }}" type="number" class="form-control total_input" name="total_price[]" id="total_price" placeholder="Total Price" required>
                                    </div>
                                </div>
                                <hr style="border-top: 1px solid #eff2f5;opacity: 1;">
                            </div>
                              
                                <div class="row mt-5">
                                    <div class="form-group col-md-2 mb-3 ms-auto">
                                        <label for="" class="mb-3">Invoice Total</label>
                                        <br>
                                        <span><b id="invoice_total"></b></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" id="user_submit" class="btn btn-primary me-3">Submit</button>
                            <a href="{{ route('admin.new_invoice') }}" class="btn btn-secondary">Cancel</a>
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
<script>
    var rowNum = 0;
        function addRow(frm) {
        rowNum ++;
        var row ='<div id="rowNum'+rowNum+'" class="row mt-10"><div class="form-group col-md-3 mb-3"><label for="" class="mb-3">Product Number</label><select name="product_id[]" id="product_code" class="form-control"><option>Select Product Number</option>@if(count($products))@foreach($products as $key => $product)<option value="{{$product->id}}" @if(isset($invoice->product_id)) selected @endif>{{$product->product_code}}</option>@endforeach @endif</select></div><div class="form-group col-md-3 mb-3"><label for="" class="mb-3">Product Name</label><input value="{{ isset($invoice->product_name) ? $invoice->product_name: '' }}" type="text" class="form-control" name="product_name[]" id="product_name" placeholder="Product Name"></div><div class="form-group col-md-2 mb-3"><label for="" class="mb-3">Qty</label><input value="{{ isset($invoice->qty) ? $invoice->qty: '' }}" type="number" class="form-control qty_input" name="qty[]" id="qty_input_'+rowNum+'" placeholder="Qty"  onkeyup="add_number_m('+rowNum+')"></div><div class="form-group col-md-2 mb-3"><label for="" class="mb-3">Price/item</label><input value="{{ isset($invoice->price) ? $invoice->price: '' }}" type="number" class="form-control price_input" name="price[]" id="price_input_'+rowNum+'" placeholder="Price "  onkeyup="add_number_m('+rowNum+')"></div><div class="form-group col-md-2 mb-3"><label for="" class="mb-3">Total Price</label><input value="{{ isset($invoice->total_price) ? $invoice->total_price: '' }}" type="number" class="form-control" name="total_price[]" id="total_price_'+rowNum+'" placeholder="Total Price" onclick="final_sum()"></div><input type="button" class="text-white bg-danger cancel_row" value="X" onclick="removeRow('+rowNum+');"><hr class="mt-3" style="border-top: 1px solid #eff2f5;opacity: 1;"></div>'
        jQuery('#itemRows').append(row);
        frm.product_id.value = '';
        frm.product_name.value = '';
        frm.qty.value = '';
        frm.price.value = '';
        frm.total_price.value = '';
        }
        function removeRow(rnum) {
        jQuery('#rowNum'+rnum).remove();
        }
        var mytotal;
    function add_number() {
      var first_number = parseFloat(document.getElementById("qty_input").value);
      if (isNaN(first_number)) first_number = 0;
      var second_number = parseFloat(document.getElementById("price_input").value);
      if (isNaN(second_number)) second_number = 0;
      var result = first_number * second_number;
      document.getElementById("total_price").value = result;
      mytotal = result;
      document.getElementById("invoice_total").innerHTML = mytotal;
    }
    function add_number_m(rnum) {
      var first_number = parseFloat(document.getElementById("qty_input_"+rnum).value);
      if (isNaN(first_number)) first_number = 0;
      var second_number = parseFloat(document.getElementById("price_input_"+rnum).value);
      if (isNaN(second_number)) second_number = 0;
      var result = first_number * second_number;
      document.getElementById("total_price_"+ rnum).value = result;
      var invoice_total = mytotal + result;
      document.getElementById("invoice_total").innerHTML = invoice_total;
    }
</script>
@endsection