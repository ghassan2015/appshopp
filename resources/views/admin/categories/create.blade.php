@extends('layouts.admin')
@section('title')
    الخدمات-اضافة الخدمات
@endsection

@section('content-title')
    اضافة خدمة جديد
@endsection
@section('content')
<div class="col-12 p-3">
	<div class="col-12 col-lg-12 p-0 ">
        <div class="row">
            <div class="col-lg-12">
                <div class="card card-custom example example-compact">
                    <div class="card-header">
                        <h3 class="card-title">البيانات الخاصة  باضافة خدمة جديد</h3>

                    </div>
                    <!--begin::Form-->
                    <form class="form" action="{{route('admin.categories.store')}}" method="Post" name="add_category"  id="kt_form_2" enctype="multipart/form-data">
                     @csrf
                        <div class="card-body">


                            <div class="mb-3">
                                <div class="mb-2">
                                    <div class="form-group row">
                                        <div class="col-lg-6">
                                            <label>اسم الخدمة باللغة العربية: <span style="color: red">*</span></label>
                                            <input type="text" name="name_ar" class="form-control" placeholder="" value="" />
                                        </div>
                                        <div class="col-lg-6">
                                            <label>اسم الخدمة باللغة الانجليزية: <span style="color: red">*</span></label>
                                            <input type="text" name="name_en" class="form-control" placeholder=""  />
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-lg-6">
                                            <label>هل تابع الى  الخدمة اخر: </label>
                                            <span class="switch switch-icon">
																<label>
																	<input type="checkbox"  class="select" name="select" />
																	<span></span>
																</label>
															</span>
                                        </div>
                                        <div class="col-lg-6 parent_id">

                                            <div class="col-lg-12 form-group ">
                                                <div class="col-lg-12">

                                            <label>تابع الى اي خدمة:</label>
                                                </div>
                                                <div class="col-lg-12">

                                                <select style="width: 100%"  name="parent_id" class="form-control select2 category_id"

                                                    id="category_id">
                                                <option value=""> القسم التابع له</option>
                                                @foreach($categories as $category)
                                                    <option value="{{$category->id}}">{{$category->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                          </div>

                                        </div>
                                    </div>
                                    <div id="kt_docs_repeater_advanced">
                                        <!--begin::Form group-->
                                        <div class="form-group">
                                            <div data-repeater-list="group">
                                                <div data-repeater-item>
                                                    <div class="col-lg-12 form-group row">
                                                            <div class="col-lg-5">
                                                                <label class="form-label">السمات</label>
                                                            </div>

                                                        <div class="col-lg-5">
                                                            <label>الصفات</label>
                                                        </div>

                                                        </div>
                                                    <div class="col-lg-12 form-group row">
                                                        <div class="col-lg-5">

                                                        <select style="width: 100%"  name="attribute_id" class="form-select attribute" data-kt-repeater="select2" data-dir="rtl" data-placeholder="اختر " >

                                                        <option value=''>اختر</option>
                                                        @foreach($attributes as $attribute)
                                                            <option value="{{$attribute->id}}">{{$attribute->name}}</option>
                                                        @endforeach
                                                    </select>
                                                        </div>
                                                        <div class="col-lg-5">
                                                            <select style="width: 100%" name="option_id" class="form-select option_id " data-kt-repeater="select2"  data-dir="rtl" data-placeholder="اختر "  multiple="multiple">

                                                                <option value=''>اختر</option>

                                                            </select>

                                                        </div>

                                                    <div class="col-lg-2">
                                                            <a href="javascript:;" data-repeater-delete class="btn btn-sm btn-light-danger">
                                                                <i class="la la-trash-o fs-3"></i>حذف
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!--end::Form group-->

                                        <!--begin::Form group-->
                                        <div class="form-group">
                                            <a href="javascript:;" data-repeater-create class="btn btn-light-primary">
                                                <i class="la la-plus"></i>اضافة
                                            </a>
                                        </div>
                                        <!--end::Form group-->
                                    </div>
                                        <!--begin::Form group-->

                                    <div class="form-group row ">
                                        <div class="col-lg-12">
                                            <label>وصف القسم: </label>
                                        <div class="col-lg-12 col-md-12 col-sm-12">
                                            <textarea class="summernote" name="description">{{old('description')}}</textarea>
                                        </div>
                                    </div>
                                </div>

                                    <div class="form-group row ">
                                        <div class="col-lg-12">
                                            <label>
                                                					ميتا الوصف
                                            </label>
                                            <div class="col-lg-12 col-md-12 col-sm-12">
                                                <textarea name="meta_description" class="form-control" style="min-height:150px">{{old('meta_description')}}</textarea>                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row ">
                                        <div class="col-lg-12">
                                            <label>
                                                الشعار البارز <span style="color: red">*</span>
                                            </label>
                                            <div class="col-lg-12 col-md-12 col-sm-12">
                                                        <input type="file" name="image"  required   class="form-control" accept="image/*">
                                            </div>
                                        </div>
                                </div>
                                    <div class="form-group row">
                                        <div class="col-lg-6">
                                            <label>الحالة: </label>
                                            <span class="switch switch-icon">
																<label>
																	<input type="checkbox" value="1" checked="checked" name="status" />
																	<span></span>
																</label>
															</span>
                                        </div>

                                    </div>
                                </div>

                        </div>

                        <div class="card-footer">
                            <div class="row">
                                <div class="col-lg-12">
                                    <button type="submit" class="btn btn-primary font-weight-bold mr-2">تاكيد</button>
                                    <button type="reset" class="btn btn-light-primary font-weight-bold">الغاء</button>
                                </div>
                            </div>
                        </div>
                    </form>
                    <!--end::Form-->
                </div>
                <!--end::Card-->
            </div>
        </div>


	</div>
</div>

@include('admin.categories.js.add_js')

@endsection

