@extends('admin.layouts.master')
@section('css')
<!-- Internal Data table css -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
<link href="{{URL::asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" />
<link href="{{URL::asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/datatable/css/responsive.bootstrap4.min.css')}}" rel="stylesheet" />
<link href="{{URL::asset('assets/plugins/datatable/css/jquery.dataTables.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/datatable/css/responsive.dataTables.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">


@endsection

@section('content')
<br><br>


    

    {{--  TABLE TO SHOW ALL PRODUCTS RECIVED  --}}
	<div class="row row-sm">
		<div class="col-xl-12">
			<div class="card">
				<div class="card-header pb-0">
					<div class="d-flex justify-content-between">
						<h4 class="card-title mg-b-0">بيانات الأوردر</h4>
						<i class="mdi mdi-dots-horizontal text-gray"></i>
					</div>
<!-- 					<p class="tx-12 tx-gray-500 mb-2">Example of Valex Simple Table. <a href="">Learn more</a></p>
 -->				</div>
				<div class="card-body">

				{{--  START GET FLASH MESSAGES   --}}
					@include('admin.alerts.success')
					@include('admin.alerts.errors')

					<div class="row mr-2 ml-2" id="successMsg" style="display: none">
						<button type="text" class="btn btn-lg btn-block btn-outline-success mb-2">
							تم حزف الشحنة من المخزن بنجاح
						</button>
					</div>
					<div class="row mr-2 ml-2" id="successStatus" style="display: none">
						<button type="text" class="btn btn-lg btn-block btn-outline-success mb-2">
							تم تعديل الحالة بنجاح
						</button>
					</div>
					<div class="row mr-2 ml-2" id="errorStatus" style="display: none">
						<button type="text" class="btn btn-lg btn-block btn-outline-success mb-2">
							لا يمكن تعديل حالة الشحنة لان الاوردر تم توصيله 
						</button>
					</div>

					
				{{--  END GET FLASH MESSAGES   --}}


                    <div class="row">
                        <div class="col-md-2">
                           <div class="form-group">
                               <label for="">رقم الفاتورة</label>
                            <input type="text" name="" class="form-control text-center" value="{{ $order->id }}" disabled>
                           </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="">الاجمالي</label>
                             <input type="text" name="" class="form-control text-center" value="{{ $order->total_prices }} جنيه" disabled>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="">المدينة</label>
                             <input type="text" value="{{ $order->ordersDetailes->pluck('product')->pluck('cities')->pluck('name')->first() }}" name="" class="form-control text-center" disabled>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="">اسم المندوب</label>
                             <input type="text" name="" value="{{ $order->servant->name }}" class="form-control text-center" disabled>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for=""> تاريخ التسليم</label>
                             <input type="text" name="" value="{{ $order->created_at }}" class="form-control text-center" disabled>
                            </div>
                        </div>
                    </div>
                        
                    </div>


					<div class="table-responsive">
						@if ($order->ordersDetailes && $order->ordersDetailes->count() > 0)
							<table class="table text-md-nowrap" id="example1">
								<thead>
									<tr>
										<th class="wd-15p border-bottom-0"> رقم </th>
										<th class="wd-15p border-bottom-0"> رقم الشحنة</th>
										<th class="wd-15p border-bottom-0"> اسم المستلم</th>
										<th class="wd-15p border-bottom-0"> سعر الشحن</th>
										<th class="wd-15p border-bottom-0">سعر الشحنة</th>
										<th class="wd-15p border-bottom-0"> اجمالي الشحن</th>
										<th class="wd-15p border-bottom-0"> حالة الشحنة</th>
										<th class="wd-15p border-bottom-0">تاريخ التسليم</th>
										<th class="wd-15p border-bottom-0"> الاجرائات</th>
									</tr>
								</thead>
								<tbody >
									@php
										$x = 1;
									@endphp
								
									@foreach ($order->ordersDetailes as $item)
										<tr class="productRow">
											<td>{{ $x++ }}</td>
											<td>{{ $item->id }}</td>
											<td>{{ $item->product->resever_name }}</td>
											<td>{{ $item->shipping_price}}</td>
											<td>{{ $item->product->product_price}}</td>
											<td>{{  $item->shipping_price + $item->product->product_price}}</td>
										
											<td>
												<form action="" class="status">										
													<select name="status_id{{ $item->id }}" id="package_status{{ $item->id }}" class="st_id{{ $item->id }} form-control">
														<option value="">اختار الحالة</option>
														@foreach ($allStatus as $status)
															<option value="{{ $status->id }}"@if ($status->id == $item->product_status)
																selected
															@endif>
																{{ $status->name }}
															</option>
														@endforeach
													</select>

													<button class="btn btn-primary makeStatus" id="{{ $item->id }}">تعديل</button>
												</form>
											</td>


											<td>{{ $item->created_at}}</td>
											<td>
												<div class="btn-icon-list">
													<a href="{{ route('orders.edit',$order->id) }}">
														<button class="btn btn-indigo btn-icon"><i class="typcn typcn-folder"></i></button>
													</a>
													
												</div>
											</td>
										
										
										</tr>
									@endforeach
									

								</tbody>
							</table>
						
						@elseif ($order2->returnsDetailes && $order2->returnsDetailes->count() > 0)
						
							<table class="table text-md-nowrap" id="example1">
								<thead>
									<tr>
										<th class="wd-15p border-bottom-0"> رقم </th>
										<th class="wd-15p border-bottom-0"> رقم الشحنة</th>
										<th class="wd-15p border-bottom-0"> اسم المستلم</th>
										<th class="wd-15p border-bottom-0"> سعر الشحن</th>
										<th class="wd-15p border-bottom-0">سعر الشحنة</th>
										<th class="wd-15p border-bottom-0"> اجمالي الشحن</th>
										<th class="wd-15p border-bottom-0"> حالة الشحنة</th>
										<th class="wd-15p border-bottom-0">تاريخ التسليم</th>
										<th class="wd-15p border-bottom-0"> الاجرائات</th>
									</tr>
								</thead>
								<tbody >
									@php
										$x = 1;
									@endphp
								
									@foreach ($order2->returnsDetailes as $item)
										<tr class="productRow">
											<td>{{ $x++ }}</td>
											<td>{{ $item->id }}</td>
											<td>{{ $item->returns->resever_name }}</td>
											<td>{{ $item->shipping_price}}</td> 
											<td>{{ $item->returns->product_price}}</td>
											
											<td>{{  $item->shipping_price + $item->returns->product_price}}</td>
										
											<td>
												<form action="" class="status">										
													<select name="status_id{{ $item->id }}" id="packageStatusReturns{{ $item->id }}" class="st_id{{ $item->id }} form-control">
														<option value="">اختار الحالة</option>
														@foreach ($statusReturns as $status)
															<option value="{{ $status->id }}"@if ($status->id == $item->product_status)
																selected
															@endif>
																{{ $status->name }}
															</option>
														@endforeach
													</select>

													<button class="btn btn-primary makeStatusReturns" id="{{ $item->id }}">تعديل</button>
												</form>
											</td>


											<td>{{ $item->created_at}}</td>
											<td>
												<div class="btn-icon-list">
													<a href="{{ route('orders.edit',$order->id) }}">
														<button class="btn btn-indigo btn-icon"><i class="typcn typcn-folder"></i></button>
													</a>
													
												</div>
											</td>
										
										
										</tr>
									@endforeach
									

								</tbody>
							</table>
						@else  
							<h1 class="text-center">No Products</h1>
                        @endif
					</div> 
				</div>
			</div>
		</div>
		<!--/div-->
	</div>
