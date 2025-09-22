<?php

namespace App\Services;

use App\Models\Faq;

class FaqService
{
    use ServiceTrait;

    public function __construct()
    {
        self::$models = 'App\Models\Faq';
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
        $data = Faq::query();
        return $data;
    }

    public static function getActiveDescSortedList()
    {
        $data = Faq::query()->where('is_active', 1)->orderBy('created_at', 'desc');
        return $data;
    }

    public static function getAnsweredActiveSortedList()
    {
        $data = Faq::query()->whereIsActive(1)->whereIsAnswered(1)
            ->orderByDesc('created_at');
        return $data;
    }

    public static function getUnAnsweredActiveSortedList()
    {
        $data = Faq::query()->whereIsActive(1)->whereIsAnswered(0)
            ->orderByDesc('created_at');
        return $data;
    }

    /**
     * Get data for datatable from storage.
     *
     * @return Faq with states, countries
     */
    public static function datatable()
    {
        $data = Faq::query();
        return $data;
    }
}
