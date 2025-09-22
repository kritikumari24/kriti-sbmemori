<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AdminErrorPageController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('admin.auth');
    }


    /**
     * Redirect to 404 Error Page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function pageNotFound()
    {
        $data['error_code'] = 404;
        $data['title'] = "Page Not Found - Go to Homepage";
        $data['description'] = "Oops! The page you are looking for does not exist. It might have been moved or deleted.";
        return view('admin.errors.error', compact('data'));
    }

    /**
     * Redirect to 500 Error Page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function serverError()
    {
        $data['error_code'] = 500;
        $data['title'] = "Internal Server Error - Go to Homepage";
        $data['description'] = "Oops! The page you are looking for does not fulfill your response.";
        return view('admin.errors.error', compact('data'));
    }
}
