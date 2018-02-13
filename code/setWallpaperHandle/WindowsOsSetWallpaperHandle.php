<?php
/**
 * Created by PhpStorm.
 * User: perfei
 * Date: 2018/2/13
 * Time: 上午9:16
 */

namespace code\setWallpaperHandle;

class WindowsOsSetWallpaperHandle extends BaseSetWallpaperHandle
{
    /**
     * @param $wallpaperImageRoute
     * @return string
     */
    function getScript($wallpaperImageRoute)
    {
        return 'reg add "HKCU\\Control Panel\\Desktop" /v Wallpaper /f /t REG_SZ /d ' . $wallpaperImageRoute . ' \\n RunDll32.exe USER32.DLL,UpdatePerUserSystemParameters';
    }
}