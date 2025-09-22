<?php

namespace App\Providers;

use App\Models\Faq;
use App\Models\Setting;
use App\Policies\FaqPolicy;
use Illuminate\Support\Collection;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;
use Illuminate\Pagination\LengthAwarePaginator;

class AppServiceProvider extends ServiceProvider
{

    /**
     * Register any application services.
     */
    public function register(): void
    {
        if ($this->app->environment('local')) {
            $this->app->register(\Laravel\Telescope\TelescopeServiceProvider::class);
            $this->app->register(TelescopeServiceProvider::class);
        }
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->registerCustomValidators();
        $this->cacheSettingsData();
        $this->registerViewComposer();
        $this->registerCollectionPaginationMacro();
        Paginator::useBootstrapFive();
    }

    /**
     * Register custom validation rules.
     */
    private function registerCustomValidators(): void
    {
        Validator::extend('alpha_spaces', function ($attribute, $value) {
            return preg_match('/^[\pL\s]+$/u', $value);
        });

        Validator::extend('alpha_num_spaces', function ($attribute, $value) {
            return preg_match('/^[a-zA-Z0-9\s]+$/', $value);
        });

        Validator::extend('alpha_num_underscore', function ($attribute, $value) {
            return preg_match('/^[a-zA-Z0-9_]*$/', $value);
        });

        Validator::extend('str_not_start_zero', function ($attribute, $value) {
            return preg_match('/^[^0].*/', $value);
        });

        Validator::extend('strong_password', function ($attribute, $value) {
            return preg_match('/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-_]).{6,}$/', (string) $value);
        }, 'Your password must be more than 8 characters long, should contain at least 1 Uppercase, 1 Lowercase, 1 Numeric, and 1 special character.');

        Validator::extend('new_email', function ($attribute, $value) {
            return preg_match('/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix', $value);
        });

        Validator::extend('domain_url', function ($attribute, $value) {
            return preg_match('/(https?:\/\/(?:www\.|(?!www))[a-zA-Z0-9][a-zA-Z0-9-]+[a-zA-Z0-9]\.[^\s]{2,}|www\.[a-zA-Z0-9][a-zA-Z0-9-]+[a-zA-Z0-9]\.[^\s]{2,}|https?:\/\/(?:www\.|(?!www))[a-zA-Z0-9]+\.[^\s]{2,}|www\.[a-zA-Z0-9]+\.[^\s]{2,})/', $value);
        });

        Validator::extend('one_alpha_num_spaces', function ($attribute, $value) {
            return preg_match('/^[\d]*[a-zA-Z][a-zA-Z\d_." "]*$/', $value);
        });

        Validator::extend('youtube', function ($attribute, $value) {
            return preg_match('/(youtube.com|youtu.be)\/(watch)?(\?v=)?(\S+)?/', $value);
        });

        Validator::extend('youtube_id', function ($attribute, $value) {
            return preg_match('/^[a-zA-Z0-9_-]{11}$/', $value);
        }, 'Please add a valid YouTube sharable ID.');

        Validator::extend('video', function ($attribute, $value) {
            $allowedExtTypes = ['mp4', 'm4p', 'm4v', 'mkv', 'mpg', 'mp2', 'mpeg', 'mpe', 'mpv'];
            if (is_array($value)) {
                foreach ($value as $video_data) {
                    $file_extension = $video_data->getClientOriginalExtension() ?: $video_data->extension();
                    if (in_array($file_extension, $allowedExtTypes)) {
                        return true;
                    }
                }
            } else {
                $file_extension = $value->getClientOriginalExtension() ?: $value->extension();
                if (in_array($file_extension, $allowedExtTypes)) {
                    return true;
                }
            }
            return false;
        }, "Please upload a proper video format file. Allowed formats: .mp4, .m4p, .m4v, .mkv, .mpg, .mp2, .mpeg, .mpe, .mpv");

        Validator::extend('image_file', function ($attribute, $value) {
            $allowedExtTypes = ['jpeg', 'jpg', 'png'];
            if (is_array($value)) {
                foreach ($value as $image_data) {
                    $file_extension = $image_data->getClientOriginalExtension() ?: $image_data->extension();
                    if (in_array($file_extension, $allowedExtTypes)) {
                        return true;
                    }
                }
            } else {
                $file_extension = $value->getClientOriginalExtension() ?: $value->extension();
                if (in_array($file_extension, $allowedExtTypes)) {
                    return true;
                }
            }
            return false;
        }, 'Please upload a proper image format file. Allowed formats: .jpeg, .jpg, and .png');
    }

    /**
     * Cache settings data.
     */
    private function cacheSettingsData(): void
    {
        if (Schema::hasTable('settings')) {
            $settings = cache()->rememberForever('global_settings', function () {
                return Setting::pluck('value', 'slug');
            });
        }
    }

    /**
     * Register view composer.
     */
    private function registerViewComposer(): void
    {
        if (Schema::hasTable('settings')) {
            $settings = Setting::pluck('value', 'slug');
            $logo_img = webLogoImg();
            $favicon_img = webFaviconImg();
            $page_title = webSiteTitleName();
            $site_name = webSiteTitleName();
            view()->composer('*', function ($view) use ($settings, $logo_img, $favicon_img, $page_title, $site_name) {
                $view->with('global_setting_data', $settings);
                $view->with('currency_icon', config('services.env.currency'));
                $view->with('auth_user', Auth::guard('admin')->user());
                $view->with('logo_img', $logo_img);
                $view->with('favicon_img', $favicon_img);
                $view->with('page_title', $page_title);
                $view->with('site_name', $site_name);
            });
        }
    }

    /**
     * Register macro for paginating collections.
     */
    private function registerCollectionPaginationMacro(): void
    {
        Collection::macro('paginate', function ($perPage, $total = null, $page = null, $pageName = 'page') {
            $page = $page ?: LengthAwarePaginator::resolveCurrentPage($pageName);
            return new LengthAwarePaginator(
                $this->forPage($page, $perPage),
                $total ?: $this->count(),
                $perPage,
                $page,
                [
                    'path' => LengthAwarePaginator::resolveCurrentPath(),
                    'pageName' => $pageName,
                ]
            );
        });
    }
}
