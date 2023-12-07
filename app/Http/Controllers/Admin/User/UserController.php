<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $result = User::query();

        if ($request->has('keywords') && $request->keywords != null) {
            $result->where('full_name', 'like', '%' . $request->keywords . '%')
                ->orWhere('email', 'like', '%' . $request->keywords . '%')
                ->orWhere('phone_number', 'like', '%' . $request->keywords . '%');
        }

        if ($request->has('group_id') && $request->group_id != null) {
            $result->where('group_id', $request->group_id);
        }

        if ($request->has('sort') && $request->sort != null) {
            $result->orderBy('created_at', $request->sort);
        } else {
            $result->orderBy('created_at', 'desc');
        }

        if ($request->has('status') && $request->status != null && $request->status == 'active') {
            $result->where('deleted_at', "=", null);
        } elseif ($request->has('status') && $request->status != null && $request->status == 'inactive') {
            $result->onlyTrashed();
        } else {
            $result->withTrashed();
        }

        $users = $result->paginate(10);
        return view('admin.user.index', compact('users'));
    }

    public function add()
    {
        return view('admin.user.add');
    }

    public function store(Request $request)
    {
        $validate = $request->validate([
            'full_name' => 'required|max:50',
            'group_id' => 'required|numeric',
            'phone_number' => 'required|numeric',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
            'password_confirmation' => 'required|min:6'
        ], [
            "full_name.required" => "Please enter this field",
            "group_id.required" => "Please add a role group",
            "phone_number.numeric" => "Please enter the correct format",
            "phone_number.required" => "Please add a role group",
            "group_id.numeric" => "Value must be a number",
            "full_name.max" => "Maximum :max characters",
            "email.required" => "Please enter email",
            "email.email" => "Please enter the correct format",
            "email.unique" => "This email has already been used",
            "password.required" => "Please enter a password",
            "password.min" => "Password must be greater than or equal to :min characters",
            "password.confirmed" => "Password confirmation field does not match.",
            "password_confirmation.required" => "Please confirm your password",
            "password_confirmation.min" => "Password must be greater than or equal to :min characters",

        ]);

        $validate['password'] = Hash::make($validate['password']);

        unset($validate['password_confirmation']);
        $check = User::insert($validate);
        if ($check) {
            return back()->with('msgSuccess', 'Successfully added member');
        }
        return back()->with('msgError', 'Failed to add member!');
    }

    public function edit(User $user)
    {
        return view('admin.user.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        if (Auth::user()->id != $id) {
            return abort(401);
        }

        $validate = $request->validate([
            'full_name' => 'required|max:50',
            'group_id' => 'required|numeric',
            'phone_number' => 'required|numeric',
            'avatar' =>  'image'
        ], [
            "full_name.required" => "Please enter this field",
            "group_id.required" => "Please add a role group",
            "phone_number.numeric" => "Please enter the correct format",
            "phone_number.required" => "Please add a role group",
            "group_id.numeric" => "Value must be a number",
            "avatar.image" => "Please choose the correct image format",

        ]);

        if ($request->hasFile('avatar')) {
            $file = $request->file('avatar');

            // Set file name
            $filename = $file->hashName();

            // Store file in the directory storage/app/public/photos/1/projects
            $path = $file->storePubliclyAs('public/photos/1/projects', $filename);

            // Create public URL from storage path
            $url = Storage::url($path);

            // Save URL to the variable $validate['avatar'] or do something else
            $validate['avatar'] = $url;
        }

        $check = User::where('id', $id)->update($validate);
        if ($check) {
            return back()->with('msgSuccess', 'Update successful');
        }
        return back()->with('msgError', 'Update failed!');
    }

    public function softDelete($id)
    {
        $check = User::destroy($id);
        if ($check) {
            return back()->with('msgSuccess', 'Change status successful');
        }
        return back()->with('msgError', 'Change status failed!');
    }

    public function restore($id)
    {
        $check = User::onlyTrashed()->where('id', $id)->restore();
        if ($check) {
            return back()->with('msgSuccess', 'Restore successful');
        }
        return back()->with('msgError', 'Restore failed!');
    }

    public function forceDelete($id)
    {
        if (Auth::user()->id != $id) {
            return abort(401);
        }

        $check = User::onlyTrashed()->where('id', $id)->forceDelete();
        if ($check) {
            return back()->with('msgSuccess', 'Delete user successful');
        }
        return back()->with('msgError', 'Delete user failed!');
    }

    public function accountSetting()
    {
        return view('admin.user.Account');
    }
    public function changePw()
    {
        return view('admin.user.change-pw');
    }
    public function handleChangePassword(Request $request, $email)
    {
        if (Auth::user()->email != $email) {
            return abort(401);
        }
        $request->validate([
            'currentPassword' => 'required',
            'password' => 'required|min:6|confirmed',
            'password_confirmation' => 'required|min:6'
        ]);

        $user = User::where('email', $email)->first();

        if (Hash::check($request->currentPassword, $user->password)) {
            $check = User::where('email', $email)->update(['password' => Hash::make($request->password)]);

            if ($check) {
                return back()->with('msgSuccess', 'Changed password successfully');
            }
            return back()->with('msgError', 'Password change failed!');
        } else {
            return back()->with('msgError', 'Current password is incorrect!');
        }
    }
}
