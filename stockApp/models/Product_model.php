<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product_model extends Resto_Model {
    protected
        $datatable_param = NULL,
        $table = 'product',
        $orderable_field = ['name','type','unit_price'],
        $fillable_field = ['name','type','unit_price','status'],
        $searchable_field = ['name','type'];

    function get_datatable($params = [])
    {
        $sql = "SELECT * FROM {$this->table}";

        $sql_user = $this->_combine_datatable_param($sql);
        $sql_count = $this->_combine_datatable_param($sql, TRUE);

        return [
            'row' => $this->db->query($sql_user)->result(),
            'total' => $this->db->query($sql_count)->row()->count
        ];
    }

    function get_active()
    {
        return $this->db->where('status', 1)->get($this->table);
    }

    function get_byid($id)
    {
        return $this->db->where('product_id', ((int) $id))->get($this->table)->row();
    }

    function del($id)
    {
        return $this->db->delete($this->table, ['product_id' => ((int) $id)]);
    }

    function upd($data, $product_id)
    {
        $this->db->where('product_id', $product_id);
        return $this->db->update($this->table, $this->_sanity_field($data));
    }

    function add($data)
    {
        return $this->db->insert($this->table, $this->_sanity_field($data));
    }
}
