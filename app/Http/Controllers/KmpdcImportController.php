<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Storage;

class KmpdcImportController extends Controller
{
    public function index()
    {
        // Check for existing CSV files
        $csvFiles = [];
        $csvPath = storage_path('app/kmpdc-data/csv');
        
        if (is_dir($csvPath)) {
            $csvFiles = array_slice(scandir($csvPath), 2); // Remove . and ..
            $csvFiles = array_filter($csvFiles, fn($file) => str_ends_with($file, '.csv'));
        }
        
        return view('kmpdc.import', compact('csvFiles'));
    }
    
    public function sync()
    {
        try {
            Artisan::call('kmpdc:sync');
            $output = Artisan::output();
            
            return back()->with('success', 'Sync completed: ' . $output);
        } catch (\Exception $e) {
            return back()->with('error', 'Sync failed: ' . $e->getMessage());
        }
    }
    
    public function extract()
    {
        try {
            Artisan::call('kmpdc:extract');
            $output = Artisan::output();
            
            return back()->with('success', 'Extract completed: ' . $output);
        } catch (\Exception $e) {
            return back()->with('error', 'Extract failed: ' . $e->getMessage());
        }
    }
    
    public function import()
    {
        try {
            Artisan::call('kmpdc:import');
            $output = Artisan::output();
            
            return back()->with('success', 'Import completed: ' . $output);
        } catch (\Exception $e) {
            return back()->with('error', 'Import failed: ' . $e->getMessage());
        }
    }
    
    public function runAll()
    {
        try {
            $results = [];
            
            // Step 1: Sync
            Artisan::call('kmpdc:sync');
            $results['sync'] = Artisan::output();
            
            // Step 2: Extract
            Artisan::call('kmpdc:extract');
            $results['extract'] = Artisan::output();
            
            // Step 3: Import
            Artisan::call('kmpdc:import');
            $results['import'] = Artisan::output();
            
            return back()->with('success', 'All operations completed successfully!');
        } catch (\Exception $e) {
            return back()->with('error', 'Operation failed: ' . $e->getMessage());
        }
    }
}
