@extends('layouts.app')

@section('title', 'Manage Teachers')

@section('content')
<div class="container-fluid ">
      <div class="d-flex justify-content-between mb-3 py-4">
            <h3>Teachers List</h3>
            <a href="{{ route('superadmin.teachers.create') }}" class="btn btn-primary">
                  <i class="fas fa-plus"></i> Add Teacher
            </a>
      </div>

      @if(session('success'))
      <div class="alert alert-success">{{ session('success') }}</div>
      @endif
      @if(session('error'))
      <div class="alert alert-danger">{{ session('error') }}</div>
      @endif

      <div class="card">
            <div class="card-body table-responsive">
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
                              @forelse($teachers as $teacher)
                              <tr>
                                    <td>{{ $loop->iteration + ($teachers->currentPage() - 1) * $teachers->perPage() }}
                                    </td>
                                    <td>
                                          @if($teacher->profile_pic)
                                          <img src="{{ asset('uploads/profile_pics/' . $teacher->profile_pic) }}"
                                                alt="Profile" width="50" class="img-thumbnail">
                                          @else
                                          <img src="{{ asset('default-avatar.png') }}" alt="Profile" width="50"
                                                class="img-thumbnail">
                                          @endif
                                    </td>
                                    <td>{{ $teacher->name }}</td>
                                    <td>{{ $teacher->email }}</td>
                                    <td>
                                          <a href="{{ route('superadmin.teachers.edit', $teacher->id) }}"
                                                class="btn btn-sm btn-warning">
                                                <i class="fas fa-edit"></i> Edit
                                          </a>
                                          <form action="{{ route('superadmin.teachers.destroy', $teacher->id) }}"
                                                method="POST" style="display:inline-block;">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-sm btn-danger"
                                                      onclick="return confirm('Are you sure?')">
                                                      <i class="fas fa-trash-alt"></i> Delete
                                                </button>
                                          </form>
                                    </td>
                              </tr>
                              @empty
                              <tr>
                                    <td colspan="5" class="text-center">No teachers found.</td>
                              </tr>
                              @endforelse
                        </tbody>
                  </table>

                  {{ $teachers->links() }}
            </div>
      </div>
</div>
@endsection