@endsection

@section('js')
	<!-- Internal Data tables -->
		<script src="{{URL::asset('assets/plugins/datatable/js/jquery.dataTables.min.js')}}"></script>
		<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.dataTables.min.js')}}"></script>
		<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js')}}"></script>
		<script src="{{URL::asset('assets/plugins/datatable/js/responsive.dataTables.min.js')}}"></script>
		<script src="{{URL::asset('assets/plugins/datatable/js/jquery.dataTables.js')}}"></script>
		<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.bootstrap4.js')}}"></script>
		<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.buttons.min.js')}}"></script>
		<script src="{{URL::asset('assets/plugins/datatable/js/buttons.bootstrap4.min.js')}}"></script>
		<script src="{{URL::asset('assets/plugins/datatable/js/jszip.min.js')}}"></script>
		<script src="{{URL::asset('assets/plugins/datatable/js/pdfmake.min.js')}}"></script>
		<script src="{{URL::asset('assets/plugins/datatable/js/vfs_fonts.js')}}"></script>
		<script src="{{URL::asset('assets/plugins/datatable/js/buttons.html5.min.js')}}"></script>
		<script src="{{URL::asset('assets/plugins/datatable/js/buttons.print.min.js')}}"></script>
		<script src="{{URL::asset('assets/plugins/datatable/js/buttons.colVis.min.js')}}"></script>
		<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js')}}"></script>
		<script src="{{URL::asset('assets/plugins/datatable/js/responsive.bootstrap4.min.js')}}"></script>

	<!--Internal  Datatable js -->
	<script src="{{URL::asset('assets/js/table-data.js')}}"></script>
	<!--Internal  Datepicker js -->
	<script src="{{URL::asset('assets/plugins/jquery-ui/ui/widgets/datepicker.js')}}"></script>
	<!-- Internal Select2 js-->
	<script src="{{URL::asset('assets/plugins/select2/js/select2.min.js')}}"></script>
	<!-- Internal Modal js-->
	<script src="{{URL::asset('assets/js/modal.js')}}"></script>


     {{--  CHANGE STATUS  ORDERS--}}
	 <script>
		$(document).on('click','.makeStatus',function(e)
		{
			e.preventDefault();

			//Get Form Data           
            var itemId = $(this).attr('id');
            //alert(itemId);
			
			//var item_id = document.getElementById("item_id"+itemId).value;
			var sel_val = document.getElementById("package_status"+itemId).value;
			//alert(sel_val);
			//console.log(sel_val);
			//console.log(item_id);
			
			$.ajax(
			{
				type: 'post',
			    url: "{{route('orders.changeStatus')}}",
				data: 
				{
					'_token' : "{{ csrf_token() }}",
					'item_status' : sel_val,
					'id'     : itemId, 
				},
				
				success: function(data)
				{
					
                    if(data.status == true)
                    {
                        $('#successStatus').show();
                       

                        // DELETE ROW FROM TABLE
                    //$('.supplierRow'+data.id).remove();
                        
                    }else
                    {
                        $('#errorStatus').show();
                    }
                    
                    
				},
				error: function(reject)
				{
					var response = $.parseJSON(reject.responseText);
					$.each(response.errors,function(key,val)
					{
					    $("#" + key + "_error").text(val[0]);
					});
				}    

			});
		});
	</script> 

     {{--  CHANGE STATUS  RETURNS--}}
	 <script>
		$(document).on('click','.makeStatusReturns',function(e)
		{
			e.preventDefault();

			
			//Get Form Data           
            var itemIdReturns = $(this).attr('id');
            //alert(itemIdReturns);
			
			//var item_id = document.getElementById("item_id"+itemId).value;
			var sel_val_returns = document.getElementById("packageStatusReturns"+itemIdReturns).value;
			//alert(sel_val_returns);
			//console.log(sel_val);
			//console.log(item_id);
			
			$.ajax(
			{
				type: 'post',
			    url: "{{route('returns.changeStatusItems')}}",
				data: 
				{
					'_token' : "{{ csrf_token() }}",
					'item_status' : sel_val_returns,
					'id'     : itemIdReturns, 
				},
				
				success: function(data)
				{
					
                    if(data.status == true)
                    {
                        //$('#successStatus').show();
						//window.location.reload();
						$('#success-div').show();
						$('#successStatus').html(data.msg;


                        // DELETE ROW FROM TABLE
                    //$('.supplierRow'+data.id).remove();
                        
                    }else
                    {
                        $('#errorStatus').show();
                    }
                    
                    
				},
				error: function(reject)
				{
					var response = $.parseJSON(reject.responseText);
					$.each(response.errors,function(key,val)
					{
					    $("#" + key + "_error").text(val[0]);
					});
				}    

			});
		});
	</script>  
@endsection

