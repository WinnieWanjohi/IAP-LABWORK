@extends('layouts.admin')

@section('title', 'KMPDC Data Import')
@section('page-title', 'KMPDC Data Import')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
    <li class="breadcrumb-item"><a href="{{ route('practitioners.index') }}">Practitioners</a></li>
    <li class="breadcrumb-item active">KMPDC Import</li>
@endsection

@section('content')
<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">KMPDC Data Import Process</h3>
            </div>
            <div class="card-body">
                <div class="alert alert-info">
                    <h5><i class="bi bi-info-circle"></i> Three-Step Import Process</h5>
                    <p>This process will scrape, extract, and import data from the Kenya Medical Practitioners and Dentists Council.</p>
                </div>
                
                <div class="row">
                    <!-- Step 1: Sync -->
                    <div class="col-md-4">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Step 1: Sync</h3>
                            </div>
                            <div class="card-body">
                                <p>Crawls KMPDC register and saves CSV file.</p>
                                <form action="{{ route('kmpdc.sync') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-primary btn-block">
                                        <i class="bi bi-cloud-download"></i> Run Sync
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Step 2: Extract -->
                    <div class="col-md-4">
                        <div class="card card-warning">
                            <div class="card-header">
                                <h3 class="card-title">Step 2: Extract</h3>
                            </div>
                            <div class="card-body">
                                <p>Extracts structured data from CSV to JSON.</p>
                                <form action="{{ route('kmpdc.extract') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-warning btn-block">
                                        <i class="bi bi-file-earmark-text"></i> Run Extract
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Step 3: Import -->
                    <div class="col-md-4">
                        <div class="card card-success">
                            <div class="card-header">
                                <h3 class="card-title">Step 3: Import</h3>
                            </div>
                            <div class="card-body">
                                <p>Imports JSON data into database.</p>
                                <form action="{{ route('kmpdc.import') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-success btn-block">
                                        <i class="bi bi-database"></i> Run Import
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="mt-4">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Run All Steps</h4>
                        </div>
                        <div class="card-body">
                            <p>Run all three steps sequentially:</p>
                            <form action="{{ route('kmpdc.runAll') }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-info btn-lg">
                                    <i class="bi bi-play-circle"></i> Run Complete Import
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Existing Data Files</h3>
            </div>
            <div class="card-body">
                @if(count($csvFiles) > 0)
                    <div class="list-group">
                        @foreach($csvFiles as $file)
                            <div class="list-group-item">
                                <i class="bi bi-file-earmark-spreadsheet"></i>
                                {{ $file }}
                                <small class="text-muted float-right">
                                    {{ Storage::size('kmpdc-data/csv/' . $file) }} bytes
                                </small>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="alert alert-warning">
                        No CSV files found. Run Sync to generate data files.
                    </div>
                @endif
            </div>
        </div>
        
        <div class="card mt-3">
            <div class="card-header">
                <h3 class="card-title">Statistics</h3>
            </div>
            <div class="card-body">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        Practitioners
                        <span class="badge bg-primary">{{ \App\Models\Practitioner::count() }}</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        Specialities
                        <span class="badge bg-success">{{ \App\Models\Speciality::count() }}</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        Institutions
                        <span class="badge bg-info">{{ \App\Models\Institution::count() }}</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        Degrees
                        <span class="badge bg-warning">{{ \App\Models\Degree::count() }}</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>

@if(session('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    {{ session('success') }}
    <button type="button" class="close" data-dismiss="alert">
        <span>&times;</span>
    </button>
</div>
@endif

@if(session('error'))
<div class="alert alert-danger alert-dismissible fade show" role="alert">
    {{ session('error') }}
    <button type="button" class="close" data-dismiss="alert">
        <span>&times;</span>
    </button>
</div>
@endif
@endsection
