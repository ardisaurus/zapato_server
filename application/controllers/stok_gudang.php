<?php

require APPPATH . '/libraries/REST_Controller.php';

class Stok_gudang extends REST_Controller {

    function __construct($config = 'rest') {
        parent::__construct($config);
    }

    // show data stok_gudang
    function index_get() {
        $id_stok_gudang = $this->get('id_stok_gudang');
        $id_gudang = $this->get('id_gudang');        
        $id_sepatu = $this->get('id_sepatu');
        if ($id_stok_gudang == '' AND $id_gudang != '' AND $id_sepatu=='') {
            $stok_gudang = $this->db->query('SELECT * FROM `stok_gudang` INNER JOIN `gudang` INNER JOIN `sepatu` ON `stok_gudang`.`id_gudang` = `gudang`.`id_gudang` AND `stok_gudang`.`id_sepatu` = `sepatu`.`id_sepatu` WHERE `stok_gudang`.`id_gudang` = '. $id_gudang)->result();
        }elseif($id_sepatu!='' AND $id_gudang!=''){
            $this->db->where('id_sepatu', $id_sepatu);
            $this->db->where('id_gudang', $id_gudang);
            $stok_gudang = $this->db->get('stok_gudang')->result();
        }elseif($id_sepatu!=''){
            $this->db->where('id_sepatu', $id_sepatu);
            $stok_gudang = $this->db->get('stok_gudang')->result();
        } else {
            $this->db->where('id_stok_gudang', $id_stok_gudang);
            $stok_gudang = $this->db->get('stok_gudang')->result();
        }
        $this->response($stok_gudang, 200);
    }

        // insert new data to stok_gudang
    function index_post() {
        $this->db->where('id_sepatu', $this->post('id_sepatu'));
        $this->db->where('ukuran', $this->post('ukuran'));
        $stok_gudang = $this->db->get('stok_gudang')->result();
        if ($stok_gudang) {
            foreach ($stok_gudang as $m) {
                $id_stok_gudang=$m->id_stok_gudang;
                $id_sepatu=$m->id_sepatu;
                $id_gudang=$m->id_gudang;
                $stok=$m->stok + $this->post('stok');
                $ukuran=$m->ukuran;
            }
            $data = array(
                        'id_stok_gudang'           => $id_stok_gudang,
                        'id_gudang'          => $id_gudang,
                        'id_sepatu'        => $id_sepatu,
                        'ukuran'          => $ukuran,
                        'stok'        => $stok);
            $this->db->where('id_stok_gudang', $id_stok_gudang);
            $insert = $this->db->update('stok_gudang', $data);
            if ($insert) {
                $this->response($data, 200);
            } else {
                $this->response(array('status' => 'fail', 502));
            }
        }else{
            $data = array(
                    'id_stok_gudang'           => $this->post('id_stok_gudang'),
                    'id_gudang'          => $this->post('id_gudang'),
                    'id_sepatu'        => $this->post('id_sepatu'),
                    'ukuran'          => $this->post('ukuran'),
                    'stok'        => $this->post('stok'));
            $insert = $this->db->insert('stok_gudang', $data);
            if ($insert) {
                $this->response($data, 200);
            } else {
                $this->response(array('status' => 'fail', 502));
            }
        }       
    }

    // update data stok_gudang
    function index_put() {
        $id_stok_gudang = $this->put('id_stok_gudang');
        $data = array(
                    'id_stok_gudang'       => $this->put('id_stok_gudang'),
                    'id_gudang'      => $this->put('id_gudang'),
                    'id_sepatu'        => $this->put('id_sepatu'),
                    'ukuran'      => $this->put('ukuran'),
                    'stok'        => $this->put('stok'));
        $this->db->where('id_stok_gudang', $id_stok_gudang);
        $update = $this->db->update('stok_gudang', $data);
        if ($update) {
            $this->response($data, 200);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }

    // delete stok_gudang
    function index_delete() {
        $id_stok_gudang = $this->delete('id_stok_gudang');
        $this->db->where('id_stok_gudang', $id_stok_gudang);
        $delete = $this->db->delete('stok_gudang');
        if ($delete) {
            $this->response(array('status' => 'success'), 201);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }

}