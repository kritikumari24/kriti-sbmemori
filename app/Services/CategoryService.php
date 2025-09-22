<?php

namespace App\Services;

use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use phpDocumentor\Reflection\Types\Integer;

class CategoryService
{
    /**
     * Update the specified resource in storage.
     *
     * @param  array $data
     * @return Category
     */
    public static function create(array $data)
    {
        $data = Category::create($data);
        return $data;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Array $data - Updated Data
     * @param  Category $category
     * @return Category
     */
    public static function update(array $data, Category $category)
    {
        $data = $category->update($data);
        return $data;
    }

    /**
     * Get Data By Id from storage.
     *
     * @param  Int $id
     * @return Category
     */
    public static function getById($id)
    {
        $data = Category::find($id);
        return $data;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  App\Models\Category
     * @return bool
     */
    public static function delete(Category $category)
    {
        $data = $category->delete();
        return $data;
    }

    /**
     * update data in storage.
     *
     * @param  Array $data - Updated Data
     * @param  Int $id - Category Id
     * @return bool
     */
    public static function status(array $data, $id)
    {
        $data = Category::where('id', $id)->update($data);
        return $data;
    }

    /**
     * Get data for datatable from storage.
     *
     * @return Category with states, countries
     */
    public static function datatable()
    {
        $data = Category::orderBy('created_at', 'desc');
        return $data;
    }
}
