<?php 
/*
Plugin Name: lololo
Plugin URI: http://digitalcube.jp
Description: lolo
Author: Digitalcube
Version: 1.0
Author URI: http://digitalcube.jp
*/

require_once('src/MegumiTeam/WooCommerceElasticsearch/Loader.php');
MegumiTeam\WooCommerceElasticsearch\Loader::get_instance()->init();
