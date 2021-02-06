

    

<div class="col-sm-6 col-md-4 col-xl-3 mg-t-20">
    <a class="modal-effect btn btn-outline-primary btn-block" data-effect="effect-sign" data-toggle="modal" href="#modaldemo8">اضافة مندوب جديد</a>
</div>

<!-- Modal effects -->
    <div class="modal" id="modaldemo8">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content modal-content-demo">
                <div class="modal-header">
                    <h6 class="modal-title">اضافة مندوب جديد</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                </div>

                {{--  SUCCESS MESSAGE   --}}
                <div class="row mr-2 ml-2" id="succes_msg" style="display: none">
                    <button type="text" class="btn btn-lg btn-block btn-outline-success mb-2" id="success">
                           
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
								
								<form  class="parsley-style-1" id="createٍServant" name="selectForm2" novalidate="">
                                    @csrf

                                    <div class="row">
                                        <div class="col-md-6">

                                            {{--  NAME   --}}
                                            <div class="form-group">
                                                <label for="">اسم المندوب</label>
                                                <input type="text" name="name" class="form-control" placeholder="ادخل اسم المندوب">
                                               
                                                    <span class="text-danger" id="name_error"></span>
                                            </div>
                                        </div>

                                        {{--  ADRESS   --}}
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">عنوان المندوب</label>
                                                <input type="adress" name="adress" class="form-control" placeholder="ادخل عنوان المندوب">
                                                
                                                    <span class="text-danger" id="adress_error"></span>
                                            </div>
                                        </div>

                                        {{--  PHONE   --}}
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">رقم التليفون</label>
                                                <input type="number" name="phone" class="form-control" placeholder="ادخل رقم تليفون المدير">
                                               
                                                    <span class="text-danger" id="phone_error"></span>
                                            </div>
                                        </div>

                                        {{--  AGE   --}}
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">السن</label>
                                                <input type="number" name="age" class="form-control" placeholder="ادخل سن المندوب">
                                           
                                                    <span class="text-danger" id="age_error"></span>
                                            </div>
                                        </div>
                                    </div>
								
									<div class="mg-t-30">
										<button class="btn btn-main-primary pd-x-20" id="makeCreateServant" type="submit">اضافة مندوب</button>
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






