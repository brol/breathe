<?php
/* BEGIN LICENSE BLOCK
This file is part of breathe, a theme for Dotclear.

Copyright (c) 2010
Pierre Van Glabeke contact@brol.info

Licensed under the GPL version 2.0 license.
A copy of this license is available in LICENSE file or at
http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
END LICENSE BLOCK */

if (!defined('DC_CONTEXT_ADMIN')) { return; }

// chargement de la traduction
l10n::set(dirname(__FILE__).'/locales/'.$_lang.'/main');

$need_update = false;

// Initialisation
// styles pour le menu
$breathemenu_styles = array(
	"Horizontal" => 'menuH',
	"Vertical" => 'menuV'
);

// style pour l'affichage des saisons
$breathestyle_styles = array(
	__('Default') => 'gray',
	__('Spring') => 'spring',
	__('Summer') => 'summer',
	__('Autumn') => 'autumn',
	__('Winter') => 'winter'
);


// affichage du dock
$breathedock_styles = array(
	__('Yes') => 'dock',
	__('No') => 'nodock'
);


// Traitement à l'enregistrement
// menu
if (!$core->blog->settings->themes->breathemenu_style) {
	$core->blog->settings->themes->breathemenu_style = 'menuH';
}

if (!empty($_POST['breathemenu_style']) && in_array($_POST['breathemenu_style'],$breathemenu_styles))
{
	$core->blog->settings->themes->breathemenu_style = $_POST['breathemenu_style'];
	$core->blog->settings->addNamespace('themes');
	$core->blog->settings->themes->put('breathemenu_style',$core->blog->settings->themes->breathemenu_style,'string','Menu',true);
	$need_update = true;
}

// saisons
if (!$core->blog->settings->themes->breathestyle_style) {
	$core->blog->settings->themes->breathestyle_style = 'gray';
}

if (!empty($_POST['breathestyle_style']) && in_array($_POST['breathestyle_style'],$breathestyle_styles))
{
	$core->blog->settings->themes->breathestyle_style = $_POST['breathestyle_style'];
	$core->blog->settings->addNamespace('themes');
	$core->blog->settings->themes->put('breathestyle_style',$core->blog->settings->themes->breathestyle_style,'string','Season',true);
	$need_update = true;
}


// dock
if (!$core->blog->settings->themes->breathedock_style) {
	$core->blog->settings->themes->breathedock_style = 'dock';
}

if (!empty($_POST['breathedock_style']) && in_array($_POST['breathedock_style'],$breathedock_styles))
{
	$core->blog->settings->themes->breathedock_style = $_POST['breathedock_style'];
	$core->blog->settings->addNamespace('themes');
	$core->blog->settings->themes->put('breathedock_style',$core->blog->settings->themes->breathedock_style,'string','Dock',true);
	$need_update = true;
}

// message succès
if ($need_update) {
   $core->blog->triggerBlog();
   dcPage::success(__('Theme configuration has been successfully updated.'));
}

// affichage dans l'admin
echo
'<div class="fieldset"><h4>'.__('Personalizations').'</h4>'.
'<p class="field"><label>'.__('Type of menu:').'</label>'.
form::combo('breathemenu_style',$breathemenu_styles,$core->blog->settings->themes->breathemenu_style).
'</p>'.


'<p class="field"><label>'.__('Season:').'</label>'.
form::combo('breathestyle_style',$breathestyle_styles,$core->blog->settings->themes->breathestyle_style).
'</p>'.


'<p class="field"><label>'.__('Display dock:').'</label>'.
form::combo('breathedock_style',$breathedock_styles,$core->blog->settings->themes->breathedock_style).
'</p>'.
'</div>';
