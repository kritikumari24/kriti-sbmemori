<?php

namespace App\Services;

use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Hash;

class UtilityService
{
    public static function is200Response($responseMessage)
    {
        throw new HttpResponseException(response()->json([
            'status' => true,
            'message' => $responseMessage
        ], 200));
    }


    public static function is200ResponseWithData($responseMessage, $data)
    {
        throw new HttpResponseException(response()->json([
            'status' => true,
            'data' => $data,
            'message' => $responseMessage
        ], 200));
    }

    public static function is200ResponseWithDataArrKey($responseMessage, $data)
    {
        throw new HttpResponseException(response()->json([
            'status' => true,
            'data' => [
                'data' => $data,
            ],
            'message' => $responseMessage
        ], 200));
    }

    public static function is200ResponseWithDataWithExtra($responseMessage, $data, $extra_key, $extra_value)
    {
        throw new HttpResponseException(response()->json([
            'status' => true,
            $extra_key => $extra_value,
            'data' => $data,
            'message' => $responseMessage
        ], 200));
    }

    public static function is200ResponseWithDataArrWithExtra($responseMessage, $data, $extra_key, $extra_value)
    {
        throw new HttpResponseException(response()->json([
            'status' => true,
            $extra_key => $extra_value,
            'data' => [
                'data' => $data,
            ],
            'message' => $responseMessage
        ], 200));
    }

    public static function is422Response($responseMessage)
    {
        throw new HttpResponseException(response()->json([
            'status' => false,
            'message' => $responseMessage
        ], 422));
    }

    public static function is422ResponseWithData($responseMessage, $data)
    {
        throw new HttpResponseException(response()->json([
            'status' => false,
            'data' => $data,
            'message' => $responseMessage
        ], 422));
    }


    public static function is500Response($responseMessage)
    {
        throw new HttpResponseException(response()->json([
            'status' => false,
            'error' => $responseMessage,
            'message' => $responseMessage
        ], 500));
    }

    public static function is401Response($responseMessage)
    {
        throw new HttpResponseException(response()->json([
            'status' => false,
            'type' => 'unauthorized',
            'message' => $responseMessage
        ], 401));
    }


    public static function hash_password($value)
    {
        return Hash::make($value);
    }

    public static function responseMsg($key, $name = null, $number = 1, $filename = 'messages')
    {
        if (isset($name)) {
            if (gettype($name) == 'string') {
                return __($filename . '.' . $key, ['name' => trans_choice($filename . '.' . $name, $number)]);
            }
            if (gettype($name) == 'integer') {
                return trans_choice($filename . '.' . $key, $name);
            }
        }
        return trans_choice($filename . '.' . $key, $number);
    }

    public static function returnJsonWithResponseMsg($data, $key = 'data')
    {
        //messages
        if ($data) {
            return self::is200Response(responseMsg('added', $key));
        } else {
            return self::is422Response(responseMsg('error_msg'));
        }
    }

    public static function returnJsonWithPatchResponseMsg($data, $key = 'data')
    {
        //messages
        if ($data) {
            return self::is200Response(responseMsg('success_update_msg', $key));
        } else {
            return self::is422Response(responseMsg('error_msg'));
        }
    }

    public static function jsonResponse($status, $message, $status_name)
    {
        return response()->json([
            'status' => $status,
            'message' => $message,
            'status_name' => $status_name,
        ]);
    }

    public static function jsonResponseWithTitle($status, $message, $status_name, $title = '')
    {
        return response()->json([
            'status' => $status,
            'message' => $message,
            'status_name' => $status_name,
            'title' => $title
        ]);
    }

    public static function onlyBooleanMsg($result, $key, $value)
    {
        if ($result) {
            return self::is200Response(responseMsg($key, $value, 1));
        } else {
            return self::is422Response(responseMsg('not_' . $key, $value, 1));
        }
    }
}
