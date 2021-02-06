@extends('admin.layouts.master')

@section('content')
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">Forms</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ Form-Elements</span>
            </div>
        </div>
    </div>

    <!-- row -->
        <div class="row row-sm">
            
            <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
                <div class="card  box-shadow-0 ">
                    <div class="card-header">
                        <h4 class="card-title mb-1">Vertical Form</h4>
                        <p class="mb-2">It is Very Easy to Customize and it uses in your website apllication.</p>
                    </div>
                    <div class="card-body pt-0">
                        <form  class="parsley-style-1" id="updateAdmin" name="selectForm2" novalidate="" action="{{ route('servants.update',$servant->id) }}" method="POST">
                            @csrf
                            
                        
                            <div class="row">
                        
                                {{--  SERVANT ID   --}}
                                <input type="hidden" name="servent_id"  value="{{ $servant->id }}" >
                            
                                {{--  SERVANT NAME   --}}
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">اسم المندوب</label>
                                        <input type="text" name="name" class="form-control" placeholder="ادخل اسم المندوب" value="{{ $servant->name }}">
                                        @error("name")
                                            <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                </div>
                        
                                {{--  SERVANT ADRESS   --}}
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">عنوان المندوب</label>
                                        <input type="text" name="adress" class="form-control" placeholder="ادخل عنوان المندوب" value="{{ $servant->adress }}">
                                        @error("adress")
                                            <span class="text-danger">{{$message}}</span>
                                        @enderror 
                                    </div>                                   
                                </div>
                        
                                {{--  SERVANT PHONE   --}}
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">رقم التليفون</label>
                                        <input type="number" name="phone" class="form-control" placeholder="ادخل رقم تليفون المندوب" value="{{ $servant->phone }}">
                                        @error("phone")
                                            <span class="text-danger">{{$message}}</span>
                                        @enderror  
                                    </div>            
                                </div>
                        
                                {{--  SERVANT AGE   --}}
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">سن المندوب</label>
                                       
                                        <input type="number" name="age" class="form-control" placeholder="ادخل سن المندوب" value="{{ $servant->age }}">
                                        @error("age")
                                        <span class="text-danger">{{$message}}</span>
                                        @enderror                                       
                                </div>
                            </div>
                        
                            <div class="mg-t-30">
                                <button class="btn btn-main-primary pd-x-20 makeUpdateAdmin"  type="submit">تعديل بيانات المندوب </button>
                            </div>
                        </form> 
                    </div>
                </div>
            </div>
        </div>
    <!-- row -->

				
			
@endsection


