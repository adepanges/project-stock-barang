<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Del extends Resto_Controller {
    public function index($id = 0)
    {
        $this->_restrict_access('rest');

        $id = (int) $id;
        if(!$id) $this->_response_json([
            'status' => 0,
            'message' => 'id must be set in uri'
        ]);

        $this->load->model('customer_model');

        if($this->customer_model->del($id))
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
