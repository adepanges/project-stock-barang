<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Get extends Resto_Controller {

    function __construct()
    {
        parent::__construct();
        if(!in_array($this->role_active['role_id'], [1,2]))
        {
            redirect();
        }
    }

	public function income_chart()
	{
        $this->load->model('statistik_model');

        $start_date = $this->input->post('start_date');
        $end_date = $this->input->post('end_date');

        $res = $this->statistik_model->income($start_date, $end_date);
        $res_product = $this->statistik_model->product($start_date, $end_date);

        $this->_response_json([
            'data' => $res->result(),
            'product' => $res_product->result()
        ]);
	}
}
