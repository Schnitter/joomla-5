<?php
defined('_JEXEC') or die;

use Joomla\CMS\Helper\ModuleHelper;
use Joomla\CMS\Factory;

require_once __DIR__ . '/helper.php';

$menu  = HelperBootstrap::getMenu();
$logo  = '';  
$fluid = 1;  

// Bootstrap JS über Joomla WebAssetManager laden
$app = Factory::getApplication();
$wa  = $app->getDocument()->getWebAssetManager();

// Prüfen, ob 'bootstrap.bundle' bereits geladen ist
if (!$wa->getAsset('script', 'bootstrap.bundle')) {
    $wa->useScript('bootstrap.bundle');
}

require ModuleHelper::getLayoutPath('mod_vtc-bootstrap5', 'default');
