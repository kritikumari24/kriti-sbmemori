<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, Postmark, AWS and more. This file provides the de facto
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'slack' => [
        'notifications' => [
            'bot_user_oauth_token' => env('SLACK_BOT_USER_OAUTH_TOKEN'),
            'channel' => env('SLACK_BOT_USER_DEFAULT_CHANNEL'),
        ],
    ],

    'app_details' => [
        'app_name' => env('APP_NAME'),
    ],

    'img' => [
        'local_img_url' => env('APP_URL') . '/storage/',
    ],

    'img_size' => [
        //all sizes are in mb
        'premade_plan_floor_max' => 10,
    ],

    's3' => [
        'image_url' => env("AWS_IMAGE_URL", "https://s3.ap-south-1.amazonaws.com/" . env('AWS_BUCKET') . "/public/"),
    ],

    'env' => [
        'img_compression' => env('IMG_COMPRESSION', false),
        'production' => env('PRODUCTION', false),
        'filesystem_disk' => env('FILESYSTEM_DISK', 'local'),
        'dob_format' => env('DOB_FORMAT', "Y-M-D"),
        'date_format' => env('DATE_FORMAT', "M d, Y"),
        'datetime_format' => env('DATETIME_FORMAT', "d M Y, h:i A"),
        'time_format' => env('TIME_FORMAT', "h:i A"),
        'user_default_pswd' => env('USER_DEFAULT_PSWD', "User@123"),
        'currency' => env('CURRENCY_FORMAT', '₹'),
        'mail_services' => env('MAIL_SERVICES', false),
        'notify_services' => env('NOTIFY_SERVICES', false),
        'otp_digit' => (env('PRODUCTION', false)) ? env('OTP_DIGIT', 4) : 4,
        'banner_upload_img_count' => env('BANNER_UPLOAD_IMG_COUNT', 10),
    ],

];
