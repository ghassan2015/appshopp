<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Http\Requests\RoleRequest;
use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::get(); // use pagination and  add custom pagination on index.blade
        return view('admin.roles.index', compact('roles'));
    }

    public function create()
    {
        return view('admin.roles.create');
    }

    public function saveRole(RoleRequest $request)
    {

        try {
            $role = $this->process(new Role, $request);
            if ($role) {
                toastr()->success('تم اضافة الصلاحية بنجاح','عملية ناجحة');
                return redirect()->route('admin.roles.index');
            } else {
                notify()->error('لم يتم عملية الاضافة بنجاح','فشل العملية');

                return redirect()->route('admin.roles.index');
            }
        }catch (\Exception $ex) {
            // return message for unhandled exception
            notify()->error('لم يتم عملية الاضافة بنجاح','فشل العملية');

            return redirect()->route('admin.roles.index');
        }
    }

    public function edit($id)
    {
        $role = Role::findOrFail($id);
        return view('admin.roles.edit',compact('role'));
    }
    public function update($id,RoleRequest $request)
    {
        try {
            $role = Role::findOrFail($id);
            $role = $this->process($role, $request);
            if ($role) {
                toastr()->success('تم اضافة الصلاحية بنجاح','عملية ناجحة');
                return redirect()->route('admin.roles.index');
            } else {
                notify()->error('لم يتم عملية التعديل بنجاح','فشل العملية');

                return redirect()->route('admin.roles.index');
            }
        }catch (\Exception $ex) {
            // return message for unhandled exception
            notify()->error('لم يتم عملية الاضافة بنجاح','فشل العملية');

            return redirect()->route('admin.roles.index');
        }
    }

    protected function process(Role $role, Request $r)
    {
        $role->name = $r->name;
        $role->permissions = $r->permissions;
        $role->save();
        return $role;
    }
}
