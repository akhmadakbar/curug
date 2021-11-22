<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Master extends CI_Controller
{
  function __construct(){
		parent::__construct();
		$this->load->helper('url','language');
		$this->load->library(array('ion_auth','form_validation'));
		if(!$this->ion_auth->logged_in()){
			// save the redirect_back data from referral url (where user first was prior to login)
			$this->session->set_userdata('last_page', current_url());
			redirect('auth/login');
	  	}
		$group = array('admin','members');
		if(!$this->ion_auth->in_group($group)){
			$this->session->set_flashdata('message', 'You must be an admin and member to view Master COA page');
			redirect('home');
	  	}
	}
    public function coa()
    {
        $this->load->helper('xcrud');
        $xcrud = xcrud_get_instance();
        $xcrud->table('coa');
				$xcrud->table_name('Data C.O.A');
				$xcrud->label(array('coa_id' => 'C.O.A Code'));
				$xcrud->label(array('coa' => 'C.O.A'));
				$plant = $xcrud->nested_table('Doc Type','coa_id','doc_type','coa_id'); // 2nd level
				$plant->order_by('doc_type');
				$plant->columns('doc_type');
				$plant->fields('doc_type');
				// $plant = $xcrud->nested_table('Plant','customer_id','tbl_plant','customer_id'); // 2nd level
				// $plant->order_by('plant');
				// $plant->columns('plant');
				// $plant->fields('plant');
				// $plant->unset_title();
				// $plant->default_tab('Plant');
				// $plant->table_name('Plant');
				// $plant_city = $plant->nested_table('City','plant_id','tbl_plant_city','plant_id'); // 2nd level
				// $plant_city->order_by('city_id');
				// $plant_city->columns('city_id');
				// $plant_city->fields('city_id');
				// $plant_city->relation('city_id','tbl_city','city_id','city');			
				// $plant_city->unset_title();
				// $plant_city->default_tab('City');
				// $plant_city->table_name('City');
				
        $data['content'] = $xcrud->render();
        $data['title']="Data C.O.A";
        // $this->template->display('master/customer',$data);

				$meta = array(
								'activeMenu' => 'master',
								'activeTab' => 'coa',
								'page_title' => 'Master - C.O.A',
								'menu' => 'Master',
								'sub_menu' => 'C.O.A',
								'load_js' => 'js.php',
								'load_css' => 'css.php',
								'xcrud_js' => 'y'
						);					
						
				$this->load->view('commons/header', $meta);
				// $this->load->view('expire_unit', $data);
				$this->load->view('master/coa', $data);
				$this->load->view('commons/footer',$meta);
				
    }
    public function customer()
    {
        $this->load->helper('xcrud');
        $xcrud = xcrud_get_instance();
        $xcrud->table('tbl_customer');
				$xcrud->table_name('Data Customer');
				$plant = $xcrud->nested_table('Plant','customer_id','tbl_plant','customer_id'); // 2nd level
				$plant->order_by('plant');
				$plant->columns('plant');
				$plant->fields('plant');
				$plant->unset_title();
				$plant->default_tab('Plant');
				$plant->table_name('Plant');
				$plant_city = $plant->nested_table('City','plant_id','tbl_plant_city','plant_id'); // 2nd level
				$plant_city->order_by('city_id');
				$plant_city->columns('city_id');
				$plant_city->fields('city_id');
				$plant_city->relation('city_id','tbl_city','city_id','city');			
				$plant_city->unset_title();
				$plant_city->default_tab('City');
				$plant_city->table_name('City');
				
        $data['content'] = $xcrud->render();
        $data['title']="Data Customer";
        // $this->template->display('master/customer',$data);
				// $meta = array(
								// 'activeMenu' => 'master', // master
								// 'activeTab' => 'customer' //customer
						// );					
				$meta = array(
								'activeMenu' => 'master',
								'activeTab' => 'coa',
								'page_title' => 'Master - C.O.A',
								'menu' => 'Master',
								'sub_menu' => 'C.O.A',
								'load_js' => 'js.php',
								'load_css' => 'css.php'
						);					
				$this->load->view('commons/header', $meta);
				$this->load->view('master/customer', $data);
				$this->load->view('commons/footer');
				
    }
    public function driver()
    {
			$this->load->helper('xcrud');
			$xcrud = xcrud_get_instance();
			$xcrud->table('tbl_driver');
			$xcrud->table_name('Driver');
			$xcrud->relation('status_karyawan_id','tbl_status_karyawan','status_karyawan_id','status');			
			$data['content'] = $xcrud->render();
			$data['title']="Data Driver";
			$meta = array(
							'activeMenu' => 'master', // master
							'activeTab' => 'driver' //driver
					);					
			$this->load->view('commons/header', $meta);
			$this->load->view('master/driver', $data);
			$this->load->view('commons/footer');
    }
    public function plant()
    {
			$this->load->helper('xcrud');
			$xcrud = xcrud_get_instance();
			$xcrud->table('tbl_plant');
			$xcrud->table_name('Plant');
			$xcrud->relation('customer_id','tbl_customer','customer_id','customer','','customer_id');			
			$xcrud->relation('city_id','tbl_city','city_id','city');
			$xcrud->label(array('customer_id' => 'Customer'));
			$xcrud->label(array('city_id' => 'City'));
			$data['content'] = $xcrud->render();
			$data['title']="Data Plant";
			$meta = array(
							'activeMenu' => 'reference', // master
							'activeTab' => 'plant' //driver
					);					
			$this->load->view('commons/header', $meta);
			$this->load->view('master/plant', $data);
			$this->load->view('commons/footer');
    }
    public function product()
    {
			$this->load->helper('xcrud');
			$xcrud = xcrud_get_instance();
			$xcrud->table('tbl_product');
			$xcrud->table_name('Product');
			$xcrud->relation('customer_id','tbl_customer','customer_id','customer');			
			$xcrud->label(array('customer_id' => 'Customer'));
			$data['content'] = $xcrud->render();
			$data['title']="Data Product";
			$meta = array(
							'activeMenu' => 'master', // master
							'activeTab' => 'product' //product
					);					
			$this->load->view('commons/header', $meta);
			$this->load->view('master/product', $data);
			$this->load->view('commons/footer');
    }
    public function route()
    {
			$this->load->helper('xcrud');
			$xcrud = xcrud_get_instance();
			$xcrud->table('tbl_route');
			$xcrud->table_name('Route');
			$xcrud->relation('customer_id','tbl_customer','customer_id','customer');			
			$xcrud->relation('product_id','tbl_product','product_id','product');
			$xcrud->relation('origin_id','tbl_origin','origin_id','origin');
			$xcrud->relation('city_id','tbl_city','city_id','city');
			$xcrud->relation('cluster_id','tbl_cluster','cluster_id','cluster');
			$xcrud->relation('area_id','tbl_area','area_id','area');
			$xcrud->label(array('customer_id' => 'Customer'));
			$xcrud->label(array('product_id' => 'Product'));
			$xcrud->label(array('origin_id' => 'Origin'));
			$xcrud->label(array('city_id' => 'City'));
			$xcrud->label(array('cluster_id' => 'Cluster'));
			$xcrud->label(array('area_id' => 'Area'));
			$data['content'] = $xcrud->render();
			$data['title']="Data Route";
			$meta = array(
							'activeMenu' => 'reference', // master
							'activeTab' => 'route' //route
					);					
			$this->load->view('commons/header', $meta);
			$this->load->view('master/route', $data);
			$this->load->view('commons/footer');
    }
    public function tarif()
    {
			$this->load->helper('xcrud');
			$xcrud = xcrud_get_instance();
			$xcrud->table('tbl_tarif');
			$xcrud->table_name('Tarif Customer');
			$xcrud->relation('customer_id','tbl_customer','customer_id','customer');			
			$xcrud->relation('product_id','tbl_product','product_id','product');
			$xcrud->relation('origin_id','tbl_origin','origin_id','origin');
			$xcrud->relation('cluster_id','tbl_cluster','cluster_id','cluster');
			$xcrud->relation('city_id','tbl_city','city_id','city');
			$xcrud->relation('trucktype_id','tbl_trucktype','trucktype_id','trucktype');
			$xcrud->label(array('customer_id' => 'Customer'));
			$xcrud->label(array('product_id' => 'Product'));
			$xcrud->label(array('origin_id' => 'Origin'));
			$xcrud->label(array('cluster_id' => 'Cluster'));
			$xcrud->label(array('city_id' => 'City'));
			$xcrud->label(array('trucktype_id' => 'Truck Type'));
			$xcrud->change_type('opt_tarif','radio','Tujuan','Tujuan,Balikan');
			$data['content'] = $xcrud->render();
			$data['title']="Data Tarif";
			$meta = array(
							'activeMenu' => 'master', // master
							'activeTab' => 'tarif' //tarif
					);					
			$this->load->view('commons/header', $meta);
			$this->load->view('master/tarif', $data);
			$this->load->view('commons/footer');
    }
    public function origin()
    {
			$this->load->helper('xcrud');
			$xcrud = xcrud_get_instance();
			$xcrud->table('tbl_origin');
			$xcrud->table_name('Origin');
			// $xcrud->columns('ujo_id,product_id,origin_id,plant_id,city_id,trucktype_id,km,rasio,tiup,toleransi,fuel,total_fuel,tol,meal,retribusi,mel,ujo,komisi,tonnage,point,tarif');
			// $xcrud->fields('ujo_id,product_id,origin_id,plant_id,city_id,trucktype_id',false,'Vehicle');
			// $xcrud->fields('km,rasio,tiup,toleransi,fuel,ujo,komisi,tonnage,point,tarif',false,'Fuel');
			// $xcrud->fields('total_fuel,tol,meal,retribusi,mel',false,'UJO Component');
			// // $xcrud->relation('product_trucktype_id','v_trucktype','product_trucktype_id',array('trucktype','trucktype_holcim','product'),'','','','-');
			// $xcrud->relation('trucktype_id','tbl_trucktype','trucktype_id','trucktype');
			// $xcrud->relation('product_id','tbl_product','product_id','product');
			// $xcrud->relation('origin_id','tbl_origin','origin_id','origin');
			// $xcrud->relation('city_id','tbl_city','city_id','city');
			// // $xcrud->relation('plant_id','v_plant','plant_id',array('plant','city'),'','','','-');
			// $xcrud->relation('plant_id','v_plant','plant_id','plant','','','','-');
			// $xcrud->label(array('product_trucktype_id' => 'Product Truck Type'));
			// $xcrud->label(array('origin_id' => 'Origin'));
			// $xcrud->label(array('plant_id' => 'Plant'));
			$data['content'] = $xcrud->render();
			$data['title']="Data Origin";
			$meta = array(
							'activeMenu' => 'master', // master
							'activeTab' => 'origin' //ujo
					);					
			$this->load->view('commons/header', $meta);
			$this->load->view('master/ujo', $data);
			$this->load->view('commons/footer');
    }
    public function city()
    {
			$this->load->helper('xcrud');
			$xcrud = xcrud_get_instance();
			$xcrud->table('tbl_city');
			$xcrud->table_name('City');
			$xcrud->relation('cluster_id','tbl_cluster','cluster_id','cluster');
			$xcrud->label(array('cluster_id' => 'Cluster'));
			$data['content'] = $xcrud->render();
			$data['title']="Data City";
			$meta = array(
							'activeMenu' => 'master', // master
							'activeTab' => 'city' //ujo
					);					
			$this->load->view('commons/header', $meta);
			$this->load->view('master/ujo', $data);
			$this->load->view('commons/footer');
    }
    public function ujo()
    {
			$this->load->helper('xcrud');
			$xcrud = xcrud_get_instance();
			$xcrud->table('tbl_ujo');
			$xcrud->table_name('UJO');
			$xcrud->where('active =', '1');
			$xcrud->columns('ujo_id,product_id,origin_id,plant_id,city_id,trucktype_id,km,rasio,tiup,toleransi,fuel,total_fuel,tol,meal,retribusi,mel,ujo,komisi,tonnage,point,tarif');
			$xcrud->fields('ujo_id,product_id,origin_id,plant_id,city_id,trucktype_id,opt_tarif,active',false,'Vehicle');
			$xcrud->fields('km,rasio,tiup,toleransi,fuel,ujo,komisi,tonnage,point,tarif',false,'Fuel');
			$xcrud->fields('total_fuel,tol,meal,retribusi,mel',false,'UJO Component');
			$xcrud->fields('ppli_shb,ppli_koord',false,'PPLI');
			// $xcrud->relation('product_trucktype_id','v_trucktype','product_trucktype_id',array('trucktype','trucktype_holcim','product'),'','','','-');
			$xcrud->relation('trucktype_id','tbl_trucktype','trucktype_id','trucktype');
			$xcrud->relation('product_id','tbl_product','product_id','product');
			$xcrud->relation('origin_id','tbl_origin','origin_id','origin');
			$xcrud->relation('city_id','tbl_city','city_id','city');
			// $xcrud->relation('plant_id','v_plant','plant_id',array('plant','city'),'','','','-');
			$xcrud->relation('plant_id','v_plant','plant_id','plant','','','','-');
			$xcrud->label(array('product_trucktype_id' => 'Product Truck Type'));
			$xcrud->label(array('origin_id' => 'Origin'));
			$xcrud->label(array('plant_id' => 'Plant'));
			$xcrud->change_type('opt_tarif','radio','Tujuan',array('values'=>'Tujuan, Balikan'));
			$xcrud->change_type('tarif','password');
			$data['content'] = $xcrud->render();
			$data['title']="Data UJO";
			$meta = array(
							'activeMenu' => 'master', // master
							'activeTab' => 'm_ujo' //ujo
					);					
			$this->load->view('commons/header', $meta);
			$this->load->view('master/ujo', $data);
			$this->load->view('commons/footer');
    }
    public function vehicle()
    {
			$this->load->helper('xcrud');
			$xcrud = xcrud_get_instance();
			$xcrud->table('tbl_vehicle');
			$xcrud->table_name('Vehicle');
			$xcrud->columns('nopol,trucktype_id,License,Expired,NearestExp');
			// $xcrud->unset_edit(true,'username','=','admin'); // 'admin' row can't be editable
			$xcrud->subselect('License','SELECT GROUP_CONCAT(jenis_surat SEPARATOR ", ") FROM tbl_vehicle_license WHERE nopol_id = {nopol_id}');
			$xcrud->subselect('Expired','SELECT GROUP_CONCAT(tgl_expired SEPARATOR ", ") FROM tbl_vehicle_license WHERE nopol_id = {nopol_id}');
			$xcrud->subselect('NearestExp','SELECT tgl_expired FROM tbl_vehicle_license WHERE nopol_id = {nopol_id} ORDER BY tgl_expired LIMIT 1');
			$xcrud->highlight_row('NearestExp','=',date('Y-m-d'),'red');
			$xcrud->fields('nopol,trucktype_id,active');
			$xcrud->change_type('active', 'checkboxes', '', array('1'=>'Yes', '0'=>'No'));
			$xcrud->unset_remove();
			$xcrud->relation('trucktype_id','tbl_trucktype','trucktype_id','trucktype');
			$xcrud->label(array('trucktype_id' => 'Truck Type'));
			
			$mst_unit_surat = $xcrud->nested_table('Dokumentasi','nopol_id','tbl_vehicle_license','nopol_id'); // 2nd level
			$mst_unit_surat->unset_title();
			$mst_unit_surat->default_tab('Detail Information');
			$mst_unit_surat->table_name('Detail Material');
			$mst_unit_surat->columns('jenis_surat,tgl_expired,attachment,attachment_2,attachment_3,status');
			$mst_unit_surat->create_action('action_menunggu', 'action_menunggu');
			$mst_unit_surat->button('#', 'action_menunggu', 'icon-close glyphicon glyphicon-star', 'xcrud-action', 
									array(  // set action vars to the button
									'data-task' => 'action',
									'data-action' => 'action_menunggu',
									'data-primary' => '{vehicle_license_id}'), 
									array(  // set condition ( when button must be shown)
									'status',
									'!=',
									'Menunggu')
									);
			$mst_unit_surat->fields('jenis_surat,no_dokumen,tgl_expired,attachment,attachment_2,attachment_3');
			$mst_unit_surat->change_type('attachment', 'image');
			$mst_unit_surat->change_type('attachment_2', 'image');
			$mst_unit_surat->change_type('attachment_3', 'file', '', array('not_rename'=>true));
			$mst_unit_surat->pass_var('create_user', USER_NAME, 'create');
			$mst_unit_surat->pass_var('create_date', date('Y-m-d H:i:s'), 'create');
			$mst_unit_surat->pass_var('modify_user', USER_NAME, 'edit');			
			$mst_unit_surat->pass_var('modify_date', date('Y-m-d H:i:s'), 'edit');	
			$mst_unit_surat->after_insert('update_surat'); //UPDATE STATUS SURAT YANG LAMA MENJADI 'SELESAI' DAN IS_CURRENT MENJADI 'N'
			
			$data['content'] = $xcrud->render();
			$data['title']="Data Vehicle	";
			$meta = array(
							'activeMenu' => 'master', // master
							'activeTab' => 'vehicle' //vehicle
					);					
			$this->load->view('commons/header', $meta);
			$this->load->view('master/vehicle', $data);
			$this->load->view('commons/footer');
    }
    public function trucktype()
    {
			$this->load->helper('xcrud');
			$xcrud = xcrud_get_instance();
			$xcrud->table('tbl_trucktype');
			$xcrud->table_name('Truck Type');
			$data['content'] = $xcrud->render();
			$data['title']="Data Product";
			$meta = array(
							'activeMenu' => 'master', // master
							'activeTab' => 'trucktype' //trucktype
					);					
			$this->load->view('commons/header', $meta);
			$this->load->view('master/trucktype', $data);
			$this->load->view('commons/footer');
    }
    public function product_trucktype()
    {
			$this->load->helper('xcrud');
			$xcrud = xcrud_get_instance();
			$xcrud->table('tbl_product_trucktype');
			$xcrud->table_name('Product / Truck Type');
			$xcrud->relation('product_id','tbl_product','product_id','product');
			$xcrud->relation('trucktype_id','tbl_trucktype','trucktype_id','trucktype');
			$xcrud->label(array('product_id' => 'Product'));
			$xcrud->label(array('trucktype_id' => 'Truck Type'));
			$data['content'] = $xcrud->render();
			$data['title']="Data Product";
			$meta = array(
							'activeMenu' => 'reference', // master
							'activeTab' => 'product_trucktype' //trucktype
					);					
			$this->load->view('commons/header', $meta);
			$this->load->view('master/product_trucktype', $data);
			$this->load->view('commons/footer');
    }
    public function other()
    {
        $this->load->helper('xcrud');
        $xcrud = xcrud_get_instance();
        $xcrud->table('tbl_other');
				$xcrud->table_name('Data Other');
        $data['content'] = $xcrud->render();
        $data['title']="Data Other";
        // $this->template->display('master/customer',$data);
				$meta = array(
								'activeMenu' => 'master', // master
								'activeTab' => 'other' //customer
						);					
				$this->load->view('commons/header', $meta);
				$this->load->view('master/other', $data);
				$this->load->view('commons/footer');
				
    }
    public function solar()
    {
        $this->load->helper('xcrud');
        $xcrud = xcrud_get_instance();
        $xcrud->table('tbl_solar');
				$xcrud->table_name('Diesel Fuel Price');
				$xcrud->unset_view();
				$xcrud->unset_edit();
				$xcrud->unset_remove();
				$xcrud->pass_var('transaction_date', date('Y-m-d H:i:s'), 'create');
				$xcrud->fields('solar_price');
				$xcrud->change_type('solar_price','price', '0', array('prefix'=>'Rp. ','separator'=>'.','point'=>','));
				$xcrud->column_class('solar_price', 'align-right');
				$data['content'] = $xcrud->render();
        $data['title']="Diesel Fuel Price";
        // $this->template->display('master/customer',$data);
				$meta = array(
								'activeMenu' => 'master', // master
								'activeTab' => 'solar' //customer
						);					
				$this->load->view('commons/header', $meta);
				$this->load->view('master/other', $data);
				$this->load->view('commons/footer');
				
    }
    public function claim_bayar()
		{
        $this->load->helper('xcrud');
        $xcrud = xcrud_get_instance();
        $xcrud->table('tbl_claim_bayar');
				$xcrud->table_name('Data Pembayaran Driver');
				$xcrud->label(array('driver_id' => 'Driver'));
				$xcrud->relation('driver_id','tbl_driver','driver_id',array('driver','nick_name'));
				// $xcrud->columns('driver_id,jml_pot_dom,jml_pot_luar,Total Claim,Total Potongan');
				// $xcrud->column_class('jml_pot_dom,jml_pot_luar,Total Claim,Total Potongan', 'align-right');
				// $xcrud->sum('Total Claim,Total Potongan');
				// $xcrud->subselect('Total Claim','SELECT IFNULL(SUM(total_kewajiban_driver),0) FROM tbl_claim_driver_dtl WHERE id_claim_driver = {id_claim_driver}');
				// $xcrud->subselect('Total Potongan','SELECT IFNULL(SUM(bayar),0) FROM v_claim_driver WHERE driver_id = {driver_id}');
				// $xcrud->change_type('jml_pot_dom','price', '0', array('prefix'=>'Rp. ','separator'=>'.','point'=>','));
				// $xcrud->change_type('jml_pot_luar','price', '0', array('prefix'=>'Rp. ','separator'=>'.','point'=>','));
				// $xcrud->change_type('Total Claim','price', '0', array('prefix'=>'Rp. ','separator'=>'.','point'=>','));
				// $xcrud->change_type('Total Potongan','price', '0', array('prefix'=>'Rp. ','separator'=>'.','point'=>','));
				// $detail = $xcrud->nested_table('Detail','id_claim_driver','tbl_claim_driver_dtl','id_claim_driver'); // 2nd level
				// $detail->unset_title();
				// $detail->label(array('nopol_id' => 'No.Polisi'));
				// $detail->relation('nopol_id','tbl_vehicle','nopol_id','nopol');
				// $detail->columns('nopol_id,total_claim,kewajiban_driver_prosen,kewajiban_driver_prosen,dp,total_kewajiban_driver,tgl_mulai_berlaku,remarks');
				// $detail->validation_required('nopol_id,total_claim,kewajiban_driver_prosen,kewajiban_driver_prosen');
				// $detail->fields('nopol_id,total_claim,kewajiban_driver_prosen,dp,total_kewajiban_driver',false,'Biaya');
				// $detail->fields('tgl_mulai_berlaku,remarks',false,'Keterangan');
				// $detail->pass_var('tgl_mulai_berlaku', date('Y-m-d'), 'create');
        $data['content'] = $xcrud->render();
        $data['title']="Data Pembayaran Driver";
        // $this->template->display('master/customer',$data);
				$meta = array(
								'activeMenu' => 'master', // master
								'activeTab' => 'claim_driver' //customer
						);					
				$this->load->view('commons/header', $meta);
				$this->load->view('master/other', $data);
				$this->load->view('commons/footer');			
		}
		
    public function claim_driver()
    {
				// die("test");
        $this->load->helper('xcrud');
        $xcrud = xcrud_get_instance();
        $xcrud->table('tbl_claim_driver');
				$xcrud->table_name('Data Claim Driver');
				$xcrud->label(array('driver_id' => 'Driver'));
				$xcrud->label(array('nopol_id' => 'Nopol'));
				$xcrud->label(array('jml_pot_dom' => 'Jml Potongan Domestik'));
				$xcrud->label(array('jml_pot_luar' => 'Jml Potongan Luar'));
				$xcrud->relation('driver_id','tbl_driver','driver_id',array('driver','nick_name'));
				$xcrud->columns('driver_id,jml_pot_dom,jml_pot_luar,Total Claim,Total Potongan');
				$xcrud->column_class('jml_pot_dom,jml_pot_luar,Total Claim,Total Potongan', 'align-right');
				$xcrud->sum('Total Claim,Total Potongan');
				$xcrud->subselect('Total Claim','SELECT IFNULL(SUM(total_kewajiban_driver),0) FROM tbl_claim_driver_dtl WHERE id_claim_driver = {id_claim_driver}');
				$xcrud->subselect('Total Potongan','SELECT IFNULL(SUM(bayar),0) FROM v_claim_driver WHERE driver_id = {driver_id}');
				$xcrud->change_type('jml_pot_dom','price', '0', array('prefix'=>'Rp. ','separator'=>'.','point'=>','));
				$xcrud->change_type('jml_pot_luar','price', '0', array('prefix'=>'Rp. ','separator'=>'.','point'=>','));
				$xcrud->change_type('Total Claim','price', '0', array('prefix'=>'Rp. ','separator'=>'.','point'=>','));
				$xcrud->change_type('Total Potongan','price', '0', array('prefix'=>'Rp. ','separator'=>'.','point'=>','));
				$detail = $xcrud->nested_table('Detail','id_claim_driver','tbl_claim_driver_dtl','id_claim_driver'); // 2nd level
				$detail->unset_title();
				$detail->label(array('nopol_id' => 'No.Polisi'));
				$detail->relation('nopol_id','tbl_vehicle','nopol_id','nopol');
				$detail->columns('nopol_id,total_claim,kewajiban_driver_prosen,kewajiban_driver_prosen,dp,total_kewajiban_driver,tgl_mulai_berlaku,remarks');
				$detail->validation_required('nopol_id,total_claim,kewajiban_driver_prosen,kewajiban_driver_prosen');
				$detail->fields('nopol_id,total_claim,kewajiban_driver_prosen,dp,total_kewajiban_driver',false,'Biaya');
				$detail->fields('tgl_mulai_berlaku,remarks',false,'Keterangan');
				$detail->pass_var('tgl_mulai_berlaku', date('Y-m-d'), 'create');
        $data['content'] = $xcrud->render();
        $data['title']="Data Claim Driver";
        // $this->template->display('master/customer',$data);
				$meta = array(
								'activeMenu' => 'master', // master
								'activeTab' => 'claim_driver' //customer
						);					
				$this->load->view('commons/header', $meta);
				$this->load->view('master/plant', $data);
				$this->load->view('commons/footer');
    }

    public function update_info()
    {
        $this->load->helper('xcrud');
        $xcrud = xcrud_get_instance();
        $xcrud->table('tbl_info');
				$xcrud->table_name('Info');
				$xcrud->unset_edit();
				$xcrud->unset_remove();
				$xcrud->order_by('id_info','desc');
        $data['content'] = $xcrud->render();
        $data['title']="Info";
        // $this->template->display('master/customer',$data);
				$meta = array(
								'activeMenu' => 'master', // master
								'activeTab' => 'update_info' //customer
						);					
				$this->load->view('commons/header', $meta);
				$this->load->view('master/plant', $data);
				$this->load->view('commons/footer');
    }

    public function update_news()
    {
        $this->load->helper('xcrud');
        $xcrud = xcrud_get_instance();
        $xcrud->table('tbl_news');
				$xcrud->table_name('News');
				$xcrud->unset_edit();
				$xcrud->unset_remove();
        $data['content'] = $xcrud->render();
        $data['title']="News";
        // $this->template->display('master/customer',$data);
				$meta = array(
								'activeMenu' => 'master', // master
								'activeTab' => 'update_news' //customer
						);					
				$this->load->view('commons/header', $meta);
				$this->load->view('master/plant', $data);
				$this->load->view('commons/footer');
    }
}
