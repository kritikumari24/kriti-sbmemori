<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PageContentRequest;
use App\Models\PageContent;
use App\Services\ManagerLanguageService;
use App\Services\PageContentService;
use App\Services\UtilityService;
use Illuminate\Http\Request;

class PageContentController extends Controller
{
    protected $mls, $pageContentService, $upload_file_directory;
    protected $index_view, $create_view, $edit_view, $detail_view;
    protected $index_route, $create_route, $detail_route, $edit_route;

    public function __construct()
    {
        //Permissions
        // $this->middleware('permission:page_content', ['only' => ['index', 'create', 'store', 'edit', 'update', 'destroy']]);
        // $this->middleware('permission:page_content-list|page_content-create|page_content-edit|page_content-delete', ['only' => ['index', 'store']]);
        // $this->middleware('permission:page_content-create', ['only' => ['create', 'store']]);
        // $this->middleware('permission:page_content-edit', ['only' => ['edit', 'update', 'status']]);
        // $this->middleware('permission:page_content-delete', ['only' => ['destroy']]);

        //route
        $this->index_route = 'admin.page-contents.index';
        $this->create_route = 'admin.page-contents.create';
        $this->detail_route = 'admin.page-contents.show';
        $this->edit_route = 'admin.page-contents.edit';

        //view files
        $this->index_view = 'admin.page_content.index';
        $this->create_view = 'admin.page_content.create';
        $this->detail_view = 'admin.page_content.details';
        $this->edit_view = 'admin.page_content.edit';

        //services
        $this->pageContentService = new PageContentService();

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
            $items = $this->pageContentService->datatable();
            return datatables()->eloquent($items)->make(true);
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
    public function store(PageContentRequest $request)
    {
        $input = $request->except(['_token', 'proengsoft_jsvalidation']);
        $page_content = $this->pageContentService->create($input);
        return redirect()->route($this->index_route)
            ->with('success', $this->mls->messageLanguage('created', 'page_content', 1));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $page_content = $this->pageContentService->getById($id);
        return view($this->detail_view, compact('page_content'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $page_content = $this->pageContentService->getById($id);
        return view($this->edit_view, compact('page_content'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PageContentRequest $request, PageContent $page_content)
    {
        $input = $request->except(['_token', '_method', 'proengsoft_jsvalidation']);
        $user = $this->pageContentService->update($input, $page_content);
        return redirect()->route($this->index_route)
            ->with('success', $this->mls->messageLanguage('updated', 'page_content', 1));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(PageContent $page_content)
    {
        $result = $this->pageContentService->delete($page_content);
        if ($result) {
            return response()->json([
                'status' => 1,
                'title' => $this->mls->onlyNameLanguage('deleted_title'),
                'message' => $this->mls->onlyNameLanguage('page_content'),
                'status_name' => 'success'
            ]);
        } else {
            return response()->json([
                'status' => 0,
                'title' => $this->mls->onlyNameLanguage('deleted_title'),
                'message' => $this->mls->onlyNameLanguage('page_content'),
                'status_name' => 'error'
            ]);
        }
    }
    public function status($id, $status)
    {
        $status = ($status == 1) ? 0 : 1;
        $result = $this->pageContentService->status(['is_active' => $status], $id);

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
}
