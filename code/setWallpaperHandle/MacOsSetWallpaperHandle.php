<?php
/**
 * Created by PhpStorm.
 * User: perfei
 * Date: 2018/2/13
 * Time: 上午9:16
 */

namespace code\setWallpaperHandle;

class MacOsSetWallpaperHandle extends BaseSetWallpaperHandle
{
    /**
     * @param $wallpaperImageRoute
     * @return string
     */
    function getScript($wallpaperImageRoute)
    {
        return 'osascript -e "tell application \\"Finder\\" to set desktop picture to POSIX file \\"' . $wallpaperImageRoute . '\\""';
    }
}