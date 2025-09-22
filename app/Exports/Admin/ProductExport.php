<?php

namespace App\Exports\Admin;

use App\Services\ProductService;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class ProductExport implements FromQuery, WithHeadings, ShouldAutoSize, WithStyles
{
    /**
     * @return \Illuminate\Support\Collection
     */
    use Exportable;

    protected $request, $productService;

    public function __construct(Request $request)
    {
        $this->request = $request;
        $this->productService = new ProductService;
    }

    public function query()
    {
        $items = $this->productService->downloadProductReport();
        $items = $this->productService->search($this->request, $items);
        return $items;
    }

    public function headings(): array
    {
        return [
            'Product-Id',
            'Title',
            'Name',
            'Quantity',
            'Price',
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
