<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\ContactUs;
use Illuminate\Http\Request;
use App\Services\UtilityService;
use App\Services\ContactUsService;
use App\Http\Controllers\Controller;
use App\Services\ManagerLanguageService;
use App\Http\Requests\Admin\ContactUsRequest;

class ContactUsController extends Controller
{
    protected $mls, $contactUsService, $upload_file_directory;
    protected $index_view, $create_view, $edit_view, $detail_view;
    protected $index_route, $create_route, $detail_route, $edit_route;

    public function __construct()
    {
        //Permissions
        // $this->middleware('permission:contact_us', ['only' => ['index', 'create', 'store', 'edit', 'update', 'destroy']]);
        // $this->middleware('permission:contact_us-list|contact_us-create|contact_us-edit|contact_us-delete', ['only' => ['index', 'store']]);
        // $this->middleware('permission:contact_us-create', ['only' => ['create', 'store']]);
        // $this->middleware('permission:contact_us-edit', ['only' => ['edit', 'update', 'status']]);
        // $this->middleware('permission:contact_us-delete', ['only' => ['destroy']]);

        //route
        $this->index_route = 'admin.contact-us.index';
        $this->create_route = 'admin.contact-us.create';
        $this->detail_route = 'admin.contact-us.show';
        $this->edit_route = 'admin.contact-us.edit';

        //view files
        $this->index_view = 'admin.contact_us.index';
        $this->create_view = 'admin.contact_us.create';
        $this->detail_view = 'admin.contact_us.details';
        $this->edit_view = 'admin.contact_us.edit';

        //services
        $this->contactUsService = new ContactUsService();

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
            $items = $this->contactUsService->datatable();
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
        $users = User::whereHas('roles', function ($q) {
            $q->whereNotIn('name', ['Admin']);
        })->where('is_active', 1)->pluck('name', 'id');
        return view($this->create_view, compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ContactUsRequest $request)
    {
        $input = $request->except(['_token', 'proengsoft_jsvalidation']);
        $contact_us = $this->contactUsService->create($input);
        return redirect()->route($this->index_route)
            ->with('success', $this->mls->messageLanguage('created', 'contact_us', 1));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $contact_us = $this->contactUsService->getById($id);
        return view($this->detail_view, compact('contact_us'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $users = User::whereHas('roles', function ($q) {
            $q->whereNotIn('name', ['Admin']);
        })->where('is_active', 1)->pluck('name', 'id');
        $contact_us = $this->contactUsService->getById($id);
        return view($this->edit_view, compact('contact_us', 'users'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ContactUsRequest $request, ContactUs $contact_u)
    {
        $input = $request->except(['_token', '_method', 'proengsoft_jsvalidation']);

        $user = $this->contactUsService->updateById($input, $contact_u->id);
        return redirect()->route($this->index_route)
            ->with('success', $this->mls->messageLanguage('updated', 'contact_us', 1));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(ContactUs $contact_u)
    {
        $result = $this->contactUsService->delete($contact_u);
        if ($result) {
            $message = $this->mls->messageLanguage('deleted', 'contact_us', 1);
            UtilityService::is200Response($message);
        } else {
            $message =  $this->mls->messageLanguage('not_deleted', 'contact_us', 1);
            UtilityService::is422Response($message);
        }
    }
    public function status($id, $status)
    {
        $status = ($status == 1) ? 0 : 1;
        $result = $this->contactUsService->status(['is_active' => $status], $id);
        if ($result) {
            $message = $this->mls->messageLanguage('updated', 'status', 1);
            UtilityService::is200Response($message);
        } else {
            $message =  $this->mls->messageLanguage('not_updated', 'status', 1);
            UtilityService::is422Response($message);
        }
    }
}
