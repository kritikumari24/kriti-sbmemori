<?php

namespace App\Services;

use App\Models\MasterOtp;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use Carbon\Carbon;
use Cviebrock\EloquentSluggable\Services\SlugService;
use DateTime;
use DateTimeZone;
use Illuminate\Support\Facades\Log;

class HelperService
{

    /** String Convert to String Mask*/
    public static function stringMask(String $text, int $mask, bool $is_mobile = false)
    {

        if ($is_mobile) {
            $first_char = mb_substr($text, 0, 1);
            $other_char = str_pad(substr($text, -$mask), strlen($text) - 1, 'x', STR_PAD_LEFT);
            $mask_sting = $first_char . $other_char;
        } else {
            $mask_sting = str_pad(substr($text, -$mask), strlen($text), 'x', STR_PAD_LEFT);
        }

        return $mask_sting;
    }

    /** String Convert to Slug*/
    public static function slugify(String $text)
    {
        // replace non letter or digits by -
        $text = preg_replace('~[^\pL\d]+~u', '-', $text);

        // transliterate
        $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

        // remove unwanted characters
        $text = preg_replace('~[^-\w]+~', '', $text);

        // trim
        $text = trim($text, '-');

        // remove duplicate -
        $text = preg_replace('~-+~', '-', $text);

        // lowercase
        $text = strtolower($text);

        if (empty($text)) {
            return 'n-a';
        }

        return $text;
    }

    /** SMS Send Service */
    public static function createOtp()
    {
        if (env('PRODUCTION', false)) {
            $digits = config('services.env.otp_digit');
            $otp = rand(pow(10, $digits - 1), pow(10, $digits) - 1);
        } else {
            $otp = 1234;
        }
        return $otp;
    }

    public static function sendMessage($number, $message, $otp = '')
    {
        if (!empty($otp)) {
            $data = [
                'mobile_no' => $number,
                'otp' => $otp,
                'role_id' => 4
            ];
            MasterOtp::create($data);
        }

        if (env('PRODUCTION', false)) {
            $curl = curl_init();

            try {
                curl_setopt_array($curl, array(
                    CURLOPT_URL => "http://api.msg91.com/api/sendhttp.php",
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => "",
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 30,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => "GET",
                    CURLOPT_POSTFIELDS => '{ "sender": "COMONSETUP", "route": "4", "country": "91", "sms": [ { "message": "' . $message . '", "to": [ "' . $number . '" ] } ] }',
                    CURLOPT_SSL_VERIFYHOST => 0,
                    CURLOPT_SSL_VERIFYPEER => 0,
                    CURLOPT_HTTPHEADER => array(
                        "authkey: 342058A50bp5Jx5f6493e3P1",
                        "content-type: application/json"
                    ),
                ));

                $response = curl_exec($curl);
                $err = curl_error($curl);
                // dd($response, $err);
                curl_close($curl);
            } catch (\Exception $e) {
                return false;
            }
            return true;
        } else {
            return true;
        }
    }


