<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Home_model extends CI_Model
{
	function __construct()
	{
		parent::__construct();

	}

 function revenue_()
 {
   
  $revenue = $this->db->query("
   
  select
  ifnull((SELECT sum(revenue) FROM (v_revenue_cost_maintenance_profit)WHERE((month_maintenance=1)AND (year_ujo=2015))),0) AS `Januari`,
  ifnull((SELECT sum(revenue) FROM (v_revenue_cost_maintenance_profit)WHERE((month_maintenance=2)AND (year_ujo=2015))),0) AS `Februari`,
  ifnull((SELECT sum(revenue) FROM (v_revenue_cost_maintenance_profit)WHERE((month_maintenance=3)AND (year_ujo=2015))),0) AS `Maret`,
  ifnull((SELECT sum(revenue) FROM (v_revenue_cost_maintenance_profit)WHERE((month_maintenance=4)AND (year_ujo=2015))),0) AS `April`,
  ifnull((SELECT sum(revenue) FROM (v_revenue_cost_maintenance_profit)WHERE((month_maintenance=5)AND (year_ujo=2015))),0) AS `Mei`,
  ifnull((SELECT sum(revenue) FROM (v_revenue_cost_maintenance_profit)WHERE((month_maintenance=6)AND (year_ujo=2015))),0) AS `Juni`,
  ifnull((SELECT sum(revenue) FROM (v_revenue_cost_maintenance_profit)WHERE((month_maintenance=7)AND (year_ujo=2015))),0) AS `Juli`,
  ifnull((SELECT sum(revenue) FROM (v_revenue_cost_maintenance_profit)WHERE((month_maintenance=8)AND (year_ujo=2015))),0) AS `Agustus`,
  ifnull((SELECT sum(revenue) FROM (v_revenue_cost_maintenance_profit)WHERE((month_maintenance=9)AND (year_ujo=2015))),0) AS `September`,
  ifnull((SELECT sum(revenue) FROM (v_revenue_cost_maintenance_profit)WHERE((month_maintenance=10)AND (year_ujo=2015))),0) AS `Oktober`,
  ifnull((SELECT sum(revenue) FROM (v_revenue_cost_maintenance_profit)WHERE((month_maintenance=11)AND (year_ujo=2015))),0) AS `November`,
  ifnull((SELECT sum(revenue) FROM (v_revenue_cost_maintenance_profit)WHERE((month_maintenance=12)AND (year_ujo=2015))),0) AS `Desember`
  from v_revenue_cost_maintenance_profit GROUP BY year_ujo
  ");
   
  return $revenue;
   
 }

 function revenue($tahun)
 {
  $tahun = date("Y");
  $revenue = $this->db->query("
   
  select DISTINCT
  ifnull((SELECT sum(Total) FROM (v_revenue_total)WHERE((Bulan=1)AND (tahun=2016))),0) AS `Revenue Januari`,
  ifnull((SELECT sum(Total) FROM (v_revenue_total)WHERE((Bulan=2)AND (tahun=2016))),0) AS `Revenue Februari`,
  ifnull((SELECT sum(Total) FROM (v_revenue_total)WHERE((Bulan=3)AND (tahun=2016))),0) AS `Revenue Maret`,
  ifnull((SELECT sum(Total) FROM (v_revenue_total)WHERE((Bulan=4)AND (tahun=2016))),0) AS `Revenue April`,
  ifnull((SELECT sum(Total) FROM (v_revenue_total)WHERE((Bulan=5)AND (tahun=2016))),0) AS `Revenue Mei`,
  ifnull((SELECT sum(Total) FROM (v_revenue_total)WHERE((Bulan=6)AND (tahun=2016))),0) AS `Revenue Juni`,
  ifnull((SELECT sum(Total) FROM (v_revenue_total)WHERE((Bulan=7)AND (tahun=2016))),0) AS `Revenue Juli`,
  ifnull((SELECT sum(Total) FROM (v_revenue_total)WHERE((Bulan=8)AND (tahun=2016))),0) AS `Revenue Agustus`,
  ifnull((SELECT sum(Total) FROM (v_revenue_total)WHERE((Bulan=9)AND (tahun=2016))),0) AS `Revenue September`,
  ifnull((SELECT sum(Total) FROM (v_revenue_total)WHERE((Bulan=10)AND (tahun=2016))),0) AS `Revenue Oktober`,
  ifnull((SELECT sum(Total) FROM (v_revenue_total)WHERE((Bulan=11)AND (tahun=2016))),0) AS `Revenue November`,
  ifnull((SELECT sum(Total) FROM (v_revenue_total)WHERE((Bulan=12)AND (tahun=2016))),0) AS `Revenue Desember`
  from v_revenue_total
  ");
   
  return $revenue;
   
 }
 

 function profit()
 {
   
  $profit = $this->db->query("
   
  select
  ifnull((SELECT sum(profit) FROM (v_revenue_cost_maintenance_profit)WHERE((month_maintenance=1)AND (year_ujo=2015))),0) AS `Profit Januari`,
  ifnull((SELECT sum(profit) FROM (v_revenue_cost_maintenance_profit)WHERE((month_maintenance=2)AND (year_ujo=2015))),0) AS `Profit Februari`,
  ifnull((SELECT sum(profit) FROM (v_revenue_cost_maintenance_profit)WHERE((month_maintenance=3)AND (year_ujo=2015))),0) AS `Profit Maret`,
  ifnull((SELECT sum(profit) FROM (v_revenue_cost_maintenance_profit)WHERE((month_maintenance=4)AND (year_ujo=2015))),0) AS `Profit April`,
  ifnull((SELECT sum(profit) FROM (v_revenue_cost_maintenance_profit)WHERE((month_maintenance=5)AND (year_ujo=2015))),0) AS `Profit Mei`,
  ifnull((SELECT sum(profit) FROM (v_revenue_cost_maintenance_profit)WHERE((month_maintenance=6)AND (year_ujo=2015))),0) AS `Profit Juni`,
  ifnull((SELECT sum(profit) FROM (v_revenue_cost_maintenance_profit)WHERE((month_maintenance=7)AND (year_ujo=2015))),0) AS `Profit Juli`,
  ifnull((SELECT sum(profit) FROM (v_revenue_cost_maintenance_profit)WHERE((month_maintenance=8)AND (year_ujo=2015))),0) AS `Profit Agustus`,
  ifnull((SELECT sum(profit) FROM (v_revenue_cost_maintenance_profit)WHERE((month_maintenance=9)AND (year_ujo=2015))),0) AS `Profit September`,
  ifnull((SELECT sum(profit) FROM (v_revenue_cost_maintenance_profit)WHERE((month_maintenance=10)AND (year_ujo=2015))),0) AS `Profit Oktober`,
  ifnull((SELECT sum(profit) FROM (v_revenue_cost_maintenance_profit)WHERE((month_maintenance=11)AND (year_ujo=2015))),0) AS `Profit November`,
  ifnull((SELECT sum(profit) FROM (v_revenue_cost_maintenance_profit)WHERE((month_maintenance=12)AND (year_ujo=2015))),0) AS `Profit Desember`
  from v_revenue_cost_maintenance_profit GROUP BY year_ujo
  ");
   
  return $profit;
   
 }
 
 function cost($tahun)
 {
  $tahun = date("Y");
  $cost = $this->db->query("
   
  select DISTINCT
  ifnull((SELECT sum(Total) FROM (v_ujo_komisi_total)WHERE((Bulan=1)AND (tahun=2016))),0) AS `Cost Januari`,
  ifnull((SELECT sum(Total) FROM (v_ujo_komisi_total)WHERE((Bulan=2)AND (tahun=2016))),0) AS `Cost Februari`,
  ifnull((SELECT sum(Total) FROM (v_ujo_komisi_total)WHERE((Bulan=3)AND (tahun=2016))),0) AS `Cost Maret`,
  ifnull((SELECT sum(Total) FROM (v_ujo_komisi_total)WHERE((Bulan=4)AND (tahun=2016))),0) AS `Cost April`,
  ifnull((SELECT sum(Total) FROM (v_ujo_komisi_total)WHERE((Bulan=5)AND (tahun=2016))),0) AS `Cost Mei`,
  ifnull((SELECT sum(Total) FROM (v_ujo_komisi_total)WHERE((Bulan=6)AND (tahun=2016))),0) AS `Cost Juni`,
  ifnull((SELECT sum(Total) FROM (v_ujo_komisi_total)WHERE((Bulan=7)AND (tahun=2016))),0) AS `Cost Juli`,
  ifnull((SELECT sum(Total) FROM (v_ujo_komisi_total)WHERE((Bulan=8)AND (tahun=2016))),0) AS `Cost Agustus`,
  ifnull((SELECT sum(Total) FROM (v_ujo_komisi_total)WHERE((Bulan=9)AND (tahun=2016))),0) AS `Cost September`,
  ifnull((SELECT sum(Total) FROM (v_ujo_komisi_total)WHERE((Bulan=10)AND (tahun=2016))),0) AS `Cost Oktober`,
  ifnull((SELECT sum(Total) FROM (v_ujo_komisi_total)WHERE((Bulan=11)AND (tahun=2016))),0) AS `Cost November`,
  ifnull((SELECT sum(Total) FROM (v_ujo_komisi_total)WHERE((Bulan=12)AND (tahun=2016))),0) AS `Cost Desember`
  from v_ujo_komisi_total
  ");
   
  return $cost;
   
 }
 
 function maintenance()
 {
   
  $maintenance = $this->db->query("
   
  select DISTINCT
  ifnull((SELECT sum(Total) FROM (v_maintenance_total)WHERE((Bulan=1)AND (tahun=2016))),0) AS `Mtc Januari`,
  ifnull((SELECT sum(Total) FROM (v_maintenance_total)WHERE((Bulan=2)AND (tahun=2016))),0) AS `Mtc Februari`,
  ifnull((SELECT sum(Total) FROM (v_maintenance_total)WHERE((Bulan=3)AND (tahun=2016))),0) AS `Mtc Maret`,
  ifnull((SELECT sum(Total) FROM (v_maintenance_total)WHERE((Bulan=4)AND (tahun=2016))),0) AS `Mtc April`,
  ifnull((SELECT sum(Total) FROM (v_maintenance_total)WHERE((Bulan=5)AND (tahun=2016))),0) AS `Mtc Mei`,
  ifnull((SELECT sum(Total) FROM (v_maintenance_total)WHERE((Bulan=6)AND (tahun=2016))),0) AS `Mtc Juni`,
  ifnull((SELECT sum(Total) FROM (v_maintenance_total)WHERE((Bulan=7)AND (tahun=2016))),0) AS `Mtc Juli`,
  ifnull((SELECT sum(Total) FROM (v_maintenance_total)WHERE((Bulan=8)AND (tahun=2016))),0) AS `Mtc Agustus`,
  ifnull((SELECT sum(Total) FROM (v_maintenance_total)WHERE((Bulan=9)AND (tahun=2016))),0) AS `Mtc September`,
  ifnull((SELECT sum(Total) FROM (v_maintenance_total)WHERE((Bulan=10)AND (tahun=2016))),0) AS `Mtc Oktober`,
  ifnull((SELECT sum(Total) FROM (v_maintenance_total)WHERE((Bulan=11)AND (tahun=2016))),0) AS `Mtc November`,
  ifnull((SELECT sum(Total) FROM (v_maintenance_total)WHERE((Bulan=12)AND (tahun=2016))),0) AS `Mtc Desember`
  from v_maintenance_total
  ");
   
  return $maintenance;
   
 }
 
 function get_hrg_solar()
 {
	$this->db->select('solar_price');
	$this->db->order_by("transaction_date", "desc");
	$q = $this->db->get('tbl_solar',1); 
	// $q = $this->db->limit(1);
		if( $q->num_rows() > 0 )
		{
			$number = $q->row()->solar_price;
			return number_format($number, 2, ',', '.');
		} 				  
 }
 	
}

/* End of file home_model.php */ 
/* Location: ./sma/modules/home/models/home_model.php */
