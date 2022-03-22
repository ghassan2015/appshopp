{{--<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>--}}
<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
<script>
    $(document).ready(function (){

        $('.category_id').select2({
            dir:'rtl',
        });
        $(document).on('click', '.edit_category', function () {
            $('#edit_Category_modal').modal('show');                // your code goes here
            var Name_ar = $(this).attr('name_ar');
            $('#edit_category_name_ar').val(Name_ar);
            var Name_en = $(this).attr('name_en');
            $('#edit_category_name_en').val(Name_en);
            var category_id = $(this).attr('id');
            $('#edit_category_id').val(category_id);
            var status = $(this).attr('status');
            if (status){
                $('#status').prop('checked', true);
                $('#status').val(1);
            }else{
                $('#status').prop('checked', false);
                $('#status').val(0);
            }

            var image = $(this).attr('image');
            var url='assets/images/categories/'+image;

            var APP_URL = {!! json_encode(url('/')) !!}
                _url=APP_URL+'/'+url;
            $('#image_preview').attr('src',_url);

            var parent_id = $(this).attr('parent_id');

            if (parent_id){
                $('.check_parent').prop('checked', true);
                $('.parent_category').show();
                $('#parent_id')
                    .val(parent_id)
                    .trigger('change');

            }else{
                $('.check_parent').prop('checked', false);
                $('.parent_category').hide();

            }

        });



        $(document).on('click', '.delete', function (e) {
            var $id = $(this).attr('id');
            var category_name = $(this).attr('category_name');
            $('#Delete_id').val($id);
            $('#Name_Delete').val(category_name);
            $('#confirmModal').modal('show')
        });
        $('.check_parent').on('change',function (){
            if ($(this).is(":checked")){
                $('.parent_category').show();
            }else{
                $('.parent_category').hide();
            }
        });



        table = $('.data-table').DataTable({
            processing: true,
            serverSide: true,

            searching: false,
            ajax: {
                url: "{{route('admin.categories.getCategory')}}",
                type: 'GET',
                "data": function (d) {
                    d.category_id = $('#category_id').val();
                    d.name = $('#name').val();
                },
            },

            columns: [
                {data: 'name', name: 'name'},
                {data: 'parent_name', name: 'parent_name'},
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
        $('.select_categories').hide();
        $('input[type="checkbox"]').on('change',function(){
            if ($(this).is(":checked")){
                $('.select_categories').show();
            }else{
                $('.select_categories').hide();
            }

        });

        if ($(".kt_select2_1").val() ) {
            $('.select_categories').show();
            $('input[type=checkbox]').prop('checked', true);
        }else{
            $('.select_categories').hide();
            $('input[type=checkbox]').prop('checked', false);

        }


    });

</script>

