<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class App extends Resto_Controller {

    function __construct()
    {
        parent::__construct();
        if(!in_array($this->role_active['role_id'], [3,4]))
        {
            redirect();
        }
    }

	public function index()
	{
        $this->_restrict_access('web');
        $this->load->model('table_model');

        $active_table = $this->table_model->get_active()->result();

        $this->_set_data([
            'title' => 'List of Table',
            'active_table' => $active_table
        ]);
        $this->blade->view('inc/orders/app', $this->data);
	}

    public function serve()
    {
        $this->_restrict_access('rest');
        
        $data = [
            'table_id' => (int) $this->input->post('table_id'),
            'user_id' => $this->profile['user_id'],
            'customer_name' => $this->input->post('customer_name'),
            'total_price' => 0,
            'is_deleted' => 0,
            'is_active' => 1,
            'created_at' => date('Y-m-d H:i:s')
        ];

        $this->load->model('orders_model');
        $res = $this->orders_model->add($data);

        if($res)
        {
            $this->_response_json([
                'status' => 1,
                'message' => 'Berhasil menyimpan data'
            ]);
        }
        else
        {
            $this->_response_json([
                'status' => 0,
                'message' => 'Gagal menyimpan data'
            ]);
        }
    }
}
