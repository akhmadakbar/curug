<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {


	function __construct()
	{
		parent::__construct();
		
		// check if user logged in 
		if (!$this->ion_auth->logged_in())
	  	{
			header('location:'.base_url().'auth/login');	
	  	}
		$this->load->helper('url');
		$this->load->library('form_validation');
		//$this->security->csrf_verify(); 
		$this->load->model('home_model');	
		
		$this->meta = array(
            'activeMenu' => 'dashboard', // laporan
            'activeTab' => 'dashboard' //expire_unit
        );	
	}
	
	function test(){
		echo(USER_EMAIL);
		// print_r(GROUP_AUTH);
		$group_auth = explode(',', GROUP_AUTH);
		print_r($group_auth);
		if(in_array("admin", $group_auth)){
			echo("<br>OK");
		}
	}
	
   function index()
   {

		$meta = $this->meta;
			
		$data['message'] = (validation_errors() ? validation_errors() : $this->session->flashdata('message'));
		$data['success_message'] = $this->session->flashdata('success_message');
		$data['test'] = "[{
            name: 'John',
            data: [5, 3, 4, 7, 2]
        }, {
            name: 'Jane',
            data: [2, 2, 3, 2, 1]
        }, {
            name: 'Joe',
            data: [3, 4, 4, 2, 5]
        }]";
			
		$meta = array(
						'activeMenu' => 'dashboard',
						'activeTab' => 'dashboard',
						'page_title' => 'Dashboard - '.SITE_NAME,
						'menu' => 'Dashboard',
						'sub_menu' => 'overview &amp; stats',
						'load_js' => 'js.php',
						'load_css' => 'css.php',
						'testing' => $data['test']				
				);					

		$data['page_title'] = $this->lang->line("welcome")." ".SITE_NAME."";

		$this->load->view('commons/header', $meta);
		// $this->load->view('expire_unit', $data);
		$this->load->view('content', $data);
		$this->load->view('commons/footer',$meta);
   	// }
   }

	 
 function grafik($tahun)
 {
  // $tahun = date("Y");
  $finance = $this->db->query("

		select 
		sum(IF(MONTH(`date`)=1,1,0)) as `Finance Januari`,
		sum(IF(MONTH(`date`)=2,1,0)) as `Finance Februari`,
		sum(IF(MONTH(`date`)=3,1,0)) as `Finance Maret`,
		sum(IF(MONTH(`date`)=4,1,0)) as `Finance April`,
		sum(IF(MONTH(`date`)=5,1,0)) as `Finance Mei`,
		sum(IF(MONTH(`date`)=6,1,0)) as `Finance Juni`,
		sum(IF(MONTH(`date`)=7,1,0)) as `Finance Juli`,
		sum(IF(MONTH(`date`)=8,1,0)) as `Finance Agustus`,
		sum(IF(MONTH(`date`)=9,1,0)) as `Finance September`,
		sum(IF(MONTH(`date`)=10,1,0)) as `Finance Oktober`,
		sum(IF(MONTH(`date`)=11,1,0)) as `Finance November`,
		sum(IF(MONTH(`date`)=12,1,0)) as `Finance Desember`
		from doc where YEAR(`date`) = '".$tahun."' and coa_id = '302' group by YEAR(`date`);	
  ");

	foreach($finance->result_array() as $row){
		$data['grafik'][]=(float)$row['Finance Januari'];
		$data['grafik'][]=(float)$row['Finance Februari'];
		$data['grafik'][]=(float)$row['Finance Maret'];
		$data['grafik'][]=(float)$row['Finance April'];
		$data['grafik'][]=(float)$row['Finance Mei'];
		$data['grafik'][]=(float)$row['Finance Juni'];
		$data['grafik'][]=(float)$row['Finance Juli'];
		$data['grafik'][]=(float)$row['Finance Agustus'];
		$data['grafik'][]=(float)$row['Finance September'];
		$data['grafik'][]=(float)$row['Finance Oktober'];
		$data['grafik'][]=(float)$row['Finance November'];
		$data['grafik'][]=(float)$row['Finance Desember'];
	}

  $logistics = $this->db->query("

		select 
		sum(IF(MONTH(`date`)=1,1,0)) as `Logistics Januari`,
		sum(IF(MONTH(`date`)=2,1,0)) as `Logistics Februari`,
		sum(IF(MONTH(`date`)=3,1,0)) as `Logistics Maret`,
		sum(IF(MONTH(`date`)=4,1,0)) as `Logistics April`,
		sum(IF(MONTH(`date`)=5,1,0)) as `Logistics Mei`,
		sum(IF(MONTH(`date`)=6,1,0)) as `Logistics Juni`,
		sum(IF(MONTH(`date`)=7,1,0)) as `Logistics Juli`,
		sum(IF(MONTH(`date`)=8,1,0)) as `Logistics Agustus`,
		sum(IF(MONTH(`date`)=9,1,0)) as `Logistics September`,
		sum(IF(MONTH(`date`)=10,1,0)) as `Logistics Oktober`,
		sum(IF(MONTH(`date`)=11,1,0)) as `Logistics November`,
		sum(IF(MONTH(`date`)=12,1,0)) as `Logistics Desember`
		from doc where YEAR(`date`) = '".$tahun."' and coa_id = '150' group by YEAR(`date`);	
  ");

	foreach($logistics->result_array() as $row){
		$data['grafik2'][]=(float)$row['Logistics Januari'];
		$data['grafik2'][]=(float)$row['Logistics Februari'];
		$data['grafik2'][]=(float)$row['Logistics Maret'];
		$data['grafik2'][]=(float)$row['Logistics April'];
		$data['grafik2'][]=(float)$row['Logistics Mei'];
		$data['grafik2'][]=(float)$row['Logistics Juni'];
		$data['grafik2'][]=(float)$row['Logistics Juli'];
		$data['grafik2'][]=(float)$row['Logistics Agustus'];
		$data['grafik2'][]=(float)$row['Logistics September'];
		$data['grafik2'][]=(float)$row['Logistics Oktober'];
		$data['grafik2'][]=(float)$row['Logistics November'];
		$data['grafik2'][]=(float)$row['Logistics Desember'];
	}

  $extrusion = $this->db->query("

		select 
		sum(IF(MONTH(`date`)=1,1,0)) as `Extrusion Januari`,
		sum(IF(MONTH(`date`)=2,1,0)) as `Extrusion Februari`,
		sum(IF(MONTH(`date`)=3,1,0)) as `Extrusion Maret`,
		sum(IF(MONTH(`date`)=4,1,0)) as `Extrusion April`,
		sum(IF(MONTH(`date`)=5,1,0)) as `Extrusion Mei`,
		sum(IF(MONTH(`date`)=6,1,0)) as `Extrusion Juni`,
		sum(IF(MONTH(`date`)=7,1,0)) as `Extrusion Juli`,
		sum(IF(MONTH(`date`)=8,1,0)) as `Extrusion Agustus`,
		sum(IF(MONTH(`date`)=9,1,0)) as `Extrusion September`,
		sum(IF(MONTH(`date`)=10,1,0)) as `Extrusion Oktober`,
		sum(IF(MONTH(`date`)=11,1,0)) as `Extrusion November`,
		sum(IF(MONTH(`date`)=12,1,0)) as `Extrusion Desember`
		from doc where YEAR(`date`) = '".$tahun."' and coa_id = '600' group by YEAR(`date`);	
  ");

	foreach($extrusion->result_array() as $row){
		$data['grafik3'][]=(float)$row['Extrusion Januari'];
		$data['grafik3'][]=(float)$row['Extrusion Februari'];
		$data['grafik3'][]=(float)$row['Extrusion Maret'];
		$data['grafik3'][]=(float)$row['Extrusion April'];
		$data['grafik3'][]=(float)$row['Extrusion Mei'];
		$data['grafik3'][]=(float)$row['Extrusion Juni'];
		$data['grafik3'][]=(float)$row['Extrusion Juli'];
		$data['grafik3'][]=(float)$row['Extrusion Agustus'];
		$data['grafik3'][]=(float)$row['Extrusion September'];
		$data['grafik3'][]=(float)$row['Extrusion Oktober'];
		$data['grafik3'][]=(float)$row['Extrusion November'];
		$data['grafik3'][]=(float)$row['Extrusion Desember'];
	}

  $fabrication = $this->db->query("

		select 
		sum(IF(MONTH(`date`)=1,1,0)) as `Fabrication Januari`,
		sum(IF(MONTH(`date`)=2,1,0)) as `Fabrication Februari`,
		sum(IF(MONTH(`date`)=3,1,0)) as `Fabrication Maret`,
		sum(IF(MONTH(`date`)=4,1,0)) as `Fabrication April`,
		sum(IF(MONTH(`date`)=5,1,0)) as `Fabrication Mei`,
		sum(IF(MONTH(`date`)=6,1,0)) as `Fabrication Juni`,
		sum(IF(MONTH(`date`)=7,1,0)) as `Fabrication Juli`,
		sum(IF(MONTH(`date`)=8,1,0)) as `Fabrication Agustus`,
		sum(IF(MONTH(`date`)=9,1,0)) as `Fabrication September`,
		sum(IF(MONTH(`date`)=10,1,0)) as `Fabrication Oktober`,
		sum(IF(MONTH(`date`)=11,1,0)) as `Fabrication November`,
		sum(IF(MONTH(`date`)=12,1,0)) as `Fabrication Desember`
		from doc where YEAR(`date`) = '".$tahun."' and coa_id = '605' group by YEAR(`date`);	
  ");

	foreach($fabrication->result_array() as $row){
		$data['grafik4'][]=(float)$row['Fabrication Januari'];
		$data['grafik4'][]=(float)$row['Fabrication Februari'];
		$data['grafik4'][]=(float)$row['Fabrication Maret'];
		$data['grafik4'][]=(float)$row['Fabrication April'];
		$data['grafik4'][]=(float)$row['Fabrication Mei'];
		$data['grafik4'][]=(float)$row['Fabrication Juni'];
		$data['grafik4'][]=(float)$row['Fabrication Juli'];
		$data['grafik4'][]=(float)$row['Fabrication Agustus'];
		$data['grafik4'][]=(float)$row['Fabrication September'];
		$data['grafik4'][]=(float)$row['Fabrication Oktober'];
		$data['grafik4'][]=(float)$row['Fabrication November'];
		$data['grafik4'][]=(float)$row['Fabrication Desember'];
	}

  // $cost = $this->db->query("
   
		// select 
		// sum(IF(MONTH(`date`)=1,1,0)) as `Cost Januari`,
		// sum(IF(MONTH(`date`)=2,1,0)) as `Cost Februari`,
		// sum(IF(MONTH(`date`)=3,1,0)) as `Cost Maret`,
		// sum(IF(MONTH(`date`)=4,1,0)) as `Cost April`,
		// sum(IF(MONTH(`date`)=5,1,0)) as `Cost Mei`,
		// sum(IF(MONTH(`date`)=6,1,0)) as `Cost Juni`,
		// sum(IF(MONTH(`date`)=7,1,0)) as `Cost Juli`,
		// sum(IF(MONTH(`date`)=8,1,0)) as `Cost Agustus`,
		// sum(IF(MONTH(`date`)=9,1,0)) as `Cost September`,
		// sum(IF(MONTH(`date`)=10,1,0)) as `Cost Oktober`,
		// sum(IF(MONTH(`date`)=11,1,0)) as `Cost November`,
		// sum(IF(MONTH(`date`)=12,1,0)) as `Cost Desember`
		// from doc where YEAR(`date`) = '".$tahun."' group by YEAR(`date`);

  // ");
   
			// foreach($cost->result_array() as $row){
				// $data['grafik2'][]=(float)$row['Cost Januari'];
				// $data['grafik2'][]=(float)$row['Cost Februari'];
				// $data['grafik2'][]=(float)$row['Cost Maret'];
				// $data['grafik2'][]=(float)$row['Cost April'];
				// $data['grafik2'][]=(float)$row['Cost Mei'];
				// $data['grafik2'][]=(float)$row['Cost Juni'];
				// $data['grafik2'][]=(float)$row['Cost Juli'];
				// $data['grafik2'][]=(float)$row['Cost Agustus'];
				// $data['grafik2'][]=(float)$row['Cost September'];
				// $data['grafik2'][]=(float)$row['Cost Oktober'];
				// $data['grafik2'][]=(float)$row['Cost November'];
				// $data['grafik2'][]=(float)$row['Cost Desember'];
			// }

	
  // $maintenance = $this->db->query("
   
		// select 
		// sum(IF(MONTH(`date`)=1,1,0)) as `Mtc Januari`,
		// sum(IF(MONTH(`date`)=2,1,0)) as `Mtc Februari`,
		// sum(IF(MONTH(`date`)=3,1,0)) as `Mtc Maret`,
		// sum(IF(MONTH(`date`)=4,1,0)) as `Mtc April`,
		// sum(IF(MONTH(`date`)=5,1,0)) as `Mtc Mei`,
		// sum(IF(MONTH(`date`)=6,1,0)) as `Mtc Juni`,
		// sum(IF(MONTH(`date`)=7,1,0)) as `Mtc Juli`,
		// sum(IF(MONTH(`date`)=8,1,0)) as `Mtc Agustus`,
		// sum(IF(MONTH(`date`)=9,1,0)) as `Mtc September`,
		// sum(IF(MONTH(`date`)=10,1,0)) as `Mtc Oktober`,
		// sum(IF(MONTH(`date`)=11,1,0)) as `Mtc November`,
		// sum(IF(MONTH(`date`)=12,1,0)) as `Mtc Desember`
		// from doc where YEAR(`date`) = '".$tahun."' group by YEAR(`date`);
		
  // ");
   
	// foreach($maintenance->result_array() as $row){
		// $data['grafik3'][]=(float)$row['Mtc Januari'];
		// $data['grafik3'][]=(float)$row['Mtc Februari'];
		// $data['grafik3'][]=(float)$row['Mtc Maret'];
		// $data['grafik3'][]=(float)$row['Mtc April'];
		// $data['grafik3'][]=(float)$row['Mtc Mei'];
		// $data['grafik3'][]=(float)$row['Mtc Juni'];
		// $data['grafik3'][]=(float)$row['Mtc Juli'];
		// $data['grafik3'][]=(float)$row['Mtc Agustus'];
		// $data['grafik3'][]=(float)$row['Mtc September'];
		// $data['grafik3'][]=(float)$row['Mtc Oktober'];
		// $data['grafik3'][]=(float)$row['Mtc November'];
		// $data['grafik3'][]=(float)$row['Mtc Desember'];
	// }

  print_r('{"finance":'.json_encode($data['grafik']).',');
	print_r('"logistics":'.json_encode($data['grafik2']).',');			
	print_r('"extrusion":'.json_encode($data['grafik3']).',');			
	print_r('"fabrication":'.json_encode($data['grafik4']).'}');			
	// print_r('"maintenance":'.json_encode($data['grafik3']).'}');			
   
 }
 

	 
	function get_data()
	{
		$this->db->select('yearmonth, finance, logistics, extrusion, fabrication');
		$this->db->from('v_grafik');
		$query = $this->db->get();
		$query->result();
	}

	public function data()
	{
		$data = $this->get_data();

		$category = array();
		$category['name'] = 'Category';

		$series1 = array();
		$series1['name'] = 'Finance';

		$series2 = array();
		$series2['name'] = 'Logistics';

		$series3 = array();
		$series3['name'] = 'Extrusion';

		$series4 = array();
		$series4['name'] = 'Fabrication';

		foreach ($data as $row)
		{
		$category['data'][] = $row->yearmonth;
		$series1['data'][] = $row->finance;
		$series2['data'][] = $row->logistics;
		$series3['data'][] = $row->extrusion;
		$series4['data'][] = $row->fabrication;
		}

		$result = array();
		array_push($result,$category);
		array_push($result,$series1);
		array_push($result,$series2);
		array_push($result,$series3);
		array_push($result,$series4);

		print json_encode($result, JSON_NUMERIC_CHECK);
	}
	
	function testing($tahun){
	$tahun = '2014';
		$bulan = $this->db->query("SELECT
				id, bulan
			FROM
				bulan
			");

		$bulan = $bulan->result_array();
		
		$jml = $this->db->query("SELECT
			MONTH (`date`) as bulan_id, count(*) as jml
		FROM
			doc
		WHERE
			YEAR (`date`) = '$tahun'
		AND coa_id = '302'
			");

		$jml = $jml->result_array();


	 // $bulan = $this->model_inventory->four_week($itemId);
		$newArray[] = array();
		if(isset($jml)){
				foreach ($jml as $record) {
						$newArray['thatArray'][] = $record['jml'];
				}
		}
		$testArray = Array(0 => 45, 1 => 34, 2 => 67,3 => 46);
		$series_data[] = array('name' => 'Product', 'data' => $newArray['thatArray']);
		$series_data[] = array('name' => 'Funky', 'data' => $testArray);
		// print_r($series_data[]);
		// $this->view_data['series_data'] = json_encode($series_data);
		
		
		// foreach ($bulan as $key=>$each)
		// {		
				// echo $each['id'] ;
        // // $bulan[$key]              = $this->db->select('count(*)')->$this->db->where('MONTH(`date`)', $each['id'])->get('doc')->row_array();
        // // $data[$key]['artwork']   = $this->db->where('idjob', $each['idjob'])->get('artwork')->result_array();  
		// }

		// $jml = $this->db->query("SELECT
			// count(*)
		// FROM
			// doc
		// WHERE
			// MONTH (`date`) = bulan.id
		// AND YEAR (`date`) = '2014'
		// AND coa_id = '302'");

		// $jml = $jml->result();
		// array_push($bulan,$jml);

			// $category = array();
		// $category['finance'] = array(
										// "finance"    => 1,
										// "finance"  => 2,
										// "finance"  => 3,
										// "finance" => 4,
								// );
		// array_push($data,$category);
		
		// foreach ($data as $key=>$each)
		// {				
        // $data[$key]   = $row->bulan;
        // $data[$key][$row->bulan]	= $this->db->select('count(*) as test')->get('doc_type')->row_array();
        // // $data[$key]              = $this->db->where('doc_type', $each['doc_type'])->get('doc_type')->row_array();
        // // $data[$key]['artwork']   = $this->db->where('idjob', $each['idjob'])->get('artwork')->result_array();  
		// }
		echo json_encode($series_data,JSON_NUMERIC_CHECK);
		
		// $data   = $this->db->get('job')->result_array();
    // foreach( $data as $key=>$each ){
        // $data[$key]              = $this->db->where('idadministrator', $each['idadministrator'])->get('administrator')->row_array();
        // $data[$key]['artwork']   = $this->db->where('idjob', $each['idjob'])->get('artwork')->result_array();  
    // }
    // return $data;
		
		// $json = $query->result();		
		// echo json_encode($json,JSON_NUMERIC_CHECK);	
		
		// foreach ($query->result() as $row)
		// {
						// echo $row->bulan;
						// echo array($row->name);
						// echo $row->body;
		// }
	
		// if(!empty($this->input->get("q"))){
			// $this->db->like('coa', $this->input->get("q"));
		// }
		// $query = $this->db->select("	bulan,
	// (
		// SELECT
			// count(*)
		// FROM
			// doc
		// WHERE
			// MONTH (`date`) = bulan.id
		// AND YEAR (`date`) = '2014'
		// AND coa_id = '302'
	// ) AS 'data'
	// ")
					// ->get("bulan");
		// $json = $query->result();			

		// echo json_encode($json,JSON_NUMERIC_CHECK);	
		// // echo '[{"name":"golfers"},{"data":[5.7879,6.6286,6.1724,5.3125,7.1481,6.1333,4.5769]}]';
		// // echo '[{
            // // "name": "John",
            // // "data": [5, 3, 4, 7, 2]
        // // }, {
            // // "name": "Jane",
            // // "data": [2, 2, 3, 2, 1]
        // // }, {
            // // "name": "Joe",
            // // "data": [3, 4, 4, 2, 5]
        // // }]';
	}

	function expire_unit(){
		$meta = array(
            'activeMenu' => 'laporan', // laporan
            'activeTab' => 'expire_unit' //expire_unit
        );	
	   if($this->input->get('year')){ $year = $this->input->get('year'); } else { $year = date('Y'); }
	   if($this->input->get('week')){ $week = $this->input->get('week'); } else { $week = date('W'); } 
	   if($this->input->get('month')){ $month = $this->input->get('month'); } else { $month = date('m', strtotime($year.'W'.$week)); }
	   
	   $this->form_validation->set_rules('comment', $this->lang->line("comment"), 'xss_clean');
	  
	  if ($this->form_validation->run() == true)
		{ 
			$comment = $this->ion_auth->clear_tags($this->input->post('comment'));
			echo $comment; die('');
		}
	  
	  if ( $this->form_validation->run() == true && $this->home_model->updateComment($comment) )
		{ 
				$this->session->set_flashdata('success_message', $this->lang->line("comment_updated"));
				header('location:'.base_url().'home');	
		}
		else
		{ 

	  
	  $data['message'] = (validation_errors() ? validation_errors() : $this->session->flashdata('message'));
	  $data['success_message'] = $this->session->flashdata('success_message');
	  $config['translated_day_names'] = array($this->lang->line("sunday"), $this->lang->line("monday"), $this->lang->line("tuesday"), $this->lang->line("wednesday"), $this->lang->line("thursday"), $this->lang->line("friday"), $this->lang->line("saturday"));
	  $config['translated_month_names'] = array('01' => $this->lang->line("january"), '02' => $this->lang->line("february"), '03' => $this->lang->line("march"), '04' => $this->lang->line("april"), '05' => $this->lang->line("may"), '06' => $this->lang->line("june"), '07' => $this->lang->line("july"), '08' => $this->lang->line("august"), '09' => $this->lang->line("september"), '10' => $this->lang->line("october"), '11' => $this->lang->line("november"), '12' => $this->lang->line("december"));
		
	  $config['template'] = '

   			{table_open}<table border="0" cellpadding="0" cellspacing="0" class="table table-bordered" style="margin-top: 10px;">{/table_open}
			
			{heading_row_start}<tr>{/heading_row_start}
			
			{heading_previous_cell}<th><a href="{previous_url}">&lt;&lt;</a></th>{/heading_previous_cell}
			{heading_title_cell}<th colspan="{colspan}" style="text-align:center;">{heading}</th>{/heading_title_cell}
			{heading_next_cell}<th><a href="{next_url}">&gt;&gt;</a></th>{/heading_next_cell}
			
			{heading_row_end}</tr>{/heading_row_end}
			
			{week_row_start}<tr>{/week_row_start}
			{week_day_cell}<td class="cl_wday">{week_day}</td>{/week_day_cell}
			{week_row_end}</tr>{/week_row_end}
			
			{cal_row_start}<tr class="days">{/cal_row_start}
			{cal_cell_start}<td class="day">{/cal_cell_start}
			
			{cal_cell_content}
				<div class="day_num">{day}</div>
				<div class="content">{content}</div>
			{/cal_cell_content}
			{cal_cell_content_today}
				<div class="day_num highlight">{day}</div>
				<div class="content">{content}</div>
			{/cal_cell_content_today}
			
			{cal_cell_no_content}<div class="day_num">{day}</div>{/cal_cell_no_content}
			{cal_cell_no_content_today}<div class="day_num highlight">{day}</div>{/cal_cell_no_content_today}
			
			{cal_cell_blank}&nbsp;{/cal_cell_blank}
			
			{cal_cell_end}</td>{/cal_cell_end}
			{cal_row_end}</tr>{/cal_row_end}
			
			{table_close}</table>{/table_close}';

		
		$this->load->library('week_cal', $config);
		
		
	   $cal_data = $this->home_model->get_calendar_data($year, $month);
	   $data['calendar'] = $this->week_cal->generateWeek($week, $year, $month, $cal_data);
	   
	  $data['com'] = $this->home_model->getComment();	
		
      $meta['page_title'] = $this->lang->line("welcome")." ".SITE_NAME."";
      $data['page_title'] = "Expired Unit Dokumentation";
	  // $data['page_title'] = $this->lang->line("welcome")." ".SITE_NAME."";

      $this->load->view('commons/header', $meta);
      $this->load->view('expire_unit', $data);
      // $this->load->view('content', $data);
      $this->load->view('commons/footer-home');
   	}		 
	 }

	 function expire_supir(){
		$meta = array(
            'activeMenu' => 'laporan', // laporan
            'activeTab' => 'expire_supir' //expire_unit
        );	
	   if($this->input->get('year')){ $year = $this->input->get('year'); } else { $year = date('Y'); }
	   if($this->input->get('week')){ $week = $this->input->get('week'); } else { $week = date('W'); } 
	   if($this->input->get('month')){ $month = $this->input->get('month'); } else { $month = date('m', strtotime($year.'W'.$week)); }
	   
	   $this->form_validation->set_rules('comment', $this->lang->line("comment"), 'xss_clean');
	  
	  if ($this->form_validation->run() == true)
		{ 
			$comment = $this->ion_auth->clear_tags($this->input->post('comment'));
			echo $comment; die('');
		}
	  
	  if ( $this->form_validation->run() == true && $this->home_model->updateComment($comment) )
		{ 
				$this->session->set_flashdata('success_message', $this->lang->line("comment_updated"));
				header('location:'.base_url().'home');	
		}
		else
		{ 

	  
	  $data['message'] = (validation_errors() ? validation_errors() : $this->session->flashdata('message'));
	  $data['success_message'] = $this->session->flashdata('success_message');
	  $config['translated_day_names'] = array($this->lang->line("sunday"), $this->lang->line("monday"), $this->lang->line("tuesday"), $this->lang->line("wednesday"), $this->lang->line("thursday"), $this->lang->line("friday"), $this->lang->line("saturday"));
	  $config['translated_month_names'] = array('01' => $this->lang->line("january"), '02' => $this->lang->line("february"), '03' => $this->lang->line("march"), '04' => $this->lang->line("april"), '05' => $this->lang->line("may"), '06' => $this->lang->line("june"), '07' => $this->lang->line("july"), '08' => $this->lang->line("august"), '09' => $this->lang->line("september"), '10' => $this->lang->line("october"), '11' => $this->lang->line("november"), '12' => $this->lang->line("december"));
		
	  $config['template'] = '

   			{table_open}<table border="0" cellpadding="0" cellspacing="0" class="table table-bordered" style="margin-top: 10px;">{/table_open}
			
			{heading_row_start}<tr>{/heading_row_start}
			
			{heading_previous_cell}<th><a href="{previous_url}">&lt;&lt;</a></th>{/heading_previous_cell}
			{heading_title_cell}<th colspan="{colspan}" style="text-align:center;">{heading}</th>{/heading_title_cell}
			{heading_next_cell}<th><a href="{next_url}">&gt;&gt;</a></th>{/heading_next_cell}
			
			{heading_row_end}</tr>{/heading_row_end}
			
			{week_row_start}<tr>{/week_row_start}
			{week_day_cell}<td class="cl_wday">{week_day}</td>{/week_day_cell}
			{week_row_end}</tr>{/week_row_end}
			
			{cal_row_start}<tr class="days">{/cal_row_start}
			{cal_cell_start}<td class="day">{/cal_cell_start}
			
			{cal_cell_content}
				<div class="day_num">{day}</div>
				<div class="content">{content}</div>
			{/cal_cell_content}
			{cal_cell_content_today}
				<div class="day_num highlight">{day}</div>
				<div class="content">{content}</div>
			{/cal_cell_content_today}
			
			{cal_cell_no_content}<div class="day_num">{day}</div>{/cal_cell_no_content}
			{cal_cell_no_content_today}<div class="day_num highlight">{day}</div>{/cal_cell_no_content_today}
			
			{cal_cell_blank}&nbsp;{/cal_cell_blank}
			
			{cal_cell_end}</td>{/cal_cell_end}
			{cal_row_end}</tr>{/cal_row_end}
			
			{table_close}</table>{/table_close}';

		
		$this->load->library('week_cal', $config);
		
		
	   $cal_data = $this->home_model->get_calendar_data($year, $month);
	   $data['calendar'] = $this->week_cal->generateWeek($week, $year, $month, $cal_data);
	   
	  $data['com'] = $this->home_model->getComment();	
		
      $meta['page_title'] = $this->lang->line("welcome")." ".SITE_NAME."";
      $data['page_title'] = "Expired Supir Dokumen";
	  // $data['page_title'] = $this->lang->line("welcome")." ".SITE_NAME."";

      $this->load->view('commons/header', $meta);
      $this->load->view('expire_supir', $data);
      // $this->load->view('content', $data);
      $this->load->view('commons/footer-home');
   	}		 
	 }

   function update_comment()
   {
	   $this->form_validation->set_rules('comment', $this->lang->line("comment"), 'xss_clean');
	  
	  if ($this->form_validation->run() == true)
		{ 
			$comment = $this->ion_auth->clear_tags($this->input->post('comment'));
		}
	  
	  if ( $this->form_validation->run() == true && $this->home_model->updateComment($comment) )
		{ 
				$this->session->set_flashdata('success_message', $this->lang->line("comment_updated"));
				header('location:'.base_url().'home');	
	
		}
   }
   
   function image_upload()
   {
		$_FILES['file'] = 'C:\Users\Akbar\Pictures\2015-02-23_112453.jpg';
	 
			if(DEMO) { 
				$error = array('error' => $this->lang->line('disabled_in_demo'));
				echo json_encode($error);
				exit;
			}
		
		$this->security->csrf_verify(); 	
		if(isset($_FILES['file'])){
				
		$this->load->library('upload_photo');
		
		$config['upload_path'] = 'assets/uploads/images/'; 
		$config['allowed_types'] = 'gif|jpg|png|jpeg'; 
		$config['max_size'] = '500';
		$config['max_width'] = '800';
		$config['max_height'] = '800';
		$config['overwrite'] = FALSE; 
		
			$this->upload_photo->initialize($config);
			
			if( ! $this->upload_photo->do_upload('file')){

				$error = $this->upload_photo->display_errors();
				$error = array('error' => $error);
				echo json_encode($error);
				exit;

			} 
		
		$photo = $this->upload_photo->file_name;
		$array = array(
        	'filelink' => base_url().'assets/uploads/images/'.$photo
		);
	
		echo stripslashes(json_encode($array));
		exit;
		
		} else {
			$error = array('error' => 'No file selected to upload!');
			echo json_encode($error);
			exit;
		}
   	  
   }
   
   function language($lang = false){
	    if($this->input->get('lang')){ $lang = $this->input->get('lang'); }
		$this->load->helper('cookie');
		$folder = 'inv/language/';
		$languagefiles = scandir($folder);
		if(in_array($lang, $languagefiles)){
		//setcookie("sma_language", $lang, '31536000');
		$cookie = array(
                   'name'   => 'language',
                   'value'  => $lang,
                   'expire' => '31536000',
				   'prefix' => 'sma_',
				   'secure' => false
               );
 
		$this->input->set_cookie($cookie);
		}
		redirect($_SERVER["HTTP_REFERER"]); 
	}
	
   function getdatatableajax()
   {
		// if($this->_is_ajax()){
			$this->load->library('datatables'); 
			$this->datatables
			->select("nomor_unit,
					bussiness_unit,
					jenis_surat,
					maxdate,
					hari,
					status,
					warna")
			->from("v_expire_unit")
			->add_column("maxdate",
			'<center>			
				<span class="label $3 label-mini">$2</span>
			</center>', "id,status_invoice,label_type")
			->add_column("Actions", 
			'<center>			
				<a class="btn btn-success btn-xs" title="View" href="'.base_url().'inquiry/view/$1/$2"><i class="fa fa-eye"></i></a>
			</center>', "")
			->unset_column('');


			echo $this->datatables->generate();
   }

   function get_expire_supir()
   {
		// if($this->_is_ajax()){
			$this->load->library('datatables'); 
			$this->datatables
			->select("nama_supir,
					jenis_surat,
					maxdate,
					hari")
			->from("v_expire_supir")
			->add_column("maxdate",
			'<center>			
				<span class="label $3 label-mini">$2</span>
			</center>', "id,status_invoice,label_type")
			->add_column("Actions", 
			'<center>			
				<a class="btn btn-success btn-xs" title="View" href="'.base_url().'inquiry/view/$1/$2"><i class="fa fa-eye"></i></a>
			</center>', "")
			->unset_column('');


			echo $this->datatables->generate();
   }
	 
 function grafikss($tahun)
 {
  // $tahun = date("Y");
  $revenue = $this->db->query("

		select 
		sum(IF(Bulan=1,Total,0)) as `Revenue Januari`,
		sum(IF(Bulan=2,Total,0)) as `Revenue Februari`,
		sum(IF(Bulan=3,Total,0)) as `Revenue Maret`,
		sum(IF(Bulan=4,Total,0)) as `Revenue April`,
		sum(IF(Bulan=5,Total,0)) as `Revenue Mei`,
		sum(IF(Bulan=6,Total,0)) as `Revenue Juni`,
		sum(IF(Bulan=7,Total,0)) as `Revenue Juli`,
		sum(IF(Bulan=8,Total,0)) as `Revenue Agustus`,
		sum(IF(Bulan=9,Total,0)) as `Revenue September`,
		sum(IF(Bulan=10,Total,0)) as `Revenue Oktober`,
		sum(IF(Bulan=11,Total,0)) as `Revenue November`,
		sum(IF(Bulan=12,Total,0)) as `Revenue Desember`
		from v_revenue_total where Tahun = '".$tahun."' group by Tahun;	
  ");

	foreach($revenue->result_array() as $row){
		$data['grafik'][]=(float)$row['Revenue Januari'];
		$data['grafik'][]=(float)$row['Revenue Februari'];
		$data['grafik'][]=(float)$row['Revenue Maret'];
		$data['grafik'][]=(float)$row['Revenue April'];
		$data['grafik'][]=(float)$row['Revenue Mei'];
		$data['grafik'][]=(float)$row['Revenue Juni'];
		$data['grafik'][]=(float)$row['Revenue Juli'];
		$data['grafik'][]=(float)$row['Revenue Agustus'];
		$data['grafik'][]=(float)$row['Revenue September'];
		$data['grafik'][]=(float)$row['Revenue Oktober'];
		$data['grafik'][]=(float)$row['Revenue November'];
		$data['grafik'][]=(float)$row['Revenue Desember'];
	}

  $cost = $this->db->query("
   
		select 
		sum(IF(Bulan=1,Total,0)) as `Cost Januari`,
		sum(IF(Bulan=2,Total,0)) as `Cost Februari`,
		sum(IF(Bulan=3,Total,0)) as `Cost Maret`,
		sum(IF(Bulan=4,Total,0)) as `Cost April`,
		sum(IF(Bulan=5,Total,0)) as `Cost Mei`,
		sum(IF(Bulan=6,Total,0)) as `Cost Juni`,
		sum(IF(Bulan=7,Total,0)) as `Cost Juli`,
		sum(IF(Bulan=8,Total,0)) as `Cost Agustus`,
		sum(IF(Bulan=9,Total,0)) as `Cost September`,
		sum(IF(Bulan=10,Total,0)) as `Cost Oktober`,
		sum(IF(Bulan=11,Total,0)) as `Cost November`,
		sum(IF(Bulan=12,Total,0)) as `Cost Desember`
		from v_ujo_komisi_total where Tahun = '".$tahun."' group by Tahun;

  ");
   
			foreach($cost->result_array() as $row){
				$data['grafik2'][]=(float)$row['Cost Januari'];
				$data['grafik2'][]=(float)$row['Cost Februari'];
				$data['grafik2'][]=(float)$row['Cost Maret'];
				$data['grafik2'][]=(float)$row['Cost April'];
				$data['grafik2'][]=(float)$row['Cost Mei'];
				$data['grafik2'][]=(float)$row['Cost Juni'];
				$data['grafik2'][]=(float)$row['Cost Juli'];
				$data['grafik2'][]=(float)$row['Cost Agustus'];
				$data['grafik2'][]=(float)$row['Cost September'];
				$data['grafik2'][]=(float)$row['Cost Oktober'];
				$data['grafik2'][]=(float)$row['Cost November'];
				$data['grafik2'][]=(float)$row['Cost Desember'];
			}

	
  $maintenance = $this->db->query("
   
		select 
		sum(IF(Bulan=1,Total,0)) as `Mtc Januari`,
		sum(IF(Bulan=2,Total,0)) as `Mtc Februari`,
		sum(IF(Bulan=3,Total,0)) as `Mtc Maret`,
		sum(IF(Bulan=4,Total,0)) as `Mtc April`,
		sum(IF(Bulan=5,Total,0)) as `Mtc Mei`,
		sum(IF(Bulan=6,Total,0)) as `Mtc Juni`,
		sum(IF(Bulan=7,Total,0)) as `Mtc Juli`,
		sum(IF(Bulan=8,Total,0)) as `Mtc Agustus`,
		sum(IF(Bulan=9,Total,0)) as `Mtc September`,
		sum(IF(Bulan=10,Total,0)) as `Mtc Oktober`,
		sum(IF(Bulan=11,Total,0)) as `Mtc November`,
		sum(IF(Bulan=12,Total,0)) as `Mtc Desember`
		from v_maintenance_total where Tahun = '".$tahun."' group by Tahun;
		
  ");
   
	foreach($maintenance->result_array() as $row){
		$data['grafik3'][]=(float)$row['Mtc Januari'];
		$data['grafik3'][]=(float)$row['Mtc Februari'];
		$data['grafik3'][]=(float)$row['Mtc Maret'];
		$data['grafik3'][]=(float)$row['Mtc April'];
		$data['grafik3'][]=(float)$row['Mtc Mei'];
		$data['grafik3'][]=(float)$row['Mtc Juni'];
		$data['grafik3'][]=(float)$row['Mtc Juli'];
		$data['grafik3'][]=(float)$row['Mtc Agustus'];
		$data['grafik3'][]=(float)$row['Mtc September'];
		$data['grafik3'][]=(float)$row['Mtc Oktober'];
		$data['grafik3'][]=(float)$row['Mtc November'];
		$data['grafik3'][]=(float)$row['Mtc Desember'];
	}

  print_r('{"revenue":'.json_encode($data['grafik']).',');
	print_r('"cost":'.json_encode($data['grafik2']).',');			
	print_r('"maintenance":'.json_encode($data['grafik3']).'}');			
   
 }
 

 function profit($tahun)
 {
   
  $profit = $this->db->query("
   
  select
  ifnull((SELECT sum(profit) FROM (v_revenue_cost_maintenance_profit)WHERE((month_maintenance=1)AND (year_ujo=".$tahun."))),0) AS `Profit Januari`,
  ifnull((SELECT sum(profit) FROM (v_revenue_cost_maintenance_profit)WHERE((month_maintenance=2)AND (year_ujo=".$tahun."))),0) AS `Profit Februari`,
  ifnull((SELECT sum(profit) FROM (v_revenue_cost_maintenance_profit)WHERE((month_maintenance=3)AND (year_ujo=".$tahun."))),0) AS `Profit Maret`,
  ifnull((SELECT sum(profit) FROM (v_revenue_cost_maintenance_profit)WHERE((month_maintenance=4)AND (year_ujo=".$tahun."))),0) AS `Profit April`,
  ifnull((SELECT sum(profit) FROM (v_revenue_cost_maintenance_profit)WHERE((month_maintenance=5)AND (year_ujo=".$tahun."))),0) AS `Profit Mei`,
  ifnull((SELECT sum(profit) FROM (v_revenue_cost_maintenance_profit)WHERE((month_maintenance=6)AND (year_ujo=".$tahun."))),0) AS `Profit Juni`,
  ifnull((SELECT sum(profit) FROM (v_revenue_cost_maintenance_profit)WHERE((month_maintenance=7)AND (year_ujo=".$tahun."))),0) AS `Profit Juli`,
  ifnull((SELECT sum(profit) FROM (v_revenue_cost_maintenance_profit)WHERE((month_maintenance=8)AND (year_ujo=".$tahun."))),0) AS `Profit Agustus`,
  ifnull((SELECT sum(profit) FROM (v_revenue_cost_maintenance_profit)WHERE((month_maintenance=9)AND (year_ujo=".$tahun."))),0) AS `Profit September`,
  ifnull((SELECT sum(profit) FROM (v_revenue_cost_maintenance_profit)WHERE((month_maintenance=10)AND (year_ujo=".$tahun."))),0) AS `Profit Oktober`,
  ifnull((SELECT sum(profit) FROM (v_revenue_cost_maintenance_profit)WHERE((month_maintenance=11)AND (year_ujo=".$tahun."))),0) AS `Profit November`,
  ifnull((SELECT sum(profit) FROM (v_revenue_cost_maintenance_profit)WHERE((month_maintenance=12)AND (year_ujo=".$tahun."))),0) AS `Profit Desember`
  from v_revenue_cost_maintenance_profit GROUP BY year_ujo
  ");
   
			foreach($profit->result_array() as $row){
				$data['grafik1'][]=(float)$row['Profit Januari'];
				$data['grafik1'][]=(float)$row['Profit Februari'];
				$data['grafik1'][]=(float)$row['Profit Maret'];
				$data['grafik1'][]=(float)$row['Profit April'];
				$data['grafik1'][]=(float)$row['Profit Mei'];
				$data['grafik1'][]=(float)$row['Profit Juni'];
				$data['grafik1'][]=(float)$row['Profit Juli'];
				$data['grafik1'][]=(float)$row['Profit Agustus'];
				$data['grafik1'][]=(float)$row['Profit September'];
				$data['grafik1'][]=(float)$row['Profit Oktober'];
				$data['grafik1'][]=(float)$row['Profit November'];
				$data['grafik1'][]=(float)$row['Profit Desember'];
			}

	echo('<pre>');
  print_r($data['grafik1']);
	echo('<pre>');
			
   
 }	 
}

/* End of file home.php */ 
/* Location: ./sma/modules/home/controllers/home.php */