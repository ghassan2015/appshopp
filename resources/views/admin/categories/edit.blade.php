@extends('layouts.admin')
@section('title')
    الخدمات-تعديل قسم
@endsection

@section('content-title')
    تعديل الخدمة
@endsection
@section('content')
    <div class="col-12 p-3">
        <div class="col-12 col-lg-12 p-0 ">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card card-custom example example-compact">
                        <div class="card-header">
                            <h3 class="card-title">البيانات الخاصة تعديل الخدمة</h3>

                        </div>
                        <!--begin::Form-->
                        <form class="form" action="{{route('admin.categories.update')}}" name="edit_category" method="Post"  id="kt_form_2" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">

                                <input type="hidden"  name="category_id" placeholder="" value="{{$category->id??null}}" />

                                <div class="mb-3">
                                    <div class="mb-2">
                                        <div class="form-group row">
                                            <div class="col-lg-6">
                                                <label>اسم القسم باللغة العربية: <span style="color: red">*</span></label>
                                                <input type="text" name="name_ar" class="form-control" placeholder="" value="{{$category->getTranslation('name','ar')}}" />
                                            </div>
                                            <div class="col-lg-6">
                                                <label>اسم القسم باللغة الانجليزية: <span style="color: red">*</span></label>
                                                <input type="text" name="name_en" class="form-control" placeholder="" value="{{$category->getTranslation('name','en')}}" />
                                            </div>
                                        </div>

                                        <input type="hidden"  class="check_parent_id" placeholder="" value="{{$category->parent->id??null}}" />

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
                                                            @foreach($categories as $value)
                                                                <option value="{{$value->id}}"
                                                                        @if($category->parent)
                                                                        @if($value->id=== $category->parent->id) selected='selected' @endif
                                                                @endif
                                                                >{{$value->name}}</option>
                                                            @endforeach
                                                        </select>



                                                    </div>
                                                </div>

                                            </div>
                                        </div>

@if(isset($category->probabilty))
                                                   @foreach ($category->probabilty as $probabilty)
                                            <div class="col-lg-12 form-group row">
                                                @if(count(array($probabilty->option_id))>0)
                                                @foreach ($probabilty->option_id as $val)
                                                @foreach ($options as $op)
                                                    @if ($op->id==$val)
                                                            <div class="col-lg-2">

                                                            <input type="text"  class="form-control"  value="{{$op->name}}" placeholder="" readonly  />

                                                            </div>

                                                    @endif
                                                @endforeach

                                                 @endforeach


                                                <div class="col-lg-2">
                                                    <input type="hidden"  class="form-control"  name="id[]"  value="{{$probabilty->id}}" placeholder=""  />

                                                <input type="text"  class="form-control" name="price[]"  value="{{$probabilty->price}}" placeholder=""  />
                                                </div>
                                                <div class="col-lg-2">

                                                    <a type="text"  class="form-control btn btn-danger delete"  data-category_id="{{$probabilty->category_id}}" data-id="{{$category->id}}">حذف</a>
                                                </div>
                                                @endif

                                            </div>
                                            @endforeach
@endif

                                        <hr>
                                        </div>

                                        <div class="form-group row ">
                                            <div class="col-lg-12">
                                                <label>وصف القسم: </label>
                                                <div class="col-lg-12 col-md-12 col-sm-12">
                                                    <textarea class="summernote" name="description">{!! $category->description??null !!}</textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row ">
                                            <div class="col-lg-12">
                                                <label>
                                                    ميتا الوصف
                                                </label>
                                                <div class="col-lg-12 col-md-12 col-sm-12">
                                                    <textarea name="meta_description" class="form-control" style="min-height:150px">{!! $category->meta_description??null !!}</textarea>                                            </div>
                                            </div>
                                        </div>
                                        <div class="form-group row ">
                                            <div class="col-lg-12">
                                                <label>
                                                    الشعار البارز
                                                </label>
                                                <div class="col-lg-12 col-md-12 col-sm-12">
                                                    <input type="file" name="image"     class="form-control" accept="image/*">
                                                </div>
                                                <div class="col-lg-12 col-md-12 col-sm-12">
                                 <img src="{{asset('assets/images/categories/'.$category->image)}}" width="150px" height="150px">
                                                </div>

                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-lg-6">
                                                <label>الحالة: </label>
                                                <span class="switch switch-icon">
																<label>
																	<input type="checkbox" value="1" @if($category->status_cd==config('app.status_cd_active')) checked="checked"@endif name="status" />
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
@include('admin.categories.Modal.delete_option')
@include('admin.categories.js.edit_js')

@endsection

