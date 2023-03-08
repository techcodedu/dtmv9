@extends('layouts.dashlayout')

@section('title', 'Admin Dashboard')

@section('nav')
    <!-- Sidebar -->
    <div class="sidebar">
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu">
            <li class="nav-item">
                    <a href="{{ route('system.dashboard') }}" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                
                <li class="nav-item">
                    <a href="{{ route('users.create') }}" class="nav-link">
                        <i class="nav-icon fas fa-file-alt"></i>
                        <p>Create Users</p>
                    </a>     
                </li>
            </ul>
        </nav>
    </div>
    <!-- /.sidebar -->
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <h2>Edit User</h2>
            <form action="{{ route('users.update', $user->id) }}" method="POST" id="update-form">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="name">Name:</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $user->name) }}">
                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $user->email) }}">
                </div>
                <div class="form-group">
                    <label for="office">Office:</label>
                    <select class="form-control" id="office-select" name="office_id">
                      <option value="">-- Select Office --</option>
                      @foreach ($offices as $office)
                        <option value="{{ $office->id }}" {{ $office->id == $user->office_id ? 'selected' : '' }}>{{ $office->name }}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="department">Department:</label>
                    <select class="form-control" id="department-select" name="department_id">
                      <option value="">-- Select Department --</option>
                      @foreach ($departments as $department)
                        <option value="{{ $department->id }}" {{ $department->id == $user->department_id ? 'selected' : '' }}>{{ $department->name }}</option>
                      @endforeach
                    </select>
                  </div>
                  
                  <div class="form-group">
                    <label for="role">Role:</label>
                    <select class="form-control" id="role" name="role">
                        <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                        <option value="college" {{ $user->role == 'college' ? 'selected' : '' }}>College</option>
                        <option value="campus_records" {{ $user->role == 'campus_records' ? 'selected' : '' }}>Campus Records</option>
                        <option value="campus_extensions" {{ $user->role == 'campus_extensions' ? 'selected' : '' }}>Campus Extension</option>
                        <option value="chancellor" {{ $user->role == 'chancellor' ? 'selected' : '' }}>Chancellor</option>
                        <option value="bacnotan" {{ $user->role == 'bacnotan' ? 'selected' : '' }}>Bacnotan</option>
                        <option value="central_admin" {{ $user->role == 'central_admin' ? 'selected' : '' }}>Central Admin</option>
                        <option value="president" {{ $user->role == 'president' ? 'selected' : '' }}>President</option>
                        <option value="vp_research" {{ $user->role == 'vp_research' ? 'selected' : '' }}>VP Research</option>
                        <option value="university_extension" {{ $user->role == 'university_extension' ? 'selected' : '' }}>University Extension</option>
                        <option value="extension" {{ $user->role == 'extension' ? 'selected' : '' }}>Extension</option>
                    </select>
                </div>
                
                <button type="submit" class="btn btn-primary" id="submit-btn">Update</button>
            </form>
        </div>
    </div>
</div>
@include('_partials.confirmation-modal')
@endsection




