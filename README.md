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
