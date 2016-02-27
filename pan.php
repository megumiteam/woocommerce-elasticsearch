<?php
/**
 * Plugin Name: Panpanpan
 * Version: 0.1-alpha
 * Description: PLUGIN DESCRIPTION HERE
 * Author: YOUR NAME HERE
 * Author URI: YOUR SITE HERE
 * Plugin URI: PLUGIN SITE HERE
 * Text Domain: panpanpan
 * Domain Path: /languages
 * @package Panpanpan
 */
 
require_once('src/MegumiTeam/woocommerce-elasticsearch.php');

\MegumiTeam\WooComerceElasticsearch\Loader::get_instance()->init();

