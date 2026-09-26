@extends('layout.main')
@section('content')
    <div class="page-content">
        <div class="card border-top border-0 border-primary">
            <div class="card-body">
                <div class="card-body p-5">
                    <div class="card-title d-flex align-items-center">
                        <div><i class="bx bx-user me-1 font-22 text-primary"></i></div>
                        <h5 class="mb-0 text-primary">Form Edit User</h5>
                    </div>
                    <hr>
                    <form action="{{ route('user.update', $user->id)  }}" method="POST" class="row g-3">
                        @csrf
                        @method('PUT')
                        <div class="col-md-12">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" name="name" class="form-control" id="name" value="{{ old('name', $user->name) }}">
                        </div>
                        @error('name')
                            <div class="mt-2 text-danger">{{ $message }}</div>
                        @enderror
                        <div class="col-md-12">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" name="username" class="form-control" id="username" value="{{ old('username', $user->username) }}">
                        </div>
                        @error('username')
                            <div class="mt-2 text-danger">{{ $message }}</div>
                        @enderror
                        <div class="col-md-12">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" id="email" value="{{ old('email', $user->email) }}">
                        </div>
                        @error('email')
                            <div class="mt-2 text-danger">{{ $message }}</div>
                        @enderror
                        <div class="col-md-12">
                            <label for="username" class="form-label">Role</label>
                            <select class="form-select" name="role">
                                <option hidden>-- Select Role --</option>
                                @if (Auth::user()->role == 'superuser')
                                    <option value="admin">Admin</option>
                                    <option value="user">User</option>
                                @else
                                    <option value="user">User</option>
                                @endif
                            </select>
                        </div>
                        @error('role')
                            <div class="mt-2 text-danger">{{ $message }}</div>
                        @enderror
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary btn-sm">Save</button>
                            <a href="{{ route('user.index') }}" class="btn btn-secondary btn-sm">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
