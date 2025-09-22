<?php

namespace App\Http\Controllers\Admin;

use App\Models\Faq;
use App\Services\FaqService;
use Illuminate\Http\Request;
use App\Services\UtilityService;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\FaqRequest;
use App\Services\ManagerLanguageService;

class FaqController extends Controller
{
    protected $mls, $faqService, $upload_file_directory;
    protected $index_view, $create_view, $edit_view, $detail_view;
    protected $index_route, $create_route, $detail_route, $edit_route;

    public function __construct()
    {
        //Permissions
        // $this->middleware('permission:faq', ['only' => ['index', 'create', 'store', 'edit', 'update', 'destroy']]);
        // $this->middleware('permission:faq-list|faq-create|faq-edit|faq-delete', ['only' => ['index', 'store']]);
        // $this->middleware('permission:faq-create', ['only' => ['create', 'store']]);
        // $this->middleware('permission:faq-edit', ['only' => ['edit', 'update', 'status']]);
        // $this->middleware('permission:faq-delete', ['only' => ['destroy']]);

        //route
        $this->index_route = 'admin.faqs.index';
        $this->create_route = 'admin.faqs.create';
        $this->detail_route = 'admin.faqs.show';
        $this->edit_route = 'admin.faqs.edit';

        //view files
        $this->index_view = 'admin.faq.index';
        $this->create_view = 'admin.faq.create';
        $this->detail_view = 'admin.faq.details';
        $this->edit_view = 'admin.faq.edit';

        //services
        $this->faqService = new FaqService();

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
            $items = $this->faqService->datatable();
            if (isset($request->question)) {
                $items = $items->where('question', 'like', "%{$request->question}%");
            }
            if (isset($request->status)) {
                $items = $items->where('is_active', $request->status);
            }
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
    public function store(FaqRequest $request)
    {
        $input = $request->except(['_token', 'proengsoft_jsvalidation']);
        $faq = $this->faqService->create($input);
        return redirect()->route($this->index_route)
            ->with('success', $this->mls->messageLanguage('created', 'faq', 1));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $faq = $this->faqService->getById($id);
        return view($this->detail_view, compact('faq'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $faq = $this->faqService->getById($id);
        return view($this->edit_view, compact('faq'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(FaqRequest $request, Faq $faq)
    {
        $input = $request->except(['_token', '_method', 'proengsoft_jsvalidation']);
        $user = $this->faqService->updateById($input, $faq->id);
        return redirect()->route($this->index_route)
            ->with('success', $this->mls->messageLanguage('updated', 'faq', 1));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Faq $faq)
    {
        $result = $this->faqService->delete($faq);
        if ($result) {
            $message = $this->mls->messageLanguage('deleted', 'faq', 1);
            UtilityService::is200Response($message);
        } else {
            $message =  $this->mls->messageLanguage('not_deleted', 'faq', 1);
            UtilityService::is422Response($message);
        }
    }
    public function status($id, $status)
    {
        $status = ($status == 1) ? 0 : 1;
        $result = $this->faqService->status(['is_active' => $status], $id);
        if ($result) {
            $message = $this->mls->messageLanguage('updated', 'status', 1);
            UtilityService::is200Response($message);
        } else {
            $message =  $this->mls->messageLanguage('not_updated', 'status', 1);
            UtilityService::is422Response($message);
        }
    }
}
