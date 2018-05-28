<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class App extends Resto_Controller {

    function __construct()
    {
        parent::__construct();
        if(!in_array($this->role_active['role_id'], [1,2]))
        {
            redirect();
        }
    }

	public function index()
	{
        $this->_restrict_access('web');
        $this->load->model('table_model');

        $this->_set_data([
            'title' => 'Halaman Pimpinan',
        ]);
        $this->blade->view('inc/pimpinan/app', $this->data);
	}
}
