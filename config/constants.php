<?php

return [
    'jazzcash' => [
        'MERCHANT_ID' 	 => env('MERCHANT_ID'),
        'PASSWORD' 		 => env('MERCHANT_PASSWORD'),
		'INTEGERITY_SALT'=> env('INTEGERITY_SALT'),
		'CURRENCY_CODE'  => env('CURRENCY_CODE'),
		'VERSION'		 => env('VERSION'),
		'LANGUAGE'  	 => env('LANGUAGE'),
		'RETURN_URL'  => env('RETURN_URL'),
		'TRANSACTION_POST_URL' => env('TRANSACTION_POST_URL')

    ]
];
