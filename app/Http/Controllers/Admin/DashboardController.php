<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\User;
use App\Services\DashboardService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Mpdf\Mpdf;

class DashboardController extends Controller
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

    public function test()
    {
        $user = Auth::guard('admin')->user();
        return view('admin.test', compact('user'));
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // $user = Auth::guard('admin')->user();
        // dd($user);
        // dd($user->getRoleNames(), $user->roles, $user->permissions, $user->getPermissionsViaRoles(), $user->getAllPermissions());

        return view('admin.dashboard');
    }

    public function dashboardCountsData()
    {
        $data = DashboardService::adminDataCounts();
        return response()->json([
            'status' => 1,
            'message' => 'Dashboard Data Get Successfully ',
            'data' => $data
        ]);
    }

    public function samplePdf(Request $request)
    {
        // Initialize mPDF
        $mpdfConfig = [
            'mode' => 'utf-8',
            'format' => 'A4',
            'autoMarginPadding' => 0, // Remove auto padding
            'margin_left' => 0,
            'margin_right' => 0,
            'margin_top' => 9,
            'margin_bottom' => 5,
            'margin_header' => 0, // Set header margin (optional)
            'margin_footer' => 0, // Set footer margin (optional)
        ];
        $mpdf = new Mpdf($mpdfConfig);

        // Set header and footer
        $mpdf->SetHTMLHeader('Test Header');
        $mpdf->SetHTMLFooter('Test Footer');
        // // Set font for Hindi text
        $mpdf->autoScriptToLang = true;
        $mpdf->baseScript = 1;
        $mpdf->autoLangToFont = true;

        $filename = 'sample_kundli';

        // Generate PDF content (replace this with your own content generation logic)
        $html_content = "Invoice By Gorishanker sharma";
        $html_blade = 'sample_pdf';
        $html = View::make($html_blade, compact('html_content'))->render();
        // Add content to PDF
        $mpdf->WriteHTML($html);

        // Output PDF
        if ($request->download_type == 'stream') {
            $mpdf->Output($filename, 'I');
        } else {
            $mpdf->Output($filename, 'D');
        }
    }
    public function showChartData()
    {
        $dailyUserData  = $this->getUserChartData('user');
        $weeklyUserCount = $this->getUserChartData('user', 7);
        return response()->json([
            'dailyUserData' => $dailyUserData,
            'weeklyUserCount' => $weeklyUserCount,
        ]);
    }
    public function getUserChartData($user_type = 'user', $days = null)
    {
        $days = isset($days) ? $days : Carbon::now()->daysInMonth;
        $dates = [];
        for ($day = 0; $day < $days; $day++) {
            $dates[] = Carbon::today()->copy()->subDays($day)->toDateString();
        }
        $dataCounts = User::selectRaw('DATE(created_at) as date, COUNT(*) as count')
            ->where('created_at', ">=", Carbon::today()->subDays($days))
            ->groupBy('date')
            ->orderBy('date')
            ->pluck('count', 'date')
            ->toArray();

        foreach ($dates as $date) {
            if (!isset($dataCounts[$date])) {
                $dataCounts[$date] = 0;
            }
        }
        return $dataCounts;
    }
}
