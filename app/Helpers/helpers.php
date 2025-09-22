<?php

use App\Models\Setting;
use App\Models\User;
use App\Services\ManagerLanguageService;
use App\Services\UserService;
use App\Services\UtilityService;
use App\Services\SettingService;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Tymon\JWTAuth\Facades\JWTAuth;

function getUserName($name, $email = '', $mobile_no = '')
{
    if (!isset($name)) {
        if ($name == null) {
            $name = 'Guest';
        }
    } else {
        if ($name == null) {
            $name = 'Guest';
        }
    }

    if (!isset($email)) {
        if ($email == null) {
            $email = 'NA';
        }
    } else {
        if ($email == null) {
            $email = 'NA';
        }
    }

    if (!isset($mobile_no)) {
        if ($mobile_no == null) {
            $mobile_no = 'NA';
        }
    } else {
        if ($mobile_no == null) {
            $mobile_no = 'NA';
        }
    }

    return `<div>` . $name . `<br>(Mobile No: ` . $mobile_no . `) <br> (Email: ` . $email . `)</div>`;
}

function roleNameArr()
{
    return [
        'admin' => 'Admin',
        'customer' => 'Customer',
    ];
}

/** Get Role Names As String
 * @param mixed $key
 * @param Keys 'admin' => 'Admin',
 * @param Keys 'customer' => 'Customer',
 * @param Keys 'team' => 'Team',
 * @param Keys 'care' => 'Care',
 * @return string
 */
function roleName($key)
{
    $role = roleNameArr();
    return $role[$key];
}

function roleIdArr()
{
    return [
        'admin' => 1,
        'customer' => 2,
    ];
}

function roleId($key)
{
    $role = roleIdArr();
    return $role[$key];
}

function incorrectKeyJsonMsg($msg = 'Incorrect key Provided.')
{
    return UtilityService::is422Response($msg);
}

function getApiAuthUser()
{
    return JWTAuth::parseToken()->authenticate();
}

function getDataStatus($status=null){
    if($status == null){
        return [1 => "Active", 0 => "Inactive"];
    }else{
        if($status == 1){
            return "Active";
        }else{
            return "Inactive";
        }
    }
}

function getWebAuthUser()
{
    return Auth::user();
}
function getAdminAuthUser()
{
    return Auth::guard('admin')->user();
}

function url_exists($url)
{
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_NOBODY, true);
    curl_exec($ch);
    $code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    return ($code == 200);
}

function checkUserRole(User $user, $role_name)
{
    if ($user->hasRole($role_name)) {
        return true;
    } else {
        return false;
    }
}

function checkUserIsAdmin(User $user)
{
    return checkUserRole($user, 'Admin');
}

function checkUserIsCustomer(User $user)
{
    return checkUserRole($user, 'Customer');
}

function incrementKeyByModelId(Model $model, String $column_name)
{
    return $model->increment($column_name);
}

function incrementKeyByModelIdWithVal(Model $model, String $column_name, $value)
{
    return $model->increment($column_name, $value);
}

function decrementKeyByModelId(Model $model, String $column_name)
{
    return $model->decrement($column_name);
}

function decrementKeyByModelIdWithVal(Model $model, String $column_name, $value)
{
    return $model->decrement($column_name, $value);
}

/** Date convert into days ago*/
function time_elapsed_string($datetime, $full = false)
{
    $now = new DateTime();
    $ago = new DateTime($datetime);
    $diff = $now->diff($ago);

    $diff->w = floor($diff->d / 7);
    $diff->d -= $diff->w * 7;

    $string = array(
        'y' => 'year',
        'm' => 'month',
        'w' => 'week',
        'd' => 'day',
        'h' => 'hour',
        'i' => 'minute',
        's' => 'second',
    );

    foreach ($string as $k => &$v) {
        if ($diff->$k) {
            $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
        } else {
            unset($string[$k]);
        }
    }


    if (!$full) $string = array_slice($string, 0, 1);
    return $string ? implode(', ', $string) . ' ago' : 'just now';
}

