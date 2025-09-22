<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\TypeRequest;
use App\Models\Type;
use App\Services\TypeService;
use App\Services\ManagerLanguageService;
use App\Services\UtilityService;

class TypeController extends Controller
{
    protected $mls;
    protected $index_view, $create_view, $edit_view, $detail_view;
    protected $index_route_name, $create_route_name, $detail_route_name, $edit_route_name;
    protected $typeService, $utilityService;

    public function __construct()
    {
        //route
        $this->index_route_name = 'admin.types.index';
        $this->detail_route_name = 'admin.types.show';
        $this->edit_route_name = 'admin.types.edit';

        //view files
        $this->index_view = 'admin.type.index';
        $this->detail_view = 'admin.type.details';
        $this->edit_view = 'admin.type.edit';

        //service files
        $this->typeService = new TypeService();
        $this->utilityService = new UtilityService();

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
            $items = $this->typeService->dataTable();
            return dataTables()->eloquent($items)->toJson();
        } else {
            return view($this->index_view);
        }
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TypeRequest $request)
    {
        $input = $request->validated();
        $data = Type::create($input);
        if (isset($data)) {
            return response()->json([
                'status' => true,
                'message' => 'Abuse Language created successfully.',
            ], 200);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Error! while creating categories.',
            ], 422);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Type $type)
    {
        $html = view($this->detail_view, compact('type'))->render();
        return response()->json([
            'status' => true,
            'data' => $html,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Type $type)
    {
        $html = view($this->edit_view, compact('type'))->render();
        return response()->json([
            'status' => true,
            'data' => $html,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TypeRequest $request, Type $type)
    {
        $input = $request->validated();
        $data = $type->update($input);
        if (isset($data)) {
            return response()->json([
                'status' => true,
                'message' => 'Abuse Language created successfully.',
            ], 200);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Error! while creating type.',
            ], 422);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Type $type)
    {
        $result = $type->delete();
        if ($result) {
            return response()->json([
                'status' => 1,
                'title' => $this->mls->onlyNameLanguage('deleted_title'),
                'message' => $this->mls->onlyNameLanguage('type'),
                'status_name' => 'success'
            ]);
        } else {
            return response()->json([
                'status' => 0,
                'title' => $this->mls->onlyNameLanguage('deleted_title'),
                'message' => $this->mls->onlyNameLanguage('type'),
                'status_name' => 'error'
            ]);
        }
    }

    public function status($id, $status)
    {
        $status = ($status ==1 ) ? 0 : 1;
        $result = TypeService::status(['is_active' => $status], $id);
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
