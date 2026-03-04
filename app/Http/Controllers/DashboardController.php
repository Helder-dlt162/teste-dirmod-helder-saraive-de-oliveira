<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = auth()->user();

        $totalBrl     = $user->expenses()->sum('brl_value');
        $totalCount   = $user->expenses()->count();
        $pendingCount = $user->expenses()->where('status', 'pending')->count();

        $latest = $user->expenses()->latest()->take(5)->get();

        return view('dashboard', compact(
            'totalBrl',
            'totalCount',
            'pendingCount',
            'latest'
        ));
    }
}