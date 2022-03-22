<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\User;
use Intervention\Image\ImageManager;
use Imagick;
use Illuminate\Support\Str;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\File\File;
use Hash;
class ProfileController extends Controller
{
    public function index(Request $request)
    {
        return view('admin.profile.index');
    }
    public function edit(Request $request)
    {
        return view('admin.profile.edit');
    }

    public function update(Request $request)
    {
        $user= User::where('id',auth()->id())->firstOrFail();
        if($request->avatar!=null){
            if($request->hasFile('avatar')){
                $file = uploadImage('users',$request->file('avatar'));
                $user->update(['avatar'=>$file]);
            }
//            $this->use_hub_file($file, $user->id, auth()->user()->id);
//            $user->update([
//                'avatar'=>$file
//            ]);
        }
        $request->validate([
            'first_name'=>"required|min:3|max:190",
            'bio'=>"nullable|max:10000",
            'last_name'=>"required|min:3|max:190",

        ]);
        $user->update([
            'first_name'=>$request->first_name,
            'last_name'=>$request->last_name,

            'bio'=>$request->bio
        ]);
        notify()->info('عملية ناجحة','تمت العملية بنجاح');
        //emotify('info','تمت العملية بنجاح');
        return redirect()->back();
    }

    public function base64ToFile($file){

        $fileData = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $file));

        // save it to temporary dir first.
        $tmpFilePath = sys_get_temp_dir() . '/' . Str::uuid()->toString();
        file_put_contents($tmpFilePath, $fileData);

        // this just to help us get file info.
        $tmpFile = new File($tmpFilePath);

        $file = new UploadedFile(
            $tmpFile->getPathname(),
            $tmpFile->getFilename(),
            $tmpFile->getMimeType(),
            0,
            true // Mark it as test, since the file isn't from real HTTP POST.
        );

        return $file;
    }


    public function update_password(Request $request){
        $request->validate([
            'old_password'=>"required|string|min:8|max:190",
            'password'=>"required|string|confirmed|min:8|max:190"
        ]);
        if(Hash::check($request->old_password, auth()->user()->password)){
            auth()->user()->update([
                'password'=>Hash::make($request->password)
            ]);
            toastr()->success('تم تغيير كلمة المرور بنجاح','عملية ناجحة');
            return redirect()->back();
        }else{
            notify()->error('كلمة المرور الحالية التي أدخلتها غير صحيحة','عملية غير ناجحة');
            return redirect()->back();
        }
    }
    public function update_email(Request $request){
       $request->validate([
            'old_email'=>"required|email",
            'email'=>"required|email|confirmed|unique:users,email,".auth()->user()->id
        ]);
        auth()->user()->update([
            'email'=>$request->email
        ]);
        toastr()->success('تمت عملية تغيير البريد الالكتروني بنجاح','عملية ناجحة');
        return redirect()->back();
    }







}
