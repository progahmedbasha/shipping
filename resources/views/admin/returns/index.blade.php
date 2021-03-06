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
                                <h4 class="card-title mg-b-0">المرتجعـــــــــات</h4>
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


                            <div class="table-responsive">
                                @if ($allReturns && $allReturns->count() > 0)
                                    <table class="table text-md-nowrap" id="example1">
                                        <thead>
                                            <tr>
												<th class="wd-15p border-bottom-0"> رقم</th>
												<th class="wd-15p border-bottom-0">اسم المورد</th>
                                                <th class="wd-15p border-bottom-0">اسم المستلم</th>
												<th class="wd-15p border-bottom-0">تليفون المستلم</th>
												<th class="wd-15p border-bottom-0">اسم المحافظة</th>
                                                <th class="wd-15p border-bottom-0">اسم المدينة التابعة لها</th>
                                                <th class="wd-15p border-bottom-0">عنوان المستلم</th>
                                                <th class="wd-15p border-bottom-0"> سعر الشحنة</th>
                                                <th class="wd-15p border-bottom-0"> حالة الشحنة</th>
                                                <th class="wd-15p border-bottom-0">  الملاحظات</th>
                                                {{-- <th class="wd-10p border-bottom-0">الاجرائات</th> --}}
                                            </tr>
                                        </thead>
                                        <tbody>
                                            
                                            @php
                                                $x = 1;
                                            @endphp
                                            @foreach ($allReturns as $item)
                                                <tr class="productRow{{ $item->id }}">
                                                    <td>{{ $x++ }}</td>
                                                    <td>{{ $item->supplier->name }}</td> 
                                                    <td>{{ $item->resever_name }}</td> 
                                                    <td>{{ $item->resver_phone }}</td>  
                                                    <td>{{ $item->cities->governorate->name }}</td> 
                                                    <td>{{ $item->cities->name }}</td> 
                                                    <td>{{ $item->adress }}</td> 
                                                    <td>{{ $item->product_price }}</td> 
                                                    <td>{{ $item->status->name }}</td> 
                                                    <td>{{ $item->notes }}</td> 
                
                                                    {{-- <td>
                                                        <div class="btn-icon-list">
                                                            <a href="{{ route('products.edit',$item->id) }}">
                                                                <button class="btn btn-indigo btn-icon"><i class="typcn typcn-folder"></i></button>
                                                            </a>
                                                            <a href="" class="makeDeleteProduct" item_id="{{ $item->id }}">
                                                                <button class="btn btn-primary btn-icon"><i class="typcn typcn-calendar-outline"></i></button>
                                                            </a>
                                                            <a href="{{ route('products.show',$item->id) }}">
                                                                <button class="btn btn-success btn-icon"><i class="typcn typcn-document-add"></i></button>
                                                            </a>
                                                        </div>
                                                    </td> --}}
                                                </tr>
                                            @endforeach

                                        </tbody>
                                    </table>
                                @else
                                    <h1 class="text-center">No Products</h1>
                                @endif <br>

                                {{-- NEXT BUTTON  --}}
                                    <a href="{{ route('returns.create') }}" class="text-center " style="margin-right: 90%;">
                                        <button class="btn btn-primary">
                                            انشاء خط سير جديد
                                        </button>
                                    </a>
                                {{-- NEXT BUTTON  --}}
                                

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

@endsection