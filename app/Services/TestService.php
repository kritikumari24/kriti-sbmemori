<?php

namespace App\Services;

use App\Models\Test;

class TestService
{
    /**
     * Update the specified resource in storage.
     *
     * @param  array $data
     * @return Test
     */
    public static function create(array $data)
    {
        $data = Test::create($data);
        return $data;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Array $data - Updated Data
     * @param  Test $test
     * @return Test
     */
    public static function update(array $data, Test $test)
    {
        $data = $test->update($data);
        return $data;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Array $data - Updated Data
     * @param  Test $test
     * @return Test
     */
    public static function updateById(array $data, $id)
    {
        $data = Test::where('id', $id)->update($data);
        return $data;
    }

    /**
     * Get Data By Id from storage.
     *
     * @param  Int $id
     * @return Test
     */
    public static function getById($id)
    {
        $data = Test::find($id);
        return $data;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  App\Models\Test
     * @return bool
     */
    public static function delete(Test $test)
    {
        $data = $test->delete();
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
     * update data in storage.
     *
     * @param  Array $data - Updated Data
     * @param  Int $id - Test Id
     * @return bool
     */
    public static function status(array $data, $id)
    {
        $data = Test::where('id', $id)->update($data);
        return $data;
    }

    /**
     * Get data for datatable from storage.
     *
     * @return Test with states, countries
     */
    public static function datatable()
    {
        $data = Test::query();
        return $data;
    }

    public static function getList()
    {
        $data = Test::orderBy('created_at', 'desc');
        return $data;
    }

    public static function getActiveDescSortedList()
    {
        $data = Test::query()->where('is_active', 1)->orderBy('created_at', 'desc');
        return $data;
    }

    public static function getApprovedActiveSortedList()
    {
        $data = Test::query()->whereIsActive(1)->whereIsApproved(1)
            ->orderByDesc('created_at');
        return $data;
    }
}
