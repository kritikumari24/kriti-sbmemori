<?php

namespace App\Services;

use App\Models\Setting;
use Illuminate\Http\Request;
use phpDocumentor\Reflection\Types\Integer;

class SettingService
{
    /**
     * Update the specified resource in storage.
     *
     * @param  array $data
     * @return Setting
     */
    public function create(array $data)
    {
        $data = Setting::create($data);
        return $data;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Array $data - Updated Data
     * @param  Setting $setting
     * @return Setting
     */
    public function update(array $data, Setting $setting)
    {
        $data = $setting->update($data);
        return $data;
    }

    /**
     * Get Data By Id from storage.
     *
     * @param  Int $id
     * @return Setting
     */
    public function getById($id)
    {
        $data = Setting::find($id);
        return $data;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  App\Models\Setting
     * @return bool
     */
    public function delete(Setting $setting)
    {
        $data = $setting->delete();
        return $data;
    }

    /**
     * update data in storage.
     *
     * @param  Array $data - Updated Data
     * @param  Int $id - Setting Id
     * @return bool
     */
    public function status(array $data, $id)
    {
        $data = Setting::where('id', $id)->update($data);
        return $data;
    }

    /**
     * Get data for datatable from storage.
     *
     * @return Setting with states, countries
     */
    public function datatable()
    {
        $data = Setting::orderBy('created_at', 'desc');
        return $data;
    }

    /**
     * Get data for datatable from storage.
     *
     * @return Setting with states, countries
     */
    public function getAllSetting()
    {
        // $data = Setting::with('coupons')->orderBy('created_at','desc')->paginate(10);
        $data = Setting::all();
        return $data;
    }

    /**
     * Get data for datatable from storage.
     *
     * @return Setting with states, countries
     */
    public function settingWithPagination($page = 10)
    {
        // $data = Setting::with('coupons')->orderBy('created_at','desc')->paginate(10);
        $data = Setting::orderBy('created_at', 'desc')->paginate($page);
        return $data;
    }

    /**
     * Get data for datatable from storage.
     *
     * @return Setting with states, countries
     */
    public function settingByIdWithPagination($setting_id, $page = 10)
    {
        $data = Setting::where('id', $setting_id)->orderBy('created_at', 'desc')->paginate($page);
        return $data;
    }

    /**
     * Get active data from storage.
     *
     * @param  null
     * @return Setting
     */
    public function getActiveData()
    {
        $data = Setting::join('setting_types', 'setting_types.id', 'settings.setting_type_id')
            ->select('settings.*', 'setting_types.title as setting_type_title')
            ->where('status', 1);
        return $data;
    }

    /**
     * Get active data from storage.
     *
     * @param  null
     * @return Setting
     */
    public static function getDataByKey($name)
    {
        $data = Setting::where('name', '=', $name)->select(['id', 'value'])->first();
        return $data;
    }

    /**
     * Get active data from storage.
     *
     * @param  null
     * @return Setting
     */
    public static function getDataBySlug($slug)
    {
        $data = Setting::where('slug', '=', $slug)->first();
        if ($data) {
            return $data->value;
        }
        return null;
    }
}
