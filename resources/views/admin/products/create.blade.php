

    

    <div class="col-sm-6 col-md-4 col-xl-3 mg-t-20">
        <a class="modal-effect btn btn-outline-primary btn-block" data-effect="effect-sign" data-toggle="modal" href="#modaldemo8">اضافة شحنة جديدة للمخزن</a>
    </div>

    <!-- Modal effects -->
        <div class="modal" id="modaldemo8">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content modal-content-demo">
                    <div class="modal-header">
                        <h6 class="modal-title">اضافة شحنة جديدة للمخزن</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                    </div>

                    {{--  SUCCESS MESSAGE   --}}
                    <div class="row mr-2 ml-2" id="succes_msg" style="display: none">
                        <button type="text" class="btn btn-lg btn-block btn-outline-success mb-2">
                                تم الحفظ بنجاح
                        </button>
                    </div>

                    {{--  ERROR MESSAGE   --}}
                    <div class="row mr-2 ml-2" id="error_msg" style="display: none">
                        <button type="text" class="btn btn-lg btn-block btn-outline-danger mb-2">
                                هناك خطا ما برجاء المحاولة فيما بعد
                        </button>
                    </div>
                    
                    <div class="row">
                        <div class="col-lg-12 col-md-12">
                            <div class="card">
                                <div class="card-body">
                                    
                                    <form  class="parsley-style-1" id="createٍProduct" name="selectForm2" novalidate="">
                                        @csrf

                                        <div class="row">
                                            
                                                {{--  SUPPLIER ID   --}}
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="">اسم المورد</label>
                                                        <select name="supplier_id" class="form-control">
                                                            <option value="">اختار اسم المورد</option>
                                                            @foreach ($suppliers as $supplier)
                                                                <option value="{{ $supplier->id }}">
                                                                    {{ $supplier->name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    
                                                        <span class="text-danger" id="supplier_id_error"></span>
                                                    </div>
                                                </div>

                                                {{--  RESEVER NAME   --}}
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="">اسم المستلم</label>
                                                        <input type="text" name="resever_name" class="form-control" placeholder="ادخل اسم المستلم">
                                                    
                                                            <span class="text-danger" id="resever_name_error"></span>
                                                    </div>
                                                </div>
                                                
                                                {{--  RESEVER PHONE   --}}
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="">تليفون المستلم</label>
                                                        <input type="text" name="resver_phone" class="form-control" placeholder="ادخل تليفون المستلم">
                                                    
                                                            <span class="text-danger" id="resver_phone_error"></span>
                                                    </div>
                                                </div>

                                                {{--  GOVERNORATE_ID   --}}
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="">اسم المحافظة</label>
                                                        
                                                        <select  class="form-control" id="gov">
                                                            <option value="">اختار محافظة</option>
                                                            @foreach ($governorates as $gov)
                                                                <option value="{{ $gov->id }}">
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
                                                            <option disabled selected>Select City</option>
                                                    
                                                        </select>
                                                        <span class="text-danger" id="city_id_error"></span>
                                                    </div> 
                                                </div>

                                                {{--  ADRESS   --}}
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="">عنوان المستلم</label>
                                                        <input type="text" name="adress" class="form-control" placeholder="ادخل عنوان المستلم">
                                                    
                                                        <span class="text-danger" id="adress_error"></span>
                                                    </div>
                                                </div>

                                                {{--  PRODUCT PRICE   --}}
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="">سعر الشحنة</label>
                                                        <input type="number" name="product_price" class="form-control" placeholder="ادخل سعر الشحنة">
                                                    
                                                        <span class="text-danger" id="product_price_error"></span>
                                                    </div>
                                                </div>

                                                 {{--  STATUS ID   --}}
                                                 {{-- <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="">حالة الشحنة</label>
                                                        <select name="status_id" class="form-control">
                                                            <option value="">اختار حالة الشحنة</option>
                                                            @foreach ($status as $stat)
                                                                <option value="{{ $stat->id }}">
                                                                    {{ $stat->name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    
                                                        <span class="text-danger" id="status_id_error"></span>
                                                    </div>
                                                </div> --}}

                                                 {{--   NOTES   --}}
                                                 <div class="col-md-12">
                                                    <div class="form-groupفثءف-ؤثىفثق">
                                                        <label for="">ملاحظات الشحنة</label>
                                                        <textarea name="notes" id="" cols="50" rows="5">

                                                        </textarea>
                                                    
                                                        <span class="text-danger" id="notes_error"></span>
                                                    </div>
                                                </div>
                                            
                                        </div>

                                        
                                    
                                        <div class="mg-t-30">
                                            <button class="btn btn-main-primary pd-x-20" id="makeCreateProduct" type="submit">اضافة شحنة جديدة للمخزن</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <!-- End Modal effects-->

<br>






