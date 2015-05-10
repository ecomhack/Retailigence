<?php

$app->group('/paypal', function() use ($app) {

    // return URL
    $app->get('/returns', function() {
        // payment complete
    });

    // cancel URL
    $app->get('/cancellations', function() {
        // payment was cancelled
    });

    // notify URL
    $app->get('/notifications', function() {
        // receive IPN
    });

});
