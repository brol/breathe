<?php
/* BEGIN LICENSE BLOCK
This file is part of breathe, a theme for Dotclear.

Copyright (c) 2013 - 2015
Pierre Van Glabeke https://github.com/brol/breathe

Licensed under the Creative Commons version 4.0 license.
A copy of this license is available in LICENSE file or at
http://creativecommons.org/licenses/by-nc-sa/4.0/deed.fr
END LICENSE BLOCK */

if (!defined('DC_CONTEXT_ADMIN')) { return; }

global $core;

//PARAMS

# Translations
l10n::set(dirname(__FILE__).'/locales/'.$_lang.'/main');

# Default values
$default_menu = 'menuV';
$default_color = 'gray';
$default_dock = 'yesdock';
$default_slidenav = 'yesslidenav';
$default_slide1 = false;
$default_slide2 = false;

# Settings
$my_menu = $core->blog->settings->themes->breathe_menu;
$my_color = $core->blog->settings->themes->breathe_color;
$my_dock = $core->blog->settings->themes->breathe_dock;
$my_slidenav = $core->blog->settings->themes->breathe_slidenav;
$my_slide1 = $core->blog->settings->themes->breathe_slide1;
$my_slide2 = $core->blog->settings->themes->breathe_slide2;

# Menu type
$breathe_menu_combo = array(
	__('Menu (horizontal)') => 'menuH',
	__('Menu (vertical)') => 'menuV',
	__('SimpleMenu') => 'simplemenu'
);

# Color scheme
$breathe_color_combo = array(
	__('Default') => 'gray'
  //,
	//__('Spring') => 'spring',
//	__('Summer') => 'summer',
//	__('Autumn') => 'autumn',
//	__('Winter') => 'winter'
);

# dock
$breathe_dock_combo = array(
	__('Yes') => 'yesdock',
	__('No') => 'nodock'
);

# slide1
$html_fileslide1 = path::real($core->blog->themes_path).'/'.$core->blog->settings->system->theme.'/tpl/_slide1.html';
$html_contentslide1 = is_file($html_fileslide1) ? file_get_contents($html_fileslide1) : '';

if (!is_file($html_fileslide1) && !is_writable(dirname($html_fileslide1))) {
	throw new Exception(
		sprintf(__('File %s does not exist and directory %s is not writable.'),
		$css_fileslide1,dirname($html_fileslide1))
	);
}

# slide2
$html_fileslide2 = path::real($core->blog->themes_path).'/'.$core->blog->settings->system->theme.'/tpl/_slide2.html';
$html_contentslide2 = is_file($html_fileslide2) ? file_get_contents($html_fileslide2) : '';

if (!is_file($html_fileslide2) && !is_writable(dirname($html_fileslide2))) {
	throw new Exception(
		sprintf(__('File %s does not exist and directory %s is not writable.'),
		$css_fileslide2,dirname($html_fileslide2))
	);
}

# slide on the following pages
$breathe_slidenav_combo = array(
	__('Yes') => 'yesslidenav',
	__('No') => 'noslidenav'
);

// POST ACTIONS

if (!empty($_POST))
{
	try
	{
		$core->blog->settings->addNamespace('themes');

		# Menu type
		if (!empty($_POST['breathe_menu']) && in_array($_POST['breathe_menu'],$breathe_menu_combo))
		{
			$my_menu = $_POST['breathe_menu'];

		} elseif (empty($_POST['breathe_menu']))
		{
			$my_menu = $default_menu;

		}
		$core->blog->settings->themes->put('breathe_menu',$my_menu,'string','Menu to display',true);

		# Color scheme
		if (!empty($_POST['breathe_color']) && in_array($_POST['breathe_color'],$breathe_color_combo))
		{
			$my_color = $_POST['breathe_color'];


		} elseif (empty($_POST['breathe_color']))
		{
			$my_color = $default_color;

		}
		$core->blog->settings->themes->put('breathe_color',$my_color,'string','Color display',true);

		# Dock scheme
		if (!empty($_POST['breathe_dock']) && in_array($_POST['breathe_dock'],$breathe_dock_combo))
		{
			$my_dock = $_POST['breathe_dock'];


		} elseif (empty($_POST['breathe_dock']))
		{
			$my_dock = $default_dock;

		}
		$core->blog->settings->themes->put('breathe_dock',$my_dock,'string','Dock display',true);

		# slide1
		if (!empty($_POST['breathe_slide1']))
		{
			$my_slide1 = $_POST['breathe_slide1'];


		} elseif (empty($_POST['breathe_slide1']))
		{
			$my_slide1 = $default_slide1;

		}
		$core->blog->settings->themes->put('breathe_slide1',$my_slide1,'boolean', 'Display slide1',true);

		if (isset($_POST['slide1']))
		{
			@$fp = fopen($html_fileslide1,'wb');
			fwrite($fp,$_POST['slide1']);
			fclose($fp);
    }

		# slide2
		if (!empty($_POST['breathe_slide2']))
		{
			$my_slide2 = $_POST['breathe_slide2'];


		} elseif (empty($_POST['breathe_slide2']))
		{
			$my_slide2 = $default_slide2;

		}
		$core->blog->settings->themes->put('breathe_slide2',$my_slide2,'boolean', 'Display slide2',true);

		# slide on the following pages
		if (!empty($_POST['breathe_slidenav']) && in_array($_POST['breathe_slidenav'],$breathe_slidenav_combo))
		{
			$my_slidenav = $_POST['breathe_slidenav'];


		} elseif (empty($_POST['breathe_slidenav']))
		{
			$my_slidenav = $default_slidenav;

		}
		$core->blog->settings->themes->put('breathe_slidenav',$my_slidenav,'string','Slidenav display',true);

		if (isset($_POST['slide2']))
		{
			@$fp = fopen($html_fileslide2,'wb');
			fwrite($fp,$_POST['slide2']);
			fclose($fp);
    }

		// Blog refresh
		$core->blog->triggerBlog();

		// Template cache reset
		$core->emptyTemplatesCache();

		dcPage::success(__('Theme configuration has been successfully updated.'),true,true);
	}
	catch (Exception $e)
	{
		$core->error->add($e->getMessage());
	}
}

