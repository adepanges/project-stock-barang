<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Del extends Resto_Controller {
    public function index($id = 0)
    {
        $this->_restrict_access('rest');

        $product_id = (int) $id;
        if(!$product_id) $this->_response_json([
            'status' => 0,
            'message' => 'id must be set in uri'
        ]);

        $this->load->model('product_model');

        if($this->product_model->del($product_id))
        {
            $this->_response_json([
                'status' => 1,
                'message' => 'Berhasil menghapus data'
            ]);
        }
        else
        {
            $this->_response_json([
                'status' => 0,
                'message' => 'Gagal menghapus data'
            ]);
        }
    }
}
