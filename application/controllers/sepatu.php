<?php

require APPPATH . '/libraries/REST_Controller.php';

class sepatu extends REST_Controller {

    function __construct($config = 'rest') {
        parent::__construct($config);
    }

    // show data sepatu
    function index_get() {
        $id_sepatu = $this->get('id_sepatu');
        if ($id_sepatu == '') {
            $sepatu = $this->db->get('sepatu')->result();
        } else {
            $this->db->where('id_sepatu', $id_sepatu);
            $sepatu = $this->db->get('sepatu')->result();
        }
        $this->response($sepatu, 200);
    }

        // insert new data to sepatu
    function index_post() {
        $data = array(
                    'id_sepatu'           => $this->post('id_sepatu'),
                    'brand'          => $this->post('brand'),
                    'model'    => $this->post('model'),
                    'harga'          => $this->post('harga'),
                    'kategori'        => $this->post('kategori'));

        // $uploaddir = './upload/';
        // if(!file_exists($uploaddir) && !is_dir($uploaddir)) {
        //     echo mkdir($uploaddir, 0750, true);
        // }

        // if (!empty($_FILES)){
        //     $path = $_FILES['foto']['name'];
        //     $ext = pathinfo($path, PATHINFO_EXTENSION);
        //     $user_img = md5($data['id_sepatu']). '.' . "png";
        //     $uploadfile = $uploaddir . $user_img;
        //     $data['foto'] = "upload/".$user_img;
        // }else{
        //     $data['foto']="upload/nopic.jpg";
        // }

        // if (!empty($_FILES)){
        //     if ($_FILES["foto"]["name"]) {
        //         if(move_uploaded_file($_FILES["foto"]["tmp_name"],$uploadfile)){
        //             $insert_image = "success";
        //         } else{
        //             $insert_image = "failed";
        //         }
        //     }else{
        //         $insert_image = "Image Tidak ada Masukan";
        //     }
        //     $data['foto'] = base_url()."upload/".$user_img;
        // }else{
        //     $data['foto'] = "upload/nopic.jpg";
        // }

        $insert = $this->db->insert('sepatu', $data);
        if ($insert) {
            $this->response($data, 200);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }

    // update data sepatu
    function index_put() {
        $id_sepatu = $this->put('id_sepatu');
        $data = array(
                    'id_sepatu'       => $this->put('id_sepatu'),
                    'brand'      => $this->put('brand'),
                    'model'=> $this->put('model'),                    
                    'harga'    => $this->put('harga'),
                    'kategori'        => $this->put('kategori'));
        $this->db->where('id_sepatu', $id_sepatu);
        $update = $this->db->update('sepatu', $data);
        if ($update) {
            $this->response($data, 200);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }

    // delete sepatu
    function index_delete() {
        $id_sepatu = $this->delete('id_sepatu');
        $this->db->where('id_sepatu', $id_sepatu);
        $delete = $this->db->delete('sepatu');
        $this->db->where('id_sepatu', $id_sepatu);        
        $delete = $this->db->delete('stok_gudang');
        if ($delete) {
            $this->response(array('status' => 'success'), 201);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }

}