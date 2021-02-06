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
            <!-- row opened -->
            <div class="row row-sm">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-header pb-0">
                            <div class="d-flex justify-content-between">
                                <h4 class="card-title mg-b-0">المــــورديـــــــــــن</h4>
                                <i class="mdi mdi-dots-horizontal text-gray"></i>
                            </div>
<!--                             <p class="tx-12 tx-gray-500 mb-2">Example of Valex Simple Table. <a href="">Learn more</a></p>
 -->                        </div>
                        <div class="card-body">

                        {{--  START GET FLASH MESSAGES   --}}
                            @include('admin.alerts.success')
                            @include('admin.alerts.errors')

                            <div class="row mr-2 ml-2" id="successMsg" style="display: none">
                                <button type="text" class="btn btn-lg btn-block btn-outline-success mb-2">
                                        تم الحزف بنجاح
                                </button>
                            </div>
                        {{--  END GET FLASH MESSAGES   --}}

                            @include('admin.suppliers.create')

                            <div class="table-responsive">
                                @if ($suppliers && $suppliers->count() > 0)
                                    <table class="table text-md-nowrap" id="example1">
                                        <thead>
                                            <tr>
                                                <th class="wd-15p border-bottom-0"> رقم</th>
                                                <th class="wd-15p border-bottom-0">اسم المورد</th>
                                                <th class="wd-15p border-bottom-0">اسم المدينة التابعة لها</th>
                                                <th class="wd-15p border-bottom-0">عنوان المورد</th>
                                                <th class="wd-15p border-bottom-0">تليفون المورد</th>
                                                <th class="wd-10p border-bottom-0">الاجرائات</th>
                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                            
                                            @php
                                                $x = 1;
                                            @endphp
                                            @foreach ($suppliers as $supplier)
                                                <tr class="supplierRow{{ $supplier->id }}">
                                                    <td>{{ $x++ }}</td>
                                                    <td>{{ $supplier->name }}</td> 
                                                    <td>{{ $supplier->cities->name }}</td> 
                                                    <td>{{ $supplier->adress }}</td> 
                                                    <td>{{ $supplier->phone }}</td> 
                
                                                    <td>
                                                        <div class="btn-icon-list">
                                                            <a href="{{ route('suppliers.edit',$supplier->id) }}">
                                                                <button class="btn btn-indigo btn-icon"><i class="fa fa-edit"></i></button>
                                                            </a> &nbsp;
                                                            <a href="" class="makeDeleteSupplier" supplier_id="{{ $supplier->id }}">
                                                                <button class="btn btn-primary btn-icon"><i class="fa fa-trash"></i></button>
                                                            </a>
                                                            
                                                        
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach

                                        </tbody>
                                    </table>
                                @else
                                    <h1 class="text-center">No Suppliers</h1>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <!--/div-->
            </div>
            <!-- /row -->
        </div>
        <!-- Container closed -->
    </div>
    <!-- main-content closed -->
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



	{{--  CREATE NEW CITY   --}}

	<script>
		$(document).on('click','#makeCreateSupplier',function(e)
		{
			e.preventDefault();

			// DELETE ERROR MESSAGE IF INPUT HAVE VALUE WITHOUT REFRESH PAGE
			$('#name_error').text('');
			$('#city_id_error').text('');
			$('#adress_error').text('');
			$('#phone_error').text('');
			

			//Get Form Data
			var formData = new FormData($('#createٍSupplier')[0]);            

			$.ajax(
			{
				type: 'post',
				url: "{{route('suppliers.store')}}",
				data: formData,
				processData: false,
				contentType: false,
				cache: false,
				success: function(data)
				{
					if(data.status == true)
					{
						
						if(data.status == true)
						{
                            $('#success').html(data.msg);
							$('#succes_msg').show().fadeOut(3000);
							setTimeout(function(){
								$('#modaldemo8').modal('hide')
							}, 5000);
						}
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

	{{--  DELETE CITY   --}}
	<script>
		$(document).on('click','.makeDeleteSupplier',function(e)
		{
			e.preventDefault();

			

			//Get Form Data           
            var supplier_id = $(this).attr('supplier_id');
            
			$.ajax(
			{
				type: 'post',
				url: "{{route('suppliers.destroy')}}",
				data: 
				{
					
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
                             url:"{{ url('/admin/suppliers/cities/') }}/" + gov,
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