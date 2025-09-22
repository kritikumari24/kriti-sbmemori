<?php

namespace App\Providers;

use App\Models\Setting;
use Illuminate\Support\Collection;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
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
        //Add this custom validation rule.
        Validator::extend('alpha_spaces', function ($attribute, $value) {
            // This will only accept alpha and spaces.
            // If you want to accept hyphens use: /^[\pL\s-]+$/u.
            return preg_match('/^[\pL\s]+$/u', $value);
        });

        //Add this custom validation rule.
        Validator::extend('alpha_num_spaces', function ($attribute, $value) {
            // This will only accept alpha and spaces.
            // If you want to accept hyphens use: /^[\pL\s-]+$/u.
            return preg_match('/^[a-zA-Z0-9\s]+$/', $value);
        });

        //Add this custom validation rule.
        Validator::extend('alpha_num_underscore', function ($attribute, $value) {
            // This will only accept alpha and spaces.
            // If you want to accept hyphens use: /^[\pL\s-]+$/u.
            return preg_match('/^[a-zA-Z0-9_]*$/', $value);
        });

        //Add this custom validation rule.
        Validator::extend('str_not_start_zero', function ($attribute, $value) {
            // This will only accept alpha and spaces.
            // If you want to accept hyphens use: /^[\pL\s-]+$/u.
            return preg_match('/^[^0].*/', $value);
        });

        Validator::extend('strong_password', function ($attribute, $value, $parameters, $validator) {
            // Contain at least one uppercase/lowercase letters, one number and one special char
            return preg_match('/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-_]).{6,}$/', (string)$value);
        }, 'Your password must be more than 8 characters long, should contain at-least 1 Uppercase, 1 Lowercase, 1 Numeric and 1 special character.');

        //Add this custom validation rule.
        Validator::extend('new_email', function ($attribute, $value) {
            // This will only accept alpha and spaces.
            // If you want to accept hyphens use: /^[\pL\s-]+$/u.
            return preg_match('/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix', $value);
        });

        //Add this custom validation rule.
        Validator::extend('domain_url', function ($attribute, $value) {
            // This will only accept alpha and spaces.
            // If you want to accept hyphens use: /^[\pL\s-]+$/u.
            return preg_match('/(https?:\/\/(?:www\.|(?!www))[a-zA-Z0-9][a-zA-Z0-9-]+[a-zA-Z0-9]\.[^\s]{2,}|www\.[a-zA-Z0-9][a-zA-Z0-9-]+[a-zA-Z0-9]\.[^\s]{2,}|https?:\/\/(?:www\.|(?!www))[a-zA-Z0-9]+\.[^\s]{2,}|www\.[a-zA-Z0-9]+\.[^\s]{2,})/', $value);
        });

        //Add this custom validation rule.
        Validator::extend('one_alpha_num_spaces', function ($attribute, $value) {
            // This will only accept atleast one alpha and with numbers and spaces.
            // If you want to accept hyphens use: /^[\d]*[a-zA-Z][a-zA-Z\d_." "]*$/.
            return preg_match('/^[\d]*[a-zA-Z][a-zA-Z\d_." "]*$/', $value);
        });

        //Add this custom validation rule.
        Validator::extend('youtube', function ($attribute, $value) {
            return preg_match('/(youtube.com|youtu.be)\/(watch)?(\?v=)?(\S+)?/', $value);
        });

        //Add this custom validation rule.
        Validator::extend('youtube_id', function ($attribute, $value) {
            return preg_match('/^[a-zA-Z0-9_-]{11}$/', $value);
        }, 'Please add valid youtube sharable id.');

        //Add this custom validation rule for validating video.
        Validator::extend('video', function ($attribute, $value) {
            // Video Type	Extension	MIME Type
            // Flash	.flv	video/x-flv
            // MPEG-4	.mp4	video/mp4, video/mpeg
            // iPhone Index	.m3u8	application/x-mpegURL
            // iPhone Segment	.ts	video/MP2T
            // 3GP Mobile	.3gp	video/3gpp
            // QuickTime	.mov	video/quicktime
            // A/V Interleave	.avi	video/x-msvideo video/avi
            // Windows Media	.wmv	video/x-ms-wmv

            $allowedMimeTypes = [
                'application/octet-stream',
                // 'video/x-flv',
                'video/mp4',
                'application/x-mpegURL',
                'video/MP2T',
                // 'video/3gpp',
                // 'video/quicktime',
                // 'video/x-msvideo',
                // 'video/x-ms-wmv',
                // 'video/avi',
                'video/mpeg',
            ];
            $allowedExtTypes = [
                'mp4', 'm4p', 'm4v', //MP4 (MPEG-4 Part 14) is the most common type of video file format.
                // 'mov', 'qt', //MOV (QuickTime Movie) stores high-quality video, audio, and effects, but these files tend to be quite large.
                // 'wmv', //WMV (Windows Media Viewer) files offer good video quality and large file size like MOV
                // 'avi', //AVI (Audio Video Interleave) works with nearly every web browser on Windows, Mac, and Linux machines.
                // 'avchd', //AVCHD Advanced Video Coding High Definition is specifically for high-definition video.
                // 'flv', 'f4v', 'swf', //Flash video formats FLV, F4V, and SWF (Shockwave Flash) are designed for Flash Player, but they’re commonly used to stream video on YouTube. Flash is not supported by iOS devices.
                'mkv', //MKV Developed in Russia, Matroska Multimedia Container format is free and open source. It supports nearly every codec, but it is not itself supported by many programs. MKV is a smart choice if you expect your video to be viewed on a TV or computer using an open-source media player like VLC or Miro.
                // 'webm', //These formats are best for videos embedded on your personal or business website. They are small files, so they load quickly and stream easily.
                // 'mpeg-2', //If you want to burn your video to a DVD, MPEG-2 with an H.262 codec is the way to go.

                'mpg', 'mp2', 'mpeg', 'mpe', 'mpv', //files can play audio/video media, or simply audio. They are low in file size but also relatively low in quality. They also have lossy compression, meaning their quality will degrade after being edited numerous times.
                // 'ogg', //.OGG files are an open-source alternative to .MPG files, and are used for high-quality videos to be streamed via the internet.

            ];
            if (is_array($value)) {
                $video_dt = $value;
                foreach ($video_dt as $video_data) {
                    // $contentType = $video_data->getClientMimeType();
                    // if (!$contentType) {
                    $file_extension = $video_data->getClientOriginalExtension() !== "" ? $video_data->getClientOriginalExtension() : $video_data->extension();
                    if (in_array($file_extension, $allowedExtTypes)) {
                        return true;
                    }
                    // }
                    // if (in_array($contentType, $allowedMimeTypes)) {
                    //     return true;
                    // }
                }
            } else {
                // $contentType = $value->getClientMimeType();
                // if (!$contentType) {
                $file_extension = $value->getClientOriginalExtension() !== "" ? $value->getClientOriginalExtension() : $value->extension();
                if (in_array($file_extension, $allowedExtTypes)) {
                    return true;
                }
                // }
                // if (in_array($contentType, $allowedMimeTypes)) {
                //     return true;
                // }
            }
        }, "Please upload a proper video format file. Allowed formats: .mp4, .m4p, .m4v, .mkv, .mpg, .mp2, .mpeg, .mpe, .mpv");


        //Add this custom validation rule for validating video.
        Validator::extend('image_file', function ($attribute, $value) {
            // Image Type	Extension	MIME Type
            // All Formats	.*	image/*

            $allowedMimeTypes = [
                'application/octet-stream',
                'image/jpeg',
                'image/jpg',
                'image/png',
            ];
            $allowedExtTypes = [
                'jpeg',
                'jpg',
                'png',
            ];
            if (is_array($value)) {
                $image_dt = $value;
                foreach ($image_dt as $image_data) {
                    // $contentType = $image_data->getClientMimeType();
                    // if (!$contentType) {
                    $file_extension = $image_data->getClientOriginalExtension() !== "" ? $image_data->getClientOriginalExtension() : $image_data->extension();
                    if (in_array($file_extension, $allowedExtTypes)) {
                        return true;
                    }
                    // }
                    // if (in_array($contentType, $allowedMimeTypes)) {
                    //     return true;
                    // }
                }
            } else {
                // $contentType = $value->getClientMimeType();
                // if (!$contentType) {
                $file_extension = $value->getClientOriginalExtension() !== "" ? $value->getClientOriginalExtension() : $value->extension();
                if (in_array($file_extension, $allowedExtTypes)) {
                    return true;
                }
                // }
                // if (in_array($contentType, $allowedMimeTypes)) {
                //     return true;
                // }
            }
        }, 'Please upload a proper image format file. Allowed formats: .jpeg, .jpg and .png');

        if (Schema::hasTable('settings')) {
            $settings = Setting::pluck('value', 'slug');
            $logo_img = webLogoImg();
            $favicon_img = webFaviconImg();
            $page_title = webSiteTitleName();
            $site_name = webSiteTitleName();
            view()->composer('*', function ($view) use ($settings, $logo_img, $favicon_img, $page_title, $site_name) {
                $view->with('global_setting_data', $settings);
                // $view->with('global_setting_data', getJsonFile());
                $view->with('currency_icon', config('services.env.currency'));
                $view->with('auth_user', Auth::guard('admin')->user());
                $view->with('logo_img', $logo_img);
                $view->with('favicon_img', $favicon_img);
                $view->with('page_title', $page_title);
                $view->with('site_name', $site_name);
            });
        }

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

        Paginator::useBootstrapFive();

        // LogViewer::auth(function ($request) {
        //     if (
        //         $request->user()
        //         && in_array($request->user()->email, [
        //             'admin-deorwine_dev@gmail.com',
        //             'admin@gmail.com',
        //         ])
        //     ) {
        //         return true;
        //     } else {
        //         return abort(404);
        //     }
        // });
    }
}
