@extends('layouts.admin')
@section('title')
    الصلاحيات -تعديل
@endsection
@section('content-title')
     تعديل الصلاحيات
@endsection
@section('content')
    <div class="card card-custom">
        <div class="card-header">
            <div class="card-title">
                    <span class="card-icon">
                        <i class="flaticon2-heart-rate-monitor text-primary"></i>
                    </span>
                <h3 class="card-label"> عرض بيانات التعديل</h3>
            </div>
        </div>
        <div class="card-body">


                                        <form class="form"
                                              action="{{route('admin.roles.update',$role->id)}}"
                                              method="POST"
                                              enctype="multipart/form-data">
                                            @csrf
                                            <div class="form-body">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label for="projectinput1">اسم الصلاحية
                                                            </label>
                                                            <input type="text" id="name"
                                                                   class="form-control"
                                                                   placeholder="  "
                                                                   value="{{ $role->name }}"
                                                                   name="name">
                                                            @error("name")
                                                            <span class="text-danger">{{$message}}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                                    <div class="row">
                                                        @foreach (config('global.permissions') as $name => $value)
                                                            <div class="form-group col-sm-3">
                                                              <span class="switch switch-icon">
																<label>
																	<input type="checkbox" name="permissions[]" value="{{ $name }}" {{ in_array($name, $role->permissions)? 'checked' : '' }}>  {{ $value }}
																	<span></span>
																</label>
															</span>
                                                            </div>
                                                        @endforeach


                                                    </div>
                                                    @error('categories.0')
                                                    <span class="text-danger"> {{$message}}</span>
                                                    @enderror
                                                </div>
                                            <div class="form-actions">
                                                <button type="submit" class="btn btn-primary">
                                                    <i class="la la-check-square-o"></i>تعديل
                                                </button>

                                                <button type="button" class="btn btn-warning mr-1"
                                                        onclick="history.back();">
                                                    <i class="ft-x"></i>تراجع
                                                </button>

                                            </div>
                                        </form>
                                    </div>
                                </div>


@endsection
