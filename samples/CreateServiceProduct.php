<?php
require dirname(__DIR__) . '/lib/RocketrAPIHandler.class.php';

/**
 * This is an example use of Rocketr's API to create a service product
 */
class CreateServiceProduct {
    
    public static function createServiceProductExample() {
        $product = [
            'title' => 'Service Product RocketrAPI Github example',
            'description' => '<h1>Example description</h1>',
            'price' => 10.99,
            'category' => RocketrProductCategories::ServiceProduct,
            'payment_methods' => [
                RocketrPaymentMethodsShortCodes::STRIPE,
                RocketrPaymentMethodsShortCodes::BITCOIN
            ],
            'show_on_seller_page' => true,
            'allow_fb_sharing' => true,
            'allow_twitter_sharing' => false,
            'allow_pinetrest_sharing' => false,
            'block_blacklist_btc' => RocketrBlacklistMethod::ALLOW_ALL_BUYERS_TO_PURCHASE,
            'block_blacklist_stripe' => RocketrBlacklistMethod::ALLOW_ALL_BUYERS_TO_PURCHASE_EXCEPT_MY_BLACKLIST_AND_PROXIES_AND_VPNS,
        ];
        
        try {
            $rocketrAPIHandler = new RocketrAPIHandler(ROCKETR_API_CLIENT_ID, ROCKETR_API_CLIENT_SECRET);
            $result = $rocketrAPIHandler->createProduct($product);
            $result = json_decode($result, true);
            print_r($result);
            
            echo 'Newly created product link: https://rocketr.net/buy/' . $result['product_identifier'];
        } catch (Exception $e) {
            echo $e->getMessage();
        }

    }
}

CreateServiceProduct::createServiceProductExample();
?>