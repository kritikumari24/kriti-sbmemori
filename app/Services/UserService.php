<?php

namespace App\Services;

use App\Http\Resources\User\UserCollection;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserService
{
    use ServiceTrait;

    public function __construct()
    {
        self::$models = 'App\Models\User';
    }

    /**
     * Get the specified resource in storage.
     *
     * @param int $id
     * @return  App\Models\User  $user
     */
    public static function getById($id)
    {
        $data = User::with('roles')->find($id);
        return $data;
    }

    /**
     * Get the specified resource in storage.
     *
     * @return  App\Models\User  $data
     */
    public static function getAdminUser()
    {
        $data = User::find(1);
        return $data;
    }

    /**
     * Get data by $parameters.
     *
     * @param Array $parameters
     * @return Model
     */
    public static function getByParameters($parameters)
    {
        $data = User::query();
        foreach ($parameters as $parameter) {
            $data = $data->where($parameter['column_name'], $parameter['value']);
        }
        return $data;
    }

    /**
     * Remove the specified id from storage.
     *
     * @param  $id
     * @return bool
     */
    public static function deleteById($id)
    {
        $result = false;
        $data = self::getById($id);
        if ($data) {
            $result = $data->delete();
        }
        return $result;
    }

    /**
     * Fetch records for datatables
     */
    public static function datatable()
    {
        $data = User::with('roles')->whereHas("roles", function ($q) {
            $q->whereNotIn("name", ['Admin']);
        });
        return $data;
    }

    /**
     * update Last Login details.
     *
     * @param int $id
     * @param Request $request = null
     * @return bool
     */
    public static function updateLastLogin($id, $request = null)
    {
        if ($request) {
            $input = [
                'last_login' => Carbon::now(),
                'device_id' => $request->get('device_id'),
                'device_type' => $request->get('device_type'),
                // 'is_online' => 1
            ];
        } else {
            $input = [
                'last_login' => Carbon::now()
            ];
        }
        $data = User::where('id', $id)->update($input);
        return $data;
    }

    /**
     * Get user with relations
     *
     * @param Int $id
     * @param Array $relations
     * @return \App\Models\User
     */
    public static function getByIdWithRelations($id, $relations = [])
    {
        $data = User::where('id', $id);
        foreach ($relations as $relation) {
            $data = $data->with($relation);
        }
        $data = $data->first();
        return $data;
    }


    public static function update_password(User $user, String $password)
    {
        $data = $user->update([
            'password' => Hash::make($password)
        ]);
        return $data;
    }

    public static function getPushNotify($user_id)
    {
        $data = User::where('id', $user_id)
            ->select('push_notify')
            ->first();
        return $data;
    }

    /**
     * Get data by $parameters.
     *
     * @param Array $parameters
     * @return Model
     */
    public static function getByRoleId($role_id)
    {
        $data = Role::where('id', $role_id)->first()->users()->get();
        return $data;
    }

    /**
     * Get data for download Report from storage.
     *
     * @return User with all its Client data
     */
    public static function downloaduserReport()
    {
        $data = User::whereHas("roles", function ($q) {
            $q->whereNotIn("name", ['Admin']);
        })->select(
            'id',
            'name',
            'email',
            'mobile_no',
            DB::raw("(CASE WHEN (is_active = 1) THEN 'Active' ELSE 'Inactive' END) as status"),
            DB::raw("(DATE_FORMAT(created_at,'%d-%M-%Y')) as created_date"),
            DB::raw("(DATE_FORMAT(updated_at,'%d-%M-%Y')) as updated_date"),
        )->orderBy('created_at', 'desc');
        return $data;
    }

    /**
     * Delete the old user image
     */
    public static function deleteOldImage(User $user)
    {
        FileService::removeImage($user, 'image', 'files/users');
        $result = $user->delete();
        return $result;
    }

    /**
     * Create the Customer Account.
     *
     * @param  array $input
     * @return User
     */
    public static function createCustomerAccount(array $input)
    {
        $data = User::create($input);
        $data->assignRole(roleName('customer'));
        return $data;
    }

    /**
     * Create the Customer Account.
     *
     * @return User
     */
    public static function getCustomerUsers()
    {
        $data = User::with('roles')->whereHas("roles", function ($q) {
            $q->where("name", roleName('customer'));
        });
        return $data;
    }

    /**
     * Get User By FirebaseID
     * @param String FirebaseID $firebase_id
     * @return User $user OR null
     */
    public static function getUserByFirebaseID($firebase_id)
    {
        $data = User::where('firebase_id', $firebase_id)->first();
        return $data;
    }

    /**
     * Get User By EmailId
     * @param String emailID $email
     * @return User $user OR null
     */
    public static function getUserByEmail($email)
    {
        $data = User::where('email', $email)->first();
        return $data;
    }

    /**
     * Get User By Mobile Number
     * @param String MobileNumber $mobile
     * @return User $user OR null
     */
    public static function getUserByMobile($mobile)
    {
        $data = User::where('mobile_no', $mobile)->first();
        return $data;
    }

    /**
     * Get User By Mobile Number
     * @param String MobileNumber $mobile
     * @return User $user OR null
     */
    public static function getUserByReferralCode($referral_code)
    {
        $data = User::where('referral_code', $referral_code)->first();
        return $data;
    }

    public static function verifyReferralCode($referral_code)
    {
        $user = self::getUserByReferralCode($referral_code);
        if ($user) {
            return $user->id;
        }
        return null;
    }
}
