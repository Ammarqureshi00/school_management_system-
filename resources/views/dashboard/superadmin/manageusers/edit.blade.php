@extends('layouts.app')

@section('title', 'Edit User')

@section('content_header')
<h1>Edit User</h1>
@stop

@section('content')
<div class="card shadow">
      <div class="card-header">
            <h3 class="card-title">Edit User</h3>
      </div>

      <div class="card-body">
            <form action="{{ route('superadmin.users.update', $user->id) }}" method="POST"
                  enctype="multipart/form-data">
                  @csrf
                  @method('PUT')

                  {{-- Name --}}
                  <div class="form-group">
                        <label for="name">Name</label>
                        <x-adminlte-input name="name" id="name" type="text" value="{{ old('name', $user->name) }}"
                              placeholder="Enter full name" fgroup-class="mb-3" required />
                  </div>

                  {{-- Email --}}
                  <div class="form-group">
                        <label for="email">Email</label>
                        <x-adminlte-input name="email" id="email" type="email" value="{{ old('email', $user->email) }}"
                              placeholder="Enter email address" fgroup-class="mb-3" required />
                  </div>

                  {{-- Password --}}
                  <div class="form-group">
                        <label for="password">Password <small>(Leave blank to keep current)</small></label>
                        <x-adminlte-input name="password" id="password" type="password" placeholder="Enter new password"
                              fgroup-class="mb-3" />
                  </div>

                  {{-- Profile Picture --}}
                  <div class="form-group">
                        <label for="profile_pic">Profile Picture</label>
                        <x-adminlte-input-file name="profile_pic" igroup-size="sm" placeholder="Choose a file..." />
                        @if($user->profile_pic)
                        <div class="mt-2">
                              <img src="{{ asset('storage/images/' . $user->profile_pic) }}" alt="Profile Picture"
                                    width="100" class="img-thumbnail">
                        </div>
                        @endif
                  </div>

                  {{-- Role --}}
                  <div class="form-group">
                        <label for="role">Role</label>
                        <x-adminlte-select name="role" id="role" fgroup-class="mb-3">
                              @foreach($roles->whereIn('name', ['Admin', 'Teacher', 'Student']) as $role)
                              <option value="{{ $role->name }}" {{ $user->hasRole($role->name) ? 'selected' : '' }}>
                                    {{ $role->name }}
                              </option>
                              @endforeach
                        </x-adminlte-select>
                  </div>

                  {{-- Buttons --}}
                  <div class="d-flex justify-content-between">
                        <a href="{{ route('superadmin.users.index') }}" class="btn btn-secondary">
                              <i class="fas fa-arrow-left"></i> Back
                        </a>
                        <x-adminlte-button type="submit" theme="primary" icon="fas fa-save" label="Update User" />
                  </div>
            </form>
      </div>
</div>
@stop