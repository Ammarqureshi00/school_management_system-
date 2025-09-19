<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class ManageUserController extends Controller
{
    public function  index()
    {

        $users = User::with('roles')->paginate(10);
        return view('dashboard.superadmin.manageusers.index', compact('users'));
    }

    public function create()
    {
        $roles = Role::all();
        return view('dashboard.superadmin.manageusers.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users',
            'password' => 'required|min:6',
            'role'     => 'required',
            'profile_pic' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048'
        ]);

        $data = [
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => bcrypt($request->password),
        ];

        if ($request->hasFile('profile_pic')) {
            $file = $request->file('profile_pic');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/profile_pics'), $filename);
            $data['profile_pic'] = $filename;
        }

        $user = User::create($data);
        $user->assignRole($request->role);

        return redirect()->route('manage-users.index')
            ->with('success', 'User created successfully');
    }


    public function edit(User $user)
    {
        $roles = Role::all();
        return view('dashboard.superadmin.manageusers.edit', compact('user', 'roles'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name'  => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'role'  => 'required',
            'password' => 'nullable|string|min:6',
            'profile_pic' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048'
        ]);

        $data = [
            'name'  => $request->name,
            'email' => $request->email,
        ];

        if ($request->filled('password')) {
            $data['password'] = bcrypt($request->password);
        }

        if ($request->hasFile('profile_pic')) {
            $file = $request->file('profile_pic');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/profile_pics'), $filename);
            $data['profile_pic'] = $filename;

            // optional: delete old file
            if ($user->profile_pic && file_exists(public_path('uploads/profile_pics/' . $user->profile_pic))) {
                unlink(public_path('uploads/profile_pics/' . $user->profile_pic));
            }
        }


        $user->update($data);

        // ✅ Update role by name from DB
        $user->syncRoles([$request->role]);

        return redirect()->route('superadmin.users.index')
            ->with('success', 'User updated successfully');
    }



    public function destroy(User $user)
    {

        $user->roles()->detach();

        // Now delete the user
        $user->delete();

        return redirect()
            ->route('superadmin.users.index')
            ->with('success', 'User deleted successfully');
    }
}
