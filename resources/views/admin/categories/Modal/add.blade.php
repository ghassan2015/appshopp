<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true" >
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title" id="exampleModalLabel">@lang('admin.Add Category')</h1>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><h5 style="color: #0c0e1a">&times;</h5></span>
                </button>
            </div>

            <form class="needs-validation" id="form" novalidate action="{{route('store_category')}}" method="post"
                  enctype="multipart/form-data"
            >

                <div class="modal-body">
                    @csrf

                    <div class="form-group row">
                        <div class="col-lg-6 col-sm-12">

                            <label for="category_name_ar">
                                <h4>   @lang('admin.name_ar')
                                    <span class="text-danger">*</span>
                                </h4>



                            </label>
                            <input type="text" name="category_name_ar" class="form-control" id="category_name_ar"
                                   aria-describedby="emailHelp" placeholder="" required>
                            <div class="invalid-feedback">
                                @lang('admin.name_ar')
                            </div>
                            <small id="emailHelp" class="form-text text-muted"></small>
                        </div>
                        <div class="col-lg-6 col-sm-12">
                            <label for="category_name_en">
                                <h4>   @lang('admin.name_en')
                                    <span class="text-danger">*</span>
                                </h4>

                            </label>
                            <input type="text" name="category_name_en" class="form-control" id="category_name_en"
                                   placeholder="" required>
                            <div class="invalid-feedback">
                                @lang('admin.name_en')
                            </div>
                        </div>



                    </div>

                    <div class="form-group row">
                        <div class="col-lg-6 col-sm-12">
                            <label for="image">
                                <h4>   @lang('admin.Images')
                                    <span class="text-danger">*</span>
                                </h4>

                            </label>
                            <input class="form-control image" type="file" name="avatar" id="example-tel-input">
                            <div class="invalid-feedback">
                                @lang('admin.image')
                            </div>
                        </div>


                        <div class="w-50 text-center">


                            <img src="{{ asset('assets/images/img1.jpg') }}" style="width: 100px"
                                 class="img-thumbnail image-preview" alt="">

                        </div>

                    </div>

                    <div class="form-group row">

                        <div class="col-lg-6 ">
                            <label class="col-form-label">
                                <h4>@lang('admin.is category Parent')</h4></label>
                            <div class="col-6">
                            <span class="switch switch-icon">
                                <label>
                                    <input type="checkbox" value="1" class="check_parent"   />
                                    <span></span>
                                </label>
                            </span>
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-12 parent_category" style="display: none">

                            <label class="col-form-label"><h4>@lang('admin.parent_category')</h4></label>
                            <div class="col-lg-12 col-sm-12">
                                <select class="form-control kt_select2_1" name="parent_category">

                                    <option value="">@lang('admin.select category')</option>
                                    @foreach($categories as $category)
                                        <option value="{{$category->id}}">{{$category->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                    </div>

                    <div class="form-group row">

                        <div class="col-lg-6 ">
                            <label class="col-form-label"><h4>@lang('admin.status')</h4></label>
                            <div class="col-6">
                            <span class="switch switch-icon">
                                <label>
                                    <input type="checkbox" value="1" checked="checked"/>
                                    <span></span>
                                </label>
                            </span>
                            </div>
                        </div>
                    </div>



                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary"><span><i class="fa fa-paper-plane"
                                                                               aria-hidden="true"></i></span>
                           @lang('admin.submit')

                        </button>

                        <button type="button" class="btn btn-secondary" data-dismiss="modal"><i
                                class="fa fa-window-close" aria-hidden="true"></i>
                            @lang('admin.cancel')
                        </button>
                    </div>
            </form>
        </div>
        </div>
    </div>
</div>