/** Date convert into days ago*/
function time_elapsed_date_string($datetime, $full = false)
{
    $now = new DateTime();
    $ago = new DateTime($datetime);
    $diff = $now->diff($ago);

    $diff->w = floor($diff->d / 7);
    $diff->d -= $diff->w * 7;
    // dd($diff);
    // return $diff->d;
    if ($diff->w > 0) {
        return get_default_format($datetime);
    }
    $string = array(
        'y' => 'year',
        'm' => 'month',
        'w' => 'week',
        'd' => 'day',
        'h' => 'hour',
        'i' => 'minute',
        's' => 'second',
    );

    foreach ($string as $k => &$v) {
        // dump($k, $v, $string);
        if ($diff->$k) {
            $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
        } else {
            unset($string[$k]);
        }
    }


    if (!$full) $string = array_slice($string, 0, 1);
    // dd($string);
    return $string ? implode(', ', $string) . ' ago' : 'just now';
}

//return current date time
function getCurrentDateTime()
{
    // date_default_timezone_set("Asia/Calcutta");
    // return date("Y-m-d H:i:s");
    return Carbon::now();
}

/**
 * @param Dynamic $type
 * @param $type 0, DATE_FORMAT="M d, Y",
 * @param $type 1, TIME_FORMAT="h:i A"
 * @param $type 2, DATETIME_FORMAT="d M Y, h:i A"
 * @param $type 'format', User-Defined Format
 */
function get_default_format($datetime, $type = 0, $format = null)
{
    if ($type == 'format' && isset($format)) {
        $format_date = Carbon::parse($datetime)->format($format);
    } else if ($type == 2) { //DateTime
        $format_date = Carbon::parse($datetime)->format(env('DATETIME_FORMAT'));
    } else if ($type == 1) {  // time Time
        $format_date = Carbon::parse($datetime)->format(env('TIME_FORMAT'));
    } else { // date Date
        $format_date = Carbon::parse($datetime)->format(env('DATE_FORMAT'));
    }
    return $format_date;
}

function createJsonFile($json_content)
{
    if (isset($json_content)) {
        if ($json_content->count()) {
            try {
                Storage::disk('local')->put('public\global_page_content\global_page_content.json', json_encode($json_content));
                return true;
            } catch (Exception $e) {
                Log::error('Json File Not created');
            }
        }
    }
    return true;
}

function getJsonFile()
{
    $filePath = 'public/global_page_content/global_page_content.json';
    $file_exists = Storage::disk('local')->exists($filePath);
    if ($file_exists) {
        $path = Storage::disk('local')->url($filePath);
        return json_decode(file_get_contents(url('/') . $path), true);
    }
    return true;
}

function createJsonIfNotExists()
{
    $filePath = 'public/global_page_content/global_page_content.json';
    $file_exists = Storage::disk('local')->exists($filePath);
    if (!$file_exists) {
        return createJsonFile(Setting::pluck('value', 'slug'));
    }
    return true;
}

function generateUniqueReferralCode()
{
    $length = 7;
    $referral_code = 'B' . substr(str_shuffle('ABCDEFGHIJ0123456789KLMNOPQRST0123456789UVWXYZ0123456789'), 1, $length);

    $code_exists = UserService::getUserByReferralCode($referral_code);
    if (!$code_exists) {
        return $referral_code;
    }
    generateUniqueReferralCode();
}

function verifyReferralCode($referral_code)
{
    $referred_user = UserService::getUserByReferralCode($referral_code);
    if ($referred_user) {
        return $referred_user;
    }
    return null;
}

function mlsObj($filename = 'messages')
{
    $mls = new ManagerLanguageService($filename);
    return $mls;
}

function transMsg($key, $name = null, $number = 1)
{
    if (isset($name)) {
        if (gettype($name) == 'array') {
            /**
             * here, key is an array. So the index related the data as:
             * @param  string  $key = $name[0]
             * @param  \Countable|int|array  $number = $name[1]
             * @param  array  $replace = $name[2]
             * @param  string|null  $locale = $name[3]
             */
            return __($key, ['name' => trans_choice($name[0], $name[1] = 1, $name[2] = [], $name[3] = [])]);
        }
        if (gettype($name) == 'string') {
            return __($key, ['name' => trans_choice($name, $number)]);
        }
        if (gettype($name) == 'integer') {
            return trans_choice($key, $name);
        }
    }
    return trans_choice($key, $number);
}

