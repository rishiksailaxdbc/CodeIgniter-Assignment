<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class Authorization_Token {

    protected $CI;

    // constructor
    public function __construct() {
        $this->CI =& get_instance();
        $this->CI->load->config('jwt');
    }


    // core function to validate the token
    public function validateToken() {
        $headers = apache_request_headers();
        
        // validations
        if (!isset($headers['Authorization'])) {
            return ['status' => false, 'message' => 'Authorization header missing'];
        }

        $token = explode(" ", $headers['Authorization'])[1] ?? null;

        if (!$token) {
            return ['status' => false, 'message' => 'Token not found'];
        }

        // decoding the token and returning the response accordingly
        try {
            $decoded = JWT::decode(
                $token,
                new Key($this->CI->config->item('jwt_key'), 'HS256')
            );

            return [
                'status' => true,
                'data' => (array) $decoded
            ];

        } catch (Exception $e) {
            return [
                'status' => false,
                'message' => 'Invalid token: ' . $e->getMessage()
            ];
        }
    }
}
