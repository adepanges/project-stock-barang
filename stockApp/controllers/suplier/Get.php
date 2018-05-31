<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Get extends Resto_Controller {

	public function index()
	{
        $this->_restrict_access('rest');
        $this->load->model('suplier_model');

        $this->suplier_model->set_datatable_param($this->_datatable_param());
        $user_data = $this->suplier_model->get_datatable();

        $this->_response_json([
            'recordsFiltered' => $user_data['total'],
            'data' => $user_data['row']
        ]);
	}

    public function byid($id = 0)
    {
        $data = (object) [];
        $id = (int) $id;

        if($id)
        {
            $this->load->model('suplier_model');
            $data = $this->suplier_model->get_byid($id);
        }
        $this->_response_json($data);
    }
}
