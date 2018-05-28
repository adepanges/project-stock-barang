<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Orders_cart_model extends Resto_Model {
    protected
        $datatable_param = NULL,
        $table = 'orders_cart',
        $orderable_field = [],
        $fillable_field = ['order_id','product_id','product_name','unit_price','price','qty'],
        $searchable_field = ['order_id','product_id','product_name','unit_price','price','qty'];

    function get_by_orderid($id)
    {
        return $this->db->where('order_id', ((int) $id))->get($this->table);
    }

    function get_byid($id)
    {
        return $this->db->where('cart_id', ((int) $id))->get($this->table)->row();
    }

    function del($id)
    {
        return $this->db->delete($this->table, ['cart_id' => ((int) $id)]);
    }

    function upd($data, $cart_id)
    {
        $this->db->where('cart_id', $cart_id);
        return $this->db->update($this->table, $this->_sanity_field($data));
    }

    function add($data)
    {
        return $this->db->insert($this->table, $this->_sanity_field($data));
    }
}
