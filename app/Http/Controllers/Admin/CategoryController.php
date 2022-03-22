<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\CategoryRequest;
use App\Models\Attribute;
use App\Models\Category;
use App\Models\Option;
use App\Models\ProbabilityOption;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use Yajra\DataTables\DataTables;

class CategoryController extends Controller
{


    public function index()
    {
        $categories = Category::get();
        return view('admin.categories.index', compact('categories'));
    }

    public function getCategory(Request $request)
    {
        $data = Category::query();
        if ($request->input('category_id')) {
            $data = $data->where("parent_id", $request->input('category_id'));
        }
        if ($request->input('name')) {

            $data = $data->where('name', 'LIKE', '%' . $request->input('name') . '%');
        }

        return DataTables::of($data)
            ->addColumn('name', function ($data) {
                return $data->name;
            })
            ->addColumn('status', function ($data) {
                if ($data->status_cd == 8) {
                    return 'فعال';
                } else {
                    return 'غير فعال';
                }
//                return $data->category_status_cd->status_cd;
            })
            ->addColumn('parent_name', function ($data) {
                if (!is_null($data->parent)) {
                    return $data->parent->name;
                } else {
                    return '';
                }
            })
            ->addColumn('action', function ($data) {


                $button = '<a    image="' . $data->image . '" id="' . $data->id . '" name_ar="' . $data->getTranslation('name', 'ar') . '" name_en="' . $data->getTranslation('name', 'en') . '" parent_id="' . $data->parent_id . '" status="' . $data->status_cd . '" image="' . $data->image . '" href="' . route('admin.categories.edit', $data->id) . '" class="edit_category"><span><i style="color: #66afe9" class="fas fa-edit"></i></span></a>';

                $button .= '&nbsp;&nbsp;&nbsp;&nbsp;';
                $button .= '<a  id="' . $data->id . '" category_id="' . $data->category_id . '" category_name="' . $data->name . '" class="delete "><span><i  style="color: red" class="fas fa-trash-alt"></i></span></button>';
                $button .= '&nbsp;&nbsp;&nbsp;&nbsp;';

                return $button;

            })->rawColumns(['action'])
            ->make(true);
    }


    public function create()
    {
        $data['categories'] = Category::get();
        $data['attributes'] = Attribute::get();
        return view('admin.categories.create', $data);
    }
    public function store(CategoryRequest $request)
    {


        try {
            if ($request->status) {

                $status_cd = config('app.status_cd_active');
            } else {
                $status_cd = config('app.status_cd_disable');
            }

            if ($request->hasFile('image')) {

                $image = uploadImage('categories', $request->file('image'));
            }

            $category = Category::create([
                'user_id' => auth()->user()->id,
                "slug" => ['ar' => $this->slug($request->name_ar), 'en' => Str::slug($request->name_ar)],
                "name" => ['ar' => $request->name_ar, 'en' => $request->name_en],
                "description" => $request->description,
                "parent_id" => $request->parent_id ?? 0,
                "meta_description" => $request->meta_description,
                "image" => $image,
                "status_cd" => $status_cd,
            ]);

            foreach ($request->group as $key => $option) {

                $category->option()->attach($option['option_id']);
            }

            $data['options'] = Category::find($category->id)->option;
            $array = [];
            $option_id = [];
            foreach ($data['options'] as $key => $option) {
                $first_id = $data['options'][0]->attribute->id;
                $second_id = $data['options'][1]->attribute->id;
                $option_id[$option->attribute->id][] = $option->id;
            }
            foreach ($option_id as $key => $value) {
                array_push($array, $value);
            }
            foreach ($this->combinations($array) as $value) {

                ProbabilityOption::create([
                    'category_id' => $category->id,
                    'option_id' => $value,
                ]);
            }
            toastr()->success('تم إضافة الخدمة بنجاح', 'عملية ناجحة');
            return redirect()->route('admin.categories.edit', $category->id);
        } catch (\Exception $exception) {
            toastr()->error('لم يتم إضافة الخدمة بنجاح', 'عملية فاشلة');
            return redirect()->route('admin.categories.create');

        }
    }


