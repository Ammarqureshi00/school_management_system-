@extends('layouts.app')

@section('title', 'Edit Student')

@section('content_header')
<h1>Edit Student</h1>
@stop

@section('content')
<div class="card shadow">
      <div class="card-body">
            <form action="{{ route('superadmin.students.update', $student->id) }}" method="POST"
                  enctype="multipart/form-data">
                  @csrf
                  @method('PUT')

                  <x-adminlte-input name="name" label="Name" value="{{ old('name', $student->name) }}"
                        fgroup-class="mb-3" required />

                  <x-adminlte-input name="email" type="email" label="Email" value="{{ old('email', $student->email) }}"
                        fgroup-class="mb-3" required />

                  <x-adminlte-input name="password" type="password" label="Password (leave blank to keep current)"
                        fgroup-class="mb-3" />

                  <x-adminlte-input-file name="profile_pic" label="Profile Picture" igroup-size="sm"
                        fgroup-class="mb-3" />

                  @if($student->profile_pic)
                  <div class="mb-3">
                        <img src="{{ asset('uploads/profile_pics/' . $student->profile_pic) }}" class="img-thumbnail"
                              width="100">
                  </div>
                  @endif

                  <div class="d-flex justify-content-between">
                        <a href="{{ route('superadmin.students.index') }}" class="btn btn-secondary">
                              <i class="fas fa-arrow-left"></i> Back
                        </a>
                        <x-adminlte-button type="submit" theme="primary" icon="fas fa-save" label="Update Student" />
                  </div>
            </form>
      </div>
</div>
@stop