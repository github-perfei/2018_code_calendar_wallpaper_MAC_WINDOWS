<?php
/**
 * Created by PhpStorm.
 * User: perfei
 * Date: 2018/2/13
 * Time: 上午9:20
 */

namespace code\setWallpaperHandle;


use code\Wallpaper;

class SetWallpaperHandleFactory
{
    /**
     * @param $os
     * @return MacOsSetWallpaperHandle|WindowsOsSetWallpaperHandle|null
     */
    public static function createSetWallpaperHandle($os)
    {
        $handle = null;
        switch ($os){
            case Wallpaper::MAC_OS :
                $handle = new MacOsSetWallpaperHandle();
                break;
            case Wallpaper::WINDOWS_OS:
                $handle = new WindowsOsSetWallpaperHandle();
                break;
            default:
                break;
        }
        return $handle;
    }
}