<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Skill;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request)
    {

        $users =  User::where(function($q)use($request){
            if($request->id!=null)
                $q->where('id',$request->id);
            if($request->q!=null)
                $q->where('name','LIKE','%'.$request->q.'%')->orWhere('phone','LIKE','%'.$request->q.'%')->orWhere('email','LIKE','%'.$request->q.'%');
        })->where('power','USER')->orderBy('id','DESC')->paginate();

        return view('admin.users.index',compact('users'));

    }


    public function create()
    {
        $data['skills']=Skill::get();
        return view('admin.users.create',$data);
    }


    public function store(Request $request)
    {

        $request->validate([
            'name'=>"nullable|max:190",
            'phone'=>"nullable|max:190",
            'bio'=>"nullable|max:5000",
            'blocked'=>"required|in:0,1",
            'email'=>"required|unique:users,email",
            'password'=>"required|min:8|max:190"
        ]);
        try {
            $user = User::create([
                "first_name"=>$request->first_name,
                "last_name"=>$request->last_name,
                "phone"=>$request->phone,
                "power"=>'USER',
                "bio"=>$request->bio,
                "blocked"=>$request->blocked,
                "email"=>$request->email,
                "password"=>\Hash::make($request->password),
            ]);
            if($request->hasFile('avatar')){
                $file = uploadImage('users',$request->file('avatar'));
                $user->update(['avatar'=>$file]);

                $user->update(['avatar'=>$file]);
            }




            toastr()->success('تم إضافة المستخدم بنجاح','عملية ناجحة');
            return redirect()->route('admin.users.index');

        }catch (\Exception $exception){
            notify()->error('لم يتم إضافة المستخدم بنجاح','عملية فاشلة');
            return redirect()->route('admin.users.index');
        }




    }

    public function show(User $user)
    {
        return view('admin.users.show',compact('user'));
    }

    public function edit($id)
    {
        $data['user']=User::find($id);
        return view('admin.users.edit',$data);
    }


    public function update(Request $request,$id)
    {
        $request->validate([
            'first_name'=>"required|max:190",
            'last_name'=>"required|max:190",
            'phone'=>"required|max:190",
            'bio'=>"nullable|max:5000",
            'blocked'=>"required|in:0,1",
            'email'=>"required|unique:users,email,".$id,
            'password'=>"nullable|min:8|max:190"
        ]);
        $user=User::find($id);

        $user->update([
            "first_name"=>$request->first_name,
            "last_name"=>$request->last_name,
            "phone"=>$request->phone,
            "power"=>'USER',
            "bio"=>$request->bio,
            "blocked"=>$request->blocked,
            "email"=>$request->email,

        ]);
        if($request->password!=null){
            $user->update([
                "password"=>\Hash::make($request->password)
            ]);
        }
        if($request->hasFile('avatar')){
            $file = uploadImage('users',$request->file('avatar'));
            $user->update(['avatar'=>$file]);
        }

        toastr()->success('تم تحديث المستخدم بنجاح','عملية ناجحة');
        return redirect()->route('admin.users.index');
    }

    public function destroy(User $user)
    {
        if(!auth()->user()->has_access_to('delete',$user))abort(403);
        $user->delete();
        toastr()->success('تم حذف المستخدم بنجاح','عملية ناجحة');
        return redirect()->route('admin.users.index');
    }
}
