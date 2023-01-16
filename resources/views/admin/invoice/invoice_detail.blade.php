@extends('admin.layouts.master')

@section('content')
<div class="post d-flex flex-column-fluid" id="kt_post">
    <!--begin::Container-->
    <div id="kt_content_container" class="container-xxl">
        <div class="card">
									<!--begin::Body-->
									<div class="card-body p-lg-20">
										<!--begin::Layout-->
										<div class="d-flex flex-column flex-xl-row">
											<!--begin::Content-->
											<div class="flex-lg-row-fluid me-xl-18 mb-10 mb-xl-0">
												<!--begin::Invoice 2 content-->
												<div class="mt-n1">
													<!--begin::Wrapper-->
													<div class="m-0">
														<!--begin::Label-->
														<div class="fw-bolder fs-3 text-gray-800 mb-8">Invoice #{{isset($invoice->supplier_invoice_number) ? $invoice->supplier_invoice_number :'' }}</div>
														<!--end::Label-->
														<!--begin::Row-->
														<div class="row g-5 mb-11">
															<!--end::Col-->
															<div class="col-sm-6">
																<!--end::Label-->
																<div class="fw-bold fs-7 text-gray-600 mb-1">Supplier Name :</div>
																<!--end::Label-->
																<!--end::Col-->
																<div class="fw-bolder fs-6 text-gray-800">{{isset($invoice->supplier_name) ? $invoice->supplier_name :'' }}</div>
																<!--end::Col-->
															</div>
															<!--end::Col-->
															<!--end::Col-->
															<div class="col-sm-6">
																<!--end::Label-->
																<div class="fw-bold fs-7 text-gray-600 mb-1">Invoice Date :</div>
																<!--end::Label-->
																<!--end::Info-->
																<div class="fw-bolder fs-6 text-gray-800 d-flex align-items-center flex-wrap">
																	<span class="pe-2">{{ date('d F Y', strtotime($invoice->invoice_date))}}</span>
																</div>
																<!--end::Info-->
															</div>
															<!--end::Col-->
														</div>
														<!--end::Row-->
														<!--begin::Content-->
														<div class="flex-grow-1">
															<!--begin::Table-->
															<div class="table-responsive border-bottom mb-9">
																<table class="table mb-3" id="table">
																	<thead>
																		<tr class="border-bottom fs-6 fw-bolder text-muted">
																			<th class="min-w-175px pb-2">Product Number</th>
																			<th class="min-w-70px text-end pb-2">Product Name</th>
																			<th class="min-w-70px text-end pb-2">Qty</th>
																			<th class="min-w-80px text-end pb-2">Price</th>
																			<th class="min-w-100px text-end pb-2">Total Price</th>
																		</tr>
																	</thead>
																	<tbody>
                                                                      @foreach( $invoice['product_id']  as $product_key => $data)
																		<tr class="fw-bolder text-gray-700 fs-5 text-end">
                                                                        	@foreach($invoice->get_product_detail as $product)
																			<td class="d-flex align-items-center pt-6">{{$product->product_code}}</td>
                                                                            <td class="pt-6">{{$product->name}}</td>
																			<td class="pt-6">{{$invoice['qty'][$product_key]}}</td>
																			<td class="pt-6">{{$invoice['price'][$product_key]}}</td>
																			<td class="pt-6 text-dark fw-boldest">{{$invoice['total_price'][$product_key]}}</td>
                                                                            @endforeach
																		</tr>
                                                                     @endforeach
																	</tbody>
																</table>
															</div>
															<!--end::Table-->
															<!--begin::Container-->
															<div class="d-flex justify-content-end">
																<!--begin::Section-->
																<div class="mw-300px">
																	<!--begin::Item-->
																	<div class="d-flex flex-stack">
																		<!--begin::Code-->
																		<div class="fw-bold pe-10 text-gray-600 fs-7">Total</div>
																		<!--end::Code-->
																		<!--begin::Label-->
																		<div class="text-end fw-bolder fs-6 text-gray-800" id="val"></div>
																		<!--end::Label-->
																	</div>
																	<!--end::Item-->
																</div>
																<!--end::Section-->
															</div>
															<!--end::Container-->
														</div>
														<!--end::Content-->
													</div>
													<!--end::Wrapper-->
												</div>
												<!--end::Invoice 2 content-->
											</div>
											<!--end::Content-->
										</div>
										<!--end::Layout-->
									</div>
									<!--end::Body-->
								</div>
    </div>
    <!--end::Container-->
</div>

@endsection
@section('script')
<script>
            
            var table = document.getElementById("table"), sumVal = 0;
            
            for(var i = 1; i < table.rows.length; i++)
            {
                sumVal = sumVal + parseInt(table.rows[i].cells[4].innerHTML);
            }
            
            document.getElementById("val").innerHTML = sumVal;
            console.log(sumVal);
            
        </script>
        @endsection