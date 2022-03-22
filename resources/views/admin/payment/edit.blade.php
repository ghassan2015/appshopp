@extends('layouts.admin')
@section('title')
    المستخدمين-تعديل مستخدم
@endsection
@section('content-title')
    بيانات الخاصة بتعديل المستخدم
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
                        <h3 class="card-label"> تعديل
                            المستخدم</h3>
                    </div>
                </div>
                <div class="card-body">


                <form id="validate-form" class="row" enctype="multipart/form-data" method="POST" action="{{route('admin.users.update',$user->id)}}">
		@csrf
		@method("PUT")
		<div class="col-12 col-lg-12 p-0 main-box">
			<div class="col-12 px-0">

				<div class="col-12 divider" style="min-height: 2px;"></div>
			</div>
			<div class="col-12 p-3">


                <div class="col-12  row">

                    <div class="col-6">
                        <div class="col-12">
                            الاسم الاول
                        </div>
                        <div class="col-12 pt-3">
                            <input type="text" name="first_name" required minlength="3"  maxlength="190" class="form-control" value="{{$user->first_name}}" >
                        </div>
                    </div>

                    <div class="col-6">
                        <div class="col-12">
                            الاسم الاول
                        </div>
                        <div class="col-12 pt-3">
                            <input type="text" name="last_name" required minlength="3"  maxlength="190" class="form-control" value="{{$user->last_name}}" >
                        </div>
                    </div>
                </div>			<div class="col-12 p-2">
				<div class="col-12">
					البريد
				</div>
				<div class="col-12 pt-3">
					<input type="email" name="email"  class="form-control"  value="{{$user->email}}" >
				</div>
			</div>
			<div class="col-12 p-2">
				<div class="col-12">
					كلمة المرور
				</div>
				<div class="col-12 pt-3">
					<input type="password" name="password"  class="form-control"  minlength="8" >
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
					<img src="{{$user->getUserAvatar()}}" style="width:100px;margin-top:20px">
				</div>
			</div>

			<div class="col-12 p-2">
				<div class="col-12">
					الهاتف
				</div>
				<div class="col-12 pt-3">
					<input type="text" name="phone"   maxlength="190" class="form-control"  value="{{$user->phone}}" >
				</div>
			</div>

			<div class="col-12 p-2">
				<div class="col-12">
					نبذة
				</div>
				<div class="col-12 pt-3">
					<textarea  name="bio" maxlength="5000" class="form-control" style="min-height:150px">{{$user->bio}}</textarea>
				</div>
			</div>
			<div class="col-12 p-2">
				<div class="col-12">
					محظور
				</div>
				<div class="col-12 pt-3">
					<select class="form-control" name="blocked">
						<option @if($user->blocked=="0") selected @endif value="0">لا</option>
						<option @if($user->blocked=="1") selected @endif value="1">نعم</option>
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
