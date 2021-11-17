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
 *   @category        CAT_Core
 *   @package         seotool
 *
 */

if (defined('CAT_PATH')) {
	include(CAT_PATH.'/framework/class.secure.php');
} else {
	$root = "../";
	$level = 1;
	while (($level < 10) && (!file_exists($root.'/framework/class.secure.php'))) {
		$root .= "../";
		$level += 1;
	}
	if (file_exists($root.'/framework/class.secure.php')) {
		include($root.'/framework/class.secure.php');
	} else {
		trigger_error(sprintf("[ <b>%s</b> ] Can't include class.secure.php!", $_SERVER['SCRIPT_NAME']), E_USER_ERROR);
	}
}

/**
 * some configuration options, please do not change
 **/
$title_min_length = 30;
$title_max_length = 55;
$descr_min_length = 70;
$descr_max_length = 156;

// check permissions
$backend  = CAT_Backend::getInstance('Admintools', 'admintools');
$page_id  = CAT_Helper_Validate::get('_REQUEST', 'page_id', 'numeric');
$form     = \wblib\wbForms::getInstance();

// configure form
$form->set('wblib_url',CAT_URL.'/modules/lib_wblib/wblib');
$form->set('lang_path',CAT_PATH.'/modules/'.pathinfo(dirname(__FILE__),PATHINFO_BASENAME).'/languages');
$form->loadFile('inc.forms.php',CAT_PATH.'/modules/'.pathinfo(dirname(__FILE__),PATHINFO_BASENAME).'/inc');

// if we have a page_id, show the settings for this page
if($page_id)
{
    // check permissions
    if (!CAT_Helper_Page::getPagePermission($page_id, 'admin'))
        $backend->print_error('You do not have permissions to modify this page');
    // get page propertiees
    $tpl_data['page'] = CAT_Helper_Page::properties($page_id);
    // get the form
    $form->setForm('seo');

    if($form->isSent() && $form->isValid())
    {
        $data = $form->getData(1,1);
        $sql  = 'INSERT INTO `:prefix:pages_settings` ( `page_id`, `set_type`, `set_name`, `set_value` ) VALUES ( ?, ?, ?, ?)';
        $sql2 = 'DELETE FROM `:prefix:pages_settings` WHERE `page_id`=? AND `set_type`=?';
        $sql3 = 'UPDATE `:prefix:pages` SET `%s`=:value WHERE `page_id`=:id';
        $default_freq = CAT_Registry::get('SITEMAP_UPDATE_FREQ',NULL,'weekly');
        // delete old settings
        $database->query($sql2,array($page_id,'seo'));
        // insert new settings
        foreach($data as $key => $value)
        {
            if($key == 'page_id')                                        continue;
            // skip setting if default value is set
            if($key == 'sitemap_priority'    && $value == '0.5')         continue;
            if($key == 'sitemap_include'     && $value == 'auto')        continue;
            if($key == 'sitemap_update_freq' && $value == $default_freq) continue;
            if($key == 'update_sitemap')                                 continue;
            // insert new setting
            if(!is_array($value))
            {
                if($key == 'page_title' || $key == 'description' || $key == 'keywords')
                {
                    $sqltmp = sprintf($sql3,$key);
                    $database->query($sqltmp,array('value'=>$value,'id'=>$page_id));
                }
                else
                {
                    $database->query($sql, array($page_id,'seo',$key,$value));
                }
            }
            else
            {
                if($key == 'robots')
                {
                    $new = array();
                    foreach(array_values($value) as $v)
                    {
                        $new[] = $v;
                    }
                    $database->query($sql, array($page_id,'seo',$key,implode(',',$new)));
                }
            }
        }
        CAT_Helper_Page::reset(); // reload page cache
    }

    if(isset($data['update_sitemap']))
        CAT_Helper_SEO::updateSitemap();

    // get current settings
    $page   = CAT_Helper_Page::getPage($page_id);
    $data   = (isset($page['settings']) && isset($page['settings']['seo']))
            ? $page['settings']['seo']
            : array();
    $fdata  = array();
    $robots = array();
    foreach($data as $key => $value)
    {
        if($key=='robots')
        {
            $fdata['robots'] = explode(',',$value[0]);
        }
        else
        {
            $fdata[$key] = $value[0];
        }
    }

    $form->setData($fdata);
    $form->setData($page);
    $form->getElement('page_id_hidden')->setValue($page_id);
    $tpl_data['details_form'] = $form->getForm();

    $check = array();
    if(strlen($page['page_title'])<$title_min_length || strlen($page['page_title'])>$title_max_length)
        $check[] = $backend->lang()->translate('The title should be a nice &quot;human readable&quot; text having 30 up to 55 characters.')
                 . ' (' . $backend->lang()->translate('current')
                 . ': ' . strlen($page['page_title'])
                 . ')';
    if(strlen($page['description'])<$descr_min_length || strlen($page['description'])>$descr_max_length)
        $check[] = $backend->lang()->translate('The description should be a nice &quot;human readable&quot; text having 70 up to 156 characters.')
                 . ' (' . $backend->lang()->translate('current')
                 . ': ' . strlen($page['description'])
                 . ')';

    $tpl_data['check'] = $check;
}

$pages = CAT_Helper_Page::getPages(1);
$tpl_data['page_select']
    = \wblib\wbList::getInstance(array('__id_key'=>'page_id','__title_key'=>'menu_title'))
    ->buildSelect($pages,array('space'=>'|--','name'=>'page_id','selected'=>$page_id));

$parser->setPath(dirname(__FILE__).'/templates/default');
$parser->output('tool',$tpl_data);