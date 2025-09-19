@extends('layouts.app')

@section('title', 'Add Student')

@section('content_header')
<h1>Add Student</h1>
@stop

@section('content')
<div class="card shadow">
      <div class="card-body">
            <form action="{{ route('superadmin.students.store') }}" method="POST" enctype="multipart/form-data">
                  @csrf

                  <x-adminlte-input name="name" label="Name" placeholder="Enter full name" fgroup-class="mb-3"
                        required />

                  <x-adminlte-input name="email" type="email" label="Email" placeholder="Enter email"
                        fgroup-class="mb-3" required />

                  <x-adminlte-input name="password" type="password" label="Password" placeholder="Enter password"
                        fgroup-class="mb-3" required />

                  <x-adminlte-input-file name="profile_pic" label="Profile Picture" igroup-size="sm"
                        fgroup-class="mb-3" />

                  <div class="d-flex justify-content-between">
                        <a href="{{ route('superadmin.students.index') }}" class="btn btn-secondary">
                              <i class="fas fa-arrow-left"></i> Back
                        </a>
                        <x-adminlte-button type="submit" theme="success" icon="fas fa-save" label="Create Student" />
                  </div>
            </form>
      </div>
</div>
@stop