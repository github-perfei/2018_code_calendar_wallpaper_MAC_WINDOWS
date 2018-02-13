<?php
/**
 * Created by PhpStorm.
 * User: perfei
 * Date: 2018/2/13
 * Time: 上午12:19
 */

use code\Wallpaper;

/**
 * @throws Exception
 */
function checkImagick()
{
    // Let's check whether we can perform the magick.

    if (TRUE !== extension_loaded('imagick'))
    {
        throw new Exception('Imagick extension is not loaded.');
    }

    // This check is an alternative to the previous one.
    // Use the one that suits you better.
    if (TRUE !== class_exists('Imagick'))
    {
        throw new Exception('Imagick class does not exist.');
    }
}

function myAutoload($className)
{
    if ($className) {
        $file = dirname(__FILE__) . '/../';
        $file .= str_replace('\\', '/', $className);
        $file .= '.php';
        if (file_exists($file)) {
            require_once $file;
        }
    }
}


try {
    $config = require_once 'config.php';
    spl_autoload_register('myAutoload');
    checkImagick();

    $wallpaper = new Wallpaper($config['rootDir'],$config['pdfFileName'],$config['backgroundName']);
    $wallpaper->setOS($config['os']);
    $wallpaper->createWallpaper();
    $wallpaper->setWallpaper();
} catch (\Exception $e) {
    echo $e->getMessage();
}