<?php
/**
 * Created by PhpStorm.
 * User: perfei
 * Date: 2018/2/13
 * Time: 上午9:15
 */

namespace code\setWallpaperHandle;

abstract class BaseSetWallpaperHandle
{
    /**
     * @param $wallpaperImageRoute
     * @return string
     */
    abstract function getScript($wallpaperImageRoute);

    /**
     * @param $wallpaperImageRoute
     * @return mixed|void
     * @throws \Exception
     */
    function handle($wallpaperImageRoute)
    {
        $script = $this->getScript($wallpaperImageRoute);
        if(false === system($script)){
            throw new \Exception('exec command wrong');
        }
    }
}