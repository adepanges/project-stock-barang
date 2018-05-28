<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Get extends Resto_Controller {

	public function index()
	{
        $this->_restrict_access('rest');
        $this->load->model('table_model');

        $this->table_model->set_datatable_param($this->_datatable_param());
        $user_data = $this->table_model->get_datatable();

        $this->_response_json([
            'recordsFiltered' => $user_data['total'],
            'data' => $user_data['row']
        ]);
	}

    public function byid($id = 0)
    {
        $data = (object) [];
        $user_id = (int) $id;

        if($user_id)
        {
            $this->load->model('table_model');
            $data = $this->table_model->get_byid($user_id);
        }
        $this->_response_json($data);
    }
}
