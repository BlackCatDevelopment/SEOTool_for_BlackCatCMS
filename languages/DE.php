<?php

/**
 *   This program is free software; you can redistribute it and/or modify
 *   it under the terms of the GNU General Public License as published by
 *   the Free Software Foundation; either version 3 of the License, or (at
 *   your option) any later version.
 *
 *   This program is distributed in the hope that it will be useful, but
 *   WITHOUT ANY WARRANTY; without even the implied warranty of
 *   MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU
 *   General Public License for more details.
 *
 *   You should have received a copy of the GNU General Public License
 *   along with this program; if not, see <http://www.gnu.org/licenses/>.
 *
 *   @author          Black Cat Development
 *   @copyright       2015, Black Cat Development
 *   @link            http://blackcat-cms.org
 *   @license         http://www.gnu.org/licenses/gpl.html
 *   @category        CAT_Modules
 *   @package         SEOTool
 *
 */

if (defined('CAT_PATH')) {
    if (defined('CAT_VERSION')) include(CAT_PATH.'/framework/class.secure.php');
} elseif (file_exists($_SERVER['DOCUMENT_ROOT'].'/framework/class.secure.php')) {
    include($_SERVER['DOCUMENT_ROOT'].'/framework/class.secure.php');
} else {
    $subs = explode('/', dirname($_SERVER['SCRIPT_NAME']));    $dir = $_SERVER['DOCUMENT_ROOT'];
    $inc = false;
    foreach ($subs as $sub) {
        if (empty($sub)) continue; $dir .= '/'.$sub;
        if (file_exists($dir.'/framework/class.secure.php')) {
            include($dir.'/framework/class.secure.php'); $inc = true;    break;
        }
    }
    if (!$inc) trigger_error(sprintf("[ <b>%s</b> ] Can't include class.secure.php!", $_SERVER['SCRIPT_NAME']), E_USER_ERROR);
}

$LANG = array(
    'current' => 'aktuell',
    'Change page' => 'Seite wechseln',
    'Edit .htaccess' => '.htaccess bearbeiten',
    'Edit robots.txt' => 'robots.txt bearbeiten',
    'Helpful links' => 'Hilfreiche Links',
    'Load settings' => 'Einstellungen laden',
    'Please check the following issues' => 'Bitte die folgenden Hinweise prüfen',
    'The description should be a nice &quot;human readable&quot; text having 70 up to 156 characters.'
        => 'Die Beschreibung sollte ein &quot;menschenlesbarer&quot; Text mit mindestens 70 und bis zu 156 Zeichen sein.',
    'The title should be a nice &quot;human readable&quot; text having 30 up to 55 characters.' => 'Der Seitentitel sollte ein &quot;menschenlesbarer&quot; Text mit mindestens 30 und höchstens 55 Zeichen sein.',
    'Update sitemap.xml' => 'sitemap.xml erneuern',
// ----- basic settings -----
    'A canonical link element is an HTML element that helps to prevent duplicate content issues by specifying the &quot;canonical&quot; or &quot;preferred&quot; version of a web page.'
        => 'Ein kanonischer Link ist ein HTML Element, das es ermöglicht, bei mehrfach verwendetem Inhalt die Originalressource bzw. &quot;bevorzugte&quot; Quelle auszuweisen.',
    'Basic settings' => 'Grundeinstellungen',
    'Canonical URL' => 'Kanonische URL',
    'Description' => 'Seitenbeschreibung',
    'If you need to change the URL shown in the search engine results, you can use this server side 301 redirect.' => 'Falls Sie die in den Ergebnissen einer Suchmaschine angezeigte URL einer Seite ändern müssen, können Sie diese serverseitigen 301-Weiterleitung einschalten.',
    'Page title' => 'Seitentitel',
    'Used for the description META attribute. The description should be a nice &quot;human readable&quot; text with 70 up to 156 characters.'
        => 'Wird für das description-META-Attribut verwendet. Die Beschreibung sollte ein &quot;menschenlesbarer&quot; Text mit mindestens 70 und bis zu 156 Zeichen sein.',
    'Used for the keywords META attribute. You should use about 3 (up to 5-6) keywords that occur as often as possible in your page contents.'
        => 'Wird für das keywords-META-Attribut verwendet. Es sollten 3 (bis zu 5-6) Schlüsselworte sein, die in den Inhalten so oft wie möglich vorkommen.',
    'Used for the title attribute. The title should be a nice &quot;human readable&quot; text with about 30 up to 55 characters.'
        => 'Wird für das title Attribut verwendet. Der Seitentitel sollte ein &quot;menschenlesbarer&quot; Text mit mindestens 30 und höchstens 55 Zeichen sein.',
// ----- sitemap settings -----
    '0.5 - Default priority' => '0.5 - Standardpriorität',
    '1 - Highest priority' => '1 - Höchste Priorität',
    'Always include' => 'Immer',
    'always' => 'immer',
    'Automatic detection' => 'Automatisch',
    'daily' => 'täglich',
    'hourly' => 'stündlich',
    'If checked, the sitemap.xml will be re-generated after save.' => 'Wenn aktiviert, wird die sitemap.xml beim Speichern neu geschrieben',
    'Include in Sitemap' => 'In Sitemap aufnehmen',
    'monthly' => 'monatlich',
    'Never include' => 'Nie',
    'never' => 'nie',
    'Sitemap priority' => 'Sitemap Priorität',
    'Sitemap settings' => 'Sitemap Einstellungen',
    'Update frequency' => 'Updatehäufigkeit',
    'Update sitemap.xml on save' => 'Beim Speichern sitemap.xml erneuern',
    'weekly' => 'wöchentlich',
    'yearly' => 'jährlich',
// ----- robots settings -----
    'set to &quot;on&quot; to set &quot;noindex&quot; attribute' => 'Einschalten, um das &quot;noindex&quot; Attribut zu setzen',
    'set to &quot;on&quot; to set &quot;nofollow&quot; attribute' => 'Einschalten, um das &quot;nofollow&quot; Attribut zu setzen',
    'Robots settings' => 'Einstellungen für Suchmaschinen-Robots',
    'Sometimes, if you are listed in DMOZ (ODP), the search engines will display snippets of text about your site taken from them instead of your description meta tag. You can force the search engine to ignore the ODP information by setting this to on.'
        => 'Manchmal zeigen Suchmaschinen, wenn man im DMOZ (ODP) gelistet ist, Abschnitte aus dem Seitentext statt des description META Tags. Mit dieser Einstellung können Sie erzwingen, daß die Suchmaschine die ODP Information ignoriert.',
    'Same als ODP but information is taken from Yahoo! directory.' => 'Das gleiche wie ODP, aber die Information stammt aus dem Yahoo! Verzeichnis.',
    'Prevents the search engines from showing a cached copy of this page.' => 'Verhindert, daß Suchmaschinen eine zwischengespeicherte Kopie der Seite anzeigen',
    'Same as noarchive, but only used by MSN/Live.' => 'Das gleiche wie noarchive, aber nur von MSN/Live verwendet.',
    'Prevents the search engines from showing a snippet of this page in the search results and prevents them from caching the page.' => 'Verhindert, daß Suchmaschinen einen Textschnipsel aus der Seite in den Suchergebnissen anzeigen, und das Zwischenspeichern der Seite.',
    'No translation of this page in search results' => 'Keine Übersetzung der Seite in den Suchergebnissen',
    'Do not add images to index' => 'Bilder nicht indizieren',

    'Save' => 'Speichern',
);