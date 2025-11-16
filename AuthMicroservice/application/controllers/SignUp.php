<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Signup extends CI_Controller {

    // function to handle SignUp
    public function index()
    {
        header('Content-Type: application/json');

        // fecthing data from API and decoding into JSON format
        $input = json_decode(trim($this->input->raw_input_stream), true);

        
        if (!$input) {
            $input = $this->input->post();
        }

        log_message('debug', 'Received data: ' . print_r($input, true));

        // assigning values to variable from API request
        $username = $input['username'] ?? null;
        $email    = $input['email'] ?? null;
        $password = $input['password'] ?? null;
        $role     = $input['role'] ?? null;

        // Validating required fields
        if (!$username || !$email || !$password || !$role) {
            echo json_encode([
                'status' => false,
                'message' => 'username, email, password, and role are required'
            ]);
            exit;
        }

        // Sanitizing
        $username = $this->security->xss_clean($username);
        $email    = $this->security->xss_clean($email);
        $role     = $this->security->xss_clean($role);

        // storing the values to data array
        $data = [
            'username'  => $username,
            'password'  => password_hash($password, PASSWORD_BCRYPT),
            'email'     => $email,
            'role'      => $role,
            'createdAt' => date('Y-m-d H:i:s')
        ];

        

        // Check  for duplicate values
        if ($this->User_model->get_by_username($username)) {
            echo json_encode([
                'status' => false,
                'message' => 'Username already taken'
            ]);
            exit;
        }

        if ($this->User_model->get_by_email($email)) {
            echo json_encode([
                'status' => false,
                'message' => 'Email already registered'
            ]);
            exit;
        }

        // Intersting new user into database
        $inserted = $this->User_model->create_user($data);

        // Returning message along with status to requested API
        if ($inserted) {
            echo json_encode([
                'status' => true,
                'message' => 'User created successfully'
            ]);
        } else {
            echo json_encode([
                'status' => false,
                'message' => 'Failed to create user'
            ]);
        }

        exit;
    }
}
