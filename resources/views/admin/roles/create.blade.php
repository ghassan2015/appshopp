@extends('layouts.admin')
@section('title')
    الصلاحيات -اضافة
@endsection
@section('content-title')
    اضافة صلاحيةجديدة
@endsection
@section('content')
    <div class="card card-custom">
        <div class="card-header">
            <div class="card-title">
                    <span class="card-icon">
                        <i class="flaticon2-heart-rate-monitor text-primary"></i>
                    </span>
                <h3 class="card-label"> اضافة صلاحيةجديدة</h3>
            </div>
        </div>
        <div class="card-body">


                                        <form class="form"
                                              action="{{route('admin.roles.store')}}"
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
                                                                   value="{{old('name')}}"
                                                                   name="name">
                                                            @error("name")
                                                            <span class="text-danger">{{$message}}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                                    <div class="row">
                                                        @foreach (config('global.permissions') as $name => $value)
                                                            <div class="col col-lg-3">

                                                            <span class="switch switch-icon">
																<label>
																	<input type="checkbox" checked="checked" name="permissions[]" value="{{ $name }}">  {{ $value }}
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


                                        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-primary">اضافة
            </button>

        <button type="button" class="btn btn-warning mr-1"
                                                    onclick="history.back();">
                                                <i class="ft-x"></i>تراجع
                                            </button>
                                        </form>
                                    </div>
                                </div>


@endsection
