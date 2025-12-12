@extends('layouts.admin')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')

@section('breadcrumb')
    <li class="breadcrumb-item active">Dashboard</li>
@endsection

@section('content')
<div class="container-fluid">
    <!-- Small boxes (Stat box) -->
    <div class="row">
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>{{ $userCount }}</h3>
                    <p>Total Users</p>
                </div>
                <div class="icon">
                    <i class="fas fa-users"></i>
                </div>
                <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
                <div class="inner">
                    <h3>{{ $roleCount }}</h3>
                    <p>User Roles</p>
                </div>
                <div class="icon">
                    <i class="fas fa-user-shield"></i>
                </div>
                <a href="{{ route('admin.roles.index') }}" class="small-box-footer">View Roles <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
                <div class="inner">
                    <h3>44</h3>
                    <p>Active Sessions</p>
                </div>
                <div class="icon">
                    <i class="fas fa-chart-line"></i>
                </div>
                <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
                <div class="inner">
                    <h3>65</h3>
                    <p>System Logs</p>
                </div>
                <div class="icon">
                    <i class="fas fa-clipboard-list"></i>
                </div>
                <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
    </div>

    <!-- Main row -->
    <div class="row">
        <!-- Left col -->
        <section class="col-lg-7 connectedSortable">
            <!-- Recent Activities -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-history mr-1"></i>
                        Recent Activities
                    </h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Activity</th>
                                    <th>User</th>
                                    <th>Time</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>User Login</td>
                                    <td>admin@thibitisha.test</td>
                                    <td>Just now</td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>Role Updated</td>
                                    <td>System</td>
                                    <td>5 minutes ago</td>
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td>New User Registered</td>
                                    <td>john@thibitisha.test</td>
                                    <td>1 hour ago</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section>

        <!-- Right col -->
        <section class="col-lg-5 connectedSortable">
            <!-- Quick Stats -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-chart-pie mr-1"></i>
                        Quick Stats
                    </h3>
                </div>
                <div class="card-body">
                    <div class="progress-group">
                        Administrator Users
                        <span class="float-right"><b>1</b>/{{ $userCount }}</span>
                        <div class="progress progress-sm">
                            <div class="progress-bar bg-primary" style="width: {{ ($userCount > 0 ? 1/$userCount : 0) * 100 }}%"></div>
                        </div>
                    </div>
                    
                    <div class="progress-group">
                        Regular Users
                        <span class="float-right"><b>{{ $userCount - 1 }}</b>/{{ $userCount }}</span>
                        <div class="progress progress-sm">
                            <div class="progress-bar bg-success" style="width: {{ ($userCount > 0 ? ($userCount - 1)/$userCount : 0) * 100 }}%"></div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- System Info -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-info-circle mr-1"></i>
                        System Information
                    </h3>
                </div>
                <div class="card-body">
                    <ul class="list-unstyled">
                        <li><strong>Laravel Version:</strong> {{ app()->version() }}</li>
                        <li><strong>PHP Version:</strong> {{ phpversion() }}</li>
                        <li><strong>Database:</strong> MySQL</li>
                        <li><strong>Environment:</strong> {{ app()->environment() }}</li>
                        <li><strong>Timezone:</strong> {{ config('app.timezone') }}</li>
                    </ul>
                </div>
            </div>
        </section>
    </div>
</div>
@endsection