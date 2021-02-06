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
						<h4 class="card-title mg-b-0">SIMPLE TABLE</h4>
						<i class="mdi mdi-dots-horizontal text-gray"></i>
					</div>
					<p class="tx-12 tx-gray-500 mb-2">Example of Valex Simple Table. <a href="">Learn more</a></p>
				</div>
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

					
				{{--  END GET FLASH MESSAGES   --}}


				{{-- START SUBMIT FORM FOR ORDER TABLE  --}}
					<form action="{{ route('returns.store') }}" method="post" @if ($orderDetailes->count() < 1)
						hidden
					@endif>
						@csrf
						<div class="row">
							<div class="col-md-3">
								<div class="form-group">
									<label for="">الاجمالي</label>
									<input type="number" name="total_price" class="form-control" value="{{ $totalPrice }}">
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group">
									<label for="">اختار مندوب</label>
									<select name="servant_id" class="form-control">
										<option value="">اختار مندوب خط السير</option>
										@foreach ($servants as $servant)
											<option value="{{ $servant->id }}">
												{{ $servant->name }}
											</option>
										@endforeach
									</select>
									@error("servant_id")
										<span class="text-danger">{{$message}}</span>
									@enderror
								</div>
							</div>
							@if ($orders && $orders->count() > 0)
							<div class="col-md-3">
								<div class="form-group">
									<label for="">رقم الفاتورة</label>
									
										<input type="number" value="{{ $orders->id+1 }}">
								
								</div>
							</div>
							@endif
							
							<div class="col-md-3">
								<div class="form-group">
									
									<button class="btn btn-primary form-control">
										اضافة الاوردر
									</button>
								</div>
							</div>
						</div>
					</form>


				{{-- END SUBMIT FORM FOR ORDER TABLE  --}}


					<div class="table-responsive">
						@if ($orderDetailes && $orderDetailes->count() > 0)
							<table class="table text-md-nowrap" id="example1">
								<thead>
									<tr>
										<th class="wd-15p border-bottom-0"> رقم</th>
										<th class="wd-15p border-bottom-0">  رقم الشحنة</th>
										<th class="wd-15p border-bottom-0">اسم المورد</th>
										<th class="wd-15p border-bottom-0">اسم المستلم</th>
										<th class="wd-15p border-bottom-0">تليفون المستلم</th>
										<th class="wd-15p border-bottom-0">اسم المدينة التابعة لها</th>
										<th class="wd-15p border-bottom-0">عنوان المستلم</th>
										<th class="wd-15p border-bottom-0"> سعر الشحنة</th>
										<th class="wd-15p border-bottom-0"> قيمة الشحن</th>
										<th class="wd-15p border-bottom-0"> اجمالي الشحن</th>
										<th class="wd-15p border-bottom-0"> حالة الشحنة</th>
										<th class="wd-15p border-bottom-0">تاريخ التسليم</th>
									</tr>
								</thead>
								<tbody >
									@php
										$x = 1;
									@endphp
								
									@foreach ($orderDetailes as $index=>$item)
										<tr class="productRow">
											<td>{{ $x++ }}</td>
											<td>{{ $item->returns->id}}</td>
											<td>{{ $item->returns->supplier->name}}</td>
											<td>{{ $item->returns->resever_name}}</td>
											<td>{{ $item->returns->resver_phone}}</td>
											<td>{{ $item->returns->cities->name}}</td>
											<td>{{ $item->returns->adress}}</td>
											<td>{{ $item->returns->product_price}}</td>
											<td>						{{-- SHIPPING PRICE --}}
												<form action="" class="shipping_price">
													<input type="number" class="price{{ $item->id }}" name="price{{ $item->id }}" style="width: 100%" id="price{{ $item->id }}" value="{{ $item->shipping_price }}">
													<button row_id="{{ $item->id }}" class="change_price btn btn-success">تعديل</button>
												</form>
											</td>
											<td>						{{-- TOTAL PRICE --}}
												{{ $item->returns->product_price + $item->shipping_price }}
											</td>
											<td>						{{-- CHANGE STATUS --}}
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
											<td> {{ $item->created_at }}</td>
											<
										</tr>
									@endforeach
									

								</tbody>
							</table>
						@else  
							<h1 class="text-center">No Products</h1>
						@endif

					{{-- NEXT BUTTON  --}}
						<a href="{{ route('orders.index') }}" class="text-center " style="margin-right: 91%;">
							<button class="btn btn-primary">
								Next Page
							</button>
						</a>
					{{-- NEXT BUTTON  --}}
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



	
	
     {{--  GET CITIES  --}}
    <script>
        
         $(document).ready(function()
         {
             $('#gov').on('change',function()
             {
                 var gov = $(this).val();
 
                 if(gov)
                 {
                     $.ajax(
                         {
                             url:"{{ url('/admin/orderDetailes/cities/') }}/" + gov,
                             type:"GET",
                             dataType:"json",
                             success:function(data)
                             {
                                 $("#city").empty();
                                 $.each(data,function(key,value)
                                 {
                                     $("#city").append('<option value="'+value.id+'">'+value.name+'</option>')
                                 });
                             }
                         });
                 }else
                 {
                     alert('Error');
                 }
             });
         });
	</script>

	
     {{--  CHANGE STATUS  --}}
	 <script>
		$(document).on('click','.makeStatus',function(e)
		{
			e.preventDefault();

			//Get Form Data           
			var itemId = $(this).attr('id');
			
			//var item_id = document.getElementById("item_id"+itemId).value;
			var sel_val = document.getElementById("package_status"+itemId).value;
			
			console.log(sel_val);
			//console.log(item_id);
			
			$.ajax(
			{
				type: 'post',
			url: "{{route('returns.changeStatus')}}",
				data: 
				{
					'_token' : "{{ csrf_token() }}",
					'product_status' : sel_val,
					'id'     : itemId, 
				},
				
				success: function(data)
				{
					if(data.status == true)
					{
						
						if(data.status == true)
						{
							$('#successMsg').show();
                        }
                        
                        // DELETE ROW FROM TABLE
                        $('.supplierRow'+data.id).remove();
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
	

     {{--  CHANGE SHIPPING PRICE  --}}
	 <script>
		$(document).on('click','.change_price',function(e)
		{
			e.preventDefault();

			//Get Form Data           
			var itemId = $(this).attr('row_id');
			//alert(itemId);
			
			//var item_id = document.getElementById("item_id"+itemId).value;
			var sel_val = document.getElementById("price"+itemId).value;
			//alert(sel_val);
			
			$.ajax(
			{
				type: 'post',
			url: "{{route('returns.changeShippingPrice')}}",
				data: 
				{
					'_token' : "{{ csrf_token() }}",
					'price' : sel_val,
					'id'     : itemId, 
				},
				
				success: function(data)
				{
					if(data.status == true)
					{
						
						if(data.status == true)
						{
							$('#successMsg').show();
                        }
                        
                        // DELETE ROW FROM TABLE
                        $('.supplierRow'+data.id).remove();
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
