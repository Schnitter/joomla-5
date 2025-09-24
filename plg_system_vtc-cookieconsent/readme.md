# Joomla 5 Cookie Consent Plugin (vtc-cookieconsent)

## English 🇬🇧

### Overview
This Joomla 5 system plugin provides a **cookie consent banner** with support for different categories:
- **Necessary** (always active)
- **Statistics** (Google Analytics)
- **Design** (Google Fonts, CDN resources)
- **Marketing** (YouTube, Google Maps)

The plugin blocks external resources until the visitor has given consent.  
Users can change their cookie settings at any time via a settings button (⚙️) in the footer.

### Features
- Bootstrap 5 styled cookie banner (footer position)
- Modal dialog for cookie settings
- Consent categories
- Blocking & lazy-loading of:
  - Google Analytics
  - Google Fonts
  - External CDN scripts
  - YouTube iframes
  - Google Maps iframes
- User can reopen cookie settings anytime

### Installation
1. Create a ZIP archive of the plugin folder (`plg_system_vtc-cookieconsent`).
2. In Joomla backend go to **Extensions → Manage → Install**.
3. Upload the ZIP file.
4. Enable the plugin in **Extensions → Plugins**.
5. Configure texts and categories as needed.

### Usage
- The banner will show up automatically until consent is given.
- Blocked content (YouTube/Maps) is displayed as a placeholder with a button.
- After consent, blocked content loads dynamically.

---

## Deutsch 🇩🇪

### Übersicht
Dieses Joomla 5 System-Plugin zeigt ein **Cookie-Banner** mit Unterstützung für verschiedene Kategorien:
- **Notwendig** (immer aktiv)
- **Statistik** (Google Analytics)
- **Design** (Google Fonts, CDN-Ressourcen)
- **Marketing** (YouTube, Google Maps)

Das Plugin blockiert externe Inhalte, bis der Besucher zugestimmt hat.  
Über einen ⚙️-Button im Footer können die Einstellungen jederzeit geändert werden.

### Funktionen
- Cookie-Banner im Footer (Bootstrap 5 Design)
- Modal für Cookie-Einstellungen
- Kategorien zur Einwilligung
- Blockieren & Nachladen von:
  - Google Analytics
  - Google Fonts
  - Externe CDN-Skripte
  - YouTube Iframes
  - Google Maps Iframes
- Benutzer kann jederzeit Einstellungen ändern

### Installation
1. Plugin-Ordner (`plg_system_vtc-cookieconsent`) als ZIP packen.
2. Im Joomla-Backend unter **Erweiterungen → Verwalten → Installieren** hochladen.
3. Plugin unter **Erweiterungen → Plugins** aktivieren.
4. Texte und Kategorien im Backend konfigurieren.

### Verwendung
- Das Banner erscheint automatisch, solange keine Zustimmung erteilt wurde.
- Blockierte Inhalte (YouTube/Maps) erscheinen mit Platzhalter + Button.
- Nach Zustimmung werden Inhalte dynamisch geladen.
