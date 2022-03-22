<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>

<script>

    $(function() {
        $('.category_id').select2({
            dir:'rtl',
        });

        $('#kt_docs_repeater_advanced').repeater({
            initEmpty: false,

            defaultValues: {
                'text-input': 'foo'
            },

            show: function () {
                $(this).slideDown();
                $(this).find('[data-kt-repeater="select2"]').select2();
                new Tagify(this.querySelector('[data-kt-repeater="tagify"]'));
            },

            hide: function (deleteElement) {
                $(this).slideUp(deleteElement);
            },

            ready: function(){
                $('[data-kt-repeater="select2"]').select2();
                new Tagify(document.querySelector('[data-kt-repeater="tagify"]'));
            }
        });


        $("form[name='edit_category']").validate({
            rules: {

                name_ar: "required",
                name_en: "required",
                ignore: 'input[type=hidden], .kt_select2_1',


            },
            // Specify validation error messages
            messages: {
                name_ar:'الرجاء ادخل الاسم باللغة العربية',
                name_en:'الرجاء ادخل الاسم باللغة الانجليزية',

            },
            submitHandler: function(form) {
                form.submit();
            }
        });
    });

    $('.parent_id').hide();
    var parent_id=$('.check_parent_id').val()
    if ($('.check_parent_id').val()){
        $('.select').prop('checked', true);
        $('.parent_id').show();
        $('#parent_id')
            .val(parent_id)
            .trigger('change');

    }else{
        $('.select').prop('checked', false);
        $('.parent_id').hide();

    }

    $(".select").click(function () {
        if ($(this).is(":checked")) {
            $(".parent_id").show();
        } else {
            $(".parent_id").hide();
        }

    });

    $(document).on("change", ".attribute", function () {


        var attribute_id = $(this).val();
        let option_id=$(this).parent().parent().find('.option_id');
        if (attribute_id) {

            $.ajax({
                url: "{{ URL::to('ar/admin/categories/getOption') }}/" + attribute_id,
                type: "GET",
                dataType: "json",
                success: function (data) {
                    (option_id).empty();
                    $.each(data, function (key, value) {

                        $(option_id).append('<option value="' + key + '">' + value + '</option>');
                    });
                },
            });
        } else {
            console.log('AJAX load did not work');
        }
    });
    $(document).on('click', '.delete', function (e) {
        var id = $(this).attr('data-id');
        var category_id = $(this).attr('data-category_id');
        $('#Delete_id').val(id);
        $('#category_id').val(category_id);

        $('#confirmModal').modal('show')
    });
</script>
