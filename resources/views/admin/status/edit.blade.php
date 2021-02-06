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
                        <h4 class="card-title mb-1">تعديل الحالة</h4>
<!--                         <p class="mb-2">It is Very Easy to Customize and it uses in your website apllication.</p>
 -->                    </div>
                    <div class="card-body pt-0">
                        <form  class="parsley-style-1"  name="selectForm2" novalidate="" action="{{ route('status.update',$status->id) }}" method="POST">
                            @csrf
                            
                        
                            <div class="row">
                        
                                {{--  SERVANT ID   --}}
                                <input type="hidden" name="status_id"  value="{{ $status->id }}" >
                            
                                {{--  SERVANT NAME   --}}
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="">اسم حالة الاوردر</label>
                                        <input type="text" name="name" class="form-control" placeholder="ادخل اسم حالة الاوردر" value="{{ $status->name }}">
                                        @error("name")
                                            <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                </div>
                        
                             
                            <div class="mg-t-30">
                                <button class="btn btn-main-primary pd-x-20 makeUpdateAdmin"  type="submit">تعديل الحالة </button>
                            </div>
                        </form> 
                    </div>
                </div>
            </div>
        </div>
    <!-- row -->

				
			
@endsection


