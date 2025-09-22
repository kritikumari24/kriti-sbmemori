<?php

namespace App\Services;

use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Image;

class FileService
{
    /**
     * check the file in strorage Path.
     *
     * @param  App\Http\Requests\AdminRequest $request
     * @param  string  $url
     * @return string
     */
    public static function getFileUrl($file_url, $file_name = null, $type = null)
    {
        if ($file_name == null) {
            if ($type == 'user') {
                $url = self::return_user_default_image();
            } else if ($type == 'file') {
                $url = null;
            } else {
                $url = imageNotFoundUrl();
            }
        } else {
            $url = self::file_exists_storage_path($file_url . $file_name, $type);
        }
        return $url;
    }

    /**
     * check the file in storage Path.
     *
     * @param  App\Http\Requests\AdminRequest $request
     * @param  string  $url
     * @return string
     */
    public static function file_exists_storage_path($url, $type = null)
    {
        $filesystem_disk = config()->get('services.env.filesystem_disk');
        // dd($filesystem_disk);
        if ($filesystem_disk == 's3') {
            $path = config()->get('services.s3.image_url') . $url;
        } else {
            // dd(Storage::disk('public')->exists($url), Storage::disk('local')->url($url));
            if (Storage::disk('public')->exists($url)) {
                // $path = Storage::disk('local')->url($url);
                $path = config()->get('services.img.local_img_url') . $url;
            } else {
                if ($type == 'user') {
                    $path = self::return_user_default_image();
                } else if ($type == 'file') {
                    $path = null;
                } else {
                    $path = imageNotFoundUrl();
                }
            }
        }
        return $path;
    }

    /**
     * check the file in strorage Path.
     *
     * @param  App\Http\Requests\AdminRequest $request
     * @param  string  $url
     * @return string
     */
    public static function return_user_default_image()
    {
        if (request()->is('*api/*')) {
            $url = defaultUserImageApiUrl();
        } else {
            $url = blankUserUrl();
        }
        return $url;
    }

    /**
     * check the file in public Path.
     *
     * @param  App\Http\Requests\AdminRequest $request
     * @param  string  $url
     * @return string
     */
    public static function file_exists_public_path($url)
    {
        if (file_exists(public_path() . $url)) {
            return url('/') . $url;
        } else {
            return imageNotFoundUrl();
        }
    }

    /**
     * Remove the file from public Path.
     *
     * @param  string  $url
     * @return string
     */
    public static function remove_file_public_path($url)
    {
        if (file_exists(public_path() . $url)) {
            unlink(public_path($url));
            return true;
        } else {
            return false;
        }
    }

    /**
     * Upload file in storage.
     *
     * @param  Request $request
     * @param  String  $key
     * @param  String  $url public/upload/.$url
     * @param  String  $name
     * @return bool
     */
    public static function imageUploader(Request $request, $key, $url, $name = '')
    {
        $filesystem_disk = config()->get('services.env.filesystem_disk');
        $image_name = "";
        if ($request->hasFile($key)) {
            $image = $request->file($key);
            $ext = $image->getClientOriginalExtension() !== "" ? $image->getClientOriginalExtension() : $image->extension();

            if ($name) {
                $image_name = $name;
            } else {
                $image_name = $name . time() . '_' . uniqid() . '.' . $ext;
            }
            self::fileUploadToStorage($image, $image_name, $url);
            return $image_name;
        } else {
            return null;
        }
    }

    /**
     * Upload file in storage.
     *
     * @param  Request $request
     * @param  String  $key
     * @param  String  $url public/upload/.$url
     * @param  String  $name
     * @return bool
     */
    public static function imageUploaderWithExt(Request $request, $key, $url, $name = '')
    {
        $filesystem_disk = config()->get('services.env.filesystem_disk');
        $image_name = "";
        if ($request->hasFile($key)) {
            $image = $request->file($key);
            $ext = $image->getClientOriginalExtension() !== "" ? $image->getClientOriginalExtension() : $image->extension();

            $file = [];
            if ($name) {
                $image_name = $name;
                $file = [
                    'name' => $image_name,
                    'ext' => $ext,
                    'original_name' => $image->getClientOriginalName() !== "" ? $image->getClientOriginalName() : $image_name
                ];
            } else {
                $image_name = $name . time() . '_' . uniqid() . '.' . $ext;
                $file = [
                    'name' => $image_name,
                    'ext' => $ext,
                    'original_name' => $image->getClientOriginalName() !== "" ? $image->getClientOriginalName() : $image_name
                ];
            }
            self::fileUploadToStorage($image, $image_name, $url);
            return $file;
        } else {
            return null;
        }
    }

    /**
     * Upload Multiple file in storage.
     *
     * @param  Request $request
     * @param  String  $key
     * @param  String  $url public/upload/.$url
     * @param  String  $name
     * @return array
     */
    public static function multipleImageUploader(Request $request, $key, $url, $name = '')
    {
        $filesystem_disk = config()->get('services.env.filesystem_disk');
        $image_name = [];
        if ($request->hasFile($key)) {
            foreach ($request->file($key) as $image) {
                // $image = $request->file($key);
                $ext = $image->getClientOriginalExtension() !== "" ? $image->getClientOriginalExtension() : $image->extension();

                if ($name) {
                    $image_name_str = $name;
                } else {
                    $image_name_str = $name . time() . '_' . uniqid() . '.' . $ext;
                }
                $path = Storage::disk($filesystem_disk)->putFileAs('public/' . $url, $image, $image_name_str, 'public');
                self::fileUploadToStorage($image, $image_name_str, $url);
                array_push($image_name, $image_name_str);
            }

            return $image_name;
        } else {
            return [];
        }
    }

