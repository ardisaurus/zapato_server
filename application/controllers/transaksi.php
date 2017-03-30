<?php

require APPPATH . '/libraries/REST_Controller.php';

class Transaksi extends REST_Controller {

    function __construct($config = 'rest') {
        parent::__construct($config);
    }

    // show data transaksi
    function index_get() {
        $id_transaksi = $this->get('id_transaksi');
        $user_id=$this->get('user_id');
        if ($id_transaksi == '' AND $user_id != '') {
            $transaksi = $this->db->query('SELECT * FROM `transaksi` INNER JOIN `gudang` INNER JOIN `sepatu` ON `transaksi`.`id_gudang` = `gudang`.`id_gudang` AND `transaksi`.`id_sepatu` = `sepatu`.`id_sepatu` WHERE `transaksi`.`user_id` = '."'".$user_id."' ORDER BY id_transaksi DESC")->result();
        }elseif($id_transaksi == ''){ 
            $transaksi = $this->db->query('SELECT * FROM `transaksi` INNER JOIN `gudang` INNER JOIN `sepatu` ON `transaksi`.`id_gudang` = `gudang`.`id_gudang` AND `transaksi`.`id_sepatu` = `sepatu`.`id_sepatu` ORDER BY id_transaksi DESC')->result();
        }else {
            $this->db->where('id_transaksi', $id_transaksi);
            $transaksi = $this->db->get('transaksi')->result();
        }
        $this->response($transaksi, 200);
    }

    // insert new data to transaksi
    function index_post() {
        $this->db->where('id_sepatu', $this->post('id_sepatu'));
        $sepatu = $this->db->get('sepatu')->result();
        foreach ($sepatu as $row) {
            $harga=$row->harga;
        }
        $data = array(
                    'id_transaksi'           => $this->post('id_transaksi'),
                    'id_gudang'          => $this->post('id_gudang'),
                    'user_id'    => $this->post('user_id'),
                    'id_sepatu'          => $this->post('id_sepatu'),
                    'ukuran'    => $this->post('ukuran'),
                    'jml'          => $this->post('jml'),
                    'harga_total'          => $this->post('jml')*$harga,
                    'status'        => $this->post('status'));        
        $insert = $this->db->insert('transaksi', $data);
        if ($insert) {
            $this->response($data, 200);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }

    // update data transaksi
    function index_put() {
        $id_transaksi = $this->put('id_transaksi');
        $data = array(
                    'id_transaksi'       => $this->put('id_transaksi'),
                    'id_gudang'      => $this->put('id_gudang'),
                    'user_id'=> $this->put('user_id'),                    
                    'id_sepatu'    => $this->put('id_sepatu'),
                    'ukuran'=> $this->put('ukuran'),                    
                    'jml'    => $this->put('jml'),
                    'status'        => $this->put('status'));
        $this->db->where('id_transaksi', $id_transaksi);
        $update = $this->db->update('transaksi', $data);
        if ($update) {
            $this->response($data, 200);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }

    // delete transaksi
    function index_delete() {
        $id_transaksi = $this->delete('id_transaksi');
        $this->db->where('id_transaksi', $id_transaksi);
        $delete = $this->db->delete('transaksi');
        if ($delete) {
            $this->response(array('status' => 'success'), 201);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }
}