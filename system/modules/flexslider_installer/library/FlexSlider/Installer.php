<?php

/**
 * Flex Slider Installer for Contao 4+
 *
 * Copyright (C) 2018 Andrew Stevens Consulting
 *
 * @package    asconsulting/flexslider_installer
 * @link       https://andrewstevens.consulting
 */
 
 

namespace FlexSlider;

class Installer extends \Controller
{

    /**
     * Initialize the object
     */
    public function __construct()
    {
        parent::__construct();

        $GLOBALS['TL_CONFIG']['debugMode'] = false;
    }


    /**
     * Install from zip
     */
    public function install()
    {
		if (file_put_contents($this->rootDir . '/files/flexslider-master.zip', fopen("https://github.com/woocommerce/FlexSlider/archive/master.zip", 'r')) !== false) {
			$zip = new \ZipArchive;
			if ($zip->open($this->rootDir . '/files/flexslider-master.zip') === TRUE) {
				$zip->extractTo($this->rootDir . '/var/cache/flexslider/');
				$zip->close();
				
				$objAssetsFolder = new \Folder('/var/cache/flexslider/FlexSlider-master');
				$objAssetsFolder->renameTo('/files/flexslider');
				
				$objCacheFolder = new \Folder('/var/cache/flexslider');
				$objCacheFolder->delete();
				
				$objZipFile = new \File('/files/flexslider-master.zip');
				$objZipFile->delete();
				
				\File::putContent('/files/flexslider/.public', '');
			}
		}
    }

}
