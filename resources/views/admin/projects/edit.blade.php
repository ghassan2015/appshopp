@extends('layouts.admin')
@section('title')
    المهارات-تعديل المهارة
@endsection
@section('content-title')
    بيانات الخاصة بتعديل مهارة
@endsection
@section('content')
    <div class="col-12 p-3">
        <div class="col-12 col-lg-12 p-0 ">
            <div class="card card-custom">
                <div class="card-header">
                    <div class="card-title">
                    <span class="card-icon">
                        <i class="flaticon2-heart-rate-monitor text-primary"></i>
                    </span>
                        <h3 class="card-label"> تعديل المهارة </h3>
                    </div>
                </div>

                <div class="card-body">
                    <form id="validate-form" class="row" enctype="multipart/form-data" method="POST" action="{{route('admin.skills.update')}}">
                        @csrf

                        <div class="col-12 col-lg-12 p-0 main-box">
                            <div class="col-12 px-0">

                                <div class="col-12 divider" style="min-height: 2px;"></div>
                            </div>
                            <div class="col-12 p-3 row">



                                <div class="col-12 col-lg-6 p-2">
                                    <div class="col-12">
                                        الاسم باللغة العربية
                                    </div>
                                    <input type="hidden" name="id"   maxlength="190" class="form-control" value="{{$skill->id}}" >

                                    <div class="col-12 pt-3">
                                        <input type="text" name="name_ar" required   maxlength="190" class="form-control" value="{{$skill->getTranslation('name','ar')}}" >
                                    </div>
                                </div>
                                <div class="col-12 col-lg-6 p-2">
                                    <div class="col-12">
                                        الاسم  باللغة الانجليزية
                                    </div>
                                    <div class="col-12 pt-3">
                                        <input type="text" name="name_en" required   maxlength="190" class="form-control" value="{{$skill->getTranslation('name','en')}}" >
                                    </div>
                                </div>


                                <div class="col-12 col-lg-6 p-2"  >
                                    <div class="col-12">
                                        اسم التصنيف
                                    </div>
                                    <div class="col-12 pt-3">
                                        <select class="form-control select2" id="kt_select2_3" name="category_id">

                                            <option value="">اختر القسم</option>
                                            @foreach($categories as $category)
                                                <option value="{{ $category->id }}" @if($skill->category_id== $category->id) selected='selected' @endif> {{ $category->name }}</option>
                                            @endforeach
                                        </select>


                                    </div>
                                </div>






                            </div>

                        </div>
                </div>

                <div class="card-footer">
                    <div class="row">
                        <div class="col-lg-12">
                            <button type="submit" class="btn btn-primary font-weight-bold mr-2">تاكيد</button>
                        </div>
                    </div>
                </div>
                </form>
            </div>
        </div>
    @include('admin.skills.js.js')

@endsection

