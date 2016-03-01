<?php

use MegumiTeam\WooCommerceElasticsearch\Loader;

if ( defined('WP_CLI') && WP_CLI ) {

class WooCommerceElasticsearch_WP_CLI_Command extends WP_CLI_Command {
	/**
     * Setup Elasticsearch.
     *
     * ## OPTIONS
     *
     * [--host=<url>]
     * : The name of the person to greet.
     *
     * [--port=<number>]
     * : Accepted values: csv, json. Default: csv
     *
     * ## EXAMPLES
     *
     *   wp elasticsearch setup --host=example.com --port=9200
     *
     * @subcommand setup
     */
    function setup($args, $assoc_args) {

    	$param = array();
    	$param['endpoint'] = preg_replace( '/(^https:\/\/|^http:\/\/)/is', '', $assoc_args['host'] );
		$param['port']     = $assoc_args['port'];
		
		$tries = 5;
		$sleep = 3;
		do {
			$response = wp_remote_get( esc_url($assoc_args['host']).':'. $assoc_args['port'] );
			if ( 200 == wp_remote_retrieve_response_code( $response ) ) {
				// Looks good!
				break;
			} else {
				WP_CLI::log( "\nInvalid response from ES, sleeping {$sleep} seconds and trying again...\n" );
				sleep( $sleep );
			}
		} while ( --$tries );
		if ( 200 != wp_remote_retrieve_response_code( $response ) ) {
			WP_CLI::error( 'Could not connect to Elasticsearch server.' );
			exit;
		}

		update_option( 'wpels_settings', $param);
		
		try {
			if ( !\MegumiTeam\WooCommerceElasticsearch\Loader::get_instance()->data_sync() ) {
				WP_CLI::error('Elasticsearch built index failed.');
			}
		} catch(Exception $e) {
			WP_CLI::error($e->getMessage());
			exit;
		}
		
        WP_CLI::success( "Elasticsearch built index completed." );
        
    }
}
\WP_CLI::add_command( 'elasticsearch', 'WooCommerceElasticsearch_WP_CLI_Command' );
}