<?php

require APPPATH . '/libraries/REST_Controller.php';

class Stok_outlet extends REST_Controller {

    function __construct($config = 'rest') {
        parent::__construct($config);
    }

    // show data stok_outlet
    function index_get() {
        $id_stok_outlet = $this->get('id_stok_outlet');
        $user_id = $this->get('user_id');
        if ($id_stok_outlet == '' AND $user_id == '') {
            $stok_outlet = $this->db->query('SELECT * FROM `stok_outlet` INNER JOIN `sepatu` ON `stok_outlet`.`id_sepatu` = `sepatu`.`id_sepatu`')->result();
        }elseif ($user_id != '') {
            $stok_outlet = $this->db->query('SELECT * FROM `stok_outlet` INNER JOIN `sepatu` ON `stok_outlet`.`id_sepatu` = `sepatu`.`id_sepatu` WHERE `stok_outlet`.`user_id` = '."'".$user_id."'")->result();
        } else {            
            $this->db->where('id_stok_outlet', $id_stok_outlet);
            $stok_outlet = $this->db->get('stok_outlet')->result();
        }
        $this->response($stok_outlet, 200);
    }

    // insert new data to stok_outlet
    function index_post() {
        $this->db->where('id_sepatu', $this->post('id_sepatu'));
        $this->db->where('ukuran', $this->post('ukuran'));
        $stok_outlet = $this->db->get('stok_outlet')->result();
        if ($stok_outlet) {
            foreach ($stok_outlet as $m) {
                $id_stok_outlet=$m->id_stok_outlet;
                $id_sepatu=$m->id_sepatu;
                $user_id=$m->user_id;
                $stok=$m->stok + $this->post('jml');
                $ukuran=$m->ukuran;
            }
            $data = array(
                        'id_stok_outlet'           => $id_stok_outlet,
                        'user_id'          => $user_id,
                        'id_sepatu'        => $id_sepatu,
                        'ukuran'          => $ukuran,
                        'stok'        => $stok);
            $this->db->where('id_stok_outlet', $id_stok_outlet);
            $insert = $this->db->update('stok_outlet', $data);
            if ($insert) {
                $this->response($data, 200);
            } else {
                $this->response(array('status' => 'fail', 502));
            }
        }else{
            $data = array(
                        'id_stok_outlet'           => $this->post('id_stok_outlet'),
                        'user_id'          => $this->post('user_id'),
                        'id_sepatu'          => $this->post('id_sepatu'),
                        'ukuran'          => $this->post('ukuran'),
                        'stok'        => $this->post('jml'));
            $insert = $this->db->insert('stok_outlet', $data);
            if ($insert) {
                $this->response($data, 200);
            } else {
                $this->response(array('status' => 'fail', 502));
            }
        }
    }

    // update data stok_outlet
    function index_put() {
        $id_stok_outlet = $this->put('id_stok_outlet');
        $data = array(
                    'id_stok_outlet'       => $this->put('id_stok_outlet'),
                    'user_id'      => $this->put('user_id'),
                    'id_sepatu'      => $this->put('id_sepatu'),
                    'ukuran'      => $this->put('ukuran'),
                    'stok'        => $this->put('stok'));
        $this->db->where('id_stok_outlet', $id_stok_outlet);
        $update = $this->db->update('stok_outlet', $data);
        if ($update) {
            $this->response($data, 200);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }

    // delete stok_outlet
    function index_delete() {
        $id_stok_outlet = $this->delete('id_stok_outlet');
        $this->db->where('id_stok_outlet', $id_stok_outlet);
        $delete = $this->db->delete('stok_outlet');
        if ($delete) {
            $this->response(array('status' => 'success'), 201);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }

}