<?php

namespace App\Http\Controllers\Admin;

use Exception;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Guruji;
use Illuminate\Http\Request;
use App\Services\FileService;
use App\Services\UserService;
use App\Services\GurujiService;
use App\Services\HelperService;
use App\Models\PushNotification;
use App\Services\UtilityService;
use App\Notifications\PushNotify;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\PushnotificationHasUser;
use App\Services\ManagerLanguageService;
use App\Services\PushNotificationService;
use App\Http\Requests\Admin\PushNotificationRequest;

class PushNotificationController extends Controller
{

    protected $pushNotificationService, $mls;
    public function __construct()
    {
        //services
        $this->pushNotificationService = new PushNotificationService();

        $this->mls = new ManagerLanguageService('messages');
        // $this->middleware('permission:pushNotification', ['only' => ['index', 'create', 'store', 'edit', 'update', 'destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $items = PushNotification::query();
            return datatables()->eloquent($items)->toJson();
        } else {
            return view("admin.push_notification.index");
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $notification_type = HelperService::notificationType();
        $roles = Role::whereNotIn('name', ['Admin', 'Admin'])->pluck('name', 'name');
        $auth_user = Auth::guard('admin')->user();
        $userRole = $auth_user->roles->pluck('name', 'name');
        $pushNotification = [];
        return view('admin.push_notification.create', compact('roles', 'userRole', 'notification_type', 'pushNotification'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PushNotificationRequest $request)
    {
        $input = $request->except(['_token', 'users']);
        $image = FileService::imageUploader($request, 'image', 'pushNotifications/');
        $icon = FileService::imageUploader($request, 'icon', 'pushNotifications/');

        if ($image != null) {
            $input['image_url'] = 'pushNotifications/' . $image;
        }

        if ($icon != null) {
            $input['icon_url'] =  'pushNotifications/' . $icon;
        }
        if (isset($request->notification_time)) {
            $input['notification_time'] = Carbon::parse($request->notification_time)->format('Y-m-d H:i:s');
        }
        if ($request->user == 0) {
            $input['member_type'] = 0;
        }
        if (isset($request->messages)) {
            $input['message'] = $request->messages;
        }

        // dd($request->all(), $input);
        $pushNotification = $this->pushNotificationService->create($input);
        if ((!isset($request->users) || !count($request->users)) && $request->user == 1) {
            if (!isset($request->notification_time)) {
                $notification_data = [
                    'body'  => $pushNotification->message,
                    'title' => $pushNotification->title,
                    'image_url' => $pushNotification->image_url ? HelperService::getFileUrl('', $pushNotification->image_url, 'push_notification') : '',
                    'icon_url' => $pushNotification->icon_url ? HelperService::getFileUrl('', $pushNotification->icon_url, 'push_notification') : '',
                    'link_type' => $pushNotification->link_type,
                    'link_id' => isset($pushNotification->link_id) ? (string)$pushNotification->link_id : '',
                ];
                try {
                    HelperService::sendNotificationToTopic('promotion_user', $notification_data);
                    // if ($request->user_type == 'guruji') {
                    //     HelperService::sendNotificationToTopic('promotion_guruji', $notification_data);
                    // } else if ($request->user_type == 'user') {
                    //     HelperService::sendNotificationToTopic('promotion_user', $notification_data);
                    // }
                } catch (Exception $e) {
                    Log::error(["---- Store Push Notification Customer --- Topic - promotion", $e->getMessage()]);
                }
            }
        } else {
            if (isset($request->users) && count($request->users)) {
                foreach ($request->users as $user) {
                    $pushnotificationHasUser = new PushnotificationHasUser();
                    $pushnotificationHasUser->user_id = $user;
                    $pushnotificationHasUser->push_notification_id = $pushNotification->id;
                    $pushnotificationHasUser->save();

                    $user_model = UserService::getById($user);
                    if ($request->direct_notification && $user_model->is_notify == true) {
                        try {
                            $user_model->notify(new PushNotify($pushNotification));
                        } catch (Exception $e) {
                            Log::info(["----Store Push Notification --- User - $user_model->id "]);
                        }
                    }
                }
            } else {
                // return redirect()->back()->with('error', 'Please select Users for Individual');
                return redirect()->back()->with('error', 'Error! while creating PushNotification.');
            }
        }
        // dd(true);
        return redirect()->back()->with('success', 'PushNotification created successfully.');
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(PushNotification $pushNotification)
    {
        $notification_type = HelperService::notificationType();
        $roles = Role::whereNotIn('name', ['Admin', 'Admin'])->pluck('name', 'name');
        $auth_user = Auth::guard('admin')->user();
        $userRole = $auth_user->roles->pluck('name', 'name');
        return view('admin.push_notification.edit', compact('roles', 'userRole', 'notification_type', 'pushNotification'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(PushNotification $pushNotification)
    {
        return view('admin.push_notification.details', compact('pushNotification'));
    }

    /**
     * get data the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function getUserByName(Request $request)
    {
        $searchTerm = $request->search;
        $userType = $request->user_type;

        // Fetch all roles except 'Admin'
        $roles = Role::whereNotIn('name', ['Admin'])->pluck('name')->toArray();

        // Check if search term and user type are valid
        if (!$searchTerm || !in_array($userType, $roles)) {
            return response()->json([
                'status' => 0,
                'title' => 'Invalid Parameters',
                'message' => 'Please provide valid search parameters',
                'status_name' => 'error'
            ]);
        }

        // Build the query
        $query = User::whereHas("roles", function ($q) use ($userType) {
            $q->where("name", $userType);
        })->where('is_active', 1)
            ->whereNotNull('name')
            ->where('name', '!=', '')
            ->where(function ($query) use ($searchTerm) {
                $query->where('name', 'like', "%{$searchTerm}%")
                    ->orWhere('id', 'like', "%{$searchTerm}%");
            });

        // Execute the query
        $result = $query->select('id', 'name', 'name as text')
            ->orderBy('name', 'desc')
            ->limit(20)
            ->get();

        // Check if no results found
        if ($result->isEmpty()) {
            return response()->json([
                'status' => 0,
                'title' => 'No Data Found',
                'message' => 'No matching users found',
                'status_name' => 'error'
            ]);
        }

        // Return the results
        return response()->json([
            'status' => 1,
            'message' => 'User data retrieved successfully',
            'data' => $result
        ]);
    }

    public function destroy(PushNotification $pushNotification)
    {
        $result = $this->pushNotificationService->delete($pushNotification);
        if ($result) {
            $message = $this->mls->messageLanguage('deleted', 'pushNotification', 1);
            UtilityService::is200Response($message);
        } else {
            $message =  $this->mls->messageLanguage('not_deleted', 'pushNotification', 1);
            UtilityService::is422Response($message);
        }
    }
    public function status($id, $status)
    {
        $status = ($status == 1) ? 0 : 1;
        $result = $this->pushNotificationService->status(['status' => $status], $id);
        if ($result) {
            $message = $this->mls->messageLanguage('updated', 'status', 1);
            UtilityService::is200Response($message);
        } else {
            $message =  $this->mls->messageLanguage('not_updated', 'status', 1);
            UtilityService::is422Response($message);
        }
    }
}
