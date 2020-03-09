<?php
/*
Plugin Name: Student Utility
Plugin URI: https://github.com/BigTows/StudentUtility-wp-plugin
Description: Plugin helps introduce information about student like: Number of student card and students middle name; into WordPress
Author: Alexander @BigTows Chapchuk, Maxim @SphinxKingStone Mishakov
Version: 1.2
Author URI: bigtows.org
License: GPLv3
Requires PHP: 7.3
*/

namespace StudentUtility;

use StudentUtility\Action\StudentFormActions;


const LOCALE_DOMAIN = 'StudentUtility';

require_once 'Component/TemplateManager/TemplateManager.php';
require_once 'Repository/StudentMetaRepositoryWordPressFunctionality.php';
require_once 'Action/StudentFormActions.php';
require_once 'API.php';

add_action('plugins_loaded', '\StudentUtility\start');

function start()
{
    load_plugin_textdomain(LOCALE_DOMAIN, false, dirname(plugin_basename(__FILE__)) . '/language');

    (new StudentFormActions(API::getApiInstance()->getRepository()))->init_actions();
}