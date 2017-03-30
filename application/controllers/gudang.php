<?php

require APPPATH . '/libraries/REST_Controller.php';

class Gudang extends REST_Controller {

    function __construct($config = 'rest') {
        parent::__construct($config);
    }

    // show data gudang
    function index_get() {
        $id_gudang = $this->get('id_gudang');
        if ($id_gudang == '') {
            $gudang = $this->db->get('gudang')->result();
        } else {
            $this->db->where('id_gudang', $id_gudang);
            $gudang = $this->db->get('gudang')->result();
        }
        $this->response($gudang, 200);
    }

        // insert new data to gudang
    function index_post() {
        $data = array(
                    'id_gudang'           => $this->post('id_gudang'),
                    'nama'          => $this->post('nama'),
                    'alamat'        => $this->post('alamat'));
        $insert = $this->db->insert('gudang', $data);
        if ($insert) {
            $this->response($data, 200);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }

    // update data gudang
    function index_put() {
        $id_gudang = $this->put('id_gudang');
        $data = array(
                    'id_gudang'       => $this->put('id_gudang'),
                    'nama'      => $this->put('nama'),
                    'alamat'        => $this->put('alamat'));
        $this->db->where('id_gudang', $id_gudang);
        $update = $this->db->update('gudang', $data);
        if ($update) {
            $this->response($data, 200);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }

    // delete gudang
    function index_delete() {
        $id_gudang = $this->delete('id_gudang');
        $this->db->where('id_gudang', $id_gudang);
        $delete = $this->db->delete('gudang');
        $this->db->where('id_gudang', $id_gudang);
        $delete = $this->db->delete('stok_gudang');
        if ($delete) {
            $this->response(array('status' => 'success'), 201);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }

}