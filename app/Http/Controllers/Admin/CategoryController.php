<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Services\CategoryService;
use App\Services\FileService;
use App\Services\ManagerLanguageService;

class CategoryController extends Controller
{
    protected $mls;
    public function __construct()
    {
        // $this->middleware('permission:category', ['only' => ['index', 'create', 'store', 'edit', 'update', 'destroy']]);
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
            $items = CategoryService::datatable();
            return datatables()->eloquent($items)->toJson();
        } else {
            return view('admin.category.index');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->except(['_token']);
        $image = FileService::imageUploader($request, 'image', 'files/categories/');
        if ($image != null) {
            $input['image'] = $image;
        }
        $category = CategoryService::create($input);

        return redirect()->route('admin.categories.index')
            ->with('success', $this->mls->messageLanguage('created', 'category', 1));
    }

    /**
     * Display the specified resource.
     *
     * @param Category $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        return view('admin.category.details', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Category $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        return view('admin.category.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param Category $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $input = $request->except(['_token']);
        $image = FileService::imageUploader($request, 'image', 'files/categories/');
        if ($image != null) {
            $input['image'] = $image;
        }
        $category = CategoryService::update($input, $category);
        if ($category) {
            return redirect()->route('admin.categories.index')
                ->with('success', $this->mls->messageLanguage('updated', 'category', 1));
        } else {
            return redirect()->back()
                ->with('error', $this->mls->messageLanguage('not_updated', 'category', 1));
        }
    }

    public function status($id, $status)
    {
        $status = ($status == 1) ? 0 : 1;
        $result = CategoryService::status(['is_active' => $status], $id);
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
    /**
     * Remove the specified resource from storage.
     *
     * @param Category $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $result = CategoryService::delete($category);
        if ($result) {
            return response()->json([
                'status' => 1,
                'title' => $this->mls->onlyNameLanguage('deleted_title'),
                'message' => $this->mls->messageLanguage('deleted', 'category', 1),
                'status_name' => 'success'
            ]);
        } else {
            return response()->json([
                'status' => 0,
                'title' => $this->mls->onlyNameLanguage('deleted_title'),
                'message' => $this->mls->messageLanguage('not_deleted', 'category', 1),
                'status_name' => 'error'
            ]);
        }
    }
}
