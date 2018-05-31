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

        $this->_set_data([
            'title' => 'Management Suplier',
        ]);
        $this->blade->view('inc/suplier/app', $this->data);
	}

    public function save()
    {
        $suplier_id = (int) $this->input->post('suplier_id');
        if($suplier_id) $this->_restrict_access('rest');
        else $this->_restrict_access('rest');

        $this->load->model('suplier_model');

        $data = [
            'name' => $this->input->post('name'),
            'telephone' => $this->input->post('telephone'),
            'address' => $this->input->post('address'),
            'status' => (int) $this->input->post('status')
        ];

        if(!$suplier_id)
        {
            // tambah
            $res = $this->suplier_model->add($data);
        }
        else
        {
            // ubah
            $res = $this->suplier_model->upd($data, $suplier_id);
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
