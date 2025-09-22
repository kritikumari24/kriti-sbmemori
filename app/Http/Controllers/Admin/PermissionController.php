<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\PermissionRequest;
use App\Http\Requests\RoleRequest;
use App\Services\ManagerLanguageService;
use App\Services\PermissionService;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
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
            $permissions = PermissionService::datatable();
            return datatables()->eloquent($permissions)->toJson();
        } else {
            return view('admin.permissions.index');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.permissions.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PermissionRequest $request)
    {
        $input = $request->except(['_token', 'proengsoft_jsvalidation']);
        $permission = PermissionService::create($input);

        // return redirect()->route('admin.permissions.index')
        return redirect()->back()
            ->with('success', $this->mls->messageLanguage('created', 'permission', 1));
    }

    /**
     * Display the specified resource.
     *
     * @param Permission $permission
     * @return \Illuminate\Http\Response
     */
    public function show(Permission $permission)
    {
        return view('admin.permissions.details', compact('permission'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Permission $permission
     * @return \Illuminate\Http\Response
     */
    public function edit(Permission $permission)
    {
        return view('admin.permissions.edit', compact('permission'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param Permission $permission
     * @return \Illuminate\Http\Response
     */
    public function update(PermissionRequest $request, Permission $permission)
    {
        $input = $request->except(['_token']);
        $permissions = PermissionService::update($input, $permission);
        if ($permissions) {
            return redirect()->route('admin.permissions.index')
                ->with('success', $this->mls->messageLanguage('updated', 'permission', 1));
        } else {
            return redirect()->back()
                ->with('error', $this->mls->messageLanguage('not_updated', 'permission', 1));
        }
    }

    public function status($id, $status)
    {
        $status = ($status == 1) ? 0 : 1;
        $result = PermissionService::status(['is_active' => $status], $id);
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
     * @param Permission $permission
     * @return \Illuminate\Http\Response
     */
    public function destroy(Permission $permission)
    {
        $result = PermissionService::delete($permission);
        if ($result) {
            return response()->json([
                'status' => 1,
                'title' => $this->mls->onlyNameLanguage('deleted_title'),
                'message' => $this->mls->messageLanguage('deleted', 'permission', 1),
                'status_name' => 'success'
            ]);
        } else {
            return response()->json([
                'status' => 0,
                'title' => $this->mls->onlyNameLanguage('deleted_title'),
                'message' => $this->mls->messageLanguage('not_deleted', 'permission', 1),
                'status_name' => 'error'
            ]);
        }
    }
}
