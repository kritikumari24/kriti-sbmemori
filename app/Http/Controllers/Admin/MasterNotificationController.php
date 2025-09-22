<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MasterNotificationRequest;
use App\Models\MasterNotification;
use App\Services\FileService;
use Illuminate\Http\Request;
use App\Services\HelperService;
use App\Services\ManagerLanguageService;
use Spatie\Permission\Models\Role;

class MasterNotificationController extends Controller
{
    private $helperService, $fileService, $masterNotificationService;

    public function __construct()
    {
        $this->masterNotificationService = new MasterNotificationService();
        $this->helperService = new HelperService();
        $this->fileService = new FileService();
        $this->middleware('permission:master_notification', ['only' => ['index', 'create', 'store', 'edit', 'update', 'destroy']]);
        $this->mls = new ManagerLanguageService('messages');
    }

    /**
     * Display a view or listing of the resource depending on type of request
     *
     *@param  \Illuminate\Http\Request  $request
     *@return view | json
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $items = $this->masterNotificationService->dataTable();
            return datatables()->eloquent($items)->toJson();
        } else {
            return view('admin.master_notification.index');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $role = Role::whereNotIn('name', ['Admin'])->get();
        return view('admin.master_notification.create', compact('role'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MasterNotificationRequest $request)
    {
        $input = $request->except(['_token', 'icon']);
        $image = $this->fileService->imageUploader($request, 'image', 'files/notifications/');
        if ($image != null) {
            $input['image'] = $image;
        }
        $icon_image = $this->fileService->imageUploader($request, 'icon', 'files/notifications/');
        if ($icon_image != null) {
            $input['icon'] = $icon_image;
        }
        $data  = $this->masterNotificationService->create($input);

        $message = array(
            'body'  => $data->message,
            'title' => $data->title,
            'image' => $data->image ? FileService::getFileUrl('/files/notifications/', $data->image) : '',
        );
        if ($request->role_id == 2) {
            $topic = 'Therapist';
        } else if ($request->role_id == 3) {
            $topic = 'PFA';
        } else {
            $topic = 'Patient';
        }
        // Notificaion send by topic
        HelperService::sendNotificationToTopic($topic, $message);

        return redirect()->route('master_notifications.index')
            ->with('success', $this->mls->messageLanguage('created', 'master_notification', 1));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $notification = MasterNotificationService::getById($id);
        return view('admin.master_notification.details', compact('notification'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(MasterNotification $master_notification)
    {
        $role = Role::whereNotIn('name', ['Admin'])->get();
        $data = $master_notification;
        return view('admin.master_notification.edit', compact('data', 'role'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(MasterNotificationRequest $request, MasterNotification $master_notification)
    {
        $input = $request->except(['_token', '_method', 'image', 'icon']);
        $image = $this->fileService->imageUploader($request, 'image', 'files/notifications/');
        if ($image != null) {
            $input['image'] = $image;
        }
        $icon_image = $this->fileService->imageUploader($request, 'icon', 'files/notifications/');
        if ($icon_image != null) {
            $input['icon'] = $icon_image;
        }

        $data = $this->masterNotificationService->update($input, $master_notification);
        return redirect()->route('master_notifications.index')
            ->with('success', $this->mls->messageLanguage('updated', 'master_notification', 1));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(MasterNotification $master_notification)
    {
        $result = MasterNotificationService::delete($master_notification);
        if ($result) {
            return response()->json([
                'status' => 1,
                'title' => $this->mls->onlyNameLanguage('deleted_title'),
                'message' => $this->mls->messageLanguage('deleted', 'master_notification', 1),
                'status_name' => 'success'
            ]);
        } else {
            return response()->json([
                'status' => 0,
                'title' => $this->mls->onlyNameLanguage('deleted_title'),
                'message' => $this->mls->messageLanguage('not_deleted', 'master_notification', 1),
                'status_name' => 'error'
            ]);
        }
    }
    /**
     * resend the notification .
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function resendNotification($id)
    {
        $data = MasterNotificationService::getById($id);
        $message = array(
            'body'  => $data->message,
            'title' => $data->title,
            'image' => $data->image ? FileService::getFileUrl('/files/notifications/', $data->image) : '',
        );
        if ($data->role_id == 2) {
            $topic = 'Therapist';
        } else if ($data->role_id == 3) {
            $topic = 'PFA';
        } else {
            $topic = 'Patient';
        }
        // Notificaion send by topic
        $status = HelperService::sendNotificationToTopic($topic, $message);

        if ($status) {
            return response()->json([
                'status' => 1,
                'message' => $this->mls->messageLanguage('resend', 'master_notification', 1),
                'status_name' => 'success'
            ]);
        } else {
            return response()->json([
                'status' => 0,
                'message' => $this->mls->messageLanguage('not_resend', 'master_notification', 1),
                'status_name' => 'error'
            ]);
        }
    }
}
