@extends('layouts.dashlayout')

@section('title', 'Admin Creation of Users')

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
                <h2>Add System User</h2>
                @if (session('success'))
                 <div class="alert alert-success" id="success-message">
                    {{ session('success') }}
                </div>
                @endif
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Create User</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form role="form" method="POST" action="{{ route('users.store') }}">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name"
                                    placeholder="Enter name" value="{{ old('name') }}">
                                @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="email">Email address</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email"
                                    placeholder="Enter email" value="{{ old('email') }}">
                                @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="office_id">Office</label>
                                <select class="form-control @error('office_id') is-invalid @enderror" id="office_id" name="office_id">
                                    <option value="">Select office</option>
                                    @foreach ($offices as $office)
                                    <option value="{{ $office->id }}" {{ old('office_id') == $office->id ? 'selected' : '' }}>
                                        {{ $office->name }}</option>
                                    @endforeach
                                </select>
                                
                            </div>
                            
                            
                            <div class="form-group" id="department-group">
                                <label for="department_id">Department</label>
                                <select class="form-control @error('department_id') is-invalid @enderror" id="department_id" name="department_id">
                                    <option value="">Select department</option>
                                    @foreach ($departments as $department)
                                    <option value="{{ $department->id }}" {{ old('department_id') == $department->id ? 'selected' : '' }}>
                                        {{ $department->name }}</option>
                                    @endforeach
                                </select>
                                @error('department_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                        </div>
                        <!-- /.card-body -->
                
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Create</button>
                        </div>
                    </form>
                </div>
                
            </div>
        </div>
    </div>
    {{-- <script>
        document.addEventListener('DOMContentLoaded', function() {
    const officeSelect = document.getElementById('office_id');
    const departmentGroup = document.getElementById('department-group');
    const departmentInput = document.getElementById('department-input');
    
    officeSelect.addEventListener('change', function(e) {
        const selectedOption = e.target.options[e.target.selectedIndex].text;
        if (selectedOption === 'Admin') {
            departmentGroup.style.display = 'none';
            departmentInput.style.display = 'block';
        } else {
            departmentGroup.style.display = 'block';
            departmentInput.style.display = 'none';
            document.querySelector('select[name="department_id"]').value = '';
        }
    });
});


    </script> --}}
@endsection



