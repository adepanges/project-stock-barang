<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Del extends Resto_Controller {
    public function index($id = 0)
    {
        $this->_restrict_access('rest');

        $table_id = (int) $id;
        if(!$table_id) $this->_response_json([
            'status' => 0,
            'message' => 'id must be set in uri'
        ]);

        $this->load->model('table_model');

        if($this->table_model->del($table_id))
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
