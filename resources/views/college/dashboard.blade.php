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
                <div class="row">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Document Status</h3>
                            </div>
                            <div class="card-body">
                                <table class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>Document</th>
                                            <th>Location</th>
                                            <th>Status</th>
                                            <th>Forwarder</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Document 001</td>
                                            <td>Office 1</td>
                                            <td><span class="badge bg-warning">Pending</span></td>
                                            <td>User 1</td>
                                        </tr>
                                        <tr>
                                            <td>Document 002</td>
                                            <td>Office 2</td>
                                            <td><span class="badge bg-info">In Progress</span></td>
                                            <td>User 2</td>
                                        </tr>
                                        <tr>
                                            <td>Document 003</td>
                                            <td>Office 3</td>
                                            <td><span class="badge bg-success">Approved</span></td>
                                            <td>User 3</td>
                                        </tr>
                                        <tr>
                                            <td>Document 004</td>
                                            <td>Office 4</td>
                                            <td><span class="badge bg-danger">Rejected</span></td>
                                            <td>User 4</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Document Filters</h3>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <button class="btn btn-default"><i class="fas fa-filter"></i> Status</button>
                                    <button class="btn btn-default"><i class="fas fa-filter"></i> Type</button>
                                    <button class="btn btn-default"><i class="fas fa-filter"></i> Office</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    
 

                    <div class="col-md-6">
                        <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Tracking Timeline</h3>
                        </div>
                        <div class="card-body">
                            <div class="timeline">
                                <div class="time-label">
                                    <span class="bg-red">10 Feb. 2023</span>
                                </div>
                                <div>
                                    <i class="fas fa-envelope bg-blue"></i>
                                    <div class="timeline-item">
                                        <span class="time"><i class="far fa-clock"></i> 12:05</span>
                                        <h3 class="timeline-header"><a href="#">Document 001</a> sent to Office 2</h3>
                                        <div class="timeline-body">
                                            Document 001 has been sent to Office 2 for processing.
                                        </div>
                                    </div>
                                </div>
                            <div>
                                    <i class="fas fa-file bg-green"></i>
                                    <div class="timeline-item">
                                        <span class="time"><i class="far fa-clock"></i> 12:20</span>
                                        <h3 class="timeline-header"><a href="#">Document 001</a> approved by Office 2</h3>
                                        <div class="timeline-body">
                                            Document 001 has been approved by Office 2 and forwarded to Office 3.
                                        </div>
                                    </div>
                                </div>
                                <div class="time-label">
                                    <span class="bg-green">11 Feb. 2023</span>
                                </div>
                                <div>
                                    <i class="fas fa-envelope bg-blue"></i>
                                    <div class="timeline-item">
                                        <span class="time"><i class="far fa-clock"></i> 12:25</span>
                                        <h3 class="timeline-header"><a href="#">Document 001</a> sent to Office 3</h3>
                                        <div class="timeline-body">
                                            Document 001 has been sent to Office 3 for processing.
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <i class="fas fa-file bg-yellow"></i>
                                    <div class="timeline-item">
                                        <span class="time"><i class="far fa-clock"></i> 12:45</span>
                                        <h3 class="timeline-header"><a href="#">Document 001</a> rejected by Office 3</h3>
                                        <div class="timeline-body">
                                            Document 001 has been rejected by Office 3 and returned to Office 2.
                                        </div>
                                    </div>
                                </div>
                                <div class="time-label">
                                    <span class="bg-red">12 Feb. 2023</span>
                                </div>
                                <div>
                                    <i class="fas fa-file bg-blue"></i>
                                    <div class="timeline-item">
                                        <span class="time"><i class="far fa-clock"></i> 10:30</span>
                                        <h3 class="timeline-header"><a href="#">Document 001</a> approved by Office 2</h3>
                                        <div class="timeline-body">
                                            Document 001 has been approved by Office 2 and forwarded to Office 4.
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <i class="fas fa-check bg-green"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    
    
</div>
<div class="col-md-3">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">User Metrics</h3>
        </div>
        <div class="card-body">
            <div class="user-metric-card">
                <h4>User 1</h4>
                <div class="metric-item">
                    <i class="fas fa-file"></i>
                    <div class="metric-text">
                        <h5>Documents Processed</h5>
                        <p>25</p>
                    </div>
                </div>
                <div class="metric-item">
                    <i class="fas fa-clock"></i>
                    <div class="metric-text">
                        <h5>Processing Time</h5>
                        <p>12 hours</p>
                    </div>
                </div>
                <div class="metric-item">
                    <i class="fas fa-exclamation-circle"></i>
                    <div class="metric-text">
                        <h5>Error Rate</h5>
                        <p>5%</p>
                    </div>
                </div>
            </div>
            <div class="user-metric-card">
                <h4>User 2</h4>
                <div class="metric-item">
                    <i class="fas fa-file"></i>
                    <div class="metric-text">
                        <h5>Documents Processed</h5>
                        <p>18</p>
                    </div>
                </div>
                <div class="metric-item">
                    <i class="fas fa-clock"></i>
                    <div class="metric-text">
                        <h5>Processing Time</h5>
                        <p>9 hours</p>
                    </div>
                </div>
                <div class="metric-item">
                    <i class="fas fa-exclamation-circle"></i>
                    <div class="metric-text">
                        <h5>Error Rate</h5>
                        <p>2%</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


                    


   
@endsection
