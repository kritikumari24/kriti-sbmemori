<?php

namespace App\Services;

class ManagerLanguageService
{
    private $manager_language_file;

    public function __construct(String $filename)
    {
        $this->manager_language_file = $filename;
    }
    /**
     * Use the specified language.
     *
     * @param  String $key - lang file key
     * @param  String $name - name which has to show with messages (parameters)
     * @param  String $number
     * @return String
     */
    public function messageLanguage(String $key, String $name, $number = 1)
    {
        // echo trans_choice('words.minutes_ago', 1, ['value' => 10]);
        $data = __($this->manager_language_file . '.' . $key, ['name' => trans_choice($this->manager_language_file . '.' . $name, $number)]);
        return $data;
    }
    /**
     * Use the specified language.
     *
     * @param  String $key - lang file key
     * @param  String $number
     * @return String
     */
    public function getTitleNames(String $key, $number = 1)
    {
        // echo trans_choice('words.minutes_ago', 1, ['value' => 10]);
        $data = trans_choice($this->manager_language_file . '.' . $key, $number);
        return $data;
    }
    /**
     * Use the specified language.
     *
     * @param  String $key - lang file key
     * @return String
     */
    public function onlyNameLanguage(String $key)
    {
        // echo __('words.minutes_ago', 1, ['value' => 10]);
        $data = __($this->manager_language_file . '.' . $key);
        return $data;
    }
}