function responseMsg($key, $name = null, $number = 1, $filename = 'messages')
{
    if (isset($name)) {
        if (gettype($name) == 'string') {
            // return mlsObj($filename)->messageLanguage($key, $name, $number);
            return __($filename . '.' . $key, ['name' => trans_choice($filename . '.' . $name, $number)]);
        }
        if (gettype($name) == 'integer') {
            return trans_choice($filename . '.' . $key, $name);
        }
    }
    // return mlsObj($filename)->getTitleNames($key, $number);
    return trans_choice($filename . '.' . $key, $number);
}


function defaultUserImageApiUrl()
{
    return  url('/') . '/virtue/images/default_user_image_api.png';
}

function blankImageUrl()
{
    return  url('/') . '/virtue/images/blank-image.png';
}

function loadingGif()
{
    return  url('/') . '/virtue/images/loading.gif';
}

function imageNotFoundUrl()
{
    return  url('/') . '/virtue/images/image-not-found.png';
}

function iconNotFoundUrl()
{
    return  url('/') . '/virtue/images/icon-not-found.png';
}

function blankUserUrl()
{
    return  url('/') . '/virtue/images/blank_user.png';
}

function faviconUrl()
{
    return  url('/') . '/virtue/images/favicon.ico';
}

function webLogoImg()
{
    $logo = getSettingDataBySlug('logo');
    $logo_name = ($logo != null) ? $logo : null;
    if ($logo_name) {
        $logo_img = asset('files/settings/' . $logo . '');
        $logo_img = $logo_img;
    } else {
        $logo_img = imageNotFoundUrl();
    }
    return $logo_img;
}

function webFaviconImg()
{
    $favicon = getSettingDataBySlug('favicon');
    $favicon_name = ($favicon != null) ? $favicon : null;
    if ($favicon_name) {
        $favicon_img = asset('files/settings/' . $favicon . '');
        $favicon_img = $favicon_img;
    } else {
        $favicon_img = faviconUrl();
    }
    return $favicon_img;
}

function webSiteTitleName()
{
    $site_name = getSettingDataBySlug('site_name');
    return isset($site_name) ? $site_name : config('services.env.app_name');
}

function divider($number_of_digits)
{
    $tens = "1";

    if ($number_of_digits > 8)
        return 10000000;

    while (($number_of_digits - 1) > 0) {
        $tens .= "0";
        $number_of_digits--;
    }
    return $tens;
}

function convertNumIntoWords($num)
{
    $ext = ""; //thousand,lac, crore
    $number_of_digits = strlen($num); //this is call :)
    if ($number_of_digits > 3) {
        if ($number_of_digits % 2 != 0)
            $divider = divider($number_of_digits - 1);
        else
            $divider = divider($number_of_digits);
    } else
        $divider = 1;

    $fraction = $num / $divider;
    $fraction = number_format($fraction, 2);
    if ($number_of_digits == 4 || $number_of_digits == 5)
        $ext = "k";
    if ($number_of_digits == 6 || $number_of_digits == 7)
        $ext = "Lac";
    if ($number_of_digits == 8 || $number_of_digits == 9)
        $ext = "Cr";

    return $fraction . " " . $ext;
}

/**
 * Convert Amount into comma-seprated
 *
 * @param mixed $amount
 * @return string with currency icon
 */
function amount($amount)
{
    $amount = (float)$amount;
    return config('services.env.currency') . number_format($amount, 2);
}

function getSettingDataBySlug($slug)
{
    return SettingService::getDataBySlug($slug);
}

function oddFilter($x)
{
    if (($x % 2) == 1) {
        return true;
    }

    return false;
}

function getReqResponseTime()
{
    $startTime = defined('LARAVEL_START') ? LARAVEL_START : request()->server('REQUEST_TIME_FLOAT');
    // $memoryUsage = number_format(memory_get_peak_usage(true) / 1024 / 1024, 2) . ' MB';
    $requestTime = number_format((microtime(true) - $startTime) * 1000, 0) . 'ms';
    return $requestTime;
}

function getFavIconUrl()
{
    return  url('/') . '/virtue/images/favicon.png';
}
