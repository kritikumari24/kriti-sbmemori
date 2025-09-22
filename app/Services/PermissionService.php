<?php

namespace App\Services;

use Illuminate\Http\Request;
use phpDocumentor\Reflection\Types\Integer;
use Spatie\Permission\Models\Permission;

class PermissionService
{
    /**
     * Update the specified resource in storage.
     *
     * @param  array $data
     * @return Permission
     */
    public static function create(array $data)
    {
        $data = Permission::create($data);
        return $data;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Array $data - Updated Data
     * @param  Permission $permission
     * @return Permission
     */
    public static function update(array $data, Permission $permission)
    {
        $data = $permission->update($data);
        return $data;
    }

    /**
     * Get Data By Id from storage.
     *
     * @param  Int $id
     * @return Permission
     */
    public static function getById($id)
    {
        $data = Permission::find($id);
        return $data;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  App\Models\Permission
     * @return bool
     */
    public static function delete(Permission $permission)
    {
        $data = $permission->delete();
        return $data;
    }

    /**
     * update data in storage.
     *
     * @param  Array $data - Updated Data
     * @param  Int $id - Permission Id
     * @return bool
     */
    public static function status(array $data, $id)
    {
        $data = Permission::where('id', $id)->update($data);
        return $data;
    }

    /**
     * Get data for datatable from storage.
     *
     * @return Permission with states, countries
     */
    public static function datatable()
    {
        $data = Permission::query();
        return $data;
    }
}
