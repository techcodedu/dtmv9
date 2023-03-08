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
                <h2>Document View</h2>
            </div>
        </div>
    </div>
@endsection
