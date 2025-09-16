<?php
defined('_JEXEC') or die;

use Joomla\CMS\Factory;

class HelperBootstrap
{
    public static function getMenu()
    {
        $app  = Factory::getApplication();
        $menu = $app->getMenu();
        $items = $menu->getItems('menutype', 'mainmenu'); // Standard-Menü 'mainmenu'
        return $items ?: [];
    }
}
