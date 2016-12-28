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

$core->addBehavior('publicHeadContent','breathePublicHeadContent');

function breathePublicHeadContent($core)
{
    # appel css menu
	$style = $core->blog->settings->themes->breathe_menu;
	if (!preg_match('/^menuH|menuV|simplemenu$/',$style)) {
		$style = 'menuV';
	}

	$theme_url = $core->blog->settings->system->themes_url.'/'.$core->blog->settings->system->theme;
	echo '<link rel="stylesheet" type="text/css" media="screen" href="'.$theme_url."/css/menus/".$style.".css\" />\n";

    # appel css couleur
    $style = $core->blog->settings->themes->breathe_color;
	if (!preg_match('/^gray|spring|summer|autumn|winter$/',$style)) {
		$style = 'gray';
	}

	echo '<link rel="stylesheet" type="text/css" media="screen" href="'.$theme_url."/css/colors/".$style.".css\" />\n";

    # appel css dock
    if ($core->blog->settings->themes->breathe_dock=='yesdock')
    {
        echo '<link rel="stylesheet" type="text/css" media="screen" href="'.$theme_url."/css/dock/dock.css\" />\n";
	    echo '<script type="text/javascript" src="'.$theme_url."/js/dock.js\"></script>\n";
	}

    # appel css slide1/slide2 ou aucun
    # appel css slide on the following pages
    if ($core->blog->settings->themes->breathe_slide!=0)
    {
        if ($core->blog->settings->themes->breathe_slide==1)
        {
            echo '<link rel="stylesheet" type="text/css" media="screen" href="'.$theme_url."/css/slides/slide1.css\" />\n";
            echo '<script type="text/javascript" src="'.$theme_url."/js/s3Slider.js\"></script>\n";
        }
        else
        {
            echo '<link rel="stylesheet" type="text/css" media="screen" href="'.$theme_url."/css/slides/slide2.css\" />\n";
            echo '<script type="text/javascript" src="'.$theme_url."/js/jquery.tools.js\"></script>\n";
        }
	}
}

$core->tpl->addBlock('BreatheIf', array('tplBreathe', 'BreatheIf'));
$core->tpl->addBlock('BreatheIfOnFollowingPages', array('tplBreathe', 'BreatheIfOnFollowingPages'));

class tplBreathe
{
    public static function BreatheIf($attr,$content)
    {
        global $core;

        if (!empty($attr['slide']) && ($attr['slide']==$core->blog->settings->themes->breathe_slide))
        {
            return $content;
		}
        if (!empty($attr['dock'])
            && ((strtolower($attr['dock'])=='yes') || ($attr['dock']==1))
            && ($core->blog->settings->themes->breathe_dock=='yesdock'))
        {
            return $content;
		}
    }

    public static function BreatheIfOnFollowingPages($attr,$content)
    {
        global $core;

        if ($core->url->type=='default-page' && $core->blog->settings->themes->breathe_slidenav=='yesslidenav')
        {
            return $content;
        }

    }
}

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