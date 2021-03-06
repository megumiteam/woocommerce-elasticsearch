[![Build Status](https://travis-ci.org/megumiteam/woocommerce-elasticsearch.svg?branch=master)](https://travis-ci.org/megumiteam/woocommerce-elasticsearch)

# WooCommerce Elasticsearch
WooCommerce search replace Elasticsearch.

## How to use
### Install
Install this libary in your theme or plugin via Composer.
To do so, you need write `commposer.json` like below.

    {
      "require": {
        "megumiteam/woocommerce-elasticsearch": "dev-master"
      }
    }

### Load library
In your entry point( theme's functions.php or plugin's base file), initialize library.

    require_once dirname( __FILE__ ) . '/vendor/autoload.php';
    MegumiTeam\WooCommerceElasticsearch\Loader::get_instance()->init();
    
    //get Elasticsearch client
    MegumiTeam\WooCommerceElasticsearch\Loader::get_instance()->client;
    
    //get type
    MegumiTeam\WooCommerceElasticsearch\Loader::get_instance()->type;
    
    //get index
    MegumiTeam\WooCommerceElasticsearch\Loader::get_instance()->index;
    
    

### PHPUnit
    ES_HOST=‘example.com’ ES_PORT=‘9200’ phpunit
    
### WP-CLI
    wp elasticsearch setup --host=example.com --port=9200
