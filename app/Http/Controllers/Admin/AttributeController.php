<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AttributeRequest;
use App\Models\Attribute;
use App\Models\Option;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Yajra\DataTables\DataTables;

class AttributeController extends Controller
{
    public function index()
    {
        return view('admin.attribute.attribute');
    }

    public function getAttribute(Request $request)
    {



        $data = Attribute::get();



        return DataTables::of($data)
            ->addColumn('name', function ($data) {
                return $data->name;
            })
            ->addColumn('action', function ($data) {

                $button = '<a name="edit"   id="' . $data->id . '" name_ar="' . $data->getTranslation('name', 'ar') . '" name_en="' . $data->getTranslation('name', 'en') . '" class="edit_attribute"><span><i style="color: #66afe9" class="fas fa-edit"></i></span></a>';

                $button .= '&nbsp;&nbsp;&nbsp;&nbsp;';
                $button .= '<a name="delete" id="' . $data->id . '" attribute_name="' . $data->name . '" class="delete "><span><i  style="color: red" class="fas fa-trash-alt"></i></span></button>';
                $button .= '&nbsp;&nbsp;&nbsp;&nbsp;';
                return $button;
            })->rawColumns(['action'])
            ->make(true);
    }
    public function store(AttributeRequest $request)
    {
        try {

            $attribute = new Attribute();
            $attribute->name = ['ar' => $request->attribute_name_ar, 'en' => $request->attribute_name_en];
            $attribute->save();
            toastr()->success('تم إضافة السمة بنجاح','عملية ناجحة');
            return redirect()->route('admin.attribute.index');
        } catch (\Exception $ex) {
            toastr()->error('هناك خطا حاول في وقت لاحق','عملية فاشلة');
            return redirect()->route('admin.attribute.index');
        }
    }
    public function update(Request $request)
    {

        try {
            $attribute = Attribute::find($request->attribute_id);
            $attribute->name = ['ar' => $request->attribute_name_ar, 'en' => $request->attribute_name_en];
            $attribute->save();
            toastr()->success('تم تعديل السمة بنجاح','عملية ناجحة');
            return redirect()->route('admin.attribute.index');
        } catch (\Exception $exception) {
            toastr()->error('هناك خطا حاول في وقت لاحق','عملية فاشلة');
            return redirect()->route('admin.attribute.index');
        }

    }
    public function delete(Request $request)
    {
        try {

            $child_attribute=Option::where('attribute_id',$request->id)->get();
            if ($child_attribute->count()==0){
            Attribute::find($request->id)->delete();
                toastr()->success('تم حذف السمة بنجاح','عملية ناجحة');
                return redirect()->route('admin.attribute.index');
                }
            else{
                toastr()->error('هناك خطا حاول في وقت لاحق','عملية فاشلة');
                return redirect()->route('admin.attribute.index');

            }





        } catch (\Exception $exception) {
            toastr()->error('هناك خطا حاول في وقت لاحق','عملية فاشلة');
            return redirect()->route('admin.attribute.index');
        }
    }
}
