<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class ManageTeacherController extends Controller
{
    // Optional if routes already have middleware
    // public function __construct()
    // {
    //     $this->middleware(['auth', 'role:SuperAdmin']);
    // }

    // List all teachers
    public function index()
    {
        $teachers = User::role('Teacher')->paginate(10);
        return view('dashboard.superadmin.manageteachers.index', compact('teachers'));
    }

    // Show create form
    public function create()
    {
        return view('dashboard.superadmin.manageteachers.create');
    }

    // Store new teacher
    public function store(Request $request)
    {
        $request->validate([
            'name'        => 'required|string|max:255',
            'email'       => 'required|email|unique:users,email',
            'password'    => 'required|string|min:6',
            'profile_pic' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
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

        $teacher = User::create($data);
        $teacher->assignRole('Teacher');

        return redirect()->route('superadmin.teachers.index')
            ->with('success', 'Teacher created successfully.');
    }

    // Show edit form
    public function edit(User $teacher)
    {
        return view('dashboard.superadmin.manageteachers.edit', compact('teacher'));
    }

    // Update teacher
    public function update(Request $request, User $teacher)
    {
        $request->validate([
            'name'        => 'required|string|max:255',
            'email'       => 'required|email|unique:users,email,' . $teacher->id,
            'password'    => 'nullable|string|min:6',
            'profile_pic' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
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

            // Delete old profile picture if exists
            if ($teacher->profile_pic && file_exists(public_path('uploads/profile_pics/' . $teacher->profile_pic))) {
                unlink(public_path('uploads/profile_pics/' . $teacher->profile_pic));
            }

            $data['profile_pic'] = $filename;
        }

        $teacher->update($data);

        return redirect()->route('superadmin.teachers.index')
            ->with('success', 'Teacher updated successfully.');
    }

    // Delete teacher
    public function destroy(User $teacher)
    {
        // Prevent deleting super-super-admin users
        if ($teacher->is_super_admin) {
            return redirect()->route('superadmin.teachers.index')
                ->with('error', 'You cannot delete this super admin.');
        }

        // Remove all roles
        $teacher->syncRoles([]);

        // Delete profile picture
        $profilePicPath = public_path('uploads/profile_pics/' . $teacher->profile_pic);
        if ($teacher->profile_pic && file_exists($profilePicPath)) {
            unlink($profilePicPath);
        }

        // Delete user
        $teacher->delete();

        return redirect()->route('superadmin.teachers.index')
            ->with('success', 'Teacher deleted successfully.');
    }
}
