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
    'Please choose the page you wish to configure' => 'Bitte die Seite auswählen, die konfiguriert werden soll',
    '0.5 - Default priority' => '0.5 - Standardpriorität',
    '1 - Highest priority' => '1 - Höchste Priorität',
    'A canonical link element is an HTML element that helps to prevent duplicate content issues by specifying the &quot;canonical&quot; or &quot;preferred&quot; version of a web page.'
        => 'Ein kanonischer Link ist ein HTML Element, das es ermöglicht, bei mehrfach verwendetem Inhalt die Originalressource bzw. &quot;bevorzugte&quot; Quelle auszuweisen.',
    'allow follow' => 'Linkverfolgung erlauben',
    'allow index' => 'Indizierung erlauben',
    'Allows to set the META attributes "noindex" and "nofollow"' => 'Erlaubt das Setzen der META Attribute "noindex" und "nofollow"',
    'Always include' => 'Immer',
    'Automatic detection' => 'Automatisch',
    'Basic settings' => 'Grundeinstellungen',
    'Canonical URL' => 'Kanonische URL',
    'Change page' => 'Seite wechseln',
    'current' => 'aktuell',
    'Description' => 'Seitenbeschreibung',
    'Description length <= 156 characters' => 'Seitenbeschreibung Länge <= 156 Zeichen',
    'disable to set "nofollow" attribute' => 'Deaktivieren um "nofollow" zu setzen',
    'disable to set "noindex" attribute' => 'Deaktivieren um "noindex" zu setzen',
    'Default update frequency' => 'Vorgabe für Updatehäufigkeit',
    'Do not add images to index' => 'Bilder auf dieser Seite nicht in den Index aufnehmen',
    'Helpful links' => 'Hilfreiche Links',
    'Include in Sitemap' => 'In Sitemap aufnehmen',
    'Keywords appear in the description' => 'Keywords sind in der Beschreibung enthalten',
    'Keywords appear in the title attribute' => 'Keywords sind im Seitentitel enthalten',
    'Keywords appear in the URL for this page' => 'Keywords sind in der URL der Seite enthalten',
    'Load settings' => 'Einstellungen laden',
    'Never include' => 'Nie',
    'No translation of this page in search results' => 'Keine Übersetzung dieser Seite in Suchergebnissen anbieten',
    'Page title' => 'Seitentitel',
    'Please check the following issues' => 'Bitte die folgenden Hinweise prüfen',
    'Please note: These are options that need some Know-How about Search Engine Optimization. If you don\'t know what to do here, just leave the default settings.'
        => 'Hinweis: Diese Einstellungen erfordern einiges Wissen über Suchmaschinenoptimierung. Wenn Sie nicht wissen, was Sie hier einstellen sollen, belassen Sie am besten die Voreinstellungen.',
    'Robots settings' => 'Einstellungen für Suchmaschinen-Robots',
    'Save' => 'Speichern',
    'Sitemap priority' => 'Sitemap Priorität',
    'Sitemap settings' => 'Sitemap Einstellungen',
    'The description should be a nice &quot;human readable&quot; text having 70 up to 156 characters.'
        => 'Die Beschreibung sollte ein &quot;menschenlesbarer&quot; Text mit mindestens 70 und bis zu 156 Zeichen sein.',
    'The priority of this URL relative to other URLs on your site. This value does not affect how your pages are compared to pages on other sites—it only lets the search engines know which pages you deem most important for the crawlers.'
        => 'Die Priorität dieser URL gegenüber anderen URLs auf Ihrer Website. Dieser Wert hat keinen Einfluss auf einen Vergleich Ihrer Seiten mit Seiten auf anderen Websites. Er informiert die Suchmaschinen lediglich darüber, welche Seiten für die Crawler die höchste Priorität haben.',
    'The title should be a nice &quot;human readable&quot; text having 30 up to 55 characters.' => 'Der Seitentitel sollte ein &quot;menschenlesbarer&quot; Text mit mindestens 30 und höchstens 55 Zeichen sein.',
    'Update frequency' => 'Updatehäufigkeit',
    'Update sitemap.xml on save' => 'Beim Speichern sitemap.xml erneuern',
    'Used for the title attribute. The title should be a nice &quot;human readable&quot; text with about 30 up to 55 characters.'
        => 'Wird für das title Attribut verwendet. Der Seitentitel sollte ein &quot;menschenlesbarer&quot; Text mit mindestens 30 und höchstens 55 Zeichen sein.',
    'Used for the description META attribute. The description should be a nice &quot;human readable&quot; text with 70 up to 156 characters.'
        => 'Wird für das description-META-Attribut verwendet. Die Beschreibung sollte ein &quot;menschenlesbarer&quot; Text mit mindestens 70 und bis zu 156 Zeichen sein.',
    'Used for the keywords META attribute. You should use about 3 (up to 5-6) keywords that occur as often as possible in your page contents.' => 'Wird für das keywords-META-Attribut verwendet. Es sollten 3 (bis zu 5-6) Schlüsselworte sein, die in den Inhalten so oft wie möglich vorkommen.',
    'Used for the title tag in the HTML header.' => 'Wird für das title-Tag im HTML-Seitenkopf verwendet.',
    'SEO Settings for page' => 'SEO Einstellungen für Seite',
);