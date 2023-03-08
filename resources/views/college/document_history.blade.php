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
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <h2>Document Management</h2>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Document ID</th>
                            <th>Department</th>
                            <th>Type</th>
                            <th>Date Forwarded</th>
                            <th>Filename</th>
                            <th>To Office</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($documents as $document)
                            <tr>
                                <td>{{ $document->document_id }}</td>
                                <td>{{ $document->department->name }}</td>
                                <td>{{ $document->document_type }}</td>
                                <td>{{ $document->date_forwarded }}</td>
                                <td>{{ $document->filename }}</td>
                                <td>{{ optional($document->latestRouting->toOffice)->name }}</td>
                                <td>{{ optional($document->latestRouting)->status }}</td>
                                <td class="d-flex justify-content-center flex-wrap">
                                    <div class="d-flex flex-wrap">
                                        <a href="{{ route('document.view', $document->document_id) }}" class="btn btn-info btn-sm mb-3">
                                            <i class="fas fa-eye mr-2"></i> View
                                        </a>
                                        <a href="{{ route('document.edit', $document->document_id) }}" class="btn btn-warning btn-sm ml-3 mb-3">
                                            <i class="fas fa-edit mr-2"></i> Edit
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    
                </table>
                <div class="d-flex justify-content-center">
                    {{ $documents->links('vendor.pagination.bootstrap-4') }}
                </div>
            </div>
        </div>
    </div>
@endsection



