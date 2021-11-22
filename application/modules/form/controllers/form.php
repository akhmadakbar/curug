<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Form extends CI_Controller {


	function __construct()
	{
		parent::__construct();
		
		// check if user logged in 
		if (!$this->ion_auth->logged_in())
	  	{
			// save the redirect_back data from referral url (where user first was prior to login)
			$this->session->set_userdata('last_page', current_url());
			header('location:'.base_url().'auth/login');	
	  	}
		// $this->load->helper('url');
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
		//$this->security->csrf_verify(); 
		$this->load->model('edoc_model');	
		
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
	
	function index_()
	{

	$meta = $this->meta;

	$data['message'] = (validation_errors() ? validation_errors() : $this->session->flashdata('message'));
	$data['success_message'] = $this->session->flashdata('success_message');
		
	$meta = array(
					'activeMenu' => 'forms',
					'activeTab' => 'forms',
					'page_title' => 'Forms - Documents',
					'menu' => 'Forms',
					'sub_menu' => 'Document',
					'load_js' => 'js.php',
					'load_css' => 'css.php'
			);					

	$this->form_validation->set_rules('id-date-picker-1', 'Date', 'required');
	$this->form_validation->set_rules('form-field-1', 'Title', 'required');
	// $this->form_validation->set_rules('passconf', 'Password Confirmation', 'required');
	// $this->form_validation->set_rules('email', 'Email', 'required');				

	// $data['page_title'] = "Expired Unit Dokumentation";
	$data['page_title'] = $this->lang->line("welcome")." ".SITE_NAME."";

	if ($this->form_validation->run() == FALSE)
	{
		$data['message'] = (validation_errors() ? validation_errors() : $this->session->flashdata('message'));
		$data['success_message'] = $this->session->flashdata('success_message');

		$this->load->view('commons/header', $meta);
		// $this->load->view('expire_unit', $data);
		$this->load->view('content', $data);
		$this->load->view('commons/footer',$meta);

		} else 
	{
			$this->load->view('commons/header', $meta);
			// $this->load->view('expire_unit', $data);
			$this->load->view('content', $data);
			$this->load->view('commons/footer',$meta);
		// }
	}
			
	}

	public function index() {
		// $data['all_coa'] = $this->getCoa();
		// $data['all_doctype'] = $this->getDocType();
		
		$meta = $this->meta;

		$meta = array(
						'activeMenu' => 'forms',
						'activeTab' => 'forms',
						'page_title' => 'Forms - Documents',
						'menu' => 'Forms',
						'sub_menu' => 'Document',
						'load_js' => 'js.php',
						'load_css' => 'css.php'
				);					
				
		$this->load->view('commons/header', $meta);
		// $this->load->view('expire_unit', $data);
		$this->load->view('content', $data);
		$this->load->view('commons/footer',$meta);
	}

	public function edit($doc_no) {
		$data['doc'] = $this->getDataSelect($doc_no);
		$data['coa'] = $this->getCoaAll();
		$data['doctype'] = $this->getDoctypeAll($data['doc']->coa_id);
		// foreach ($data['doctype'] as $row)
		// {
			// echo $row['doc_type_id'];
		// }
		// die();
		
		$meta = $this->meta;

		$meta = array(
						'activeMenu' => 'forms',
						'activeTab' => 'forms',
						'page_title' => 'Forms - Documents',
						'menu' => 'Forms',
						'sub_menu' => 'Document',
						'load_js' => 'js_edit.php',
						'load_css' => 'css.php'
				);					
				
		$this->load->view('commons/header', $meta);
		// $this->load->view('expire_unit', $data);
		$this->load->view('edit', $data);
		$this->load->view('commons/footer',$meta);
	}

	function getData() {
			$arr = $this->edoc_model->getAllDoc();
			// die(print_r($arr));
		foreach ($arr as $key => $field) {
			$arr[$key]['doc_type_id'] = $this->edoc_model->getDocType($arr[$key]['doc_type_id'],$arr[$key]['coa_id']);
			$arr[$key]['coa_id'] = $this->edoc_model->getCoaName($arr[$key]['coa_id']);
			// if(isset($arr[$key]['attachment'])) {
				// $arr[$key]['attachment'] = "<a href='".base_url().$arr[$key]['attachment']."'>".$arr[$key]['attachment']."</a>";
			// }
		}
			echo json_encode($arr);
	}
		
	function getDataSelect($doc_no) {
			$q = $this->db->get_where('doc', array('doc_no' => $doc_no), 1); 
		  if( $q->num_rows() > 0 )
		  {
			return $q->row();
		  } 			
	}
		
	function getCoaAll() {
			$q = $this->db->get('coa'); 
		  if( $q->num_rows() > 0 )
		  {
			return $q->result_array();
		  }
			
	}

	function getDoctypeAll($coa_id) {
			$q = $this->db->get_where('doc_type', array('coa_id' => $coa_id), 1); 
		  if( $q->num_rows() > 0 )
		  {
			return $q->result_array();
		  }
			
	}

	function getCoa(){
		if(!empty($this->input->get("q"))){
			$this->db->like('coa', $this->input->get("q"));
		}
		$query = $this->db->select('coa_id as id,coa as text')
					->get("coa");
		$json = $query->result();			

		echo json_encode($json);	
	}

	function getDocType($coa_id){
		if(!empty($this->input->get("q"))){
			$this->db->like('doc_type', $this->input->get("q"));
		}
		// if(!empty($this->input->get("parent_id"))){
			// $this->db->where('coa_id', $this->input->get("parent_id"));
		// }
		$query = $this->db->select('doc_type_id as id,doc_type as text')
					->where('coa_id', $this->input->get("parent_id"))
					->get("doc_type");
		$json = $query->result();			

		echo json_encode($json);	
	}
}

/* End of file home.php */ 
/* Location: ./sma/modules/home/controllers/home.php */