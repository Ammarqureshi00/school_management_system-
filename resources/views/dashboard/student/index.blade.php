@extends('layouts.app')

@section('title', 'Student Dashboard')

@section('content')
<div class="container mt-4">
      <h2>Welcome, {{ auth()->user()->name }}!</h2>

      <div class="row mt-4">
            <div class="col-md-6">
                  <div class="card text-center p-3">
                        <h5>My Profile</h5>
                        <p>Name: {{ auth()->user()->name }}</p>
                        <p>Email: {{ auth()->user()->email }}</p>
                        <a href="" class="btn btn-primary btn-sm">View Profile</a>
                  </div>
            </div>

            <div class="col-md-6">
                  <div class="card text-center p-3">
                        <h5>Actions</h5>
                        <p>Available to you based on your role.</p>
                        <a href="#" class="btn btn-success btn-sm">View Teachers</a>
                        <a href="#" class="btn btn-info btn-sm">Other Actions</a>
                  </div>
            </div>
      </div>
</div>
@endsection