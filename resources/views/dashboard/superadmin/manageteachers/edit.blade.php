@extends('layouts.app')

@section('title', 'Edit Teacher')

@section('content')
<div class="container-fluid py-4">
      <h3>Edit Teacher</h3>

      <div class="card shadow">
            <div class="card-body">
                  <form action="{{ route('superadmin.teachers.update', $teacher->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <x-adminlte-input name="name" label="Name" value="{{ old('name', $teacher->name) }}"
                              placeholder="Enter name" fgroup-class="mb-3" required />
                        <x-adminlte-input name="email" label="Email" type="email"
                              value="{{ old('email', $teacher->email) }}" placeholder="Enter email" fgroup-class="mb-3"
                              required />
                        <x-adminlte-input name="password" label="Password (Leave blank to keep current)" type="password"
                              placeholder="Enter new password" fgroup-class="mb-3" />
                        <x-adminlte-input-file name="profile_pic" label="Profile Picture" igroup-size="sm"
                              placeholder="Choose a file..." fgroup-class="mb-3" />

                        @if($teacher->profile_pic)
                        <div class="mb-3">
                              <img src="{{ asset('uploads/profile_pics/' . $teacher->profile_pic) }}"
                                    alt="Profile Picture" width="100" class="img-thumbnail">
                        </div>
                        @endif

                        <div class="d-flex justify-content-between">
                              <a href="{{ route('superadmin.teachers.index') }}" class="btn btn-secondary">
                                    <i class="fas fa-arrow-left"></i> Back
                              </a>
                              <x-adminlte-button type="submit" theme="primary" icon="fas fa-save"
                                    label="Update Teacher" />
                        </div>
                  </form>
            </div>
      </div>
</div>
@endsection