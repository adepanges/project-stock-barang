<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Suplier_model extends Resto_Model {
    protected
        $datatable_param = NULL,
        $table = 'master_suplier',
        $orderable_field = ['name','telephone','address'],
        $fillable_field = ['name','telephone','address','status'],
        $searchable_field = ['name','telephone','address'];

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
        return $this->db->where('suplier_id', ((int) $id))->get($this->table)->row();
    }

    function del($id)
    {
        return $this->db->delete($this->table, ['suplier_id' => ((int) $id)]);
    }

    function upd($data, $suplier_id)
    {
        $this->db->where('suplier_id', $suplier_id);
        return $this->db->update($this->table, $this->_sanity_field($data));
    }

    function add($data)
    {
        return $this->db->insert($this->table, $this->_sanity_field($data));
    }
}
