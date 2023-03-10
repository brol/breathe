<?php
/* BEGIN LICENSE BLOCK
This file is part of breathe, a theme for Dotclear.

Copyright (c) 2013 - 2016
Pierre Van Glabeke https://github.com/brol/breathe

Licensed under the Creative Commons version 4.0 license.
A copy of this license is available in LICENSE file or at
http://creativecommons.org/licenses/by-nc-sa/4.0/deed.fr
END LICENSE BLOCK */

if (!defined('DC_RC_PATH')) { return; }

l10n::set(dirname(__FILE__) . '/locales/' . dcCore::app()->lang. '/public');

dcCore::app()->addBehavior('publicHeadContent','breathePublicHeadContent');

function breathePublicHeadContent()
{
    # appel css menu
	$style = dcCore::app()->blog->settings->themes->breathe_menu;
	if (!preg_match('/^menuH|menuV|simplemenu$/', (string) $style)) {
		$style = 'menuV';
	}

	$theme_url = dcCore::app()->blog->settings->system->themes_url.'/'.dcCore::app()->blog->settings->system->theme;
	echo '<link rel="stylesheet" type="text/css" media="projection, screen" href="'.$theme_url."/css/menus/".$style.".css\" />\n";

    # appel css couleur
    $style = dcCore::app()->blog->settings->themes->breathe_color;
	if (!preg_match('/^gray|spring|summer|autumn|winter$/', (string) $style)) {
		$style = 'gray';
	}

	echo '<link rel="stylesheet" type="text/css" media="screen" href="'.$theme_url."/css/colors/".$style.".css\" />\n";

    # appel css dock
    if (dcCore::app()->blog->settings->themes->breathe_dock=='yesdock')
    {
        echo '<link rel="stylesheet" type="text/css" media="screen" href="'.$theme_url."/css/dock/dock.css\" />\n";
	    echo '<script type="text/javascript" src="'.$theme_url."/js/dock.js\"></script>\n";
	}

    # appel css slide1/slide2 ou aucun
    # appel css slide on the following pages
    if (dcCore::app()->blog->settings->themes->breathe_slide!=0)
    {
        if (dcCore::app()->blog->settings->themes->breathe_slide==1)
        {
            echo '<link rel="stylesheet" type="text/css" media="screen" href="'.$theme_url."/css/slides/slide1.css\" />\n";
           // echo '<script type="text/javascript" src="'.$theme_url."/js/s3Slider.js\"></script>\n";
        }
        else
        {
            echo '<link rel="stylesheet" type="text/css" media="screen" href="'.$theme_url."/css/slides/slide2.css\" />\n";
          //  echo '<script type="text/javascript" src="'.$theme_url."/js/1.11.3/jquery.js\"></script>\n";
            echo '<script type="text/javascript" src="'.$theme_url."/js/jquery.tools.js\"></script>\n";
        }
	}
}

dcCore::app()->tpl->addBlock('BreatheIf', array('tplBreathe', 'BreatheIf'));
dcCore::app()->tpl->addBlock('BreatheIfOnFollowingPages', array('tplBreathe', 'BreatheIfOnFollowingPages'));

class tplBreathe
{
    public static function BreatheIf($attr,$content)
    {
        if (!empty($attr['slide']) && ($attr['slide']==dcCore::app()->blog->settings->themes->breathe_slide))
        {
            return $content;
		}
        if (!empty($attr['dock'])
            && ((strtolower($attr['dock'])=='yes') || ($attr['dock']==1))
            && (dcCore::app()->blog->settings->themes->breathe_dock=='yesdock'))
        {
            return $content;
		}
    }

    public static function BreatheIfOnFollowingPages($attr,$content)
    {
        if (dcCore::app()->url->type=='default-page' && dcCore::app()->blog->settings->themes->breathe_slidenav=='yesslidenav')
        {
            return $content;
        }

    }
}

# Exclude Current Post
# Source: http://tips.dotaddict.org/
dcCore::app()->addBehavior('templateBeforeBlockV2', ['behaviorsExcludeCurrentPost','templateBeforeBlock']);

class behaviorsExcludeCurrentPost
{
    public static function templateBeforeBlock(string $block, ArrayObject $attr): string
    {
        if ($block == 'Entries' && isset($attr['exclude_current']) && $attr['exclude_current'] == 1) {
            return
            "<?php\n" .
            "if (!isset(\$params)) { \$params = []; }\n" .
            "if (!isset(\$params['sql'])) { \$params['sql'] = ''; }\n" .
            '$params["sql"] .= "AND P.post_url != \'".dcCore::app()->ctx->posts->post_url."\' ";' . "\n" .
            "?>\n";
        }

        return '';
    }
}