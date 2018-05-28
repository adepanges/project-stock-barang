<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cart extends Resto_Controller {

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
        $this->load->model(['orders_model','orders_cart_model']);

        $orders = $this->orders_model->get_byid((int) $order_id);
        if(
            empty($orders) ||
            (isset($orders->is_active) && $orders->is_active == 0)
        ) redirect('orders');

        $this->_set_data([
            'title' => 'Cart',
            'orders' => $orders,
            'role_active' => $this->role_active,
            'cart' => $this->orders_cart_model->get_by_orderid($order_id)->result()
        ]);
        $this->blade->view('inc/orders/cart', $this->data);
	}

    public function checkout()
    {
        $this->_restrict_access('rest');
        $order_id = (int) $this->input->post('order_id');

        $this->load->model('orders_model');
        $this->orders_model->upt_total_price($order_id);
        $res = $this->orders_model->upd([
            'pay' => (int) $this->input->post('pay'),
            'refund' => (int) $this->input->post('refund'),
            'pay_at' => date('Y-m-d H:i:s'),
            'is_active' => 0,
        ], $order_id);

        if($res)
        {
            $this->_response_json([
                'status' => 1,
                'message' => 'Berhasil checkout pesanan'
            ]);
        }
        else
        {
            $this->_response_json([
                'status' => 0,
                'message' => 'Gagal checkout pesanan'
            ]);
        }
    }

    public function save()
    {
        $this->_restrict_access('rest');
        $cart_id = (int) $this->input->post('cart_id');

        $data = [
            'order_id' => (int) $this->input->post('order_id'),
            'product_id' => (int) $this->input->post('product_id'),
            'product_name' => $this->input->post('name'),
            'unit_price' => (int) $this->input->post('unit_price'),
            'qty' => (int) $this->input->post('qty'),
        ];

        $data['price'] = $data['unit_price'] * $data['qty'];

        $this->load->model(['orders_cart_model','orders_model']);
        if(!$cart_id) $res = $this->orders_cart_model->add($data);
        else $res = $this->orders_cart_model->upd($data);

        $this->orders_model->upt_total_price($data['order_id']);

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

    public function del($cart_id)
    {
        $this->_restrict_access('rest');
        $this->load->model(['orders_cart_model','orders_model']);
        $cart = $this->orders_cart_model->get_byid($cart_id);

        if(!empty($cart))
        {
            $res = $this->orders_cart_model->del((int) $cart_id);
            $this->orders_model->upt_total_price($cart->order_id);
        }
        else $res = FALSE;

        if($res)
        {
            $this->_response_json([
                'status' => 1,
                'message' => 'Berhasil menghapus data'
            ]);
        }
        else
        {
            $this->_response_json([
                'status' => 0,
                'message' => 'Gagal menghapus data',
                'data' => $cart
            ]);
        }
    }
}
