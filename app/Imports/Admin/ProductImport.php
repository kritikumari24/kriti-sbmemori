<?php

namespace App\Imports\Admin;

use Exception;
use App\Models\Product;
use App\Services\HelperService;
use App\Services\ProductService;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
use App\Services\ManagerLanguageService;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithStartRow;

class ProductImport implements ToCollection, WithStartRow
{
    protected $mls, $productService, $helperService, $productModel;

    public function __construct()
    {
        $this->mls = new ManagerLanguageService('flash');
        $this->productService = new ProductService();
        $this->helperService = new HelperService();
        $this->productModel = new Product();
    }

    /**
     * @return int
     */
    public function startRow(): int
    {
        return 2;
    }

    /**
     * @param Collection $collection
     */
    public function collection(Collection $rows)
    {
        $data = [];
        $i = 0;
        // dd($rows);
        foreach ($rows as $row) {
            // if ($row[0] == null) continue;
            // if ($row[1] == null) continue;
            // if ($row[2] == null) continue;
            // if ($row[3] == null) continue;
            // if ($row[4] == null) continue;
            /**
             *         'title','name','quantity', 'price','is_active', 'slug',
             */

            $data[$i]['title'] = $row[0];
            $data[$i]['name'] = $row[1];
            $data[$i]['quantity'] = $row[2];
            $data[$i]['price'] = $row[3];

            if (($row[4] == 'Active') || ($row[4] ==  'active') || ($row[4] ==  '1')) {
                $data[$i]['is_active'] = 1;
            } else {
                $data[$i]['is_active'] = 0;
            }
            // $data[$i]['slug'] = $this->helperService->createSlug($this->productModel, 'slug', $row[1]);
            $data[$i]['created_at'] = $this->helperService->getCurrentDateTime();
            $i++;
        }
        // $products = $this->productService->insert($data);
        try {
            $this->productService->insert($data);
        } catch (Exception $e) {
            Log::error("message :" . $e->getMessage());
            return redirect()->back()->with('error', 'something went wrong !');
        }
    }
}