// DISPLAY

# Menu type
echo
'<div class="fieldset"><h4>'.__('Menu').'</h4>'.
'<p class="field"><label>'.__('Menu to display:').'</label>'.
form::combo('breathe_menu',$breathe_menu_combo,$my_menu).
'</p>'.
'<p class="info">'.__('Plugins menu allowed: <a href="http://forum.dotclear.org/viewtopic.php?id=32705">Adjaya Menu</a> plugin (horizontal and vertical), or SimpleMenu.').'</p>'.
'</div>';

# Color scheme
echo
'<div class="fieldset"><h4>'.__('Colors').'</h4>'.
'<p class="field"><label>'.__('Color display:').'</label>'.
form::combo('breathe_color',$breathe_color_combo,$my_color).
'</p>'.
'</div>';

# Dock scheme
echo
'<div class="fieldset"><h4>'.__('Dock').'</h4>'.
'<p class="field"><label>'.__('Dock display:').'</label>'.
form::combo('breathe_dock',$breathe_dock_combo,$my_dock).
'</p>'.
'</div>';

# slides
echo
'<div class="fieldset"><h4>'.__('Slides').'</h4>'.
'<p class="info">'.__('The slides can display originals images 650px wide x 300px high.<br />They are positioned under the menu bar, the range of tickets will be below and sidebar to the right.<br />It is not possible to simultaneously view two slides in the blog.').'</p>'.
'<p>'.
	form::checkbox('breathe_slide1',1,$my_slide1).
	'<label class="classic" for="breathe_slide1">'.
		__('Slide without Thumbnails').
	'</label>'.
'</p>'.
'<p class="info">'.__('The title and the text (limited to the first 300 characters of the ticket) appears at the bottom of the image on a translucent background with a slide effect.').'</p>';

echo
'<p class="area"><label for="slide1">'.__('Code:').' '.
form::textarea('slide1',60,20,html::escapeHTML($html_contentslide1)).'</label></p>'.

'<p>'.
	form::checkbox('breathe_slide2',1,$my_slide2).
	'<label class="classic" for="breathe_slide2">'.
		__('Slide with Thumbnails').
	'</label>'.
'</p>'.
'<p class="info">'.__('The title and the text (limited to the first 100 characters of the ticket) appears at the bottom of the image on a translucent background. The Tab is as thumbnails.').'</p>';

echo
'<p class="area"><label for="slide2">'.__('Code:').' '.
form::textarea('slide2',60,20,html::escapeHTML($html_contentslide2)).'</label></p>'.
'<p class="info">'.__('By default, the slide is based on the last 4 selected tickets. However, you can use it to display the Notes of a category or tag.<br />For a specific class will be put in place of <code>&lt;tpl:Entries selected="1" lastn="4" ignore_pagination="1" no_context="1"&gt;</code> this <code>&lt;tpl:Entries category="Url-of-the-category" lastn="4" ignore_pagination="1" no_context="1"&gt;</code>.<br />And for a specific tag, this <code>&lt;tpl:Entries tag="Name of the tag" lastn="4" ignore_pagination="1" no_context="1"&gt;</code>.').'</p>';

# slide on the following pages
echo
'<p class="field"><label>'.__('Display on the following pages:').'</label>'.
form::combo('breathe_slidenav',$breathe_slidenav_combo,$my_slidenav).
'</p>'.
'</div>';