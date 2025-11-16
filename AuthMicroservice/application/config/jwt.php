<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$config['jwt'] = [
    // JWT secret, this will be stored as environment variables while deploying
    'secret_key' => 'thisIsASecret77255',
    // expiry time in seconds (e.g., 5*3600 = 18000s (5 hours))
    'token_ttl'  => 5*3600
];