    public function edit($id)
    {
        $data['category'] = Category::find($id);
        $data['categories'] = Category::get();
        $data['options'] = Option::get();
        return view('admin.categories.edit', $data);
    }


    public function update(Request $request)
    {
        $request->validate([
            'name_ar' => "required|max:190",
            'description' => "nullable|max:10000",
            'name_en' => "required|max:190",
            'meta_description' => "nullable|max:10000",

        ]);
        if ($request->status) {

            $status_cd = config('app.status_cd_active');
        } else {
            $status_cd = config('app.status_cd_disable');
        }
        $category = Category::find($request->category_id);
        if ($request->hasFile('image')) {
            $image = uploadImage('categories', $request->file('image'));
        } else {
            $image = $category->image;
        }

        if ($request->has('parent_id')) {
            $patent_id = $request->parent_id;
        } else {
            $patent_id = null;
        }
        $category->update([
            "slug" => ['ar' => $this->slug($request->name_ar), 'en' => Str::slug($request->name_en)],
            "name" => ['ar' => $request->name_ar, 'en' => $request->name_en],
            "description" => $request->description,
            "parent_id" => $patent_id,
            "meta_description" => $request->meta_description,
            "image" => $image,
            "status_cd" => $status_cd,

        ]);

        $price = $request->input("price");

        if (isset($request->id)) {

            foreach ($request->id as $key => $id) {
                $probability = ProbabilityOption::find($id);
                $probability->update([
                    'price' => $price[$key],
                ]);
            }
        }

        toastr()->success('تم تحديث الخدمة بنجاح', 'عملية ناجحة');
        return redirect()->route('admin.categories.index');

    }


    public function delete(Request $request)
    {
        try {
            $child_category = Category::where('parent_id', $request->id)->get();
            if ($child_category->count() == 0) {
                Category::find($request->id)->delete();
                toastr()->success('تم حذف الخدمة بنجاح', 'عملية ناجحة');
                return redirect()->route('admin.categories.index');
            } else {

                toastr()->error('لم يتم حذف الخدمة بسبب وجود خدمات اخرى تندرح تحته', 'عملية فاشلة');
                return redirect()->route('admin.categories.index');
            }


        } catch (\Exception $exception) {
            notify()->error('لم يتم حذف الخدمة بنجاح', 'عملية فاشلة');
            return redirect()->route('category.index');
        }
    }

    public function slug($string, $separator = '-')
    {
        if (is_null($string)) {
            return "";
        }

        $string = trim($string);

        $string = mb_strtolower($string, "UTF-8");;

        $string = preg_replace("/[^a-z0-9_\sءاأإآؤئبتثجحخدذرزسشصضطظعغفقكلمنهويةى]#u/", "", $string);

        $string = preg_replace("/[\s-]+/", " ", $string);

        $string = preg_replace("/[\s_]/", $separator, $string);

        return $string;
    }

    public function getOption($id)
    {

        $ids = str_replace(',', '', $id);
        $attributes_id = str_split($ids);
        $data = Option::whereIn("attribute_id", $attributes_id)->pluck('name', 'id');
        return $data;

    }

    public function deleteOption(Request $request)
    {
        try {
            ProbabilityOption::find($request->id)->delete();
            toastr()->success(' تمت عملية حذف الخدمة بنجاح', 'عملية ناجحة');
            return redirect()->route('admin.categories.edit', $request->category_id);

        } catch (\Exception $exception) {
            toastr()->error('لم يتم حذف الخدمة بنجاح', 'عملية فاشلة');
            return redirect()->route('category.index');
        }
    }


    function combinations($arrays, $i = 0)
    {
        if (!isset($arrays[$i])) {
            return array();
        }
        if ($i == count($arrays) - 1) {
            return $arrays[$i];
        }

        // get combinations from subsequent arrays
        $tmp = $this->combinations($arrays, $i + 1);

        $result = array();

        // concat each array from tmp with each element from $arrays[$i]
        foreach ($arrays[$i] as $v) {
            foreach ($tmp as $t) {
                $result[] = is_array($t) ?
                    array_merge(array($v), $t) :
                    array($v, $t);
            }
        }

        return $result;

    }


}
