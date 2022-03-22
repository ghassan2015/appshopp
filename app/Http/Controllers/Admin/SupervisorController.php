<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class SupervisorController extends Controller
{

    public function index(Request $request)
    {


        return view('admin.supervisors.index');

    }


    public function getSupervisor(Request $request)
    {
        $data = User::query()->where('power','=','ADMIN');
        if ($request->input('email')) {
            $data = $data->where("email", $request->input('email'));
        }
        if ($request->input('name')) {

            $data = $data->where('fist_name', 'LIKE','%'.$request->input('name').'%')->orWhere('last_name', 'LIKE','%'.$request->input('name').'%');
        }

        return DataTables::of($data)
            ->addColumn('name', function ($data) {
                return $data->first_name.' '.$data->name;
            })
            ->addColumn('email', function ($data) {
                return $data->email;

            })
            ->addColumn('roles', function ($data) {
                return $data->role->name;

            })
            ->addColumn('status', function ($data) {
                if ($data->blocked){
                    return 'غير فعال';
                }else{
                    return 'فعال';
                }

            })
            ->addColumn('action', function ($data) {


                $button = '<a    href="'.route('admin.supervisors.edit',$data->id).'" ><span><i style="color: #66afe9" class="fas fa-edit"></i></span></a>';

                $button .= '&nbsp;&nbsp;&nbsp;&nbsp;';
                $button .= '<a  id="' . $data->id . '"  sup_name="' . $data->first_name.''.$data->last_name . '" class="delete "><span><i  style="color: red" class="fas fa-trash-alt"></i></span></button>';
                $button .= '&nbsp;&nbsp;&nbsp;&nbsp;';

                return $button;

            })->rawColumns(['action'])
            ->make(true);
    }



    public function create()
    {
        $data['roles']=Role::get();
        return view('admin.supervisors.create',$data);
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
                "power"=>'ADMIN',
                "bio"=>$request->bio,
                "blocked"=>$request->blocked,
                "email"=>$request->email,
                "role_id"=>$request->role_id,
                "password"=>\Hash::make($request->password),
            ]);
            if($request->hasFile('avatar')){
                $file = uploadImage('users',$request->file('avatar'));
                $user->update(['avatar'=>$file]);

                $user->update(['avatar'=>$file]);
            }
        }catch (\Exception $exception){
            return $exception;
        }


        toastr()->success('تم إضافة المستخدم بنجاح','عملية ناجحة');
        return redirect()->route('admin.supervisors.index');


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
//    public function show(User $user)
//    {
//        return view('admin.supervisors.show',compact('user'));
//    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['user']=User::find($id);
        $data['roles']=Role::get();
        return view('admin.supervisors.edit',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $request->validate([
            'first_name'=>"required|max:190",
            'last_name'=>"required|max:190",
            'phone'=>"required|max:190",
//            'power'=>"required",
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
            "power"=>'ADMIN',
            "bio"=>$request->bio,
            "blocked"=>$request->blocked,
            "email"=>$request->email,
            "role_id"=>$request->role_id

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
        return redirect()->route('admin.supervisors.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function delete (Request $request)
    {
        User::where('id',$request->id)->delete();
        toastr()->success('تم حذف المستخدم بنجاح','عملية ناجحة');
        return redirect()->route('admin.supervisors.index');
    }
}
