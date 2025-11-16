<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$config['jwt_key'] = 'thisIsASecret77255';
$config['jwt_algorithm'] = 'HS256';
$config['token_ttl'] = 5*3600;             // This make the token to live for 7 hours
