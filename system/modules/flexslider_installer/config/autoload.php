<?php

/**
 * Flex Slider Installer for Contao 4+
 *
 * Copyright (C) 2018 Andrew Stevens Consulting
 *
 * @package    asconsulting/flexslider_installer
 * @link       https://andrewstevens.consulting
 */


 
/**
 * Register the classes
 */
ClassLoader::addClasses(array
(	
	// Event Listener
	'FlexSlider\Installer\EventListener\SymlinkCommandListener'	=> 'system/modules/flexslider/library/FlexSlider/Installer/EventListener/SymlinkCommandListener.php',

	// Contao Manager
	'FlexSlider\Installer\ContaoManager\Plugin'					=> 'system/modules/flexslider/library/FlexSlider/Installer/ContaoManager/Plugin.php'
));
