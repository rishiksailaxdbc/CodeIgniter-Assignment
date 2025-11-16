<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {

    protected $table = 'users';

    // constructor
    public function __construct() {
        parent::__construct();
    }

    // get a row by username
    public function get_by_username($username) {
        return $this->db->get_where($this->table, ['username' => $username])->row_array();
    }

    // get a row by email
    public function get_by_email($email) {
        return $this->db->get_where($this->table, ['email' => $email])->row_array();
    }

    // Insert the data and create the new user
    public function create_user($data) {
        return $this->db->insert($this->table, $data);
    }
}