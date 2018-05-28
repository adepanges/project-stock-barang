<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class App extends Resto_Controller {

    function __construct()
    {
        parent::__construct();
        if($this->role_active['role_id'] != 1)
        {
            redirect();
        }
    }

	public function index()
	{
        $this->_restrict_access('web');
        $this->load->model('product_model');

        $this->_set_data([
            'title' => 'Management Product',
        ]);
        $this->blade->view('inc/admin/product/app', $this->data);
	}

    public function save()
    {
        $product_id = (int) $this->input->post('product_id');
        if($product_id) $this->_restrict_access('rest');
        else $this->_restrict_access('rest');

        $this->load->model('product_model');

        $data = [
            'name' => $this->input->post('name'),
            'type' => $this->input->post('type'),
            'unit_price' => $this->input->post('unit_price'),
            'status' => (int) $this->input->post('status')
        ];

        if(!$product_id)
        {
            // tambah
            $res = $this->product_model->add($data);
        }
        else
        {
            // ubah
            $res = $this->product_model->upd($data, $product_id);
        }

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
