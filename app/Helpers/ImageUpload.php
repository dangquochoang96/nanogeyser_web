<?php

namespace App\Helpers;

use Image;

class ImageUpload {
    
    public static function avatar($file, $name) {
        try {
            $image = Image::make($file);
            $path = static::path('public/uploads/avatars/') . $name . static::extension($image->mime());
            if ($image->save($path)) {
                return '/'.$path;
            }
        } catch (\Exception $ex) {            
        }
        return "/public/uploads/avatars/no-avatar.png";
    }
    
    public static function icon($file, $name) {
        try {
            $image = Image::make($file);
            $path = static::path('public/uploads/icons/') . $name . static::extension($image->mime());
            if ($image->save($path)) {
                return '/'.$path;
            }
        } catch (\Exception $ex) {
            
        }
        return "/public/uploads/icon/no-icon.png";
    }
    
    public static function image($file, $name) {
       try {
            $image = Image::make($file);
            $path = static::path('public/uploads/images/') . $name. static::extension($image->mime());
            if ($image->save($path)) {
                return '/'.$path;
            }
       } catch (\Exception $ex) {
           
       }
       return "/uploads/images/no-image.png";
    }

    public static function imageApi($file, $name) {
       try {
            $image = Image::make($file);            
            $path = static::path('uploads/images/') . $name . static::extension($image->mime());
            if ($image->save($path)) {
                return '/'.$path;
            }
       } catch (\Exception $ex) {
       }
       return "/uploads/images/no-image.png";
    }

    public static function path($parent_dir) {
        $path = "";
        $list_dir = explode('/', $parent_dir);
        foreach ($list_dir as $dir) {
            if ($dir != "") {
                $path .= $dir . "/";
                if (!is_dir($path)) {
                    mkdir($path);
                }
            }
        }
        $date_dir = [date("Y"), date("m"), date('d')];
        foreach ($date_dir as $dir) {
            $path .= $dir . "/";
            if (!is_dir($path)) {
                mkdir($path);
            }
        }
        return $path;
    }
    public static function path2($parent_dir) {
        $path = "";
        $list_dir = explode('/', $parent_dir);
        foreach ($list_dir as $dir) {
            if ($dir != "") {
                $path .= $dir . "/";
                if (!is_dir($path)) {
                    mkdir($path);
                }
            }
        }
        return $path;
    }
    private static function extension($mime) {
        switch ($mime) {
            case 'image/gif':
                return '.gif';
            case 'image/jpeg':
                return '.jpg';
            case 'image/png':
                return '.png';
            case 'image/svg+xml':
                return '.svg';
            case 'image/tiff':
                return '.tiff';
            case 'image/webp':
                return '.webp';
            case 'image/x-icon':
                return '.ico';
            default :
                return '.jpg';
        }
    }

}
