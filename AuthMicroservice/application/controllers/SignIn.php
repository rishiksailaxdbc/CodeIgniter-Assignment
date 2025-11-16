<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// Imports
use \Firebase\JWT\JWT;
use \Firebase\JWT\Key;

class SignIn extends CI_Controller {

    // constructor
    public function __construct() {
        parent::__construct();
        $this->load->model('User_model');
        $this->load->config('jwt');
        header('Content-Type: application/json');
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Methods: POST, GET, OPTIONS');
        header('Access-Control-Allow-Headers: Authorization, Content-Type');
    }

    // function to handle SignIn
    public function index() {
        $input = json_decode(trim(file_get_contents('php://input')), true);

        if (!$input || empty($input['username']) || empty($input['password'])) {
            http_response_code(400);
            echo json_encode([
                'status' => false,
                'message' => 'Username and password are required'
            ]);
            return;
        }

        $username = $input['username'];
        $password = $input['password'];

        // allow login by username
        $user = $this->User_model->get_by_username($username);
        
        // if ussername doesnot exist in database return User not found message
        if (!$user) {
            http_response_code(401);
            echo json_encode(['status' => false, 'message' => 'User not found, Create account first']);
            return;
        }

        // verify password
        if (!password_verify($password, $user['password'])) {
            http_response_code(401);
            echo json_encode(['status' => false, 'message' => 'Invalid credentials, check your username or password']);
            return;
        }

        // generate the JWT token
        $secret = $this->config->item('jwt')['secret_key'];
        $ttl = (int)$this->config->item('jwt')['token_ttl'];
        $issuedAt = time();
        $expire = $issuedAt + $ttl;

        $payload = [
            'iss' => base_url(), 
            'iat' => $issuedAt,
            'exp' => $expire,
            'sub' => $user['id'],
            'username' => $user['username'],
            'email' => $user['email'],
            'role' => $user['role']
        ];

        $jwt = JWT::encode($payload, $secret, 'HS256');

        // send the token back to the request API
        echo json_encode([
            'status' => true,
            'message' => 'Login successful',
            'token' => $jwt,
            'expires_in' => $ttl,
            'user' => [
                'id' => $user['id'],
                'username' => $user['username'],
                'email' => $user['email'],
                'role' => $user['role']
            ]
        ]);
    }

}
