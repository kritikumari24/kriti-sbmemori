<?php

namespace App\Http\Controllers\Parents;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('parents.auth');
    }

    public function index()
    {
        $data['title'] = 'Parents Dashboard';
        $data['user'] = Auth::user();
        return view('parents.dashboard', compact('data'));
    }
}