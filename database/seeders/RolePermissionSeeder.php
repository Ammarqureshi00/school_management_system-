<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RolePermissionSeeder extends Seeder
{
    public function run(): void
    {
        /**
         * ==============================
         * Define Permissions
         * ==============================
         */
        // 🔹 Admin permissions (CRUD, but no role/permission management)
        $adminPermissions = [
            'manage_students',
            'manage_teachers',
            'manage_classes',
            'manage_subjects',
            'manage_exams',
            'manage_attendance',
            'view_reports',
        ];

        // 🔹 Teacher permissions
        $teacherPermissions = [
            'teacher_dashboard',
            'teacher_courses',
            'teacher_attendance',
            'teacher_assignments',
            'teacher_timetable',
            'teacher_reports',

        ];

        // 🔹 Student permissions
        $studentPermissions = [
            'student_dashboard',
            'student_courses',
            'student_grades',
            'student_attendance',
            'student_timetable',
            'student_announcements',
            'student_reports',
        ];

        // Merge all permissions for DB creation
        $allPermissions = array_merge(
            // $superAdminPermissions,
            $adminPermissions,
            $teacherPermissions,
            $studentPermissions
        );

        // Create permissions in DB
        foreach ($allPermissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        /**
         * ==============================
         * Create Roles
         * ==============================
         */
        $superAdminRole = Role::firstOrCreate(['name' => 'SuperAdmin']);
        $adminRole      = Role::firstOrCreate(['name' => 'Admin']);
        $teacherRole    = Role::firstOrCreate(['name' => 'Teacher']);
        $studentRole    = Role::firstOrCreate(['name' => 'Student']);

        /**
         * ==============================
         * Assign Permissions to Roles
         * ==============================
         */
        $adminRole->syncPermissions($adminPermissions);
        $teacherRole->syncPermissions($teacherPermissions);
        $studentRole->syncPermissions($studentPermissions);

        // SuperAdmin gets ALL permissions automatically
        $superAdminRole->syncPermissions(Permission::all());

        /**
         * ==============================
         * Create Example Users
         * ==============================
         */

        // SuperAdmin user
        $superAdmin = User::firstOrCreate(
            ['email' => 'superadmin@example.com'],
            [
                'name' => 'Super Admin',
                'password' => Hash::make('super@123'),
            ]
        );
        $superAdmin->assignRole($superAdminRole);

        // Admin user
        $adminUser = User::firstOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Admin User',
                'password' => Hash::make('admin@123'),
            ]
        );
        $adminUser->assignRole($adminRole);

        // Teacher user
        $teacherUser = User::firstOrCreate(
            ['email' => 'teacher@example.com'],
            [
                'name' => 'Teacher User',
                'password' => Hash::make('teacher@123'),
            ]
        );
        $teacherUser->assignRole($teacherRole);

        // Student user
        $studentUser = User::firstOrCreate(
            ['email' => 'student@example.com'],
            [
                'name' => 'Student User',
                'password' => Hash::make('student@123'),
            ]
        );
        $studentUser->assignRole($studentRole);

        $this->command->info('✅ Roles, Permissions, and Example Users have been seeded successfully.');
    }
}
