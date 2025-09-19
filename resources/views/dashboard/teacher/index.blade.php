@extends('layouts.app')

@section('content')
<div class="container">
      <h1 class="mb-4">Teacher Dashboard</h1>

      <div class="row">
            <!-- Classes Card -->
            <div class="col-md-4 mb-4">
                  <div class="card shadow-sm h-100">
                        <div class="card-body text-center">
                              <i class="fas fa-chalkboard fa-3x mb-3 text-primary"></i>
                              <h5 class="card-title">Manage Classes</h5>
                              <p class="card-text">View and manage your assigned classes.</p>
                              <a href="" class="btn btn-primary">Go</a>
                        </div>
                  </div>
            </div>

            <!-- Attendance Card -->
            <div class="col-md-4 mb-4">
                  <div class="card shadow-sm h-100">
                        <div class="card-body text-center">
                              <i class="fas fa-user-check fa-3x mb-3 text-success"></i>
                              <h5 class="card-title">Attendance</h5>
                              <p class="card-text">Track and manage student attendance.</p>
                              <a href="" class="btn btn-success">Go</a>
                        </div>
                  </div>
            </div>

            <!-- Assignments Card -->
            <div class="col-md-4 mb-4">
                  <div class="card shadow-sm h-100">
                        <div class="card-body text-center">
                              <i class="fas fa-tasks fa-3x mb-3 text-warning"></i>
                              <h5 class="card-title">Assignments</h5>
                              <p class="card-text">Create and evaluate student assignments.</p>
                              <a href="" class="btn btn-warning text-white">Go</a>
                        </div>
                  </div>
            </div>
      </div>
</div>
@endsection