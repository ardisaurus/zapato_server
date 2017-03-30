<?php

require APPPATH . '/libraries/REST_Controller.php';

class Pass_management extends REST_Controller {

    function __construct($config = 'rest') {
        parent::__construct($config);
    }

    // show data user
    function index_get() {
        $user_id = $this->get('user_id');
        if ($user_id == '') {
            $user = $this->db->get('user')->result();
        } else {
            $this->db->where('user_id', $user_id);
            $user = $this->db->get('user')->result();
        }
        $this->response($user, 200);
    }

    // update data user
    function index_put() {
        $user_id = $this->put('user_id');
        $data = array('password'=> $this->put('user_id'));
        $this->db->where('user_id', $user_id);
        $update = $this->db->update('user', $data);
        if ($update) {
            $this->response($data, 200);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }

}