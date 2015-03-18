<?php
/* BEGIN LICENSE BLOCK
This file is part of breathe, a theme for Dotclear.

Copyright (c) 2013 - 2015
Pierre Van Glabeke https://github.com/brol/breathe

Licensed under the GPL version 2.0 license.
A copy of this license is available in LICENSE file or at
http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
END LICENSE BLOCK */
	/* date 09-03-2015 */

if (!defined('DC_RC_PATH')) { return; }

$this->registerModule(
	/* Name */			"Breathe",
	/* Description*/		"Thème avec slides, menus et habillages divers",
	/* Author */			"Pierre Van Glabeke",
	/* Version */			'0.2',
	array(
		'type'	 =>	'theme',
		'tplset' => 'mustek'
	)
);