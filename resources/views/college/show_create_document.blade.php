@extends('layouts.dashlayout')

@section('title', 'College Dashboard')

@section('nav')
    <!-- Sidebar -->
    <div class="sidebar">
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu">
                <li class="nav-item">
                    <a href="{{ route('college.dashboard') }}" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('college.show_create_document') }}" class="nav-link">
                        <i class="nav-icon fas fa-file-alt"></i>
                        <p>Create Document</p>
                    </a>     
                </li>
                <li class="nav-item">
                    <a href="{{ route('college.document_history') }}" class="nav-link">
                        <i class="nav-icon fas fa-history"></i>
                        <p>Document History</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-cog"></i>
                        <p>Settings</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-bell"></i>
                        <p>Notifications</p>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
    <!-- /.sidebar -->
@endsection

@section('content')
    @if(session('showDuplicateFileModal'))
        @include('_partials.file_exist_modal')
    @endif

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-lg-8 col-md-10 col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h2 class="card-title">Create Document</h2>
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success" id="success-message">
                            {{ session('success') }}
                        </div>
                    @endif
                    <form method="POST" action="{{ route('college.store_document') }}" enctype="multipart/form-data" id="document-form">
                        @csrf
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="document_type">Document Type:</label>
                                <select name="document_type" id="document_type" class="form-control" required>
                                    <option value="">Select document type</option>
                                    <option value="Project Proposal">Project Proposal</option>
                                    <option value="Training Designs">Training Designs</option>
                                    <option value="Annual and Quarterly Operational Plan">Annual and Quarterly Operational Plan</option>
                                    <option value="Financial Plans">Financial Plans</option>
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="department_id">Department:</label>
                                <select name="department_id" id="department_id" class="form-control" required disabled>
                                    <option value="{{ $user->department_id }}" selected>{{ $user->department->name }}</option>
                                    @foreach($departments as $department)
                                        @if ($department->id != $user->department_id)
                                            <option value="{{ $department->id }}">{{ $department->name }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-row">
                            {{-- enables all offices --}}
                            {{-- <div class="form-group col-md-6">
                                <label for="office_id">Forward To Office:</label>
                                <select name="office_id" id="office_id" class="form-control" required>
                                    <option value="">Select office</option>
                                    @foreach($offices as $office)
                                        <option value="{{ $office->id }}">{{ $office->name }}</option>
                                    @endforeach
                                </select>
                            </div> --}}
                            <div class="form-group col-md-6">
                                <label for="office_id">Forward To Office:</label>
                                <select name="office_id" id="office_id" class="form-control" required>
                                    <option value="">Select office</option>
                                    @foreach($offices as $office)
                                        @if (Auth::user()->role === 'college' && $office->id === 1)
                                            {{-- If user role is college and office is Campus Records, enable the option --}}
                                            <option value="{{ $office->id }}">{{ $office->name }}</option>
                                        @elseif (Auth::user()->role === 'college')
                                            {{-- If user role is college and office is not Campus Records, disable the option --}}
                                            <option value="{{ $office->id }}" disabled>{{ $office->name }}</option>
                                        @else
                                            {{-- For other users, allow all offices --}}
                                            <option value="{{ $office->id }}">{{ $office->name }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            {{-- enables all status --}}
                            {{-- <div class="form-group col-md-6">
                                <label for="status">Status:</label>
                                <select name="status" id="status" class="form-control" required>
                                    <option value="">Select status</option>
                                    @foreach(App\Models\Document::STATUS as $status)
                                        <option value="{{ $status }}">{{ ucfirst($status) }}</option>
                                    @endforeach
                                </select>
                            </div> --}}
                            <div class="form-group col-md-6">
                                <label for="status">Status:</label>
                                <select name="status" id="status" class="form-control" required>
                                    <option value="">Select status</option>
                                    @foreach(App\Models\Document::STATUS as $status)
                                        @if (Auth::user()->role === 'college' && $status !== 'forwarded')
                                            <option  value="{{ $status }}" disabled>{{ ucfirst($status) }}</option>
                                        @else
                                            <option class="forwarded-option" value="{{ $status }}">{{ ucfirst($status) }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            
                        </div>
                        <div class="form-group">
                            <label for="file">Attachments:</label>
                            <input type="file" name="file" class="form-control-file" required>
                            @if ($errors->has('file'))
                            <span class="text-danger">{{ $errors->first('file') }}</span>
                            @endif
                        </div>
                        <div class="form-group mt-5">
                            <button type="submit" class="btn btn-primary btn-block">Submit</button>
                        </div>
                    </form>
                    @if ($errors->has('file'))
                        {{-- modal --}}
                        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> 
                        <script>
                            $(function() {
                            $('#alreadyForwardedModal').modal('show');
                            $('#document-form').on('submit', function(e) {
                                e.preventDefault();
                            });
                            });
                        </script>
                    @endif

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
