<?php

namespace App\Http\Controllers;

use App\Http\Collections\Chat\RoleChatCollection;
use App\Http\Collections\Chat\RoleChatMessageCollection;
use App\Http\Collections\Chat\UserCollection;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\RoleChat;
use App\Models\RoleChatMessage;
use App\Models\User;
use App\Services\FileService;
use App\Services\UtilityService;

class ChatWithRoleController extends Controller
{

    public function __construct()
    {
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $request->validate([
            'searching_key' => 'nullable|max:150',
            'pagination' => 'nullable|integer|between:1,100',
        ]);
        $user = getApiAuthUser();
        $role = 'Customer';
        if ($user->hasRole('Customer'))
            $role = 'Vendor';
        elseif ($user->hasRole('Vendor'))
            $role = 'Customer';
        $users = User::with('roles')->whereHas('roles', function ($q) use ($role) {
            $q->where('name', $role);
        })->get();
        if (isset($request->searching_key)) {
            $users->where('name', 'like', '%' . $request->searching_key . '%');
        }
        // if (isset($request->pagination)) {
        //     $users->paginate($request->pagination);
        // }else{
        //     $users->paginate(10);
        // }
        if (count($users) > 0) {
            $data = new UserCollection($users);
            return $data;
        } else {
            $message = __('no_item_available');
            $data = [];
            return UtilityService::is200ResponseWithDataArrKey(responseMsg($message), $data);
        }
    }

    public function store(Request $request, User $user)
    {
        $request->validate([
            'receiver_id' => 'required|integer|exists:users,id',
            'pagination' => 'nullable|integer|between:1,100',
            'message' => 'required',
            'file' => 'nullable',
        ]);
        $user = getApiAuthUser();
        $data = [];
        $data['customer_id'] = $user->id;
        $data['vendor_id'] = $request->receiver_id;
        $sender_type = 'customer';
        if ($user->hasRole('Customer')){
            $data['customer_id'] = $user->id;
            $data['vendor_id'] = $request->receiver_id;
        }elseif ($user->hasRole('Vendor')){
            $data['customer_id'] = $request->receiver_id;
            $data['vendor_id'] = $user->id;
            $sender_type = 'vendor';
        }
        $chat = RoleChat::where(['customer_id' =>$data['customer_id'], 'vendor_id' => $data['vendor_id']])->first();
        if ($request->hasFile('file')) {
            $file = FileService::ImageUploader($request, 'file', 'chat/files');
            if ($file != null) {
                $data['last_message'] = $file;
                $data['is_file'] = 1;
            }
        } else {
            $data['last_message'] = $request->message;
            $data['is_file'] = 0;
        }
        if ($chat) {
            $chat->update($data);
        } else {
            $chat = RoleChat::create($data);
        }
        $chat_messages = [
            'chat_id' => $chat->id,
            'sender_id' => $user->id,
            'sender_type' => $sender_type,
            'message' => $data['last_message'],
            'is_file' => $data['is_file'],
        ];
        RoleChatMessage::create($chat_messages);
        $chat_messages = RoleChatMessage::where(['chat_id' => $chat->id])->orderBy('created_at', 'desc')->get();
        $chat_messages->paginate(isset($request->pagination) ? $request->pagination : 10);
        if (count($chat_messages) > 0) {
            $data = new RoleChatMessageCollection($chat_messages);
            return $data;
        } else {
            $message = __('no_item_available');
            $data = [];
            return UtilityService::is200ResponseWithDataArrKey(responseMsg($message), $data);
        }
    }

    function getActiveChats(Request $request, User $user)
    {
        $request->validate([
            'pagination' => 'nullable|integer|between:1,100',
        ]);
        $user = getApiAuthUser();
        $user_id_name = 'customer_id';
        if ($user->hasRole('Customer')){
            $user_id_name = 'customer_id';
        }elseif ($user->hasRole('Vendor')){
            $user_id_name = 'vendor_id';
        }
        $chats = RoleChat::where($user_id_name,$user->id)->get();
        // if (isset($request->pagination)) {
        //     $chats->paginate($request->pagination);
        // }else{
        //     $chats->paginate(10);
        // }

        if (count($chats) > 0) {
            $data = new RoleChatCollection($chats);
            return $data;
        } else {
            $message = __('no_item_available');
            $data = [];
            return UtilityService::is200ResponseWithDataArrKey(responseMsg($message), $data);
        }
    }

    function getChatHistory(Request $request)
    {
        $request->validate([
            'pagination' => 'nullable|integer|between:1,100',
            'chat_id' => 'required|integer|exists:chat_messages,chat_id',
        ]);
        $pagination = isset($request->pagination) ? $request->pagination : 10;
        $chat_messages = RoleChatMessage::where(['chat_id' => $request->chat_id])->orderBy('created_at', 'desc')->get();
        $chat_messages->paginate($pagination);

        if (count($chat_messages) > 0) {
            $data = new RoleChatMessageCollection($chat_messages);
            return $data;
        } else {
            $message = __('no_item_available');
            $data = [];
            return UtilityService::is200ResponseWithDataArrKey(responseMsg($message), $data);
        }
    }
}
