<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cetak extends Resto_Controller {

    function __construct()
    {
        parent::__construct();
        if(!in_array($this->role_active['role_id'], [3,4]))
        {
            redirect();
        }
    }

	public function struk($order_id)
	{
        $this->_restrict_access('web');
        $this->load->model(['orders_model','orders_cart_model']);

        $orders = $this->orders_model->get_byid((int) $order_id);
        $this->_set_data([
            'orders' => $orders,
            'orders_cart' => $this->orders_cart_model->get_by_orderid($order_id)->result()
        ]);
        
        // dd($this->data['orders_cart']);
        // exit;

        $this->blade->view('cetak/struk', $this->data);
	}
}
