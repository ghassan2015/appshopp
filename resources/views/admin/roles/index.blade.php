@extends('layouts.admin')
@section('title')
    الصلاحيات
@endsection
@section('content-title')
    عرض كافة الصلاحيات
@endsection
@section('content')
    <div class="card card-custom">
        <div class="card-header flex-wrap py-5">
            <div class="card-title">
                <h1 class="card-label">كافة الصلاحيات</h1>
            </div>
            <div class="card-toolbar">
                <!--begin::Dropdown-->

                <!--end::Dropdown-->
                <!--begin::Button-->

                <a   href="{{route('admin.roles.create')}}" class="btn btn-primary font-weight-bolder ">
											<span class="svg-icon svg-icon-md">
												<!--begin::Svg Icon | path:assets/media/svg/icons/Design/Flatten.svg-->
												<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
													<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
														<rect x="0" y="0" width="24" height="24" />
														<circle fill="#000000" cx="9" cy="15" r="6" />
														<path d="M8.8012943,7.00241953 C9.83837775,5.20768121 11.7781543,4 14,4 C17.3137085,4 20,6.6862915 20,10 C20,12.2218457 18.7923188,14.1616223 16.9975805,15.1987057 C16.9991904,15.1326658 17,15.0664274 17,15 C17,10.581722 13.418278,7 9,7 C8.93357256,7 8.86733422,7.00080962 8.8012943,7.00241953 Z" fill="#000000" opacity="0.3" />
													</g>
												</svg>
                                                <!--end::Svg Icon-->
											</span>اضافة صلاحية جديدة
                </a>

                <!--end::Button-->
            </div>
        </div>


        <div class="card-body">

            <table
                class="table display nowrap table-striped table-bordered">
                <thead class="">
                <tr>
                    <th>الاسم</th>
                    <th>الصلاحيات</th>
                    <th>العمليات</th>
                </tr>
                </thead>
                <tbody>

                @isset($roles)
                    @foreach($roles as $role)
                        <tr>
                            <td>{{$role -> name}}</td>

                            <td>
                                @foreach($role -> permissions as $permission)
                                    {{$permission}} ,
                                @endforeach

                            </td>
                            <td>
                                <div class="btn-group" role="group"
                                     aria-label="Basic example">
                                    <a href="{{route('admin.roles.edit',$role -> id)}}"
                                       class="btn btn-outline-primary btn-min-width box-shadow-3 mr-1 mb-1"> تعديل الصلاحية</a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                @endisset


                </tbody>
            </table>

        </div>
    </div>






@endsection
