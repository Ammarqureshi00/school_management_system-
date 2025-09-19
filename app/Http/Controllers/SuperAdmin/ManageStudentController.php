<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ManageStudentController extends Controller
{
    // List all students
    public function index()
    {
        $students = User::role('Student')->paginate(10);
        return view('dashboard.superadmin.managestudents.index', compact('students'));
    }

    // Show create form
    public function create()
    {
        return view('dashboard.superadmin.managestudents.create');
    }

    // Store student
    public function store(Request $request)
    {
        $request->validate([
            'name'  => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'profile_pic' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048'
        ]);

        $data = [
            'name'  => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ];

        if ($request->hasFile('profile_pic')) {
            $file = $request->file('profile_pic');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/profile_pics'), $filename);
            $data['profile_pic'] = $filename;
        }

        $student = User::create($data);
        $student->assignRole('Student');

        return redirect()->route('superadmin.students.index')
            ->with('success', 'Student created successfully.');
    }

    // Edit student
    public function edit(User $student)
    {
        if (!$student->hasRole('Student')) {
            abort(403, 'This user is not a student.');
        }

        return view('dashboard.superadmin.managestudents.edit', compact('student'));
    }

    // Update student
    public function update(Request $request, User $student)
    {
        if (!$student->hasRole('Student')) {
            abort(403, 'This user is not a student.');
        }

        $request->validate([
            'name'  => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $student->id,
            'password' => 'nullable|min:6',
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
        }

        $student->update($data);

        return redirect()->route('dashboard.superadmin.managestudents.index')
            ->with('success', 'Student updated successfully.');
    }

    // Delete student
    public function destroy(User $student)
    {
        if (!$student->hasRole('Student')) {
            abort(403, 'This user is not a student.');
        }

        $student->roles()->detach();

        if ($student->profile_pic && file_exists(public_path('uploads/profile_pics/' . $student->profile_pic))) {
            unlink(public_path('uploads/profile_pics/' . $student->profile_pic));
        }

        $student->delete();

        return redirect()->route('dashboard.superadmin.managestudents.index')
            ->with('success', 'Student deleted successfully.');
    }
}
