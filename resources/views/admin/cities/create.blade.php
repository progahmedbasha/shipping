

    

<div class="col-sm-6 col-md-4 col-xl-3 mg-t-20">
    <a class="modal-effect btn btn-outline-primary btn-block" data-effect="effect-sign" data-toggle="modal" href="#modaldemo8">اضافة مدينة جديدة</a>
</div>

<!-- Modal effects -->
    <div class="modal" id="modaldemo8">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content modal-content-demo">
                <div class="modal-header">
                    <h6 class="modal-title">اضافة مدينة جديدة</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
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
								
								<form  class="parsley-style-1" id="createٍCity" name="selectForm2" novalidate="">
                                    @csrf

                                    <div class="row">
                                        <div class="col-md-6">

                                            {{--  NAME   --}}
                                            <div class="form-group">
                                                <label for="">اسم المدينة</label>
                                                <input type="text" name="name" class="form-control" placeholder="ادخل اسم المدينة">
                                               
                                                    <span class="text-danger" id="name_error"></span>
                                            </div>

                                            {{--  GOVERNORATE_ID   --}}
                                            <div class="form-group">
                                                <label for="">اسم المحافظة</label>
                                                
                                                <select name="governorate_id" class="form-control">
                                                    <option value="">اختار محافظة</option>
                                                    @foreach ($governorates as $gov)
                                                        <option value="{{ $gov->id }}">
                                                            {{ $gov->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                               
                                                    <span class="text-danger" id="governorate_id_error"></span>
                                            </div>
                                        </div>
                                    </div>

                                      
								
									<div class="mg-t-30">
										<button class="btn btn-main-primary pd-x-20" id="makeCreateCity" type="submit">اضافة مدينة</button>
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






