<?php

namespace App\Services;

use App\Models\Type;
use Illuminate\Http\Request;

class TypeService
{
    /**
     * Create the specified resource.
     *
     * @param Request $request
     * @return Type
     */
    public static function create(array $data)
    {
        $data = Type::create($data);
        return $data;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @return bool
     */
    public static function update(array $data, $type)
    {
        $data = Type::where('id', $type)->update($data);
        return $data;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Array $data
     * @param  App\Models\Type  $type
     * @return bool
     */
    public static function updateProfile(array $data, Type $type)
    {
        $data = $type->update($data);
        return $data;
    }

    /**
     * Get the specified resource in storage.
     *
     * @param int $id
     * @return  App\Models\Type  $type
     */
    public static function getById($id)
    {
        $data = Type::find($id);
        return $data;
    }
    /**
     * Delete data by Type.
     *
     * @param Type $type
     * @return bool
     */
    public static function delete(Type $type)
    {
        $data = $type->delete();
        return $data;
    }

    /**
     * Fetch records for datatables
     */
    public static function datatable()
    {
        $data = Type::query();
        return $data;
    }

    /**
     * update status.
     *
     * @param Array $data
     * @param int $id
     * @return bool
     */
    public static function status(array $data, $id)
    {
        $data = Type::where('id', $id)->update($data);
        return $data;
    }
}
