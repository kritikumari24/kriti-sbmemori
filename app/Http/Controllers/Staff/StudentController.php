<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function __construct()
    {
        $this->middleware('staff.auth');
    }

    public function index()
    {
        $students = User::role('Parents')->get();
        return view('staff.students.index', compact('students'));
    }

    public function show($id)
    {
        $student = User::findOrFail($id);
        return view('staff.students.show', compact('student'));
    }
}