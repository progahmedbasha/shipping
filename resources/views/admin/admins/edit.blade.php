

    


    <a class="modal-effect" data-effect="effect-newspaper" data-toggle="modal" href="#modaldemo{{ $admin->id }}">
        <button class="btn btn-indigo btn-icon"><i class="typcn typcn-folder"></i></button>
    </a>
   


<!-- Modal effects -->
    <div class="modal" id="modaldemo{{ $admin->id }}">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content modal-content-demo">
                <div class="modal-header">
                    <h6 class="modal-title">تعديل بيانات  المدير  {{ $admin->name }}</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
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

								{{--  FORM   --}}
								<form  class="parsley-style-1" id="updateAdmin" name="selectForm2" novalidate="">
                                    @csrf
                                    @method('PUT')

                                    <div class="row">

                                        {{--  ADMIN_ID   --}}
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="text" name="admin_id" class="form-control"  value="{{ $admin->id }}">
                                               
                                                    <span class="text-danger" id="name_error"></span>
                                            </div>
                                        </div>

                                        {{--  ADMIN NAME   --}}
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">اسم المدير</label>
                                                <input type="text" name="name" class="form-control" placeholder="ادخل اسم المدير" value="{{ $admin->name }}">
                                               
                                                    <span class="text-danger" id="name_error"></span>
                                            </div>
                                        </div>

                                        {{--  ADMIN EMAIL   --}}
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">الايميل</label>
                                                <input type="email" name="email" class="form-control" placeholder="ادخل ايميل المدير" value="{{ $admin->email }}">
                                                
                                                    <span class="text-danger" id="email_error"></span>
                                            </div>
                                        </div>

                                        {{--  ADMIN PHONE   --}}
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">رقم التليفون</label>
                                                <input type="number" name="phone" class="form-control" placeholder="ادخل رقم تليفون المدير" value="{{ $admin->phone }}">
                                               
                                                    <span class="text-danger" id="phone_error"></span>
                                            </div>
                                        </div>

                                        {{--  ADMIN PASSWORD   --}}
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">الباسورد</label>
                                               
                                                <input type="password" name="password" class="form-control" placeholder="ادخل الباسورد (لا يقل عن 8 عناصر )">
                                           
                                                    <span class="text-danger" id="password_error"></span>
                                            </div>
                                        </div>
                                    </div>
								
									<div class="mg-t-30">
										<button class="btn btn-main-primary pd-x-20 makeUpdateAdmin"  type="submit">اضافة مدير</button>
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


{{--  @section('js')  --}}




