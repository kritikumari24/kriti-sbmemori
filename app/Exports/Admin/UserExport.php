<?php

namespace App\Exports\Admin;

use App\Services\UserService;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class UserExport implements FromQuery, WithHeadings, ShouldAutoSize, WithStyles
{
    /**
     * @return \Illuminate\Support\Collection
     */
    use Exportable;

    protected $name, $email, $status, $user_id, $mobile_no, $userService;

    public function __construct(Request $request)
    {
        $this->name = $request->name;
        $this->email = $request->email;
        $this->user_id = $request->user_id;
        $this->status = $request->status;
        $this->mobile_no = $request->mobile_no;
        $this->userService = new UserService;
    }

    public function query()
    {
        $user = $this->userService->downloaduserReport();
        if (isset($this->name)) {
            $user = $user->where('name', 'like', "%{$this->name}%");
        }
        if (isset($this->email)) {
            $user = $user->where('email', 'like', "%{$this->email}%");
        }
        if (isset($this->mobile_no)) {
            $user = $user->where('mobile_no', 'like', "%{$this->mobile_no}%");
        }
        if (isset($this->user_id)) {
            $user = $user->where('id', 'like', "%{$this->user_id}%");
        }
        if (isset($this->status)) {
            $user = $user->where('is_active', $this->status);
        }
        return $user;
    }

    public function headings(): array
    {
        return [
            'User-Id',
            'Name',
            'Email',
            'Mobile Number',
            'Status',
            'Created Date',
            'Updated Date'
        ];
    }

    public function styles(Worksheet $sheet)
    {
        $sheet->getStyle('B')->getFont()->setBold(true);
        $sheet->getStyle(1)->getFont()->setBold(true);
    }
}
