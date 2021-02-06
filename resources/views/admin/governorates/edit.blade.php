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
                        <h4 class="card-title mb-1">تعديل المحافظــــــة</h4>
<!--                         <p class="mb-2">It is Very Easy to Customize and it uses in your website apllication.</p>
 -->                    </div>
                    <div class="card-body pt-0">
                        <form  class="parsley-style-1"  name="selectForm2" novalidate="" action="{{ route('governorates.update',$governorate->id) }}" method="POST">
                            @csrf
                            
                        
                            <div class="row">
                        
                                {{--  GOVERNORATE ID   --}}
                                <input type="hidden" name="gov_id"  value="{{ $governorate->id }}" >
                            
                                {{--  GOVERNORATE NAME   --}}
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="">اسم المحافظة </label>
                                        <input type="text" name="name" class="form-control" placeholder="ادخل اسم المحافظة " value="{{ $governorate->name }}">
                                        @error("name")
                                            <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                </div>
                        
                             
                            <div class="mg-t-30">
                                <button class="btn btn-main-primary pd-x-20 makeUpdateGov"  type="submit">تعديل بيانات المحافظة </button>
                            </div>
                        </form> 
                    </div>
                </div>
            </div>
        </div>
    <!-- row -->

				
			
@endsection


