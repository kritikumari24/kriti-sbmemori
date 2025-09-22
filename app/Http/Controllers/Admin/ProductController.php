<?php

namespace App\Http\Controllers\Admin;

use App\Exports\Admin\ProductExport;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ProductRequest;
use App\Imports\Admin\ProductImport;
use App\Models\Product;
use App\Models\ProductImage;
use App\Services\FileService;
use App\Services\ManagerLanguageService;
use App\Services\ProductService;
use Illuminate\Support\Facades\Response;
use Maatwebsite\Excel\Facades\Excel;

class ProductController extends Controller
{
    protected $mls, $productService, $upload_image_directory;
    protected $index_view, $create_view, $edit_view, $detail_view, $product_history_view;
    protected $index_route_name, $create_route_name, $detail_route_name, $edit_route_name;

    public function __construct()
    {
        //Permissions
        // $this->middleware('permission:product-list|product-create|product-edit|product-delete', ['only' => ['index', 'store']]);
        // $this->middleware('permission:product-create', ['only' => ['create', 'store']]);
        // $this->middleware('permission:product-edit', ['only' => ['edit', 'update', 'status']]);
        // $this->middleware('permission:product-delete', ['only' => ['destroy']]);

        //Data
        $this->upload_image_directory = 'files/products';
        //route
        $this->index_route_name = 'admin.products.index';
        $this->create_route_name = 'admin.products.create';
        $this->detail_route_name = 'admin.products.show';
        $this->edit_route_name = 'admin.products.edit';

        //view files
        $this->index_view = 'admin.product.index';
        $this->create_view = 'admin.product.create';
        $this->detail_view = 'admin.product.details';
        $this->edit_view = 'admin.product.edit';
        $this->product_history_view = 'admin.product.product_history';

        //services
        $this->productService = new ProductService();

        //mls is used for manage language content based on keys in messages.php
        $this->mls = new ManagerLanguageService('messages');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $items = $this->productService->datatable();
            $items = ProductService::search($request, $items);
            return datatables()->eloquent($items)->toJson();
        } else {
            return view($this->index_view);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view($this->create_view);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        $input = $request->all();
        $product = $this->productService->create($input);

        $product_images = [];

        if ($request->hasFile('product_images')) {
            $images = FileService::multipleImageUploader($request, 'product_images', $this->upload_image_directory);

            for ($i = 0; $i < count($images); $i++) {
                $product_images[$i]['product_id'] = $product->id;
                $product_images[$i]['name'] = $images[$i];
            }
            ProductImage::insert($product_images);
        }

        return redirect()->route($this->index_route_name)
            ->with('success', $this->mls->messageLanguage('created', 'product', 1));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return view($this->detail_view, compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        return view($this->edit_view, compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, Product $product)
    {
        $input = $request->all();
        $this->productService->update($input, $product);

        if ($request->hasFile('product_images')) {
            $images = FileService::multipleImageUploader($request, 'product_images', $this->upload_image_directory);

            for ($i = 0; $i < count($images); $i++) {
                $product_images[$i]['product_id'] = $product->id;
                $product_images[$i]['name'] = $images[$i];
            }
            ProductImage::insert($product_images);
        }

        return redirect()->back()
            ->with('success', $this->mls->messageLanguage('updated', 'product', 1));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $result = $this->productService->delete($product);
        if ($result) {
            return response()->json([
                'status' => 1,
                'title' => $this->mls->onlyNameLanguage('deleted_title'),
                'message' => $this->mls->onlyNameLanguage('product'),
                'status_name' => 'success'
            ]);
        } else {
            return response()->json([
                'status' => 0,
                'title' => $this->mls->onlyNameLanguage('deleted_title'),
                'message' => $this->mls->onlyNameLanguage('product'),
                'status_name' => 'error'
            ]);
        }
    }

    public function status($id, $status)
    {
        $status = ($status == 1) ? 0 : 1;
        $result = $this->productService->status(['is_active' => $status], $id);
        if ($result) {
            return response()->json([
                'status' => 1,
                'message' => $this->mls->messageLanguage('updated', 'status', 1),
                'status_name' => 'success'
            ]);
        } else {
            return response()->json([
                'status' => 0,
                'message' => $this->mls->messageLanguage('not_updated', 'status', 1),
                'status_name' => 'error'
            ]);
        }
    }

    public function export(Request $request)
    {
        return (new ProductExport($request))->download($request->export == 'excel' ? 'products.xlsx' : 'products.csv');
    }

    public function productHistory(Product $product)
    {
        return view($this->product_history_view, compact('product'));
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function import(Request $request)
    {
        $test = Excel::import(new ProductImport, $request->file);
        if (session()->has('error')) {
            return back()->with('error', session()->get('error'));
        } else {
            return back()->with('success', $this->mls->onlyNameLanguage('all_good_title'));
        }
    }

    public function downloadImportFormatFile()
    {
        $url = '/product_import_format.xlsx';
        // $fileName = time() . '.xlsx';
        $filePath = public_path() . $url;
        $filename = '';
        $headers = array(
            'Content-Type' => 'application/vnd.ms-excel',
            'Content-Disposition' => 'inline; filename="' . 'sasaee.xlsx' . '"'
        );

        return Response::download($filePath, $filename, $headers);
    }

    /**
     * Remove the specified product image from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function deleteImage($id)
    {
        $product_image = ProductImage::find($id);
        $remove_image = FileService::removeImage($product_image, 'name', 'files/products');
        if ($remove_image) {
            $result = $product_image->delete();
            if ($result) {
                return response()->json([
                    'status' => 1,
                    'title' => $this->mls->onlyNameLanguage('deleted_title'),
                    'message' => $this->mls->onlyNameLanguage('image_deleted'),
                    'status_name' => 'success'
                ]);
            } else {
                return response()->json([
                    'status' => 0,
                    'title' => $this->mls->onlyNameLanguage('deleted_title'),
                    'message' => $this->mls->onlyNameLanguage('image_not_deleted'),
                    'status_name' => 'error'
                ]);
            }
        } else {
            return response()->json([
                'status' => 0,
                'title' => $this->mls->onlyNameLanguage('deleted_title'),
                'message' => $this->mls->onlyNameLanguage('image_not_deleted'),
                'status_name' => 'error'
            ]);
        }
    }
}
