<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends Resto_Controller {

    function __construct()
    {
        parent::__construct();
        if(!in_array($this->role_active['role_id'], [3,4]))
        {
            redirect();
        }
    }

	public function index($order_id)
	{
        $this->_restrict_access('web');
        $this->load->model(['product_model','orders_model']);

        $orders = $this->orders_model->get_byid((int) $order_id);
        if(empty($orders)) redirect('orders');

        if(!$order_id) redirect('orders');
        $active_product = $this->product_model->get_active()->result();

        $this->_set_data([
            'title' => 'Cart',
            'orders' => $orders,
            'active_product' => $active_product
        ]);
        $this->blade->view('inc/orders/product', $this->data);
	}

    public function save()
    {
        $this->_restrict_access('rest');
        $cart_id = (int) $this->input->post('cart_id');

        $data = [
            'order_id' => (int) $this->input->post('order_id'),
            'product_id' => (int) $this->input->post('product_id'),
            'product_name' => (int) $this->input->post('product_name'),
            'unit_price' => (int) $this->input->post('unit_price'),
            'price' => (int) $this->input->post('price'),
            'qty' => (int) $this->input->post('qty'),
        ];

        $this->load->model('orders_model');
        if(!$cart_id) $res = $this->orders_model->add($data);
        else $res = $this->orders_model->upd($data);

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
