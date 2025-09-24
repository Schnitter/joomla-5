<?php
/**
 * @package     Joomla.Plugin
 * @subpackage  System.vtc-cookieconsent
 *
 * Plugin für Cookie Consent mit Blockierung von Google Analytics, Fonts, YouTube, Google Maps usw.
 */

defined('_JEXEC') or die;

use Joomla\CMS\Plugin\CMSPlugin;
use Joomla\CMS\Factory;
use Joomla\CMS\Application\CMSApplication;

class PlgSystemVtc_cookieconsent extends CMSPlugin
{
    protected $app;

    public function onAfterRender()
    {
        // Nur im Site-Bereich aktiv
        if ($this->app->isClient('administrator')) {
            return;
        }

        $body = $this->app->getBody();

        // ------------------------------------------------
        // Blocker: YouTube & Google Maps iframes ersetzen
        // ------------------------------------------------
        $body = preg_replace_callback(
            '/<iframe[^>]+src="([^"]+)"[^>]*><\/iframe>/i',
            function ($matches) {
                $src = $matches[1];
                if (strpos($src, 'youtube.com') !== false || strpos($src, 'youtu.be') !== false || strpos($src, 'google.com/maps') !== false) {
                    return '<div class="cookie-placeholder bg-light border rounded p-3 text-center my-2" 
                                data-src="' . htmlspecialchars($src) . '">
                                <p>Dieses Element ist blockiert (YouTube/Google Maps).</p>
                                <button class="btn btn-sm btn-outline-primary" onclick="loadBlockedContent(this)">Akzeptieren &amp; laden</button>
                            </div>';
                }
                return $matches[0];
            },
            $body
        );

        // ------------------------------------------------
        // Cookie-Banner einfügen (Footer)
        // ------------------------------------------------
        $banner = '
        <div id="cookie-consent-banner" class="cookie-consent card shadow-lg position-fixed bottom-0 start-0 end-0 m-3 d-none" style="z-index:9999;">
            <div class="card-body text-center">
                <p class="mb-2">Wir verwenden Cookies, um unsere Website zu optimieren.</p>
                <div class="d-flex justify-content-center gap-2">
                    <button class="btn btn-success" onclick="acceptCookies(\'all\')">Alle akzeptieren</button>
                    <button class="btn btn-secondary" onclick="acceptCookies(\'necessary\')">Nur notwendige</button>
                    <button class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#cookieSettingsModal">Einstellungen</button>
                </div>
            </div>
        </div>

        <!-- Modal für Cookie-Einstellungen -->
        <div class="modal fade" id="cookieSettingsModal" tabindex="-1">
          <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">Cookie-Einstellungen</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Schließen"></button>
              </div>
              <div class="modal-body">
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" id="cookies-necessary" checked disabled>
                  <label class="form-check-label" for="cookies-necessary">Notwendig (immer aktiv)</label>
                </div>
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" id="cookies-statistics">
                  <label class="form-check-label" for="cookies-statistics">Statistik (Google Analytics)</label>
                </div>
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" id="cookies-design">
                  <label class="form-check-label" for="cookies-design">Design (Google Fonts, CDN)</label>
                </div>
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" id="cookies-marketing">
                  <label class="form-check-label" for="cookies-marketing">Marketing (YouTube, Google Maps)</label>
                </div>
              </div>
              <div class="modal-footer">
                <button class="btn btn-primary" onclick="saveCookieSettings()">Speichern</button>
              </div>
            </div>
          </div>
        </div>

        <!-- Einstellungs-Button -->
        <button id="cookie-settings-btn" class="btn btn-sm btn-outline-secondary position-fixed bottom-0 end-0 m-3" style="z-index:9999; display:none;" onclick="openCookieSettings()">
            ⚙️ Cookies
        </button>

        <script>
        document.addEventListener("DOMContentLoaded", function() {
            if (!localStorage.getItem("cookieConsent")) {
                document.getElementById("cookie-consent-banner").classList.remove("d-none");
            } else {
                document.getElementById("cookie-settings-btn").style.display = "block";
            }
        });

        function acceptCookies(type) {
            if (type === "all") {
                localStorage.setItem("cookieConsent", JSON.stringify({necessary:true, statistics:true, design:true, marketing:true}));
            } else {
                localStorage.setItem("cookieConsent", JSON.stringify({necessary:true, statistics:false, design:false, marketing:false}));
            }
            document.getElementById("cookie-consent-banner").classList.add("d-none");
            document.getElementById("cookie-settings-btn").style.display = "block";
            location.reload();
        }

        function saveCookieSettings() {
            let settings = {
                necessary: true,
                statistics: document.getElementById("cookies-statistics").checked,
                design: document.getElementById("cookies-design").checked,
                marketing: document.getElementById("cookies-marketing").checked
            };
            localStorage.setItem("cookieConsent", JSON.stringify(settings));
            document.getElementById("cookie-consent-banner").classList.add("d-none");
            document.getElementById("cookie-settings-btn").style.display = "block";
            var modal = bootstrap.Modal.getInstance(document.getElementById("cookieSettingsModal"));
            modal.hide();
            location.reload();
        }

        function openCookieSettings() {
            var modal = new bootstrap.Modal(document.getElementById("cookieSettingsModal"));
            modal.show();
        }

        function loadBlockedContent(btn) {
            const placeholder = btn.closest(".cookie-placeholder");
            const src = placeholder.getAttribute("data-src");
            if (src) {
                const iframe = document.createElement("iframe");
                iframe.src = src;
                iframe.width = "100%";
                iframe.height = "400";
                iframe.setAttribute("frameborder", "0");
                iframe.setAttribute("allowfullscreen", "1");
                placeholder.replaceWith(iframe);
            }
        }
        </script>
        ';

        // Banner und JS vor </body> einfügen
        $body = str_ireplace('</body>', $banner . '</body>', $body);

        $this->app->setBody($body);
    }
}
