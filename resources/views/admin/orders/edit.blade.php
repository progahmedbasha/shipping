@extends('admin.layouts.master')
<br>
@section('content')
<div class="col-lg-12 col-md-12">
    <div class="card">
        <div class="card-body">
            <div class="main-content-label mg-b-5">
                تعديل بيانات الاوردر
            </div>

            <form action="{{ route('orders.update',$order->id) }}" method="post">
                @csrf

                <div class="row row-sm">

                    <div class="col-12">
                        <div class="form-group mg-b-0">
                            <label class="form-label">حالات الاوردر: <span class="tx-danger">*</span></label>
                            <select name="status_id" class="form-control">
                                <option value=""> اختار حالة الاوردر</option>
                                @foreach ($allStatus as $status)
                                    <option value="{{ $status->id }}" @if ($status->id == $order->status_id)
                                        selected
                                    @endif>
                                        {{ $status->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error("status_id")
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                        </div>
                    </div> <br><br>

                    <div class="col-12" style="margin-top: 30px">
                        <div class="form-group">
                            <label class="form-label">ملاحظات: <span class="tx-danger">*</span></label>
                            <textarea name="notes" id="" cols="30" rows="10" class="form-control">
                                {{ $order->notes }}
                            </textarea>
                            @error("notes")
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                        </div>
                    </div>
                    <div class="col-12"><button class="btn btn-main-primary pd-x-20 mg-t-10" type="submit">تعديل الاوردر</button></div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection