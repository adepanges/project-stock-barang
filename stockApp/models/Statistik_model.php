<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Statistik_model extends Resto_Model {

    function income($start_date, $end_date)
    {
        $start_date = !empty($start_date)?$start_date.' 00:00:00':date('Y-m-01 00:00:00');
        $end_date = !empty($end_date)?$end_date.' 23:59:59':date('Y-m-d 23:59:59');

        return $this->db->query("SELECT
            	CONCAT(a.day,'/',a.month) AS periode,
            	(
            		SELECT SUM(total_price) AS income
            		FROM orders WHERE DATE(created_at) = a.db_date AND is_active = 0
            	) AS income
            FROM time_dimension a
            WHERE db_date BETWEEN ? AND ?", [$start_date, $end_date]);
    }

    function product($start_date, $end_date)
    {
        $start_date = !empty($start_date)?$start_date.' 00:00:00':date('Y-m-01 00:00:00');
        $end_date = !empty($end_date)?$end_date.' 23:59:59':date('Y-m-d 23:59:59');

        return $this->db->query("SELECT
        	   a.product_id, a.name, b.qty, b.total
            FROM product a
            LEFT JOIN (
            	SELECT b.product_id, SUM(b.qty) AS qty, SUM(b.price) AS total
            	FROM orders a
            	LEFT JOIN orders_cart b ON a.order_id = b.order_id
            	WHERE a.is_active = 0 AND a.created_at BETWEEN ? AND ?
            	GROUP BY b.product_id
            ) b ON a.product_id = b.product_id
            WHERE a.status = 1", [$start_date, $end_date]);
    }
}
