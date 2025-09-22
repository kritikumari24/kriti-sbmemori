<?php

namespace App\Services;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

trait ServiceTrait
{
    public static $models;
    /**
     * create the specified resource in storage.
     *
     * @param  array $data
     * @return model
     */
    public static function create(array $data)

    {
        $model_obj = self::$models;
        $data = $model_obj::create($data);
        return $data;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Array $data - Updated Data
     * @param  Illuminate\Database\Eloquent\Model $model
     * @return Illuminate\Database\Eloquent\Model
     */

    public static function update(array $data, Model $model)
    {
        $data = $model->update($data);
        return $data;
    }

    public static function updateById(array $data, $id)
    {
        $model_obj = self::$models;
        $rec = $model_obj::find($id);
        $data = $rec->update($data);
        return $data;
    }

    /**
     * Get Data By Id from storage.
     *
     * @param  Int $id
     * @return model
     */

    public static function getById($id)
    {
        $model_obj = self::$models;
        $data = $model_obj::find($id);
        return $data;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  App\Models\model
     * @return bool
     */
    public static function delete(model $model)
    {
        $data = $model->delete();
        return $data;
    }

    /**
     * update data in storage.
     *
     * @param  Array $data - Updated Data
     * @param  Int $id - model Id
     * @return bool
     */
    public static function status(array $data, $id)
    {
        $model_obj = self::$models;
        $data = $model_obj::where('id', $id)->update($data);
        return $data;
    }

    /**
     * Get data for datatable from storage.
     *
     * @return model
     */
    public static function dataTable(Request $request)
    {
        $model_obj = self::$models;
        $data = $model_obj::query();
        if (isset($request->ref_no)) {
            $data = $data->where('ref_no',  'Like', '%' . $request->ref_no . '%');
        }
        if (isset($request->name)) {
            $data = $data->where('name', 'Like', '%' . $request->name . '%');
        }
        if (isset($request->status)) {
            $data = $data->where('status', $request->status);
        }
        return $data;
    }

    /**
     * Get Active data from storage.
     *
     * @return model
     */

    public static function getActiveData()
    {
        $model_obj = self::$models;
        $data = $model_obj::where('is_active', 1);
        // dd($data);
        return $data;
    }

    /**
     * Get Active data from storage.
     *
     * @return model
     */

    public static function getActiveDataById($id)
    {
        $model_obj = self::$models;
        $data = $model_obj::where('is_active', 1)->where('id', $id)->first();
        // dd($data);
        return $data;
    }
}
