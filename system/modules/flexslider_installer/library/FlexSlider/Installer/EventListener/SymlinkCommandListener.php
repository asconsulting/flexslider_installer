<?php

/**
 * Flex Slider Installer for Contao 4+
 *
 * Copyright (C) 2018 Andrew Stevens Consulting
 *
 * @package    asconsulting/flexslider_installer
 * @link       https://andrewstevens.consulting
 */
 
 

namespace FlexSlider\Installer\EventListener;

use Contao\CoreBundle\Command\SymlinksCommand;
use Contao\CoreBundle\Util\SymlinkUtil;
use Symfony\Component\Console\Event\ConsoleTerminateEvent;
use Symfony\Component\Filesystem\Filesystem;


class SymlinkCommandListener
{
    /**
     * @var string
     */
    private $rootDir;

    /**
     * Constructor.
     *
     * @param string $rootDir
     */
    public function __construct($rootDir)
    {
        $this->rootDir = dirname($rootDir);
    }

    /**
     * Adds the isotope symlink.
     *
     * @param ConsoleTerminateEvent $event
     */
    public function onConsoleTerminate(ConsoleTerminateEvent $event)
    {
        if (!($event->getCommand() instanceof SymlinksCommand) || $event->getExitCode() > 0) {
            return;
        }
		
		$boolSuccess = false;
		if (file_put_contents($this->rootDir . '/files/flexslider-master.zip', fopen("https://github.com/woocommerce/FlexSlider/archive/master.zip", 'r')) !== false) {
			$zip = new \ZipArchive;
			if ($zip->open($this->rootDir . '/files/flexslider-master.zip') === TRUE) {
				$zip->extractTo($this->rootDir . '/var/cache/flexslider/');
				$zip->close();
				rename($this->rootDir .'/var/cache/flexslider/FlexSlider-master', $this->rootDir .'/files/flexslider');
				unlink($this->rootDir . '/var/cache/flexslider');
				unlink($this->rootDir . '/files/flexslider-master.zip');
				$boolSuccess = true;
			}
		}

		if ($boolSuccess) {
			(new Filesystem())->mkdir($this->rootDir . '/web/flexslider');
			SymlinkUtil::symlink('files/flexslider', 'web/flexslider', $this->rootDir);
		}
    }
}
