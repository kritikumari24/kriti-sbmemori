<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\TestRequest;
use App\Models\User;
use Illuminate\Support\Arr;
use App\Services\ManagerLanguageService;
use App\Services\TestService;
use App\Services\FileService;
use App\Services\WebUtilityService;

class TestController extends Controller
{
    protected $mls, $change_password, $upload_image_directory;
    protected $index_view, $create_view, $edit_view, $detail_view;
    protected $index_route_name, $create_route_name, $detail_route_name, $edit_route_name;
    protected $testService, $webUtilityService;

    public function __construct()
    {
        //Permissions
        // $this->middleware('permission:test-list|test-create|test-edit|test-delete', ['only' => ['index', 'store']]);
        // $this->middleware('permission:test-create', ['only' => ['create', 'store']]);
        // $this->middleware('permission:test-edit', ['only' => ['edit', 'update', 'status']]);
        // $this->middleware('permission:test-delete', ['only' => ['destroy']]);

        //Data
        $this->upload_image_directory = 'files/users';
        //route
        $this->index_route_name = 'admin.tests.index';
        $this->create_route_name = 'admin.tests.create';
        $this->detail_route_name = 'admin.tests.show';
        $this->edit_route_name = 'admin.tests.edit';

        //view files
        $this->index_view = 'admin.test.index';
        $this->create_view = 'admin.test.create';
        $this->detail_view = 'admin.test.details';
        $this->profile_view = 'admin.test.profile';
        $this->edit_view = 'admin.test.edit';

        //service files
        $this->testService = new TestService();
        $this->webUtilityService = new WebUtilityService();

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
            $items = TestService::datatable();
            if (isset($request->name)) {
                $items = $items->where('name', 'like', "%{$request->name}%");
            }
            if (isset($request->test_id)) {
                $items = $items->where('id', $request->test_id);
            }
            if (isset($request->status)) {
                $items = $items->where('is_active', $request->status);
            }
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
    public function store(TestRequest $request)
    {
        $input = $request->all();
        $image = FileService::imageUploader($request, 'image', $this->upload_image_directory);
        if ($image != null) {
            $input['image'] = $image;
        }
        $test = User::create($input);

        return redirect()->route($this->index_route_name)
            ->with('success', $this->mls->messageLanguage('created', 'test', 1));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $test)
    {
        return view($this->profile_view, compact('test'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $test)
    {
        return view($this->edit_view, compact('test'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TestRequest $request, User $test)
    {
        $input = $request->all();
        if (!empty($input['image'])) {
            $image = FileService::imageUploader($request, 'image', $this->upload_image_directory);
            if ($image != null) {
                $input['image'] = $image;
            }
        } else {
            $input = Arr::except($input, array('image'));
        }

        $test->update($input);

        // return redirect()->route($this->index_route_name)
        return redirect()->back()
            ->with('success', $this->mls->messageLanguage('updated', 'test', 1));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $test)
    {
        $result = $test->delete();
        return $this->webUtilityService->swalWithTitleResponse($result, 'deleted', 'test');
        // if ($result) {
        //     return response()->json([
        //         'status' => 1,
        //         'title' => $this->mls->onlyNameLanguage('deleted_title'),
        //         'message' => $this->mls->onlyNameLanguage('test'),
        //         'status_name' => 'success'
        //     ]);
        // } else {
        //     return response()->json([
        //         'status' => 0,
        //         'title' => $this->mls->onlyNameLanguage('deleted_title'),
        //         'message' => $this->mls->onlyNameLanguage('test'),
        //         'status_name' => 'error'
        //     ]);
        // }
    }

    public function status($id, $status)
    {
        $status = ($status == 1) ? 0 : 1;
        $result = TestService::update(['is_active' => $status], $id);
        return $this->webUtilityService->swalResponse($result, 'updated', 'test');
        // if ($result) {
        //     return response()->json([
        //         'status' => 1,
        //         'message' => $this->mls->messageLanguage('updated', 'status', 1),
        //         'status_name' => 'success'
        //     ]);
        // } else {
        //     return response()->json([
        //         'status' => 0,
        //         'message' => $this->mls->messageLanguage('not_updated', 'status', 1),
        //         'status_name' => 'error'
        //     ]);
        // }
    }

    public function export(Request $request)
    {
        dd('export');
        // return (new TestExport($request))->download('tests.xlsx');
    }
}
