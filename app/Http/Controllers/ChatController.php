<?php

namespace App\Http\Controllers;

use App\Http\Collections\Chat\ChatCollection;
use App\Http\Collections\Chat\ChatMessageCollection;
use App\Http\Collections\Chat\UserCollection;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Chat;
use App\Models\ChatMessage;
use App\Models\User;
use App\Services\FileService;
use App\Services\UtilityService;

class ChatController extends Controller
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

        $users = User::where('is_active', 1)->get();
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

        $chat = Chat::where(['user_first'=> $user->id, 'user_second' => $request->receiver_id])->orWhere(['user_first'=> $request->receiver_id, 'user_second' => $user->id])->first();
        $data = [];
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
        $data['user_first'] = $user->id;
        $data['user_second'] = $request->receiver_id;
        if ($chat) {
            $chat->update($data);
        } else {
            $chat = Chat::create($data);
        }
        $chat_messages = [
            'chat_id' => $chat->id,
            'sender_id' => $user->id,
            'message' => $data['last_message'],
            'is_file' => $data['is_file'],
        ];
        ChatMessage::create($chat_messages);
        $chat_messages = ChatMessage::where(['chat_id' => $chat->id])->orderBy('created_at', 'desc')->get();
        $chat_messages->paginate(isset($request->pagination) ? $request->pagination : 10);
        if (count($chat_messages) > 0) {
            $data = new ChatMessageCollection($chat_messages);
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
        $chats = Chat::where('user_first', $user->id)->orWhere('user_second', $user->id)->get();
        // if (isset($request->pagination)) {
        //     $chats->paginate($request->pagination);
        // }else{
        //     $chats->paginate(10);
        // }

        if (count($chats) > 0) {
            $data = new ChatCollection($chats);
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
        $chat_messages = ChatMessage::where(['chat_id' => $request->chat_id])->orderBy('created_at', 'desc')->get();
        $chat_messages->paginate($pagination);

        if (count($chat_messages) > 0) {
            $data = new ChatMessageCollection($chat_messages);
            return $data;
        } else {
            $message = __('no_item_available');
            $data = [];
            return UtilityService::is200ResponseWithDataArrKey(responseMsg($message), $data);
        }
    }

}

