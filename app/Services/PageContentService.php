<?php

namespace App\Services;

use App\Models\PageContent;

class PageContentService
{
    use ServiceTrait;

    public function __construct()
    {
        self::$models = 'App\Models\PageContent';
    }
    
    /**
     * Get the specified resource in storage.
     *
     * @param int $id
     * @return  App\Models\PageContent
     */
    public static function datatable()
    {
        $data = PageContent::query();
        return $data;
    }

    /**
     * Get the specified resource in storage.
     *
     * @param int $slug
     * @return  App\Models\PageContent
     */
    public static function getBySlug($slug)
    {
        $data = PageContent::where('slug', $slug)->first();
        return $data;
    }
}
