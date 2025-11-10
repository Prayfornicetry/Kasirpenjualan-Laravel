<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        // Jika user belum login, redirect ke login
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        // Tampilkan view dashboard
        return view('dashboard.index'); // Pastikan file view ada di resources/views/dashboard/index.blade.php
    }
}