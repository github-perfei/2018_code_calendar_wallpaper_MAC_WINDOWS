<?php
/**
 * Created by PhpStorm.
 * User: perfei
 * Date: 2018/2/13
 * Time: 上午12:46
 */
namespace code;
use code\setWallpaperHandle\SetWallpaperHandleFactory;
use Imagick;

class Wallpaper
{
    const MAC_OS = 'MAC';
    const WINDOWS_OS = 'WINDOWS';

    const PAGE_OFFSET = 6;
    const MARGIN_LEFT = 100;
    const MARGIN_TOP = 10;

    private $os = self::MAC_OS;

    /**
     * @var $pdfImage Imagick
     */
    private $pdfImage;

    /**
     * @var $pdfImage Imagick
     */
    private $backgroundImage;

    /**
     * @var $pdfImage Imagick
     */
    private $wallpaperImage;

    private $wallpaperRoute;
    private $pdfRoute;
    private $backgroundRoute;

    /**
     * Wallpaper constructor.
     * @throws \Exception
     */
    public function __construct($rootDir,$pdfFileName,$backgroundName)
    {
        $pageOfPdf = self::PAGE_OFFSET + date('W',time());
        $this->pdfRoute = $rootDir . '/source/' . $pdfFileName . '[' . $pageOfPdf . ']';

        $wallpaperName = 'the' . date('W',time()) . 'week.jpg';
        $this->wallpaperRoute = $rootDir . '/wallpaper/' . $wallpaperName;

        $this->backgroundRoute = $rootDir . '/source/' . $backgroundName;

        $this->setPdfImage();
        $this->setBackgroundImage();
    }

    /**
     * @throws \Exception
     */
    private function setPdfImage()
    {
        $this->pdfImage = new Imagick();
        $this->pdfImage->setResolution(160,160); //设置分辨率
        $this->pdfImage->setCompressionQuality(100);//设置图片压缩的质量
        //从文件名读取图像
        if (FALSE === $this->pdfImage->readImage($this->pdfRoute))
        {
            throw new \Exception('read pdf image wrong ! ! ! ');
        }
    }

    /**
     * @throws \Exception
     */
    private function setBackgroundImage()
    {
        $this->backgroundImage = new Imagick();
        if (FALSE === $this->backgroundImage->readImage($this->backgroundRoute))
        {
            throw new \Exception('read background image wrong ! ! ! ');
        }
    }

    /**
     * @param $os
     * @throws \Exception
     */
    public function setOS($os)
    {
        if (in_array($os,[self::MAC_OS,self::WINDOWS_OS])){
            $this->os = $os;
        } else {
          throw new \Exception('This operating system does not support ！！！');
        }
    }

    private function isExistWallpaperFile()
    {
        return file_exists($this->wallpaperRoute);
    }

    /**
     * @throws \Exception
     */
    public function createWallpaper()
    {
        if ($this->isExistWallpaperFile())
        {
            return;
        }
        $this->backgroundImage->compositeImage($this->pdfImage, Imagick::COMPOSITE_BLEND,
            self::MARGIN_LEFT, self::MARGIN_TOP,Imagick::COMPOSITE_DEFAULT);
        $this->backgroundImage->setImageFileName($this->wallpaperRoute);
        if  (false == $this->backgroundImage->writeImage())
        {
            throw new \Exception('createWallpaper wrong ! ! ! ');
        }

        $this->wallpaperImage = new Imagick();
        if (false === $this->wallpaperImage->readImage($this->wallpaperRoute))
        {
            throw new \Exception('read wallpaper image wrong ! ! ! ');
        }
    }

    /**
     * @throws \Exception
     */
    public function setWallpaper()
    {
        if ($this->isExistWallpaperFile()) {
            $setWallpaperHandle = SetWallpaperHandleFactory::createSetWallpaperHandle($this->os);
            if (null === $setWallpaperHandle) {
                throw new \Exception('This operating system does not support ！！！');
            }
            $setWallpaperHandle->handle($this->wallpaperRoute);
        } else {
            throw new \Exception('wallpaper file not exist');
        }
    }

}