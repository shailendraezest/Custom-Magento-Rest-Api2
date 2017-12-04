<?php
/**
* Example of simple product POST using Admin account via Magento REST API. OAuth authorization is used
*/
$apiUrl = 'http://localhost.abbott.de/api/rest';
$consumerKey = 'd3966b78327c8b80e206368626480d04';
$consumerSecret = '7959e561f38dd21648e4bab62a395da5';
$token="dcca2bc8c5b2f2feefa745d1bfae2dd5";
$secret="f91bccc12af4659c1cbaefbf09d12813";


try {
    //$oauthClient = new OAuth($consumerKey, $consumerSecret, OAUTH_SIG_METHOD_HMACSHA1, $authType);
    $oauthClient = new OAuth($consumerKey, $consumerSecret);
    $oauthClient->enableDebug();
        //$requestToken = $oauthClient->getRequestToken($temporaryCredentialsRequestUrl);
        $oauthClient->setToken($token, $secret);
        //$resourceUrl = "$apiUrl/products/4";
        //create customer
        $resourceUrl = "$apiUrl/de_DE/customer/14033/shi/list";
        // $resourceUrl="$apiUrl/de_DE/customer/14032/cart/add/";
        //$resourceUrl="$apiUrl/de_DE/guest/0/cart/add";
        //$resourceUrl="$apiUrl/de_DE/checkout/address/setbilling";
         //$resourceUrl="$apiUrl/de_DE/checkout/address/setshipping";
        //$resourceUrl="$apiUrl/de_DE/checkout/payment";
        //$resourceUrl="$apiUrl/de_DE/checkout/order/generate";
        //$resourceUrl="$apiUrl/de_DE/checkout/order/create";

        $productData = json_encode(
            array(
            'type_id'           => 'simple',
            'attribute_set_id'  => 4,
            'sku'               => 'simple' . uniqid(),
            'weight'            => 1,
            'status'            => 1,
            'visibility'        => 4,
            'name'              => 'Simple Product',
            'description'       => 'Simple Description',
            'short_description' => 'Simple Short Description',
            'price'             => 99.95,
            'tax_class_id'      => 0,
        ));
        $customerData=json_encode(
            array("firstname"=>'Test',
            "lastname"=>'Rest Api',
            "email"=>'test@gmail.com',
            "password"=>'123456'
        ));
        

        
        $headers = array('Content-Type' => 'application/json','accept'=>'*/*');
        //$oauthClient->fetch($resourceUrl, $customerData, OAUTH_HTTP_METHOD_POST, $headers);
        // below for add to cart 
        /* $product=array();
        $product['sku']='71538-01';
        $product['qty']=10;    */

        //below for set billing
       /* $data=array();
        $data['customer_billing_address_id']='16421';
        $data['quote_id']='89206'; */

        ////below for set shipping
        /*$data['customer_shipping_address_id']='16421';
        $data['quote_id']='89206';
        $data['shipping_method']='freeshipping_freeshipping';*/

        // below for set payment method
        /*$data['quote_id']='89206';
        $data['payment_method']='payon_invoice';*/

        //below for generate order

        $data['quote_id']='89206';


        $oauthClient->fetch($resourceUrl, array(), 'GET', array('Content-Type' => 'application/json', 'Accept' => '*/*'));
        $productsList = json_decode($oauthClient->getLastResponse());
        echo '<pre>';
        print_r($productsList);
        //echo 'heloo';
    }
 catch (OAuthException $e) {
    //echo '<pre>';
    echo $e->getMessage();
    print_r($e->lastResponse);
}