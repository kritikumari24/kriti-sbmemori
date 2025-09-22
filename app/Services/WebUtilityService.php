<?php

namespace App\Services;

use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Hash;

class WebUtilityService
{
    public static function hash_password($value)
    {
        return Hash::make($value);
    }

    public static function responseMsg()
    {
        return
            [
                'success_msg' => 'Data Get Successfully',
                'success_add_msg' => 'Data Created Successfully',
                'success_update_msg' => 'Data Update Successfully',
                'success_status_update_msg' => 'Status Update Successfully',
                'success_delete_msg' => 'Data Deleted Successfully',
                'no_records_msg' => 'No Records Found',
                'error_msg' => 'Error! Please contact to support team',

                'add_like_msg' => 'Your Post Like has been added successfully.',
                'remove_like_msg' => 'Your Post Like has been removed successfully.',
                'add_saved_msg' => 'Your Post has been saved successfully.',
                'remove_saved_msg' => 'Your Post is no longer save.',
                'incorrect_key' => 'Incorrect key Provided.',
            ];
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

    public static function swalResponse($result, $key, $value)
    {
        if ($result) {
            return self::jsonResponse(1, responseMsg($key, $value, 1), 'success');
        } else {
            return self::jsonResponse(0, responseMsg('not_' . $key, $value, 1), 'error');
        }
    }

    public static function swalWithTitleResponse($result, $key, $value)
    {
        if ($result) {
            return self::jsonResponseWithTitle(1, responseMsg($key, $value, 1), 'success', responseMsg($key));
        } else {
            return self::jsonResponseWithTitle(0, responseMsg('not_' . $key, $value, 1), 'error', responseMsg('not_' . $key));
        }
    }
}
