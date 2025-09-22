<?php

namespace App\Services;

use App\Models\ContactUs;

class ContactUsService
{
    use ServiceTrait;

    public function __construct()
    {
        self::$models = 'App\Models\ContactUs';
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

    public static function getList()
    {
        $data = ContactUs::query();
        return $data;
    }

    public static function getActiveDescSortedList()
    {
        $data = ContactUs::query()->where('is_active', 1)->orderBy('created_at', 'desc');
        return $data;
    }

    public static function getAnsweredActiveSortedList()
    {
        $data = ContactUs::query()->whereIsActive(1)->whereIsAnswered(1)
            ->orderByDesc('created_at');
        return $data;
    }

    public static function getUnAnsweredActiveSortedList()
    {
        $data = ContactUs::query()->whereIsActive(1)->whereIsAnswered(0)
            ->orderByDesc('created_at');
        return $data;
    }

    /**
     * Get data for datatable from storage.
     *
     * @return ContactUs with states, countries
     */
    public static function datatable()
    {
        $data = ContactUs::query();
        return $data;
    }
}
