<?php
defined('_JEXEC') or die;

use Joomla\CMS\Helper\ModuleHelper;
use Joomla\CMS\Factory;

$doc = Factory::getDocument();
$wa = $doc->getWebAssetManager();
$wa->useStyle('bootstrap');

require ModuleHelper::getLayoutPath('mod_vtc_cards_multilang', 'default');