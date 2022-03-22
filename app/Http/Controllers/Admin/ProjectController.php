<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Constant;
use App\Models\Project;
use App\Models\Skill;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProjectController extends Controller
{

    public function create()
    {
        $data['Skills']=Skill::get();$data['sallary']=Constant::where('parent_id','<>',0)->where('s_key','salary_cd')->get();
        return view('admin.projects.create',$data);
    }

    public function store(Request $request){

        try {
          $project=  \App\Models\Project::create([
                'name'=>['ar'=>$request->name_ar,'en'=>$request->name_en],
                "slug"=>['ar'=>$this->slug($request->name_ar),'en'=>Str::slug($request->name_en)],
                'description'=>['ar'=>$request->description_ar,'en'=>$request->description_en],
                'date'=>$request->duration,
                'expected_salary'=>$request->budget,
                'user_id'=>auth()->id(),
                'status_cd'=>18,
            ]);

            foreach($request->file('filenames') as $file){
                $data= uploadImage('projects', $file);
                $file = \App\Models\Attachment::create([
                    'name' => 'projects',
                    'files' => $data,
                ]);
                $project->attachments()->attach($file->id);

            }



          $project->skills()->attach($request->skill_id);

        }catch (\Exception $exception){
            return $exception;
        }






    }



    public function slug($string, $separator = '-') {
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
}
