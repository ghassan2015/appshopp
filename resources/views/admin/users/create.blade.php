@extends('layouts.admin')
@section('title')
    المستخدمين-اضافة مستخدم
@endsection
@section('content-title')
    بيانات الخاصة باضافة مستخدم
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
                        <h3 class="card-label"> اضافة  مستخدم جديدة</h3>
                    </div>
                </div>
                <div class="card-body">
		<form id="validate-form" class="row" enctype="multipart/form-data" method="POST" action="{{route('admin.users.store')}}">
		@csrf

		<div class="col-12 col-lg-12 p-0 main-box">
			<div class="col-12 px-0">

				<div class="col-12 divider" style="min-height: 2px;"></div>
			</div>
			<div class="col-12 p-3">

                <div class="col-12  row">

                    <div class="col-12 col-lg-6 p-2">
                        <div class="col-12">
                            الاسم باللغة العربية
                        </div>
                        <div class="col-12 pt-3">
                            <input type="text" name="name_ar" required   maxlength="190" class="form-control" value="{{old('name_ar')}}" >
                        </div>
                    </div>
                    <div class="col-12 col-lg-6 p-2">
                        <div class="col-12">
                            الاسم  باللغة الانجليزية
                        </div>
                        <div class="col-12 pt-3">
                            <input type="text" name="name_en" required   maxlength="190" class="form-control" value="{{old('name_en')}}" >
                        </div>
                    </div>

                </div>
			<div class="col-12 p-2">
				<div class="col-12">
					الايميل
				</div>
				<div class="col-12 pt-3">
					<input type="email" name="email" required class="form-control"  value="{{old('email')}}" >
				</div>
			</div>
			<div class="col-12 p-2">
				<div class="col-12">
					كلمة المرور
				</div>
				<div class="col-12 pt-3">
					<input type="password" name="password"  class="form-control" required minlength="8" >
				</div>
			</div>

			<div class="col-12 p-2">
				<div class="col-12">
					الصورة الشخصية
				</div>
				<div class="col-12 pt-3">
					<input type="file" name="avatar"  class="form-control"  accept="image/*" >
				</div>
				<div class="col-12 p-0">

				</div>
			</div>

			<div class="col-12 p-2">
				<div class="col-12">
					الهاتف
				</div>
				<div class="col-12 pt-3">
					<input type="text" name="phone"   maxlength="190" class="form-control"  value="{{old('phone')}}" >
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


                <div class="col-12 col-lg-6 p-2"  >
                    <div class="col-12">
                        اسم المهارة
                    </div>
                    <div class="col-12 pt-3">
                        <select class="form-control select2" id="kt_select2_3" name="skill_id[]" multiple="multiple">

                            <option value="">اختر المهارة</option>
                            @foreach($skills as $skill)
                                <option value="{{$skill->id}}">{{$skill->name}}</option>
                            @endforeach
                        </select>


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

		<div class="col-12 p-3">
			<button class="btn btn-success" id="submitEvaluation">حفظ</button>
		</div>
		</form>
	</div>
</div>
        </div>
    </div>

@endsection
