<?php
/**
 * @package     Joomla.Plugin
 * @subpackage  System.VTC-Bootstrap5
 */

defined('_JEXEC') or die;

use Joomla\CMS\Plugin\CMSPlugin;

class PlgSystemVtcBootstrap5 extends CMSPlugin
{
    public function onBeforeCompileHead()
    {
        $doc = $this->app->getDocument();
        $wa = $doc->getWebAssetManager();

        // De-registrieren aller vorhandenen Bootstrap-Assets
        $existingAssets = ['bootstrap', 'bootstrap.bundle', 'bootstrap.min', 'bootstrap.css', 'bootstrap.js'];
        foreach ($existingAssets as $asset) {
            if ($wa->assetExists($asset)) {
                $wa->unregister($asset);
            }
        }

        // Eigene Bootstrap 5 Version registrieren und laden
        $wa->registerAndUseStyle('plg_system_vtc-bootstrap5.bootstrap', 'plg_system_vtc-bootstrap5/assets/css/bootstrap.min.css');
        $wa->registerAndUseScript('plg_system_vtc-bootstrap5.bootstrap', 'plg_system_vtc-bootstrap5/assets/js/bootstrap.bundle.min.js', [], ['defer' => true]);
    }
}
