@extends('layouts.admin')
@section('title')
    مشاريع-اضافة مشروع
@endsection
@section('content-title')
    بيانات الخاصة باضافة مشروع
@endsection
@section('content')
    <div class="col-12 p-3">
        <div class="col-12 col-lg-12 p-0 ">
            <div class="card card-custom">
                <div class="card-header">
                    <div class="card-title">
                    <span class="card-icon">
                        <i class="flaticon2-heart-rate-monitor text-primary"></i>
                    </span>
                        <h3 class="card-label"> اضافة مشروع جديدة</h3>
                    </div>
                </div>

                <div class="card-body">
                <form id="validate-form" class="row" enctype="multipart/form-data" method="POST" action="{{route('admin.projects.store')}}">
                @csrf

                <div class="col-12 col-lg-12 p-0 main-box">
                    <div class="col-12 px-0">

                        <div class="col-12 divider" style="min-height: 2px;"></div>
                    </div>
                    <div class="col-12 p-3 row">

                        <div class="col-12 col-lg-6 p-2">
                            <div class="col-12">
                                الاسم باللغة العربية <span style="color: red">*</span>
                            </div>

                            <div class="col-12 pt-3">
                                <input type="text" name="name_ar" required   maxlength="190" class="form-control" value="{{old('name_ar')}}" >
                            </div>
                        </div>
                        <div class="col-12 col-lg-6 p-2">
                            <div class="col-12">
                                الاسم  باللغة الانجليزية <span style="color: red">*</span>
                            </div>
                            <div class="col-12 pt-3">
                                <input type="text" name="name_en" required   maxlength="190" class="form-control" value="{{old('name_en')}}" >
                            </div>
                        </div>
                        <div class="col-12 col-lg-6 p-2">
                            <div class="col-12">
                                تفاصيل المشروع  باللغة العربية <span style="color: red">*</span>
                            </div>
                            <div class="col-12 pt-3">
                                <textarea class="summernote" name="description_ar">{{old('description_ar')}}</textarea>
                            </div>
                        </div>
                        <div class="col-12 col-lg-6 p-2">
                            <div class="col-12">
                                تفاصيل المشروع  باللغة   الانجليزية <span style="color: red">*</span>
                            </div>
                            <div class="col-12 pt-3">
                                <textarea class="summernote" name="description_en">{{old('description_en')}}</textarea>
                            </div>
                        </div>
                        <div class="col-12 col-lg-6 p-2">
                            <div class="col-12">
                                الراتب المتوقع <span style="color: red">*</span>
                            </div>

                            <div class="col-12 pt-3">
                                <select class="form-control"  name="budget">

                                    <option value="">اختر </option>
                                    @foreach($sallary as $sallary)
                                        <option value="{{$sallary->id}}">{{$sallary->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-12 col-lg-6 p-2">
                            <div class="col-12">
                                عدد الايام المتوقعة <span style="color: red">*</span>
                            </div>
                            <div class="col-12 pt-3">
                                <input type="text" name="duration" required   maxlength="190" class="form-control" value="{{old('date')}}" >
                            </div>
                        </div>
                        <div class="col-12 col-lg-6 p-2"  >
                            <div class="col-12">
                                اسم المهارة
                            </div>
                            <div class="col-12 pt-3">
                                <select class="form-control select2" id="kt_select2_3" name="skill_id[]" multiple="multiple">

                                    <option value="">اختر المهارة</option>
                                    @foreach($Skills as $skill)
                                        <option value="{{$skill->id}}">{{$skill->name}}</option>
                                    @endforeach
                                </select>


                            </div>
                        </div>
                        <div class="col-12 col-lg-6 p-2">
                                <div class="col-12">
                                    عدد الايام المتوقعة <span style="color: red">*</span>
                                </div>
                            <div class="col-lg-4 col-md-9 col-sm-12">
                                <input type="file" name="filenames[]" multiple class="myfrm form-control">

                            </div>
                        </div>
                        </div>
                    </div>

                    </div>

</div>

                <div class="card-footer">
                    <div class="row">
                        <div class="col-lg-12">
                            <button type="submit" class="btn btn-primary font-weight-bold mr-2">تاكيد</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
        <script src="{{asset('assets/js/pages/crud/file-upload/dropzonejs.js')}}"></script>
<script>
    var uploadedDocumentMap = {}
    if (document.getElementsByClassName('dropzone-primary')) {

        window.onload = function () {

            Dropzone.options.dpzMultipleFiles = {
                paramName: "dzfile", // The name that will be used to transfer the file
                //autoProcessQueue: false,
                maxFilesize: 5, // MB
                clickable: true,
                addRemoveLinks: true,
                acceptedFiles: 'image/*',
                dictFallbackMessage: " المتصفح الخاص بكم لا يدعم خاصيه تعدد الصوره والسحب والافلات ",
                dictInvalidFileType: "لايمكنك رفع هذا النوع من الملفات ",
                dictCancelUpload: "الغاء الرفع ",
                dictCancelUploadConfirmation: " هل انت متاكد من الغاء رفع الملفات ؟ ",
                dictRemoveFile: "حذف الصوره",
                dictMaxFilesExceeded: "لايمكنك رفع عدد اكثر من هضا ",
                headers: {
                    'X-CSRF-TOKEN':
                        "{{ csrf_token() }}"
                }
                ,
                {{--url: "{{ route('admin.products.images.store') }}", // Set the url--}}
                success:
                    function (file, response) {
                        $('form').append('<input type="hidden" name="document[]" value="' + response.name + '">')
                        uploadedDocumentMap[file.name] = response.name
                    }
                ,
                removedfile: function (file) {
                    file.previewElement.remove()
                    var name = ''
                    if (typeof file.file_name !== 'undefined') {
                        name = file.file_name
                    } else {
                        name = uploadedDocumentMap[file.name]
                    }
                    $('form').find('input[name="document[]"][value="' + name + '"]').remove()
                }
                ,
                // previewsContainer: "#dpz-btn-select-files", // Define the container to display the previews
                init: function () {
                    @if(isset($event) && $event->document)
                    var files =
                        {!! json_encode($event->document) !!}
                        for(
                    var i
                in
                    files
                )
                    {
                        var file = files[i]
                        this.options.addedfile.call(this, file)
                        file.previewElement.classList.add('dz-complete')
                        $('form').append('<input type="hidden" name="document[]" value="' + file.file_name + '">')
                    }
                    @endif
                }
            }
        }
    }

</script>
@endsection

