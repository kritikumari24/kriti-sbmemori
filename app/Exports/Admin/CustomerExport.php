<?php

namespace App\Exports\Admin;

use App\Services\CustomerService;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class CustomerExport implements FromQuery, WithHeadings, ShouldAutoSize, WithStyles
{
    /**
     * @return \Illuminate\Support\Collection
     */
    use Exportable;

    protected $name, $email, $status, $customer_id, $mobile_no, $customerService;

    public function __construct(Request $request)
    {
        $this->name = $request->name;
        $this->email = $request->email;
        $this->customer_id = $request->customer_id;
        $this->status = $request->status;
        $this->mobile_no = $request->mobile_no;
        $this->customerService = new CustomerService;
    }

    public function query()
    {
        $customer = $this->customerService->downloadcustomerReport();
        if (isset($this->name)) {
            $customer = $customer->where('name', 'like', "%{$this->name}%");
        }
        if (isset($this->email)) {
            $customer = $customer->where('email', 'like', "%{$this->email}%");
        }
        if (isset($this->mobile_no)) {
            $customer = $customer->where('mobile_no', $this->mobile_no);
        }
        if (isset($this->customer_id)) {
            $customer = $customer->where('id', $this->customer_id);
        }
        if (isset($this->status)) {
            $customer = $customer->where('is_active', $this->status);
        }
        return $customer;
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
