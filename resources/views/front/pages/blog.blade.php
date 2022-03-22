@extends('layouts.app',['page_title'=>"المدونة"])
@section('content')
<div class="col-12 p-0">
	<div class=" p-0 container">
		<div class="col-12 p-2 p-lg-3 row">
			<div class="col-12 px-2 pt-5 pb-3">
			    <div class="col-12 p-0 font-4">
			        <span class="start-head"></span> المدونة
			    </div>
			    <div class="col-12 p-0 mt-1" style="opacity: .7;">
			        نشارك أحدث المواضيع والمقالات
			    </div>
			</div>

                <div class="col-lg-12 form-group row ">


                    <div class="col-lg-3">



                        <label>الاقسام</label>


                        <select class="form-control  col-lg-12 category_id" name="category_id" >
                            <option value=''>اختر</option>
                                                        @foreach($categories as $category)
                                                            <option value="{{$category->id}}">{{$category->name}}</option>
                                                        @endforeach
                        </select>
                    </div>

                    <div class="col-lg-3">



                        <label>السمات</label>


                        <select class="form-control  col-lg-12 attribute" name="attribute_id" >
                            <option value=''>اختر</option>
{{--                            @foreach($attributes as $attribute)--}}
{{--                                <option value="{{$attribute->id}}">{{$attribute->name}}</option>--}}
{{--                            @endforeach--}}
                        </select>
                    </div>
                    <div class="col-lg-3">

                        <label>الصفات</label>
                        <select class="form-control col-lg-12 option_id" name="option_id" >
                            <option value=''>اختر</option>
                        </select>
                    </div>


                    <div class="col-lg-3">

                        <label>السعر</label>
                        <input type="text" name="price" class="form-control price" placeholder=""  />

                    </div>
                    <div class="col-lg-3">

                    </div>
                </div>

            <div class="col-lg-3">


                <div class="summary entry-summary">
                    <h1 class="product_title entry-title">{{$category->name}}</h1>
                    <form class="variations_form cart" action="" method="post" enctype='multipart/form-data' data-product_id="16006" data-product_variations="false">

                        @foreach($attributes as $attriute)
                            {{$attriute->name}}

                        <div>
                            <select name="option_id" class="option_price">
                                @foreach($attriute->option as $option)

                                    <option value="{{$option->id}}">{{$option->name}}</option>
                                @endforeach
                            </select>
                            <input class="total" type="text" >
                            <input class="total_v2" type="text" >

                        </div>

                            <br>
                            <hr>
                            @endforeach
                            </tbody>
                            </table>






                    </form>


                </div>
            </div>



		</div>
	</div>
</div>
@endsection
