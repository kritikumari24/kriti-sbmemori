<?php

namespace App\Services;

use App\Models\EmailTemplate;
use Exception;

class EmailTemplateService
{
    private $model;

    public function __construct()
    {
        $this->model = 'App\Models\EmailTemplate';
    }

    public function initiateQuery()
    {
        $query = $this->model::query();
        return $query;
    }

    /**
     * Create the specified resource.
     *
     * @param  array $data
     * @return App\Models\Language
     */
    public static function create(array $data)
    {
        $data = EmailTemplate::create($data);
        return $data;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  array $data
     * @return App\Models\EmailTemplate
     */
    public static function update(array $data, EmailTemplate $email)
    {
        $data = $email->update($data);
        return $data;
    }

    /**
     * Get a resource By ID
     *
     * @param int $id
     * @return App\Models\Language
     */
    public static function getById($id)
    {
        $data = EmailTemplate::find($id);
        return $data;
    }

    /**
     * Delete the specified resource
     *
     * @param App\Models\EmailTemplate $language
     * @return bool
     */
    public static function delete(EmailTemplate $email)
    {
        try {
            $data = $email->delete();
            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    /**
     * update data from storage.
     *
     * @param  array $data
     * @param  int $id
     * @return bool
     */
    public static function status(array $data, $id)
    {
        $data = EmailTemplate::where('id', $id)->update($data);
        return $data;
    }

    /**
     * update data from storage. - For Get by Parent Id  Category (Category) Only
     *
     * @param  array $data
     * @param  int $id
     * @return bool
     */
    public function getByParentId($id)
    {
        return EmailTemplate::where('parent_id', '=', $id)
            ->get();
    }

    /** For Getting all Parent Category (Category) Only
     * * @return EmailTemplate
     */

    public function getParent()
    {
        return EmailTemplate::whereNull('parent_id')->select('title')
            ->get();
    }

    /** For Getting all Parent Category (Category) Only
     * * @return EmailTemplate
     */
    public function getAllData($search_term = null)
    {
        $items = EmailTemplate::select('email.*')
            ->distinct('emails.id')
            ->where('emails.active', 1)
            ->orderBy('emails.title', 'asc');
        if ($search_term) {
            $items = $items->where('email', 'like', '%' . $search_term . '%');
        }
        return $items;
    }

    /** For Getting all Parent Category (Category) Only
     * * @return email
     */
    public function getAllActiveData()
    {
        return EmailTemplate::whereNull('parent_id')->where('active', 1)->orderBy('title', 'asc');
    }

    public function getDataWithSubSectors()
    {
        return EmailTemplate::whereNull('parent_id')
            ->where('active', 1)
            ->orderBy('title', 'asc')
            ->with('sub_sectors_active');
    }


    /**
     * Get data for datatable from storage.
     *
     * @param  null
     * @return EmailTemplate
     */
    public static function dataTable()
    {
        $data = EmailTemplate::query();
        return $data;
    }

    /**
     * Get data for datatable from storage.
     *
     * @return EmailTemplateTemplate with states, countries
     */
    public function sendMailService(array $data, $email_slug, $footer_slug = '', $herder_slug = '')
    {
        if (!empty($footer)) {
            $footer_html = $this->getBySlug($footer_slug)->content;
        }

        if (!empty($herder)) {
            $herder_html = $this->getBySlug($herder_slug)->content;
        }
        $content_html = $this->getBySlug($email_slug);

        if ($content_html == null) {
            return false;
        }
        return true;
    }

    /**
     * Get data for datatable from storage.
     *
     * @return EmailTemplate with states, countries
     */
    public static function getBySlug($slug)
    {
        $data = EmailTemplate::where('slug', $slug)->first();
        return $data;
    }

    public function getEmailTemplateBody($key, $model, $extra_data = [])
    {
        $template = $this->getBySlug($key);
        $email_variables = explode(',', $template->email_variables);
        $replaced = $this->replaceKeys($email_variables, $model, $extra_data);
        $emailstr = strtr($template->content, $replaced);
        return $emailstr;
    }

    public function replaceKeys(array $email_variables, $model, $extra_data = [])
    {
        $replaced = [];
        foreach ($email_variables as $email_variable) {
            preg_match('/##(.*?)##/', $email_variable, $match);
            if (count($match) > 0) {
                $column_name = substr($match[1], strpos($match[1], "_") + 1);
                $column_name = strtolower($column_name);
                $replaced[$email_variable] = $model->$column_name;
            }
        }
        foreach ($extra_data as $key => $email_variable) {
            $replaced[$key] = $email_variable;
        }

        return $replaced;
    }
}
