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

{{--  FORM TO SEARCH FOR PRODUCTS AND SELECT SERVANT TO CREATE ORDER   --}}
	<form id="createٍOrder">
        @csrf



            {{--  START DATE   --}}



			{{-- CITY ID  --}}


			{{--SERVANT NAME  --}}

			{{--SUPPLIER NAME  --}}

	

    

    {{--  TABLE TO SHOW ALL PRODUCTS RECIVED  --}}
	<div class="row row-sm">
		<div class="col-xl-12">
			<div class="card">
				<div class="card-header pb-0">
					<div class="d-flex justify-content-between">
						<h4 class="card-title mg-b-0">اجمالي سعر الشحن :  {{$sum}} </h4>
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
				{{--  END GET FLASH MESSAGES   --}}

					{{--  @include('admin.products.create')  --}}

					<div class="table-responsive">
						{{--  @if ($products && $products->count() > 0)  --}}
							<table class="table text-md-nowrap" id="example1">
								<thead>
									<tr>
										
										<th class="wd-15p border-bottom-0"> رقم الشحنة</th>
										<th class="wd-15p border-bottom-0"> اسم المستلم</th>
										<th class="wd-15p border-bottom-0"> سعر الشحن</th>
										<th class="wd-15p border-bottom-0">سعر الشحنة</th>
										<th class="wd-15p border-bottom-0"> اجمالي الشحن</th>
									<!-- 	<th class="wd-15p border-bottom-0"> حالة الشحنة</th> -->
										<th class="wd-15p border-bottom-0">تاريخ التسليم</th>
										<!-- <th class="wd-15p border-bottom-0"> الاجرائات</th> -->
									</tr>
								</thead>
								<tbody id="productRow">
								
									
													@foreach ($datas as $item)
										<tr class="productRow">
											
											<td>{{ $item->id }}</td>
											<td>{{ $item->Product->resever_name }}</td>
											<td>{{ $item->shipping_price }}</td>
											<td>{{ $item->Product->product_price }}</td>
											<td>{{ $item->total_price }}</td>
										<!-- 	<td>{{ $item->Product->Status->name }}</td> -->
											<td>{{ $item->created_at }}</td>

											{{--  <td>
												<div class="btn-icon-list">
													<a href="{{ route('products.edit',$product->id) }}">
														<button class="btn btn-indigo btn-icon"><i class="typcn typcn-folder"></i></button>
													</a>
													<a href="" class="makeDeleteProduct" order_id="{{ $product->id }}">
														<button class="btn btn-primary btn-icon"><i class="typcn typcn-calendar-outline"></i></button>
													</a>
													<a href="{{ route('products.show',$product->id) }}">
														<button class="btn btn-success btn-icon"><i class="typcn typcn-document-add"></i></button>
													</a>
												</div>  --}}
											{{--  </td>  --}}
										</tr>
										@endforeach

								</tbody>
							</table><br>
						{{-- NEXT BUTTON  --}}
							<a href="{{ route('orderDetailes.submit_new_order') }}" class="text-center " style="margin-right: 91%;">
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



	{{--  SEARCH FOR PRODUCTS   --}}

	<script>
		$(document).on('click','#makeCreateOrder',function(e)
		{
			e.preventDefault();

			// DELETE ERROR MESSAGE IF INPUT HAVE VALUE WITHOUT REFRESH PAGE
			
		
			$('#governorate_id_error').text('');
			$('#city_id_error').text('');
			//$('#servant_id_error').text('');
			//$('#shipping_price_error').text('');

			//Get Form Data
            var formData = new FormData($('#createٍOrder')[0]);   

			$.ajax(
			{
				type: 'post',
				url: "{{route('orderDetailes.search')}}",
				data: formData,
				processData: false,
				contentType: false,
				cache: false,
				success: function(data)
				{
                    $("#productRow").empty();
                    $.each(data,function(key,value)
                    {
                        $('#productRow').append("<tr class="+'productRow'+value.id+">"+
                            "<td>"+value.id+"</td>"+
                            "<td>"+value.supplier.name+"</td>"+
                            "<td>"+value.resever_name+"</td>"+
                            "<td>"+value.resver_phone+"</td>"+
                            "<td>"+value.cities.name+"</td>"+
                            "<td>"+value.adress+"</td>"+
                            "<td>"+value.product_price+"</td>"+
                            "<td>"+value.status.name+"</td>"+
                            "<td>"+
                                "<button class='btn btn-success createProductToOrder' id='add' product_id="+value.id+">Add</button>"
                            +"</td>"+
                            
                           
                        +"</tr>")
                    });
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

	{{--  CREATE PRODUCT TO ORDER   --}}
	<script>
		$(document).on('click','.createProductToOrder',function(e)
		{
			e.preventDefault();

			
			//Get Form Data           
           var product_id = $(this).attr('product_id');

			$.ajax(
			{
				type: 'post',
				url: "{{route('orderDetailes.addToCart')}}",
				data: 
				{
					'_token' : "{{ csrf_token() }}",
             		'id'     : product_id
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
                        $('.productRow'+data.id).remove();
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
@endsection
