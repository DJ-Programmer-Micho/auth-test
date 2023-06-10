<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        $notification = array(
            "message" => "Admin Logout Successfully",
            "alert-type" => "success"
        );

        return redirect('/login')->with($notification);
    }

    public function Profile(){
        $id = Auth::user()->id;
        $adminData = User::find($id);
        return view('admin.profile.index',compact('adminData'));
    }

    public function EditProfile(){
        $id = Auth::user()->id;
        $editData = User::find($id);
        return view('admin.profile.create',compact('editData'));
    }


    public function StoreProfile(Request $request){
        $id = Auth::user()->id;
        $data = User::find($id);
        $data->name = $request->name;
        $data->username = $request->username;
        $data->email = $request->email;

        if($request->file('profile_image_file')){
            $file = $request->file('profile_image_file');

            $filename = date('YdmHi').$file->getClientOriginalName();
            $file->move(public_path('admin/avatars'),$filename);
            $data['profile_image'] = $filename;
        }
        $data->save();

        $notification = array(
            "message" => "Admin Profile Updated Successfully",
            "alert-type" => "success"
        );

        return redirect()->route('admin.profile')->with($notification);
    }

    public function EditPassword(){
        return view('admin.password.index');
    }

    public function StorePassword(Request $request){
        $validateData = $request->validate([
            'oldPassword' => 'required',
            'newPassword' => 'required',
            'rePassword' => 'required|same:newPassword',
        ]);
        
        $hashedPassword = Auth::user()->password;
        if(Hash::check($request->oldPassword, $hashedPassword)){
            $users = User::find(Auth::id());
            $users->password = bcrypt($request->newPassword);
            $users->save();

            session()->flash('message','password Updated Successfuly');
            return redirect()->back();
        } else {
            session()->flash('message','Old password is not match');
            return redirect()->back();
        }
        // $id = Auth::user()->id;
        // $data = User::find($id);

        // return view('admin.password.index',compact('editData'));
    }
}
 