@extends('layouts.admin')
@section('title')
    مشرفين-اضافة مشرف
@endsection
@section('content-title')
بيانات الخاصة باضافة مشرف
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
                    <h3 class="card-label"> اضافة  مشرف جديدة</h3>
                </div>
            </div>
            <div class="card-body">
		<form id="validate-form" class="row" enctype="multipart/form-data" name="add_suppervisors" method="POST" action="{{route('admin.supervisors.store')}}">
		@csrf

		<div class="col-12 col-lg-12 p-0 main-box">
			<div class="col-12 px-0">

				<div class="col-12 divider" style="min-height: 2px;"></div>
			</div>
			<div class="col-12 p-3">

                <div class="col-12  row">

			<div class="col-6">
				<div class="col-12">
					الاسم الاول:<span style="color: red">*</span>
				</div>
				<div class="col-12 pt-3">
					<input type="text" name="first_name" required minlength="3"  maxlength="190" class="form-control" value="{{old('name')}}" >
				</div>
			</div>

                <div class="col-6">
                    <div class="col-12">
                        الاسم الاخير:<span style="color: red">*</span>
                    </div>
                    <div class="col-12 pt-3">
                        <input type="text" name="last_name" required minlength="3"  maxlength="190" class="form-control" value="{{old('name')}}" >
                    </div>
                </div>
                </div>
			<div class="col-12 p-2">
				<div class="col-12">
                    الايميل الشخصي:<span style="color: red">*</span>

                </div>
				<div class="col-12 pt-3">
					<input type="email" name="email" required class="form-control"  value="{{old('email')}}" >
				</div>
			</div>
			<div class="col-12 p-2">
				<div class="col-12">
                    كلمة المرور:<span style="color: red">*</span>
				</div>
				<div class="col-12 pt-3">
					<input type="password" name="password"  class="form-control" required minlength="8" >
				</div>
			</div>

			<div class="col-12 p-2">
				<div class="col-12">
                    الصورة الشخصية:<span style="color: red">*</span>
				</div>
				<div class="col-12 pt-3">
					<input type="file" name="avatar"  class="form-control"  accept="image/*" >
				</div>
				<div class="col-12 p-0">

				</div>
			</div>

			<div class="col-12 p-2">
				<div class="col-12">
                    رقم الهاتف:<span style="color: red">*</span>

                </div>
				<div class="col-12 pt-3">
					<input type="text" name="phone"   maxlength="190" class="form-control"  value="{{old('phone')}}" >
				</div>
			</div>
			<div class="col-12 p-2">
				<div class="col-12">
                    الصلاحيات:<span style="color: red">*</span>

                </div>
				<div class="col-12 pt-3">
					<select class="form-control" name="role_id">
						<option selected hidden disabled >إختر الصلاحية</option>
@foreach($roles as $role)
                            <option value="{{$role->id}}" >{{$role->name}}</option>

                        @endforeach
					</select>
				</div>
			</div>
			<div class="col-12 p-2">
				<div class="col-12">
					نبذة
				</div>
				<div class="col-12 pt-3">
					<textarea  name="bio" maxlength="5000" class="form-control" style="min-height:150px">{{old('bio')}}</textarea>
				</div>
			</div>
			<div class="col-12 p-2">
				<div class="col-12">
					محظور
				</div>
				<div class="col-12 pt-3">
					<select class="form-control" name="blocked">
						<option @if(old('blocked')=="0") selected @endif value="0">لا</option>
						<option @if(old('blocked')=="1") selected @endif value="1">نعم</option>
					</select>
				</div>
			</div>
			</div>

		</div>

            </div>
            <div class="card-footer">
                <div class="row">
                    <div class="col-lg-12">
                        <button type="submit" class="btn btn-primary font-weight-bold mr-2">تاكيد</button>
                        <button type="reset" class="btn btn-light-primary font-weight-bold">الغاء</button>
                    </div>
                </div>
            </div>
		</form>
	</div>
</div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

<script>

    $(function() {
        $("form[name='add_suppervisors']").validate({
            // Specify validation rules
            rules: {
                // The key name on the left side is the name attribute
                // of an input field. Validation rules are defined
                // on the right side
                first_name: "required",
                last_name: "required",
                password:{
                    required:true,
                    email:true,
                }
,
                phone:"required",
                avatar:"required",
                role_id:"required",



                ignore: 'input[type=hidden], .kt_select2_1',


            },
            // Specify validation error messages

            // Make sure the form is submitted to the destination defined
            // in the "action" attribute of the form when valid
            submitHandler: function(form) {
                form.submit();
            }
        });
    });
</script>
@endsection
