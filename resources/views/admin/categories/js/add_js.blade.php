<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

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

                var $this = $(this);

                $(this).slideDown();

                // Re-init select2
                $(this).find('[data-kt-repeater="select2"]').select2();
                var sels = $this.prevUntil("form.repeater").find(".attribute option:selected");
                sels.each(function(e,v){
                    $this.find("select option[value='"+v.value+"']").remove();
                });
                // Re-init flatpickr
                // $(this).find('[data-kt-repeater="datepicker"]').flatpickr();

                // Re-init tagify
                new Tagify(this.querySelector('[data-kt-repeater="tagify"]'));
            },

            hide: function (deleteElement) {
                $(this).slideUp(deleteElement);
            },

            ready: function(){
                // Init select2
                $('[data-kt-repeater="select2"]').select2();

                // Init flatpickr
                // $('[data-kt-repeater="datepicker"]').flatpickr();

                // Init Tagify
                new Tagify(document.querySelector('[data-kt-repeater="tagify"]'));
            }
        });

        // Initialize form validation on the registration form.
        // It has the name attribute "registration"
        $("form[name='add_category']").validate({
            // Specify validation rules
            rules: {
                // The key name on the left side is the name attribute
                // of an input field. Validation rules are defined
                // on the right side
                name_ar: "required",
                name_en: "required",
                image:"required",
                ignore: 'input[type=hidden], .kt_select2_1',


            },
            // Specify validation error messages
            messages: {
                name_ar:'الرجاء ادخل الاسم باللغة العربية',
                name_en:'الرجاء ادخل الاسم باللغة الانجليزية',
                image:'الرجاء ادحل الصورة الخاصة بالخدمة'
            },
            // Make sure the form is submitted to the destination defined
            // in the "action" attribute of the form when valid
            submitHandler: function(form) {
                form.submit();
            }
        });
    });

    $(".parent_id").hide();


    $(function () {

        $(".select").click(function () {
            if ($(this).is(":checked")) {
                $(".parent_id").show();
            } else {
                $(".parent_id").hide();
            }

        });
    });




</script>
