<?php

require_once 'common_api_include.php';


use Sphere\Core\Model\Product\ProductDraft;


$app->group('/offers', function() use ($app) {

    // get offers by device ID and geo location
    $app->get('/:deviceId/:longitude/:latitude', function($deviceId, $longitude, $latitude) use ($app) {
        $result = array();

        $result[]                        = array();
        $result[0]                       = new \stdClass();
        $result[0]->id                   = 1;
        $result[0]->title                = '10 Kinokarten für 20%';
        $result[0]->description          = new \stdClass();
        $result[0]->description->mime    = 'text/plain';
        $result[0]->description->content = '';
        $result[0]->validUntil           = '1979-09-05T19:00:00';
        $result[0]->location             = new \stdClass();
        $result[0]->location->lat        = 0;
        $result[0]->location->long       = 0;

        $result[]                        = array();
        $result[1]                       = new \stdClass();
        $result[1]->id                   = 2;
        $result[1]->title                = '5 Eiskugeln zum Preis von einer';
        $result[1]->description          = new \stdClass();
        $result[1]->description->mime    = 'text/plain';
        $result[1]->description->content = '';
        $result[1]->validUntil           = '1979-09-23T19:00:00';
        $result[1]->location             = new \stdClass();
        $result[1]->location->lat  =     1;
        $result[1]->location->long =     1;

        header('Content-type: application/json; charset=utf-8');
        echo json_encode($result, JSON_PRETTY_PRINT);
    });

    // post a new offer
    // for a specific customer
    $app->post('/:customerId', function($customerId) use ($app) {
        $config = json_decode($app->request->getBody());
        if (false === $config) {
            $app->stop();
            return;
        }

        //TODO: check customer from sphere.io

        $title = trim($config['title']);
        if (empty($title)) {
            // result: NO TITLE
            return;
        }

        $description = null;
        if (isset($config['description'])) {
            $description = trim($config['description']);
        }

        $latitude = null;
        if (isset($config['latitude'])) {
            $latitude = trim($config['latitude']);
        }

        $longitude = null;
        if (isset($config['longitude'])) {
            $longitude = trim($config['latitude']);
        }

        //TODO: write to sphere.io

        //TODO: push to Google+, Twitter, etc.
    });

    # /offers/:offerId/purchases
    $app->get('/:offerId/purchases', function($offerId) use ($app) {

        //TODO: list purchases for offer
        echo 'List purchases';

    });

    $app->post('/:offerId/purchases/paypal', function($offerId) use ($app) {

        $client = \Retelligence::sphereClient();

        $searchReq = \Sphere\Core\Request\Products\ProductsSearchRequest::of();
        $searchReq->addParam('id', $offerId);

        // read product from SPHERE.IO
        $products = $client->execute($searchReq)->toObject();
        $products->rewind();

        if (!$products->valid()) {
            // offer not found

            $app->notFound();
            return;
        }

        $paypalConf = \Retelligence::conf('paypal');

        $offer = $products->current();

        // read from product
        $amount = 0;

        $purchaseId = sprintf('%s_%s',
                              $offer->getId());

        $returnUrl = 'https://api.example.com/retelligence/paypal/returns?pid=' . urlencode($purchaseId);
        $cancelUrl = 'https://api.example.com/retelligence/paypal/cancellations?pid=' . urlencode($purchaseId);
        $notifyUrl = 'https://api.example.com/retelligence/paypal/notifications?pid=' . urlencode($purchaseId);

        $queryArgs = array(
            'business' => $paypalConf['paypalId'],
            'item_name' => $offer->getName()->de,
            'amount' => $amount,
            'return' => $returnUrl,
            'cancel_return' => $cancelUrl,
            'notify_url' => $notifyUrl,
            'lc' => 'DE',
            'custom' => $purchaseId,
            'currency_code' => 'EUR',
        );

        // build result
        $result = \stdClass();
        $result->paymentUrl = 'https://www.sandbox.paypal.com/cgi-bin/webscr?' .
                              http_build_query($queryArgs);

        header('Content-type: application/json');
        echo json_encode($result);
    });

});
