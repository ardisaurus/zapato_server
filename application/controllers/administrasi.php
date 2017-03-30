<?php

require APPPATH . '/libraries/REST_Controller.php';

class Administrasi extends REST_Controller {

    function __construct($config = 'rest') {
        parent::__construct($config);
    }

    // show data user
    function index_get() {
        $user_id = $this->get('user_id');
        if ($user_id == '') {            
            $this->db->order_by("level", "asc");
            $user = $this->db->get('user')->result();
        } else {
            $this->db->where('user_id', $user_id);
            $user = $this->db->get('user')->result();
        }
        $this->response($user, 200);
    }

    // insert new data to user
    function index_post() {
        $data = array(
                    'user_id'           => $this->post('user_id'),
                    'nama'          => $this->post('nama'),
                    'password'    => $this->post('password'),
                    'level'          => $this->post('level'),
                    'telepon'        => $this->post('telepon'),
                    'alamat'          => $this->post('alamat'));
        $insert = $this->db->insert('user', $data);
        if ($insert) {
            $this->response($data, 200);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }

    // update data user
    function index_put() {
        $user_id = $this->put('user_id');
        $data = array(
                    'user_id'      => $this->put('id_baru'),
                    'nama'      => $this->put('nama'),
                    'password'=> $this->put('password'),                    
                    'alamat'    => $this->put('alamat'), 
                    'telepon'        => $this->put('telepon'));
        $this->db->where('user_id', $user_id);
        $update = $this->db->update('user', $data);
        if ($update) {
            $this->response($data, 200);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }

    // delete user
    function index_delete() {
        $user_id = $this->delete('user_id');
        $this->db->where('user_id', $user_id);
        $delete = $this->db->delete('user');
        if ($delete) {
            $this->response(array('status' => 'success'), 201);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }

}