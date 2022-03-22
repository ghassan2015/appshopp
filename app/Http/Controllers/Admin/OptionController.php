<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\OptionRequest;
use App\Models\Attribute;
use App\Models\Option;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class OptionController extends Controller
{
    public function index()
    {
        $attributes = Attribute::get()->sortBy('attribute_id');
        return view('admin.option.option', ['attributes' => $attributes]);
    }

    public function getOption(Request $request)
    {

        $data = Option::get();

        return DataTables::of($data)
            ->addColumn('name', function ($data) {
                return $data->name ??null;
            })
            ->addColumn('attribute_name', function ($data) {
                return $data->attribute->name ??null;
            })
            ->addColumn('action', function ($data) {

                $button = '<a name="edit"   id="' . $data->id . '" name_ar="' . $data->getTranslation('name', 'ar') . '" name_en="' . $data->getTranslation('name', 'en') . '" attribute_id="' . $data->attribute_id . '" class="edit_option"><span><i style="color: #66afe9" class="fas fa-edit"></i></span></a>';

                $button .= '&nbsp;&nbsp;&nbsp;&nbsp;';
                $button .= '<a name="delete" id="' . $data->id . '" attribute_name="' . $data->name . '" class="delete "><span><i  style="color: red" class="fas fa-trash-alt"></i></span></button>';
                $button .= '&nbsp;&nbsp;&nbsp;&nbsp;';
                return $button;
            })->rawColumns(['action'])
            ->make(true);
    }

    public function store(OptionRequest $request)
    {
        try {

            $option = new Option();
            $option->name = ['ar' => $request->option_name_ar, 'en' => $request->option_name_ar];
            $option->attribute_id = $request->attribute_id;
            $option->save();
            toastr()->success('تم إضافة الصفة بنجاح','عملية ناجحة');
            return redirect()->route('admin.option.index');
        } catch (\Exception $ex) {
            toastr()->error('هناك خطا حاول في وقت لاحق','عملية فاشلة');
            return redirect()->route('admin.option.index');
        }

    }

    public function update(OptionRequest $request)
    {

        try {


            $option = Option::find($request->option_id);
            $option->name = ['ar' => $request->option_name_ar, 'en' => $request->option_name_ar];
            $option->attribute_id = $request->attribute_id;
            $option->save();;
            toastr()->success('تم تعديل الصفة بنجاح','عملية ناجحة');
            return redirect()->route('admin.option.index');
        } catch (\Exception $exception) {
            toastr()->error('هناك خطا حاول في وقت لاحق','عملية فاشلة');
            return redirect()->route('admin.option.index');
        }

    }

    public function delete(Request $request)
    {
        try {


            Option::where('id', $request->id)->delete();

            toastr()->success('تم حذف الصفة بنجاح','عملية ناجحة');
            return redirect()->route('admin.option.index');
        } catch (\Exception $exception) {
            toastr()->error('هناك خطا حاول في وقت لاحق','عملية فاشلة');
            return redirect()->route('admin.option.index');
        }
    }
}
