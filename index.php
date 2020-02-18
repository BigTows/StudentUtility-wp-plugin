<?php
/*
Plugin Name: Student Utility
Plugin URI: https://github.com/BigTows/StudentUtility-wp-plugin
Description: Plugin helps introduce information about student like: Number of student card; into WordPress
Author: Alexander @BigTows Chapchuk, Maxim @SphinxKingStone Mishakov
Version: 1.0
Author URI: bigtows.org
*/

namespace StudentUtility;

use StudentUtility\Action\StudentFormActions;
use StudentUtility\Repository\StudentMetaRepositoryInterfaceWordPressFunctionality;


const LOCALE_DOMAIN = 'StudentUtility';

require_once 'Component/TemplateManager/TemplateManager.php';
require_once 'Repository/StudentMetaRepositoryInterfaceWordPressFunctionality.php';
require_once 'Action/StudentFormActions.php';
add_action('plugins_loaded', '\StudentUtility\start');

function start()
{
    load_plugin_textdomain(LOCALE_DOMAIN, false, dirname(plugin_basename(__FILE__)) . '/language');
    $repository = new StudentMetaRepositoryInterfaceWordPressFunctionality();

    (new StudentFormActions($repository))->init_actions();
}