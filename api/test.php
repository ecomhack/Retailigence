<?php

require_once 'common_api_include.php';



$app->group('/test', function() use ($app) {

    $app->get('', function() {
        $client = \eLocal::sphereClient();

        // $context = Context::of()->setLanguages(['en'])->setGraceful(true);



        /**
         * create search request
         */
        $search = \Sphere\Core\Request\Products\ProductsSearchRequest::of()->addParam('text.en', 'red');

        $products = $client->execute($search)->toObject();

        foreach ($products as $product) {
            echo $product->getName()->en . '<br/>';
        }

        $test     = new \stdClass();
        $test->MK = 'TM';

        header('Content-type: application/json; charset=utf-8');
        echo json_encode($test);
    });

});
