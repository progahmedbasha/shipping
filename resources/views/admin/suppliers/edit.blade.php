@extends('admin.layouts.master')

@section('content')
<!--     <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">Forms</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ Form-Elements</span>
            </div>
        </div>
    </div> -->

    <!-- row -->
        <div class="row row-sm">
            
            <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
                <div class="card  box-shadow-0 ">
                    <div class="card-header">
                        <h4 class="card-title mb-1">تعديل بيانات المورد</h4>
<!--                         <p class="mb-2">It is Very Easy to Customize and it uses in your website apllication.</p>
 -->                    </div>
                    <div class="card-body pt-0">
                        <form  class="parsley-style-1"  name="selectForm2" novalidate="" action="{{ route('suppliers.update',$supplier->id) }}" method="POST">
                            @csrf
                            
                        
                            <div class="row">
                        
                                {{--  SUPPLIER ID   --}}
                                <input type="hidden" name="supplier_id"  value="{{ $supplier->id }}" >

                                {{--  Gov ID   --}}
                                @foreach ($gover_id as $g_id)
                                    <input type="hidden"  value="{{ $g_id->governorate->id }}" id="getGov" >
                                @endforeach
                                
                            
                                {{--  SUPPLIER NAME   --}}
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">اسم المورد </label>
                                        <input type="text" name="name" class="form-control" placeholder="ادخل اسم المورد " value="{{ $supplier->name }}">
                                        @error("name")
                                            <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                </div>

                                {{--  SUPPLIER PHONE   --}}
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">تليفون المورد </label>
                                        <input type="text" name="phone" class="form-control" placeholder="ادخل تليفون المورد " value="{{ $supplier->phone }}">
                                        @error("phone")
                                            <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                </div>


                                {{--  GOVERNORATE_ID   --}}
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">اسم المحافظة</label>
                                        
                                        <select  class="form-control" id="gov">
                                            <option value="">اختار محافظة</option>
                                            
                                            @foreach ($governorates as $gov)
                                                <option value="{{ $gov->id }}"  @if ($gov->id == $supplier->governorate_id)
                                                    selected
                                                @endif>
                                                    {{ $gov->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                               

                               {{-- CITY ID  --}}
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">اختار المدينة</label>
                                        <select class="search_form_select form-control" name="city_id" id="city">
                                            <select class="form-control input-lg dynamic" name="city_id" id="city" disabled>
                                    
                                        </select>
                                        <span class="text-danger" id="city_id_error"></span>
                                    </div> 
                                </div>

                                {{--  SUPPLIER ADRESS   --}}
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">عنوان المورد </label>
                                        <input type="text" name="adress" class="form-control" placeholder="ادخل عنوان المورد " value="{{ $supplier->adress }}">
                                        @error("adress")
                                            <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                </div>

                        
                             <div class="col-md-6">
                                <div class="mg-t-30">
                                    <button class="btn btn-main-primary pd-x-20 makeUpdateCity"  type="submit">تعديل بيانات المورد </button>
                                </div>
                             </div>
                            
                        </form> 
                    </div>
                </div>
            </div>
        </div>
    <!-- row -->

    @section('js')
        <script>
            $(document).ready(function()
            {
                var gov_id_selected = $('#getGov').val();
          
                if(gov_id_selected != null)
                {
                    //alert(gov_id_selected);
                    $("#city").removeAttr('disabled');

                    $.ajax(
                    {
                        url:"{{ url('/admin/suppliers/cities/') }}/" + gov_id_selected,
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
                        }
                    });
                }
            });
        </script>
    @endsection

				
			
@endsection


