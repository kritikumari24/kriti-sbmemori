<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('staff.auth');
    }

    public function index()
    {
        $data['title'] = 'Staff Dashboard';
        $data['user'] = Auth::user();
        return view('staff.dashboard', compact('data'));
    }
}