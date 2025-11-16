<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Items extends CI_Controller {

    // constructor
    public function __construct() {
        parent::__construct();
        $this->load->model('Item_model');
        $this->load->library('authorization_token');
    }

    // The function to verfiy the token, refer to authorization_token.php in libraries for more info
    private function auth() {
        $result = $this->authorization_token->validateToken();

        if (!$result['status']) {
            $this->output
                ->set_content_type('application/json')
                ->set_status_header(401)
                ->set_output(json_encode($result));
            exit;
        }

        return $result['data']; 
    }

    // function handle get all items: GET/items
    public function index() {
		$this->auth();   
        $items = $this->Item_model->get_all();
        echo json_encode(['status' => true, 'data' => $items]);
    }

    // function to handle get item through id: GET/items/{id}
    public function view($id) {
        $this->auth();
        $item = $this->Item_model->get_by_id($id);

        if (!$item) {
            echo json_encode(['status' => false, 'message' => 'Item not found']);
            return;
        }

        echo json_encode(['status' => true, 'data' => $item]);
    }

    // function to insert/create a new item POST/items
    public function create() {
        $this->auth();

        $input = json_decode(file_get_contents('php://input'), true);

        $data = [
            'name' => $input['name'],
            'description' => $input['description'],
            'price' => $input['price']
        ];

        $this->Item_model->insert($data);

        echo json_encode(['status' => true, 'message' => 'Item created successfully']);
    }

    // function to update a item using it's id PUT/items/{id}
    public function update($id) {
        $this->auth();

        $input = json_decode(file_get_contents('php://input'), true);

        $this->Item_model->update_item($id, $input);

        echo json_encode(['status' => true, 'message' => 'Item updated']);
    }

    // function to delete a item using it's id DELETE/items/{id}
    public function delete($id) {
        $this->auth();
        $this->Item_model->delete_item($id);
        echo json_encode(['status' => true, 'message' => 'Item deleted']);
    }
}