    public static function firebaseTokenSubscribeToTopic($topic, $token)
    {
        $headers = array(
            'Authorization: key=' . env('FCM_SERVER_KEY'),
            'Content-Type: application/json',
            'Content-Length: 0'

        );
        try {
            // dd(json_encode($fields), $headers);
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, "https://iid.googleapis.com/iid/v1/$token/rel/topics/$topic");
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            // curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
            $result = curl_exec($ch);
            if ($result === FALSE) {
                die('FCM Send Error: ' . curl_error($ch));
            }
            $result = json_decode($result, true);
            // dd($result);
            curl_close($ch);
            return true;
        } catch (\Exception $e) {
            Log::error("HelperService -> firebaseTokenSubscribeToTopic ." . $e->getMessage());
            return false;
        }
    }

    public static function sendNotificationToTopic($topic, $notificaion_data)
    {
        if (env('PRODUCTION', false)) {

            try {
                $fields = array(
                    // 'registration_ids'  => $tokens[0],
                    'to'  => '/topics/' . $topic,
                    'notification'  => $notificaion_data
                );

                $headers = array(
                    'Authorization: key=' . env('FCM_SERVER_KEY'),
                    'Content-Type: application/json'
                );
                // dd(json_encode($fields), $headers);
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
                curl_setopt($ch, CURLOPT_POST, true);
                curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
                $result = curl_exec($ch);
                if ($result === FALSE) {
                    die('FCM Send Error: ' . curl_error($ch));
                }
                $result = json_decode($result, true);
                // dd($result);
                curl_close($ch);
                return true;
            } catch (\Exception $e) {
                Log::error("HelperService -> sendNotificationToTopic ." . $e->getMessage());
                return false;
            }
        } else {
            return true;
        }
    }

    /**
     * send the notification using curl
     * @param array $noti_data
     * @param array_keys $noti_data['user_id']
     * @param array_keys $noti_data['title']
     * @param array_keys $noti_data['message']
     * @param array_keys $noti_data['type']
     * @param array_keys $noti_data['sound']
     * @return boolean
     */
    public static function sendNotification(array $noti_data)
    {
        $headr = array();
        $headr[] = 'Content-type: application/json';
        $fcm_server_key = config()->get('services.fcm.server_key');
        $headr[] = 'Authorization: key=' . $fcm_server_key;

        $user = UserService::getById($noti_data['user_id']);

        $data_array =
            [
                "to" => $user->device_id,
                "data" => $noti_data,
            ];
        $data_json = json_encode($data_array, true);
        // dd($data_array, $data_json);
        try {
            $url = "https://fcm.googleapis.com/fcm/send";
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_VERBOSE, 1);
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_FAILONERROR, 0);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headr);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data_json);
            $http_result = curl_exec($ch);
            curl_close($ch);
            // print "Response = " . print_r($http_result);
            // dd($http_result);
            return true;
        } catch (\Exception $e) {
            Log::channel('notification')->error('call Notification, Not Send - (HelperService)' . $e);
            return false;
        }
    }


    /** Nesteted Array convert into single Array*/
    public static function nestedToSingle(array $array)
    {
        $singleDimArray = [];
        foreach ($array as $item) {
            if (is_array($item)) {
                $singleDimArray = array_merge($singleDimArray, self::nestedToSingle($item));
            } else {
                $singleDimArray[] = $item;
            }
        }
        return $singleDimArray;
    }

    /** Date  convert into days ago*/
    public static function time_elapsed_string($datetime, $full = false)
    {
        $now = new DateTime;
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


    /** ****************Date convert into days ago ************* */
    //return current date time
    public static function getCurrentDateTime()
    {
        // date_default_timezone_set("Asia/Calcutta");
        // return date("Y-m-d H:i:s");
        return Carbon::now();
    }

    public static function getDateFormat($date, $type = 0)
    {
        if ($type == 1) { // date Date
            $format_date = Carbon::parse($date)->format('d-m-Y');
        } else {
            $format_date = Carbon::parse($date)->format('d-m-Y H:i:s');
        }
        return $format_date;
    }

    public static function getDateString($date)
    {
        $dateArray = date_parse_from_format('Y/m/d', $date);
        $monthName = DateTime::createFromFormat('!m', $dateArray['month'])->format('F');
        return $dateArray['day'] . " " . $monthName  . " " . $dateArray['year'];
    }

    public static function getDateTimeDifferenceString($datetime)
    {
        $currentDateTime = new DateTime(self::getCurrentDateTime());
        $passedDateTime = new DateTime($datetime);
        $interval = $currentDateTime->diff($passedDateTime);
        //$elapsed = $interval->format('%y years %m months %a days %h hours %i minutes %s seconds');
        $day = $interval->format('%a');
        $hour = $interval->format('%h');
        $min = $interval->format('%i');
        $seconds = $interval->format('%s');

        if ($day > 7)
            return self::getDateString($datetime);
        else if ($day >= 1 && $day <= 7) {
            if ($day == 1) return $day . " day ago";
            return $day . " days ago";
        } else if ($hour >= 1 && $hour <= 24) {
            if ($hour == 1) return $hour . " hour ago";
            return $hour . " hours ago";
        } else if ($min >= 1 && $min <= 60) {
            if ($min == 1) return $min . " minute ago";
            return $min . " minutes ago";
        } else if ($seconds >= 1 && $seconds <= 60) {
            if ($seconds == 1) return $seconds . " second ago";
            return $seconds . " seconds ago";
        }
    }
    /** ****************Date convert into days ago ************* */

    /** Nesteted Array convert into single Array*/
    public static function objectToSingleArray(object $data, $key, $date = false)
    {

        $singleDimArray = [];
        foreach ($data as $item) {
            if ($date) {
                $date_f = date('d-m-Y', strtotime($item->$key));
                array_push($singleDimArray, $date_f);
            } else {
                array_push($singleDimArray, $item->$key);
            }
        }
        return $singleDimArray;
    }

    /**
     * check the key in multidimensional array .
     *
     * @param  array  $arr
     * @param  string  $key
     * @return bool
     */
    public static function multiKeyExists(array $arr, $key)
    {

        // is in base array?
        if (array_key_exists($key, $arr)) {
            return true;
        }

        // check arrays contained in this array
        foreach ($arr as $element) {
            if (is_array($element)) {
                if (self::multiKeyExists($element, $key)) {
                    return true;
                }
            }
        }

        return false;
    }


    /*
    * Get Users Role Names
    */
    public static function getUsersRoleName()
    {
        $users = User::pluck('name', 'id')->all();
        foreach ($users as $key => $value) {
            $user = User::where('id', $key)->first();
            $role = $user->roles->first()->name;
            $value = $value . ' (' . $role . ')';
            $data[$key] = $value;
        }
        return $data;
    }

    /*
    * Get Users Role Names
    */
    public static function getSpecificUserRoleName($id)
    {
        $user = User::where('id', $id)->first();
        $role_name = $user->roles->first()->name;
        return $role_name;
    }

    /*
    * Set date format
    * @param string $date
    * @return formatted date
    */
    public static function dateFormat($date)
    {
        $date = Carbon::createFromFormat('Y-m-d', $date)->format('d M Y');
        return $date;
    }

    /*
    * Set date format
    * @param string $date
    * @return formatted date
    */
    public static function timeFormat($date)
    {
        $date = Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('H:i');
        return $date;
    }

    /*
    * Set date format
    * @param string $date
    * @return formatted date
    */
    public static function dateTimeFormat($date)
    {
        $date = Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('d M Y');
        return $date;
    }

    /**
     * get duration between times.
     *
     * @param string $start_time
     * @param string $end_time
     * @return string
     */
    public static function getTimeDuration($start_time, $end_time)
    {
        if ($start_time && $end_time) {
            $start_time = Carbon::parse($start_time);
            $end_time = Carbon::parse($end_time);
            $totalDuration = $end_time->diff($start_time);

            if ($totalDuration->format('%h') == '0') {
                if ($totalDuration->format('%i') == '0') {
                    $totalDuration = $totalDuration->format('%s seconds');
                } else {
                    $totalDuration = $totalDuration->format('%i minutes');
                }
            } else {
                $totalDuration = $totalDuration->format('%h hour');
            }

            return $totalDuration;
        } else {
            return null;
        }
    }

    /**
     * Combine Date and Time.
     *
     * @param string $orgDate
     * @param string $orgTime
     * @return string
     */
    public static function combineDateTime($orgDate, $orgTime)
    {
        $date = new DateTime($orgDate);
        $time = new DateTime($orgTime);

        // Merge objects to new object:
        $merge = new DateTime($date->format('Y-m-d') . ' ' . $time->format('H:i:s'));
        return $merge->format('Y-m-d H:i:s'); // Outputs '2017-03-14 13:37:42'
    }

    /**
     * Convert DateTime from origin Timezone to required Timezone.
     *
     * @param string $fromDateTime
     * @param string $fromTimezone
     * @param string $toTimezone
     * @return string
     */
    public static function convTime($fromDateTime, $fromTimezone, $toTimezone)
    {
        $from = new DateTimeZone($fromTimezone);
        $to = new DateTimeZone($toTimezone);

        $orgTime = new DateTime($fromDateTime, $from);
        $toTime = new DateTime($orgTime->format("c"));
        $toTime = $toTime->setTimezone($to);
        $time = Carbon::parse($toTime)->format('Y-m-d\TH:i:s.up');
        return $time;
    }

    /**
     * get duration between times.
     *
     * @param string $start_date
     * @param string $end_date
     * @return string
     */
    public static function getDaysDuration($start_date, $end_date)
    {
        $start_date = Carbon::parse($start_date);
        $end_date = Carbon::parse($end_date);
        $totalDuration = $end_date->diff($start_date);
        if ($totalDuration->format('%d') == '0') {
            if ($totalDuration->format('%h') == '0') {
                if ($totalDuration->format('%i') == '0') {
                    $totalDuration = $end_date->diff($start_date)->format('%s seconds ago');
                } else {
                    $totalDuration = $end_date->diff($start_date)->format('%i minutes ago');
                }
            } else {
                $totalDuration = $end_date->diff($start_date)->format('%h hours ago');
            }
        } else {
            // $totalDuration = $end_date->diff($start_date)->format('%d days ago');
            $totalDuration = self::dateDiffInDays($start_date, $end_date) . ' days ago';
        }
        return $totalDuration;
    }

    /**
     * get duration between times.
     *
     * @param string $start_time
     * @param string $end_time
     * @param string $duration (in minutes)
     * @return string
     */
    public static function splitTimeByDuration($start_time, $end_time, $duration = 60)
    {
        $durations = array(); // Define output
        $StartTime = strtotime($start_time); //Get Timestamp
        $EndTime = strtotime($end_time); //Get Timestamp

        $AddMins  = $duration * 60;
        while ($StartTime <= $EndTime) //Run loop
        {
            $durations[] = date("G:i", $StartTime);
            $StartTime += $AddMins; //Endtime check
        }

        $parse_end_time = Carbon::parse($end_time);
        $last_duration = Carbon::parse($durations[count($durations) - 1]);
        $totalDuration = $parse_end_time->diff($last_duration)->format('%I');
        if ($totalDuration != '00' || $totalDuration != 00) {
            $durations[count($durations)] = $end_time;
            // array_push($durations, $end_time);
        }
        return $durations;
    }
    /**
     * get duration between times.
     *
     * @param string $start_time
     * @param string $end_time
     * @param string $duration (in minutes)
     * @return string
     */
    public static function timeFormatInPeriod($time)
    {
        $time = date('h:i A', strtotime($time));
        return $time;
    }

    /**
     * get duration between date.
     *
     * @param string $create_date
     * @return string
     */
    public static function getDurationByDate($create_date)
    {
        $created_date = date_create($create_date);
        $now_date = date_create(Carbon::now());
        $diff = date_diff($created_date, $now_date);
        $days = $diff->format("%d");
        return $days;
    }

    public static function sessionAlert($msg, $alert = "success")
    {
        $data = '<div id="ns" class="alert alert-' . $alert . ' fade show" role="alert">';

        if ($alert == 'success') {
            $data .= '<div class="alert-icon"><i class="fa fa-check-circle"></i></div>';
        } else if ($alert == 'warning') {
            $data .= '<div class="alert-icon"><i class="flaticon-warning"></i></div>';
        } else {
            $data .= '<div class="alert-icon"><i class="flaticon-warning"></i></div>';
        }
        $data .= '<div class="alert-text">' . $msg . '</div>
            <div class="alert-close">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true"><i class="la la-close"></i></span>
                </button>
            </div>
        </div>';
        return $data;
    }


    public static function getUtcDateTime($date, $time, $user_timezone)
    {
        $fromDateTime = self::combineDateTime($date, $time);
        $utc_datetime = self::convTime($fromDateTime, $user_timezone, "UTC");
        return $utc_datetime;
    }

    public static function getDurationByCalculatedDiff($total_duration_diff)
    {
        $totalDuration = $total_duration_diff;
        if ($totalDuration->format('%d') == '0') {
            if ($totalDuration->format('%h') == '0') {
                if ($totalDuration->format('%i') == '0') {
                    $totalDuration = $totalDuration->format('%s seconds');
                } else {
                    $totalDuration = $totalDuration->format('%i minutes');
                }
            } else {
                $totalDuration = $totalDuration->format('%h hours');
            }
        } else {
            $totalDuration = $totalDuration->format('%d days');
        }
        return $totalDuration;
    }

    public static function dateDiffInDays($date1, $date2)
    {
        $diff = strtotime($date2) - strtotime($date1);
        return abs(round($diff / 86400));
    }

    /**
     * @param Model $model
     * @param $key
     * @param $source_value
     * @param $unique
     */
    public static function createSlug(Model $model, $key, $source_value, $unique = false)
    {
        $slug = SlugService::createSlug($model, $key, $source_value, ['unique' => $unique]);
        return $slug;
    }

    /**
     * check the file in strorage Path.
     *
     * @param  App\Http\Requests\AdminRequest $request
     * @param  string  $url
     * @return string
     */
    public static function getFileUrl($file_url, $file_name = null, $type = '')
    {
        if ($file_name == null) {
            $url = url('/') . '/plugins/images/cashcry.png';
        } else {
            $url = self::file_exists_storage_path($file_url . $file_name, $type);
        }
        return $url;
    }

    /**
     * check the file in strorage Path.
     *
     * @param  App\Http\Requests\AdminRequest $request
     * @param  string  $url
     * @return string
     */
    public static function file_exists_storage_path($url, $type = '')
    {
        return FileService::file_exists_storage_path($url, $type);
    }

    public static function notificationType()
    {
        $notification_type = [
            'loginScreen' => 'LoginScreen',
            'profileDetailScreen' => 'ProfileDetailScreen',
            'referCodeScreen' => 'ReferCodeScreen',
            'homeScreen' => 'HomeScreen',
            'stoneScreen' => 'StoneScreen',
            'numberScreen' => 'NumberScreen',
            'colorScreen' => 'ColorScreen',
            'chakraScreen' => 'ChakraScreen',
            'kundliScreen' => 'KundliScreen',
            'gocharScreen' => 'GocharScreen',
            'showPlanetryScreen' => 'ShowPlanetryScreen',
            'gurujiScreen' => 'GurujiScreen',
            'gurujiProfileScreen' => 'GurujiProfileScreen',
            'chatScreen' => 'ChatScreen',
            'reviewAndRatingScreen' => 'ReviewAndRatingScreen',
            'chatHistoryScreen' => 'ChatHistoryScreen',
            'milestoneScreen' => 'MilestoneScreen',
            'rewardPointsScreen' => 'RewardPointsScreen',
            'referralHistoryScreen' => 'ReferralHistoryScreen',
            'settingScreen' => 'SettingScreen',
            'pageContentScreen' => 'PageContentScreen',
            'notificationScreen' => 'NotificationScreen',
            'tarotScreen' => 'TarotScreen',
            'tarotReadingScreen' => 'TarotReadingScreen',
            'walletScreen' => 'WalletScreen',
        ];

        return  $notification_type;
    }
}
