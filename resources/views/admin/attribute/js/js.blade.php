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

            });
            $(document).on('click', '.add_attribute', function () {

                $('#exampleModal').modal('show');
                let _url = "{{route('admin.attribute.store')}}";
                $('#form').attr('action', _url);
                $('#attribute_name_ar').val('');

                $('#attribute_name_en').val('');
                $('#exampleModalLabel').text('اضافة سمة جديدة')

            });

            $(document).on('click', '.delete', function (e) {
                $('#confirmModal').modal('show')

                var $id = $(this).attr('id');
                var attribute_name = $(this).attr('attribute_name');
                $('#Delete_id').val($id);
                $('#Name_Delete').val(attribute_name);
            });



            $(document).on('click', '.edit_attribute', function () {
                $('#exampleModal').modal('show');
                let _url = "{{route('admin.attribute.update')}}";
                $('#form').attr('action', _url);
                $('#exampleModalLabel').text('تعديل سمة')
                var Name_ar = $(this).attr('name_ar');
                $('#attribute_name_ar').val(Name_ar);
                var Name_en = $(this).attr('name_en');
                $('#attribute_name_en').val(Name_en);

                var attribute_id = $(this).attr('id');
                $('#attribute_id').val(attribute_id);
                var status = $(this).attr('status');
                if (status){
                    $('#status').prop('checked', true);
                    $('#status').val(1);

                }else{
                    $('#status').prop('checked', false);
                    $('#status').val(0);

                }

            });


            table = $('.data-table').DataTable({
                processing: true,
                serverSide: true,

                searching: true,
                ajax: {
                    url: "{{route('admin.getAttribute')}}",
                    type: 'GET',
                    "data": function (d) {
                        d.name = $('#name').val();

                    },
                },
                columns: [
                    {data: 'name', name: 'name'},
                    // {data: 'parent_name', name: 'parent_name'},
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

            $('#btnFiterSubmitSearch').click(function (e) {
                e.preventDefault();
                $('.data-table').DataTable().draw(true);
            })
        });
    </script>

