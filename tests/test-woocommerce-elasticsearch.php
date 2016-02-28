<?php

class WooCommerceElasticsearchTest extends WP_UnitTestCase {

	private $client;

	public function setUp() {
		parent::setUp();
		
		$param = array();
		$param['endpoint'] = ES_HOST;
		add_option( 'wpels_settings', $param);
		$this->client = MegumiTeam\WooCommerceElasticsearch\Loader::get_instance();
	}

	function test_es_bulk() {

		$this->factory->post->create( array( 
										'post_type' => 'product',
										'post_title' => 'panpanpan',
										'post_content' => 'everyday everywhere panpanpan' )
									);
		$this->factory->post->create( array(
										'post_type' => 'product',
										'post_title' => 'panpan',
										'post_content' => 'everyday everywhere panpan' ) 
									);
		$this->factory->post->create( array( 
										'post_type' => 'product',
										'post_title' => 'es test',
										'post_content' => 'everyday everywhere es test' )
									);

		$_POST['wpels_settings']["endpoint"] = ES_HOST;
		$this->assertEquals( true, $this->client->data_sync() );
	}
}

