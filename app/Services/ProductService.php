<?php

namespace App\Services;

use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductService
{
    use ServiceTrait;
    protected $product_image_directory;

    public function __construct()
    {
        self::$models = 'App\Models\Product';
        $this->product_image_directory = 'files/products';
    }

    /**
     * Insert the specified resource.
     *
     * @param Request $request
     * @return Product
     */
    public static function insert(array $data)
    {
        $data = Product::insert($data);
        return $data;
    }

    /**
     * Get data by $parameters.
     *
     * @param Array $parameters
     * @return Model
     */
    public static function getByParameters($parameters)
    {
        $data = Product::query();
        foreach ($parameters as $parameter) {
            $data = $data->where($parameter['column_name'], $parameter['value']);
        }
        return $data;
    }

    /**
     * Fetch records for datatables
     */
    public static function datatable()
    {
        $data = Product::query();
        return $data;
    }

    /**
     * Get data for download Report from storage.
     *
     * @return Product
     */
    public static function downloadProductReport()
    {
        $data = Product::query()
            ->select(
                'id',
                'title',
                'name',
                'quantity',
                'price',
                DB::raw("(CASE WHEN (is_active = 1) THEN 'Active' ELSE 'Inactive' END) as status"),
                DB::raw("(DATE_FORMAT(created_at,'%d-%M-%Y')) as created_date"),
                DB::raw("(DATE_FORMAT(updated_at,'%d-%M-%Y')) as updated_date"),
            )->orderBy('created_at', 'desc');
        return $data;
    }

    /**
     * Delete the old product image
     */
    public static function deleteOldImage(ProductImage $product_image)
    {
        FileService::removeImage($product_image, 'image', 'files/products');
        $result = $product_image->delete();
        return $result;
    }

    public static function search(Request $request, $items)
    {
        if (isset($request->name)) {
            $items = $items->where('name', 'like', "%{$request->name}%");
        }
        if (isset($request->product_id)) {
            $items = $items->where('id', $request->product_id);
        }
        if (isset($request->status)) {
            $items = $items->where('is_active', $request->status);
        }
        return $items;
    }
}
