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
<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Document Management</h3>
        </div>
        <div class="card-body">
            <div class="row">
                @foreach ($documents as $document)
                    <div class="col-md-6">
                        <div class="timeline">
                            <div class="time-label">
                                <span class="bg-red">{{ $document->date_forwarded }}</span>
                            </div>
                            <div>
                                <i class="fas fa-envelope bg-blue"></i>
                                <div class="timeline-item">
                                    <span class="time"><i class="far fa-clock"></i> {{ $document->date_forwarded }}</span>
                                    <h3 class="timeline-header"><a href="#">{{ $document->document_id }}</a> forwarded to {{ optional($document->latestRouting->toOffice)->name }}</h3>
                                    <div class="timeline-body">
                                        {{ $document->document_type }} from {{ $document->department->name }} with filename {{ $document->filename }} has been forwarded to {{ optional($document->latestRouting->toOffice)->name }} for endorsement.
                                    </div>
                                    <div class="timeline-footer">
                                        <span class="badge badge-{{ $document->latestRouting->status_color }}">{{ $document->latestRouting->status }}</span>
                                        <a href="{{ route('document.view', $document->document_id) }}" class="btn btn-info btn-sm float-right">
                                            <i class="fas fa-eye mr-2"></i> View
                                        </a>
                                        <a href="{{ route('document.edit', $document->document_id) }}" class="btn btn-warning btn-sm float-right mr-3">
                                            <i class="fas fa-edit mr-2"></i> Edit
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="d-flex justify-content-center">
                {{ $documents->links('vendor.pagination.bootstrap-4') }}
            </div>
        </div>
    </div>
</div>


@endsection



