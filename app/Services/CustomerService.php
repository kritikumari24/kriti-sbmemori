<?php

namespace App\Services;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use App\Services\ServiceTrait;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class CustomerService
{
    use ServiceTrait;
    public $profile_image_directory;

    public function __construct()
    {
        self::$models = 'App\Models\User';
        $this->profile_image_directory = 'files/users';
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Array $data
     * @param  App\Models\User  $user
     * @return bool
     */
    public static function updateProfile(array $data, User $user)
    {
        $data = $user->update($data);
        return $data;
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
     * Fetch records for datatables
     */
    public static function datatable()
    {
        $data = User::with('roles')->whereHas("roles", function ($q) {
            $q->where("name", 'Customer');
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
        $input = [
            'last_login' => Carbon::now()
        ];

        if ($request) {
            $input = [
                'device_id' => $request->get('device_id'),
                'device_type' => $request->get('device_type'),
                'is_online' => 1
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
    public static function downloadcustomerReport()
    {
        $data = User::whereHas("roles", function ($q) {
            $q->where("name", 'Customer');
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
    public static function deleteOldImage(User $customer)
    {
        FileService::removeImage($customer, 'image', 'files/users');
        $result = $customer->delete();
        return $result;
    }
}
