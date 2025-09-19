@extends('layouts.app')

@section('title', 'Create User')

@section('content_header')
<h1>Create User</h1>
@stop

@section('content')
<form action="{{ route('superadmin.users.store') }}" method="POST" enctype="multipart/form-data">
      @csrf

      <div class="mb-3">
            <label>Name</label>
            <input type="text" name="name" class="form-control" required>
      </div>

      <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" class="form-control" required>
      </div>

      <div class="mb-3">
            <label>Password</label>
            <input type="password" name="password" class="form-control" required>
      </div>

      <div class="mb-3">
            <label>Profile Picture</label>
            <input type="file" name="profile_pic" class="form-control">
      </div>

      <div class="mb-3">
            <label>Role</label>
            <select name="role" class="form-control" required>
                  @foreach($roles->whereIn('name', ['Admin', 'Teacher', 'Student']) as $role)
                  <option value="{{ $role->name }}">{{ $role->name }}</option>
                  @endforeach
            </select>
      </div>

      <div class="d-flex justify-content-between">
            <a href="{{ route('superadmin.users.index') }}" class="btn btn-secondary">
                  <i class="fas fa-arrow-left"></i> Back
            </a>

            <button type="submit" class="btn btn-primary">
                  <i class="fas fa-save"></i> Create User
            </button>
      </div>
</form>
@stop