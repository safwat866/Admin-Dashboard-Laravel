<?php
return [
    #PAYMOB
    'PAYMOB_PUBLIC_KEY'=>env('PAYMOB_PUBLIC_KEY'),
    'PAYMOB_SECRET_KEY' => env('PAYMOB_SECRET_KEY'),
    'PAYMOB_INTEGRATION_ID' => env('PAYMOB_INTEGRATION_ID',""), //array of integration ids
    'PAYMOB_CURRENCY'=> env('PAYMOB_CURRENCY',"EGP"),
    'PAYMOB_HMAC' => env('PAYMOB_HMAC', "")
];
