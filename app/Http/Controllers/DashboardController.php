<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;
use App\Models\User;



class DashboardController extends Controller
{

    // Redirect users based on role
    public function index()
    {
        $user = Auth::user();
        $role = $user?->getRoleNames()->first(); // Safe null check

        switch ($role) {
            case 'SuperAdmin':
                return redirect()->route('dashboard.superadmin');
            case 'Admin':
                return redirect()->route('dashboard.admin');
            case 'Teacher':
                return redirect()->route('dashboard.teacher');
            case 'Student':
                return redirect()->route('dashboard.student');
            default:
                abort(403, 'Unauthorized');
        }
    }


    public function superadmin()
    {
        // Fetch all roles dynamically
        $roles = Role::all();


        $chartLabels = [];
        $chartData = [];
        $counts = [];

        foreach ($roles as $role) {
            $count = $role->users()->count();

            // For cards
            $counts[$role->name] = $count;

            // For chart
            $chartLabels[] = $role->name;
            $chartData[] = $count;
        }

        return view('dashboard.superadmin.index', compact('counts', 'chartLabels', 'chartData'));
    }


    public function admin()
    {
        // Get counts
        $counts = [
            'Student' => \App\Models\User::role('Student')->count(),
            'Teacher' => \App\Models\User::role('Teacher')->count(),
            'Class'   => 10, // replace with actual classes count when you build Class model
        ];

        // Chart data
        $chartLabels = array_keys($counts);
        $chartData   = array_values($counts);

        return view('dashboard.admin.index', compact('counts', 'chartLabels', 'chartData'));
        // return view('dashboard.admin.index');
    }

    public function teacher()
    {


        return view('dashboard.teacher.index');
    }


    public function student()
    {
        return view('dashboard.student.index');
    }
}
