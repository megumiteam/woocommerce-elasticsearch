<?php

$_tests_dir = getenv( 'WP_TESTS_DIR' );
if ( ! $_tests_dir ) {
	$_tests_dir = '/tmp/wordpress-tests-lib';
}

require_once $_tests_dir . '/includes/functions.php';

function _manually_load_plugin() {
	
	$host = getenv( 'ES_HOST' );
	$host = preg_replace( '/(^https:\/\/|^http:\/\/)/is', '', $host );

var_dump($host);
	if ( empty( $host ) ) {
		$host = 'localhost:9200';
	}
	define( 'ES_HOST', $host );
	
	require dirname( __FILE__ ) . '/../vendor/autoload.php';
	require dirname( dirname( __FILE__ ) ) . '/src/MegumiTeam/WooCommerceElasticsearch/Loader.php';
	
	$tries = 5;
	$sleep = 3;
	do {
		$response = wp_remote_get( esc_url(ES_HOST).':9200' );
var_dump(esc_url(ES_HOST));
var_dump($response);
		if ( 200 == wp_remote_retrieve_response_code( $response ) ) {
			// Looks good!
			break;
		} else {
			printf( "\nInvalid response from ES, sleeping %d seconds and trying again...\n", intval( $sleep ) );
			sleep( $sleep );
		}
	} while ( --$tries );
	if ( 200 != wp_remote_retrieve_response_code( $response ) ) {
		exit( 'Could not connect to Elasticsearch server.' );
	}
}
tests_add_filter( 'muplugins_loaded', '_manually_load_plugin' );

require $_tests_dir . '/includes/bootstrap.php';
