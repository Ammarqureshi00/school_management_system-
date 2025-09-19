<?php

namespace App\Http\Controllers;

use App\Models\User;

use Illuminate\Http\Request;

class SuperAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index()
    {
        // Total counts
        $totalStudents = User::where('role', 'student')->count();
        $totalTeachers = User::where('role', 'teacher')->count();
        $totalAdmins   = User::where('role', 'admin')->count();

        // Teacher distribution per department
        // $departments = Department::pluck('name'); // ['Math', 'Science', ...]
        $teacherCounts = [];
        // foreach ($departments as $dept) {
        //     $teacherCounts[] = User::where('role', 'teacher')
        //         ->where('department_id', Department::where('name', $dept)->first()->id)
        //         ->count();
        // }

        return view('dashboard.index', compact(
            'totalStudents',
            'totalTeachers',
            'totalAdmins',
            'totalClasses',
            'departments',
            'teacherCounts'
        ));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
