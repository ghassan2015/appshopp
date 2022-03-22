@extends('layouts.admin')
@section('title')
    الدفعات
@endsection
@section('content-title')
    عرض كافة الدفعات
@endsection
@section('content')
    <div class="card card-custom">
        <div class="card-header flex-wrap py-5">
            <div class="card-title">
                <h1 class="card-label">عرض الدفعات</h1>
            </div>
            <div class="card-toolbar">
                <!--begin::Dropdown-->

                <!--end::Dropdown-->
                <!--begin::Button-->

                <a  class="btn btn-primary font-weight-bolder" href="{{route('admin.supervisors.create')}}">
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
											</span>اضافة دفعة  جديد</a>
                <!--end::Button-->
            </div>
        </div>
        <div class="card-body">

            <form id="filter_form" action="" >
                @csrf
                <div class="form-group row m-1">
                    <div class="col-lg-6">
                        <label>اسم المستخدم:</label>
                        <input name="name" id="name" class="form-control">

                    </div>
                    <div class="col-lg-6">
                        <label>ايميل:</label>
                        <input name="email" id="email" class="form-control">

                    </div>
                </div>
                <div class="form-group row" style="margin: 10px 3px 10px 0px">
                    <div class="col-lg-4">
                        <button class="btn btn-primary " id="btnFiterSubmitSearch">بحث</button>
                    </div>
                </div>
            </form>

            <!--begin: Datatable-->

            <table class="table table-bordered table-hover table-checkable data-table" style="margin-top: 13px !important">
                <thead>
                <tr>
                    <th>اسم</th>
                    <th>الايميل</th>
                    <th>قيمة الدفعة</th>

                    <th>الحالة</th>
                    <th>العمليات</th>
                </tr>
                </thead>
                <tbody>


                </tbody>
            </table>
        </div>
        <!--end: Datatable-->
    </div>
    </div>
{{--    @include('admin.supervisors.Modal.delete')--}}
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <script>

        $(document).ready(function (){

            $(document).on('click', '.delete', function (e) {
                var $id = $(this).attr('id');
                var category_name = $(this).attr('sup_name');
                $('#Delete_id').val($id);
                $('#Name_Delete').val(category_name);
                $('#confirmModal').modal('show')
            });
            table = $('.data-table').DataTable({
                processing: true,
                serverSide: true,

                searching: false,
                ajax: {
                    url: "{{route('admin.supervisors.getSupervisor')}}",
                    type: 'GET',
                    "data": function (d) {
                        d.email = $('#email').val();
                        d.name = $('#name').val();
                    },
                },

                columns: [
                    {data: 'name', name: 'name'},
                    {data: 'email', name: 'email'},
                    {data: 'roles', name: 'roles'},

                    {data: 'status', name: 'status'},

                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ],
                @if(app()->getLocale()== 'ar')

                language: {
                    "url": "//cdn.datatables.net/plug-ins/1.10.25/i18n/Arabic.json"
                }
                @endif
            });
            $('#btnFiterSubmitSearch').click(function (e) {
                e.preventDefault();
                $('.data-table').DataTable().draw(true);
            });



        });


    </script>

@endsection

