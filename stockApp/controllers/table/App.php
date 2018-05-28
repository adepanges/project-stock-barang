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
        $this->load->model('table_model');

        $this->_set_data([
            'title' => 'Management Product',
        ]);
        $this->blade->view('inc/admin/table/app', $this->data);
	}

    public function save()
    {
        $table_id = (int) $this->input->post('table_id');
        if($table_id) $this->_restrict_access('rest');
        else $this->_restrict_access('rest');

        $this->load->model('table_model');

        $data = [
            'code' => $this->input->post('code'),
            'name' => $this->input->post('name'),
            'status' => (int) $this->input->post('status')
        ];

        if(!$table_id)
        {
            // tambah
            $res = $this->table_model->add($data);
        }
        else
        {
            // ubah
            $res = $this->table_model->upd($data, $table_id);
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
