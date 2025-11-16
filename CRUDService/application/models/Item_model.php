<?php
class Item_model extends CI_Model {

    // get all items
    public function get_all() {
        return $this->db->get('items')->result();
    }

    //get item through id
    public function get_by_id($id) {
        return $this->db->get_where('items', ['id' => $id])->row();
    }

    //insert a new item
    public function insert($data) {
        return $this->db->insert('items', $data);
    }

    //update a item through id
    public function update_item($id, $data) {
        return $this->db->update('items', $data, ['id' => $id]);
    }

    //delete a item through id
    public function delete_item($id) {
        return $this->db->delete('items', ['id' => $id]);
    }

}