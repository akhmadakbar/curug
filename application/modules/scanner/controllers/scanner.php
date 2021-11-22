<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class scanner extends CI_Controller
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
		$group = array('admin', 'members', 'manager', 'logistics', 'marketing', 'hr', 'finance', 'ga', 'plant', 'qc', 'extrusion', 'fabrication', 'building');
		if(!$this->ion_auth->in_group($group)){
			$this->session->set_flashdata('message', 'You must be a admin and member to view this page');
			redirect('home');
	  	}
	}
    public function index()
    {	
			$coa = array
				(
				array("logistics",150),
				array("marketing",200),
				array("hr",300),
				array("finance",302),
				array("ga",350),
				array("plant",501),
				array("qc",503),
				array("extrusion",600),
				array("fabrication",605),
				array("building",800)
				);
			$auth = array();
			foreach ($coa as $event)
			{
				if($this->ion_auth->in_group($event[0])){
					array_push($auth, $event[1]);
				}
			}
			$auth = implode(",",$auth);

			$this->load->helper('xcrud');
			$xcrud = xcrud_get_instance();
			$xcrud->table('doc');
			$xcrud->where('coa_id IN ('.$auth.')');
			$xcrud->order_by('id','desc');
			$xcrud->table_name('Data Scanner');
			$xcrud->columns('coa_id,Doc Type,scanned_file,title,date,no,note');
			// $xcrud->column_width('coa_id','10%');
			// $xcrud->column_width('doc_type_id','15%');
			$xcrud->column_width('scanned_file','15%');
			// $xcrud->column_width('title','10%');
			// $xcrud->column_width('date','10%');
			// $xcrud->column_width('no','15%');
			$xcrud->column_width('note','20%');
			$xcrud->column_cut(1,'scanned_file');
			$xcrud->fields('doc_no,coa_id,doc_type_id,scanned_file,title,date,no,note');
			$xcrud->validation_required('coa_id,doc_type_id,scanned_file,title,date,no,note');
			
			$xcrud->disabled('doc_no');
			$xcrud->change_type('date', 'date');
			$xcrud->change_type('note','text','',4000);
			$xcrud->change_type('scanned_file', 'file', '', array('not_rename'=>true));
			$xcrud->relation('coa_id','coa','coa_id','coa','coa_id IN ('.$auth.')');			
			$xcrud->relation('doc_type_id','doc_type','doc_type_id','doc_type','','','',' ','','coa_id','coa_id');
			$xcrud->subselect('Doc Type','SELECT doc_type FROM doc_type WHERE doc_type_id = {doc_type_id} AND coa_id = {coa_id}');
			$xcrud->pass_var('created_user', USER, 'create');
			$xcrud->pass_var('created_date', date('Y-m-d H:i:s'), 'create');
			$xcrud->pass_var('last_modified_user', USER, 'edit');			
			$xcrud->pass_var('last_modified_date', date('Y-m-d H:i:s'), 'edit');	
			$xcrud->before_insert('update_doc_no');				
			$xcrud->label('coa_id','C.O.A');
			$xcrud->label('doc_type_id','Doc. Type');
			if(!$this->ion_auth->in_group(array('admin', 'members'))){
				$xcrud->hide_button('add,edit,remove');
			}
			
			$data['content'] = $xcrud->render();
			$data['title']="Data Scanner";
			// $this->template->display('master/customer',$data);

			$meta = array(
							'activeMenu' => 'scanner',
							'activeTab' => 'scanner',
							'page_title' => 'Data - Scanner',
							'menu' => 'Data',
							'sub_menu' => 'Scanner',
							'load_js' => 'js.php',
							'load_css' => 'css.php',
							'xcrud_js' => 'y'
					);					
					
			$this->load->view('commons/header', $meta);
			$this->load->view('content', $data);
			$this->load->view('commons/footer',$meta);
				
    }
}
