@extends('layouts.app')

@section('title', 'Add Teacher')

@section('content')
<div class="container-fluid">
      <h3>Add Teacher</h3>

      <div class="card shadow">
            <div class="card-body">
                  <form action="{{ route('superadmin.teachers.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <x-adminlte-input name="name" label="Name" value="{{ old('name') }}" placeholder="Enter name"
                              fgroup-class="mb-3" required />
                        <x-adminlte-input name="email" label="Email" type="email" value="{{ old('email') }}"
                              placeholder="Enter email" fgroup-class="mb-3" required />
                        <x-adminlte-input name="password" label="Password" type="password" placeholder="Enter password"
                              fgroup-class="mb-3" required />
                        <x-adminlte-input-file name="profile_pic" label="Profile Picture" igroup-size="sm"
                              placeholder="Choose a file..." fgroup-class="mb-3" />

                        <div class="d-flex justify-content-between">
                              <a href="{{ route('superadmin.teachers.index') }}" class="btn btn-secondary">
                                    <i class="fas fa-arrow-left"></i> Back
                              </a>
                              <x-adminlte-button type="submit" theme="primary" icon="fas fa-save"
                                    label="Create Teacher" />
                        </div>
                  </form>
            </div>
      </div>
</div>
@endsection