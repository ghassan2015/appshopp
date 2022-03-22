<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Skill;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Yajra\DataTables\DataTables;

class SkillController extends Controller
{
    public function index(Request $request)
    {


        return view('admin.skills.index');
    }

    public function getSkills(Request $request){
        $data = Skill::query();
        if ($request->input('email')) {
            $data = $data->where("email", $request->input('email'));
        }
        if ($request->input('category_id')) {
            $data = $data->where("category_id", $request->input('category_id'));
        }

        return DataTables::of($data)
            ->addColumn('name', function ($data) {
                return $data->first_name.' '.$data->name;
            })
            ->addColumn('category', function ($data) {
                return $data->category->name??null;

            })

            ->addColumn('status', function ($data) {
                if ($data->status==8){
                    return ' فعال';
                }else{
                    return ' غير فعال';
                }

            })
            ->addColumn('action', function ($data) {


                $button = '<a    href="'.route('admin.skills.edit',$data->id).'" ><span><i style="color: #66afe9" class="fas fa-edit"></i></span></a>';

                $button .= '&nbsp;&nbsp;&nbsp;&nbsp;';
                $button .= '<a  id="' . $data->id . '"  skill_name="' .$data->name . '" class="delete "><span><i  style="color: red" class="fas fa-trash-alt"></i></span></button>';
                $button .= '&nbsp;&nbsp;&nbsp;&nbsp;';

                return $button;

            })->rawColumns(['action'])
            ->make(true);
    }

    public function create()
    {
        $data['categories'] = Category::get();
        return view('admin.skills.create', $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name_ar' => "required|max:190",
            'name_en' => "required|max:190",
        ]);
        try {
            foreach ($request->input('category_id') as $value) {

                $skill = new Skill();
                $skill->category_id = $value;
                $skill->name = ['ar' => $request->name_ar, 'en' => $request->name_en];
                $skill->save();

            }


            toastr()->success('تم إضافة المهارة بنجاح', 'عملية ناجحة');
            return redirect()->route('admin.skills.index');

        } catch (\Exception $exception) {
            notify()->error('لم تم إضافة المهارة بنجاح', 'عملية فاشلة');
            return redirect()->route('admin.skills.index');

        }

    }

    public function edit($id)
    {
        $data['categories'] = Category::get();
        $data['skill'] = Skill::findorfail($id);
        return view('admin.skills.edit', $data);

    }

    public function update(Request $request)
    {
        $request->validate([
            'name_ar' => "required|max:190",
            'name_en' => "required|max:190",
            'category_id'=>'required'
        ]);
         $skill = Skill::find($request->id);
        $skill->category_id = $request->category_id;
        $skill->name = ['ar' => $request->name_ar, 'en' => $request->name_en];
        $skill->save();
        toastr()->success('تم إضافة المهارة بنجاح', 'عملية ناجحة');
        return redirect()->route('admin.skills.index');
    }

    public function delete(Request $request)
    {
        try {


            Skill::find($request->id)->delete();
            toastr()->success('تم حذف المهارة بنجاح', 'عملية ناجحة');
            return redirect()->back();


        } catch (\Exception $exception) {
            notify()->error('لم تم حذف المهارة بنجاح', 'عملية فاشلة');
            return redirect()->back();

        }
    }
}
