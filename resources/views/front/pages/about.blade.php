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


                    <div class="summary entry-summary">
    <h1 class="product_title entry-title">{{$category->name}}</h1>
    <form class="variations_form cart" action="" method="post" enctype='multipart/form-data' data-product_id="16006" data-product_variations="false">

        @foreach($attributes as $attriute)
            {{$attriute->name}}
        <div>
        <select name="option_id" class="option_price">
            <option value="">اختر قيمة</option>

        @foreach($attriute->option as $key=>$option)
<option value="{{$option->id}}">{{$option->name}}</option>
            @endforeach
        </select>
<input value="{{$attriute->id}}" type="hidden">
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
    </div>
@endsection
