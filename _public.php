<?php
/* BEGIN LICENSE BLOCK
This file is part of breathe, a theme for Dotclear.

Copyright (c) 2013 - 2015
Pierre Van Glabeke https://github.com/brol/breathe

Licensed under the Creative Commons version 4.0 license.
A copy of this license is available in LICENSE file or at
http://creativecommons.org/licenses/by-nc-sa/4.0/deed.fr
END LICENSE BLOCK */

if (!defined('DC_RC_PATH')) { return; }

l10n::set(dirname(__FILE__).'/locales/'.$_lang.'/public');

# appel css menu
$core->addBehavior('publicHeadContent','breathemenu_publicHeadContent');

function breathemenu_publicHeadContent($core)
{
	$style = $core->blog->settings->themes->breathe_menu;
	if (!preg_match('/^menuH|menuV|simplemenu$/',$style)) {
		$style = 'menuV';
	}

	$url = $core->blog->settings->themes_url.'/'.$core->blog->settings->theme;
	echo '<link rel="stylesheet" type="text/css" media="projection, screen" href="'.$url."/css/menus/".$style.".css\" />\n";
}

# appel css couleur
$core->addBehavior('publicHeadContent','breathecolor_publicHeadContent');

function breathecolor_publicHeadContent($core)
{
	$style = $core->blog->settings->themes->breathe_color;
	if (!preg_match('/^gray|spring|summer|autumn|winter$/',$style)) {
		$style = 'gray';
	}

	$url = $core->blog->settings->themes_url.'/'.$core->blog->settings->theme;
	echo '<link rel="stylesheet" type="text/css" media="screen" href="'.$url."/css/colors/".$style.".css\" />\n";
}

# appel css dock
$core->addBehavior('publicHeadContent','breathedock_publicHeadContent');

function breathedock_publicHeadContent($core)
{
	$style = $core->blog->settings->themes->breathe_dock;
	if (!preg_match('/^yesdock|nodock$/',$style)) {
		$style = 'yesdock';
	}

	$url = $core->blog->settings->themes_url.'/'.$core->blog->settings->theme;
	echo '<link rel="stylesheet" type="text/css" media="screen" href="'.$url."/css/dock/".$style.".css\" />\n";
	echo '<script type="text/javascript" src="'.$url."/js/dock.js\"></script>\n";
}

# appel css slide1
if ($core->blog->settings->themes->breathe_slide1)
{
	$core->addBehavior('publicHeadContent',
		array('tplBreathe_slide1','publicHeadContent'));
}

class tplBreathe_slide1
{
	public static function publicHeadContent($core)
	{
	$url = $core->blog->settings->themes_url.'/'.$core->blog->settings->theme;
	echo '<link rel="stylesheet" type="text/css" media="screen" href="'.$url."/css/slides/slide1.css\" />\n";
	echo '<script type="text/javascript" src="'.$url."/js/s3Slider.js\"></script>\n";
	}
}

# appel css slide2
if ($core->blog->settings->themes->breathe_slide2)
{
	$core->addBehavior('publicHeadContent',
		array('tplBreathe_slide2','publicHeadContent'));
}

class tplBreathe_slide2
{
	public static function publicHeadContent($core)
	{
	$url = $core->blog->settings->themes_url.'/'.$core->blog->settings->theme;
	echo '<link rel="stylesheet" type="text/css" media="screen" href="'.$url."/css/slides/slide2.css\" />\n";
	echo '<script type="text/javascript" src="'.$url."/js/jquery.tools.js\"></script>\n";
	}
}

# appel css slide on the following pages
$core->addBehavior('publicHeadContent','breatheslidenav_publicHeadContent');

function breatheslidenav_publicHeadContent($core)
{
	$style = $core->blog->settings->themes->breathe_slidenav;
	if (!preg_match('/^yesslidenav|noslidenav$/',$style)) {
		$style = 'yesslidenav';
	}

	$url = $core->blog->settings->themes_url.'/'.$core->blog->settings->theme;
	echo '<link rel="stylesheet" type="text/css" media="screen" href="'.$url."/css/slides/".$style.".css\" />\n";
}

# exclure billet current
$core->addBehavior('templateBeforeBlock',array('behaviorsExcludeCurrentPost','templateBeforeBlock'));

class behaviorsExcludeCurrentPost
{
	public static function templateBeforeBlock($core,$b,$attr)
	{
	  if ($b == 'Entries' && isset($attr['exclude_current']) && $attr['exclude_current'] == 1)
	  {
		return
		"<?php\n".
		'$params["sql"] = "AND P.post_url != \'".$_ctx->posts->post_url."\' ";'."\n".
		"?>\n";
	  }
	}
}

# gravatar
$core->tpl->addValue('gravatar', array('gravatar', 'tplGravatar'));

class gravatar {

  const
    URLBASE = 'http://www.gravatar.com/avatar.php?gravatar_id=%s&amp;default=%s&amp;size=%d',
    HTMLTAG = '<img src="%s" class="%s" alt="%s" />',
    DEFAULT_SIZE = '40',
    DEFAULT_CLASS = 'gravatar_img',
    DEFAULT_ALT = 'Gravatar de %s';

  public static function tplGravatar($attr)
  {
    $md5mail = '\'.md5(strtolower($_ctx->comments->getEmail(false))).\'';
    $size    = array_key_exists('size',   $attr) ? $attr['size']   : self::DEFAULT_SIZE;
    $class   = array_key_exists('class',  $attr) ? $attr['class']  : self::DEFAULT_CLASS;
    $alttxt  = array_key_exists('alt',    $attr) ? $attr['alt']    : self::DEFAULT_ALT;
    $altimg  = array_key_exists('altimg', $attr) ? $attr['altimg'] : '';
    $gurl    = sprintf(self::URLBASE,
                       $md5mail, urlencode($altimg), $size);
    $gtag    = sprintf(self::HTMLTAG,
                       $gurl, $class, preg_match("/%s/i", $alttxt) ?
                                      sprintf($alttxt, '\'.$_ctx->comments->comment_author.\'') : $alttxt);
    return '<?php echo \'' . $gtag . '\'; ?>';
  }
}
