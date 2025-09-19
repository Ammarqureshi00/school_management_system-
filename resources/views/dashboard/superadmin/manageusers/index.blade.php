@extends('layouts.app')

@section('title', 'Manage Users')

@section('content')
<div class="container-fluid">
      <div class="row mb-3">
            <div class="col">
                  <h1 class="h3">Manage Users</h1>
            </div>
            <div class="col text-end">
                  <a href="{{ route('superadmin.users.create') }}" class="btn btn-success">
                        <i class="fas fa-plus-circle"></i> Add User
                  </a>
            </div>
      </div>

      <div class="card shadow-sm">
            <div class="card-body">
                  <table class="table table-bordered table-hover align-middle">
                        <thead class="table-dark">
                              <tr>
                                    <th scope="col">Profile</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Role</th>
                                    <th scope="col" class="text-center">Actions</th>
                              </tr>
                        </thead>
                        <tbody>
                              @forelse($users as $user)
                              <tr>
                                    <td class="text-center">
                                          @if($user->profile_pic)
                                          <img src="{{ asset('uploads/profile_pics/'.$user->profile_pic) }}"
                                                alt="Profile" width="50" height="50" class="rounded-circle">
                                          @else
                                          <i class="fas fa-user-circle fa-2x text-secondary"></i>
                                          @endif
                                    </td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->roles->pluck('name')->join(', ') }}</td>
                                    <td class="text-center">
                                          <a href="{{ route('superadmin.users.edit', $user->id) }}"
                                                class="btn btn-primary btn-sm me-1">
                                                <i class="fas fa-edit"></i> Edit
                                          </a>

                                          <form action="{{ route('superadmin.users.destroy', $user->id) }}"
                                                method="POST" style="display:inline-block;">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-danger btn-sm"
                                                      onclick="return confirm('Are you sure you want to delete this user?')">
                                                      <i class="fas fa-trash-alt"></i> Delete
                                                </button>
                                          </form>
                                    </td>
                              </tr>
                              @empty
                              <tr>
                                    <td colspan="5" class="text-center text-muted">No users found.</td>
                              </tr>
                              @endforelse
                        </tbody>
                  </table>

                  <div class="mt-3">
                        {{ $users->links() }} {{-- For pagination if needed --}}
                  </div>
            </div>
      </div>
</div>
@endsection