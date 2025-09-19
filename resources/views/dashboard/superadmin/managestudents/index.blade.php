@extends('layouts.app')

@section('title', 'Manage Students')

@section('content_header')
<h1>Manage Students</h1>
@stop

@section('content')
<div class="card shadow">
      <div class="card-header">
            <a href="{{ route('superadmin.students.create') }}" class="btn btn-primary">
                  <i class="fas fa-user-plus"></i> Add Student
            </a>
      </div>
      <div class="card-body">
            <table class="table table-bordered table-hover">
                  <thead>
                        <tr>
                              <th>#</th>
                              <th>Profile</th>
                              <th>Name</th>
                              <th>Email</th>
                              <th>Actions</th>
                        </tr>
                  </thead>
                  <tbody>
                        @forelse($students as $student)
                        <tr>
                              <td>{{ $loop->iteration }}</td>
                              <td>
                                    @if($student->profile_pic)
                                    <img src="{{ asset('uploads/profile_pics/' . $student->profile_pic) }}"
                                          class="img-thumbnail" width="50">
                                    @else
                                    <span class="text-muted">N/A</span>
                                    @endif
                              </td>
                              <td>{{ $student->name }}</td>
                              <td>{{ $student->email }}</td>
                              <td>
                                    <a href="{{ route('superadmin.students.edit', $student->id) }}"
                                          class="btn btn-warning btn-sm">
                                          <i class="fas fa-edit"></i> Edit
                                    </a>
                                    <form action="{{ route('superadmin.students.destroy', $student->id) }}"
                                          method="POST" style="display:inline-block;">
                                          @csrf
                                          @method('DELETE')
                                          <button onclick="return confirm('Are you sure?')"
                                                class="btn btn-danger btn-sm">
                                                <i class="fas fa-trash-alt"></i> Delete
                                          </button>
                                    </form>
                              </td>
                        </tr>
                        @empty
                        <tr>
                              <td colspan="5" class="text-center">No students found</td>
                        </tr>
                        @endforelse
                  </tbody>
            </table>

            {{ $students->links() }}
      </div>
</div>
@stop