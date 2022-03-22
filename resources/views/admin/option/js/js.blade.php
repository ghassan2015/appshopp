    <script src="{{asset('assets/plugins/custom/datatables/datatables.bundle.js')}}"></script>
    <!--end::Page Vendors-->
    <!--begin::Page Scripts(used by this page)-->
    <script src="{{asset('assets/js/pages/crud/datatables/data-sources/html.js')}}"></script>

    <script src="{{asset('assets/js/pages/crud/forms/widgets/select2.js')}}"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>

    <script>
        $(document).ready(function (){

            $('.kt_select2_1').select2({
                width: '100%',
                @if(app()->getLocale()=='ar')
                dir:'rtl',
                @endif
                allowClear: true,

            });
            $(document).on('click', '.add_option', function () {

                $('#exampleModal').modal('show');
                let _url = "{{route('admin.option.store')}}";

                $('#form').attr('action', _url);
                $('#exampleModalLabel').text('اضافة صفة جديدة');

                $('#option_name_ar').val('');
                $('#option_name_en').val('');


            });

            $(document).on('click', '.delete', function (e) {
                $('#confirmModal').modal('show')

                var $id = $(this).attr('id');
                var option_name = $(this).attr('option_name');
                $('#Delete_id').val($id);
                $('#Name_Delete').val(option_name);
            });





            $(document).on('click', '.edit_option', function () {
                $('#exampleModal').modal('show');
                let _url = "{{route('admin.option.update')}}";
                $('#form').attr('action', _url);
                var Name_ar = $(this).attr('name_ar');
                $('#option_name_ar').val(Name_ar);
                var Name_en = $(this).attr('name_en');
                $('#option_name_en').val(Name_en);

                $('#exampleModalLabel').text('تعديل الصفة');

                var option_id = $(this).attr('id');
                $('#option_id').val(option_id);
                var attribute_id = $(this).attr('attribute_id');

                $('.kt_select2_1').val(attribute_id).trigger('change');

            });


            table = $('.data-table').DataTable({
                processing: true,
                serverSide: true,

                searching: false,
                ajax: {
                    url: "{{route('admin.getOption')}}",
                    type: 'GET',

                },
                columns: [
                    {data: 'name', name: 'name'},
                    {data: 'attribute_name', name: 'attribute_name'},
                    // {data: 'status', name: 'status'},

                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ],
                @if(app()->getLocale()== 'ar')

                language: {
                    "url": "//cdn.datatables.net/plug-ins/1.10.25/i18n/Arabic.json"
                }
                @endif
            });

            (function () {
                'use strict';
                window.addEventListener('load', function () {
                    // Fetch all the forms we want to apply custom Bootstrap validation styles to
                    var forms = document.getElementsByClassName('needs-validation');
                    // Loop over them and prevent submission
                    var validation = Array.prototype.filter.call(forms, function (form) {
                        form.addEventListener('submit', function (event) {
                            if (form.checkValidity() === false) {
                                event.preventDefault();
                                event.stopPropagation();
                            }
                            form.classList.add('was-validated');
                        }, false);
                    });
                }, false);
            })();
        });
    </script>

