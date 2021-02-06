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
                                <h4 class="card-title mg-b-0">المحافظـــــات المحذوفــــة</h4>
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
                                        تم التفعيل بنجاح
                                </button>
                            </div>
                        {{--  END GET FLASH MESSAGES   --}}


                            <div class="table-responsive">
                                @if ($governorates && $governorates->count() > 0)
                                    <table class="table text-md-nowrap" id="example1">
                                        <thead>
                                            <tr>
                                                <th class="wd-15p border-bottom-0"> رقم</th>
                                                <th class="wd-15p border-bottom-0">اسم حالة الاوردر</th>
                                                <th class="wd-10p border-bottom-0">الاجرائات</th>
                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                            
                                            @php
                                                $x = 1;
                                            @endphp
                                            @foreach ($governorates as $gov)
                                                <tr class="govRow{{ $gov->id }}">
                                                    <td>{{ $x++ }}</td>
                                                    <td>{{ $gov->name }}</td>
                                                    <td>
                                                    <div class="btn-icon-list">
                                                        {{--  <a href="{{ route('servants.edit',$servant->id) }}">
                                                            <button class="btn btn-indigo btn-icon"><i class="typcn typcn-folder"></i></button>
                                                        </a>  --}}
                                                        <a href="" class="makeRestoreGov" gov_id="{{ $gov->id }}">
                                                            <button class="btn btn-primary btn-icon"><i class="typcn typcn-calendar-outline"></i></button>
                                                        </a>
                                                        
                                                      
                                                    </div>
                                                    </td>
                                                </tr>
                                            @endforeach

                                        </tbody>
                                    </table>
                                @else
                                    <h1 class="text-center">No Governorates</h1>
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



	

	{{--  DELETE ADMIN   --}}

	<script>
		$(document).on('click','.makeRestoreGov',function(e)
		{
			e.preventDefault();

			

			//Get Form Data           
            var gov_id = $(this).attr('gov_id');
            
			$.ajax(
			{
				type: 'get',
				url: "{{route('governorates.restore')}}",
				data: 
				{
					
             		'id'     : gov_id
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
                        $('.govRow'+data.id).remove();
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