    /**
     * Upload Multiple file in storage.
     *
     * @param  Request $request
     * @param  String  $key
     * @param  String  $url public/upload/.$url
     * @param  String  $name
     * @return array('image_name', 'image_ext')
     */
    public static function multipleImageUploaderWithExt(Request $request, $key, $url, $name = '')
    {
        $filesystem_disk = config()->get('services.env.filesystem_disk');
        // $image_name = [];
        // $image_ext = [];
        $file_details = [];
        if ($request->hasFile($key)) {
            $i = 0;
            foreach ($request->file($key) as $image) {
                $ext = $image->getClientOriginalExtension() !== "" ? $image->getClientOriginalExtension() : $image->extension();

                if ($name) {
                    $image_name_str = $name;
                } else {
                    $image_name_str = $name . time() . '_' . uniqid() . '.' . $ext;
                    $image_ext_str = $ext;
                }
                // $path = Storage::disk($filesystem_disk)->putFileAs('public/' . $url, $image, $image_name_str, 'public');
                self::fileUploadToStorage($image, $image_name_str, $url);
                $file_details[$i]['image_name'] = $image_name_str;
                $file_details[$i]['image_ext'] = $image_ext_str;
                $file_details[$i]['original_name'] = $image->getClientOriginalName() !== "" ? $image->getClientOriginalName() : $image_name_str;
                $i++;
            }
            return $file_details;
        } else {
            return [];
        }
    }

    public static function removeImage(Model $model, String $column_name, $url)
    {
        $filesystem_disk = config()->get('services.env.filesystem_disk');
        if ($model->getOriginal($column_name) != "" && $model->getOriginal($column_name) != null) {
            if (Storage::disk($filesystem_disk)->exists('public/' . $url . '/' . $model->getRawOriginal($column_name))) {

                $file = 'public/' . $url . '/' . $model->getRawOriginal($column_name);
                $result = Storage::disk($filesystem_disk)->delete($file);
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public static function fileUploaderWithoutRequest(UploadedFile $image, $url, $name = '')
    {
        $filesystem_disk = config()->get('services.env.filesystem_disk');
        $ext = $image->getClientOriginalExtension() !== "" ? $image->getClientOriginalExtension() : $image->extension();

        if ($name) {
            $image_name = $name;
        } else {
            $image_name = $name . time() . '_' . uniqid() . '.' . $ext;
        }
        self::fileUploadToStorage($image, $image_name, $url);
        return $image_name;
    }

    public static function fileUploaderWithoutRequestWithExt(UploadedFile $image, $url, $name = '')
    {
        $filesystem_disk = config()->get('services.env.filesystem_disk');
        $ext = $image->getClientOriginalExtension() !== "" ? $image->getClientOriginalExtension() : $image->extension();

        $file = [];
        if ($name) {
            $image_name = $name;
            $file = [
                'name' => $image_name,
                'ext' => $ext,
                'original_name' => $image->getClientOriginalName() !== "" ? $image->getClientOriginalName() : $image_name
            ];
        } else {
            $image_name = $name . time() . '_' . uniqid() . '.' . $ext;
            $file = [
                'name' => $image_name,
                'ext' => $ext,
                'original_name' => $image->getClientOriginalName() !== "" ? $image->getClientOriginalName() : $image_name
            ];
        }
        self::fileUploadToStorage($image, $image_name, $url);
        return $file;
    }

    public static function fileUploadToStorage($image, $image_name_str, $url)
    {
        $filesystem_disk = config()->get('services.env.filesystem_disk');
        // Log::debug('$filesystem_disk: ' . $filesystem_disk);

        if (config('services.env.img_compression')) {
            self::fileUploadWithCompression($image, $image_name_str, $url);
        } else {
            self::fileUploadWithoutCompression($image, $image_name_str, $url);
        }
        return true;
    }

    public static function fileUploadWithCompression($image, $image_name_str, $url)
    {
        $filesystem_disk = config()->get('services.env.filesystem_disk');
        $ext = $image->getClientOriginalExtension() !== "" ? $image->getClientOriginalExtension() : $image->extension();
        //start::img compression code
        if ($ext == 'jpg' || $ext == 'jpeg' || $ext == 'png') {
            $image = Image::make($image)->resize(1000, null, function ($constraint) {
                $constraint->aspectRatio();
            });
            try {
                $img = Storage::disk($filesystem_disk)->put('public/' . $url . '/' . $image_name_str, $image->encode());
                // Log::debug('Image Compression is working. Image uploading status: ' . $img);
            } catch (Exception $e) {
                Log::error('Image Compression not working. Request is Error: - ' . $e->getMessage());
            }
        } else {
            self::fileUploadWithoutCompression($image, $image_name_str, $url);
        }
        //end::img compression code
        return true;
    }

    public static function fileUploadWithoutCompression($image, $image_name_str, $url)
    {
        $filesystem_disk = config()->get('services.env.filesystem_disk');
        try {
            // $img = Storage::disk($filesystem_disk)->put('public/' . $url . '/' .  $image_name_str, $image_name_str);
            $img = Storage::disk($filesystem_disk)->putFileAs('public/' . $url, $image, $image_name_str, 'public');
            // Log::debug('Image uploading is working. Image uploading status: ' . $img);
        } catch (Exception $e) {
            Log::error('Compression Not applied & the file not working. Request is Error: - ' . $e);
        }
        return true;
    }

    public static function uploadPdfFile($pdf, $file_name, $url)
    {
        $filesystem_disk = config()->get('services.env.filesystem_disk');
        try {
            $content = $pdf->download()->getOriginalContent();
            Storage::disk($filesystem_disk)->put('public/' . $url . '/' . $file_name, $content);
        } catch (Exception $e) {
            Log::error('Pdf File not uploaded in storage. Error Msg:- ' . $e->getMessage());
        }
    }
}
