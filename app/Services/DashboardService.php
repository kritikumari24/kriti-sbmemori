<?php

namespace App\Services;

use App\Models\User;
use Carbon\Carbon;

class DashboardService
{
    /**
     * Update the specified resource in storage.
     *
     * @return $data
     */
    public static function adminDataCounts()
    {
        $date = Carbon::now()->subDays(7);
        $data['new_users'] = User::where('created_at', '>=', $date)->count();
        $data['total_clients'] = User::count();
        $data['yearly_sales_count'] = 0;
        $data['total_vendors'] = 0;
        $data['total_purchase'] = 0;
        $data['total_unpaid_bill'] = 455;
        $data['total_unrecieved_bill'] = 0;
        $data['total_unrecieved_amount'] = 0;
        $data['total_dept_balance'] = 0;
        $data['total_asset'] = 0;
        return $data;
    }
}
