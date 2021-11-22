<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Vendor extends CI_Controller
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
    public function index()
    {
        $this->load->helper('xcrud');
        $xcrud = xcrud_get_instance();
        $xcrud->table('m_vendor');
		$xcrud->columns('no,npwp,address,c_name,status');
		$xcrud->fields('no,npwp,address,zip,phone',false,'Name of Vendor');
		$xcrud->fields('c_name,c_position,c_phone,c_email',false,'Purchasing Contact Detail');
		$xcrud->fields('f_name,f_position,f_phone,f_fax,f_email,f_payterm',false,'Pay to Detail (Finance)');
		$xcrud->fields('distributor,services,manufacturing,others',false,'Vendor Scope of Supply');
		$xcrud->fields('subsidiary_name,iso_accreditation,iso,iso_attachment,num_of_employees,job_ref',false,'Vendor Qualification');
		$xcrud->fields('bank_name,bank_address,beneficiarys_name,beneficiarys_address,acc_no1,curr1,acc_no2,curr2,swift_code',false,'Banking Details');
		$xcrud->fields('company_profile_att,form_vendor_att,siup_att,tdp_att,sppkp_att,npwp_att,etik_att',false,'Attachment');
		$xcrud->change_type(array('company_profile_att','form_vendor_att','siup_att','tdp_att','sppkp_att','npwp_att','etik_att'), 'file', '', array('not_rename'=>true,'path'=>'../uploads/vendor'));
		$xcrud->pass_var('status', 'Request', 'create');
		$xcrud->pass_var('created_date', date('Y-m-d H:i:s'), 'create');
		$xcrud->pass_var('modified_date', date('Y-m-d H:i:s'), 'edit');
		$xcrud->create_action('send_mail_action', 'send_mail');
		$xcrud->button('#', 'Sending Approval', 'icon-close glyphicon glyphicon-envelope', 'xcrud-action', 
								array(  // set action vars to the button
								'data-task' => 'action',
								'data-action' => 'send_mail_action',
								'data-primary' => '{id}'), 
								array(  // set condition ( when button must be shown)
								'status',
								'=',
								'Request')
								);
		 $xcrud->label('npwp','NPWP');
		 $xcrud->label('c_name','Name');
		 $xcrud->label('c_position','Position');
		 $xcrud->label('c_phone','Phone');
		 $xcrud->label('c_email','Email');
		 $xcrud->label('f_name','Name');
		 $xcrud->label('f_position','Position');
		 $xcrud->label('f_phone','Phone');
		 $xcrud->label('f_fax','Fax');
		 $xcrud->label('f_email','Email');
		 $xcrud->label('f_payterm','Payment Terms');
		 $xcrud->label('distributor','Distributor/Agent');
		 $xcrud->label('others','Others (Pls. specify)');
		 $xcrud->label('subsidiary_name','Name Subsidiary/Parents Company');
		 $xcrud->label('iso_accreditation','ISO Accreditation');
		 $xcrud->label('iso','ISO');
		 $xcrud->label('iso_attachment','ISO Attachment');
		 $xcrud->label('num_of_employees','Number of Employees');
		 $xcrud->label('job_ref','Job References');
		 $xcrud->label('bank_name','Name of Bank');
		 $xcrud->label('bank_address','Address of Bank (Complete)');
		 $xcrud->label('beneficiarys_name','Beneficiary’s Name');
		 $xcrud->label('beneficiarys_address','Beneficiary’s Address');
		 $xcrud->label('acc_no1','Account Number (1)');
		 $xcrud->label('acc_no2','Account Number (2)');
		 $xcrud->label('curr1','Currency');
		 $xcrud->label('curr2','Currency');
		 $xcrud->label('swift_code','BSB/SWIFT Code');
				// $xcrud->table_name('Data C.O.A');
				// $xcrud->label(array('coa_id' => 'C.O.A Code'));
				// $xcrud->label(array('coa' => 'C.O.A'));
				// $plant = $xcrud->nested_table('Doc Type','coa_id','doc_type','coa_id'); // 2nd level
				// $plant->order_by('doc_type');
				// $plant->columns('doc_type');
				// $plant->fields('doc_type');
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
        $data['title']="Data Vendor";
        // $this->template->display('master/customer',$data);

				$meta = array(
								'activeMenu' => 'master',
								'activeTab' => 'vendor',
								'page_title' => 'Master - Vendor',
								'menu' => 'Master',
								'sub_menu' => 'vendor',
								'load_js' => 'js.php',
								'load_css' => 'css.php',
								'xcrud_js' => 'y'
						);					
						
				$this->load->view('commons/header', $meta);
				// $this->load->view('expire_unit', $data);
				$this->load->view('vendor', $data);
				$this->load->view('commons/footer',$meta);
				
    }

    public function approval($id)
    {
        $this->load->helper('xcrud');
        $xcrud = xcrud_get_instance();
        $xcrud->table('m_vendor');
		$xcrud->columns('no,npwp,address,c_name,status');
		$xcrud->fields('no,npwp,address,zip,phone',false,'Name of Vendor');
		$xcrud->fields('c_name,c_position,c_phone,c_email',false,'Purchasing Contact Detail');
		$xcrud->fields('f_name,f_position,f_phone,f_fax,f_email,f_payterm',false,'Pay to Detail (Finance)');
		$xcrud->fields('distributor,services,manufacturing,others',false,'Vendor Scope of Supply');
		$xcrud->fields('subsidiary_name,iso_accreditation,iso,iso_attachment,num_of_employees,job_ref',false,'Vendor Qualification');
		$xcrud->fields('bank_name,bank_address,beneficiarys_name,beneficiarys_address,acc_no1,curr1,acc_no2,curr2,swift_code',false,'Banking Details');
		$xcrud->fields('company_profile_att,form_vendor_att,siup_att,tdp_att,sppkp_att,npwp_att,etik_att',false,'Attachment');
		$xcrud->change_type(array('company_profile_att','form_vendor_att','siup_att','tdp_att','sppkp_att','npwp_att','etik_att'), 'file', '', array('not_rename'=>true,'path'=>'../uploads/vendor'));
		$xcrud->pass_var('status', 'Request', 'create');
		$xcrud->pass_var('created_date', date('Y-m-d H:i:s'), 'create');
		$xcrud->pass_var('modified_date', date('Y-m-d H:i:s'), 'edit');
		$xcrud->create_action('send_mail_action', 'send_mail');
		$xcrud->button('#', 'Sending Approval', 'icon-close glyphicon glyphicon-envelope', 'xcrud-action', 
								array(  // set action vars to the button
								'data-task' => 'action',
								'data-action' => 'send_mail_action',
								'data-primary' => '{id}'), 
								array(  // set condition ( when button must be shown)
								'status',
								'=',
								'Request')
								);
		 $xcrud->label('npwp','NPWP');
		 $xcrud->label('c_name','Name');
		 $xcrud->label('c_position','Position');
		 $xcrud->label('c_phone','Phone');
		 $xcrud->label('c_email','Email');
		 $xcrud->label('f_name','Name');
		 $xcrud->label('f_position','Position');
		 $xcrud->label('f_phone','Phone');
		 $xcrud->label('f_fax','Fax');
		 $xcrud->label('f_email','Email');
		 $xcrud->label('f_payterm','Payment Terms');
		 $xcrud->label('distributor','Distributor/Agent');
		 $xcrud->label('others','Others (Pls. specify)');
		 $xcrud->label('subsidiary_name','Name Subsidiary/Parents Company');
		 $xcrud->label('iso_accreditation','ISO Accreditation');
		 $xcrud->label('iso','ISO');
		 $xcrud->label('iso_attachment','ISO Attachment');
		 $xcrud->label('num_of_employees','Number of Employees');
		 $xcrud->label('job_ref','Job References');
		 $xcrud->label('bank_name','Name of Bank');
		 $xcrud->label('bank_address','Address of Bank (Complete)');
		 $xcrud->label('beneficiarys_name','Beneficiary’s Name');
		 $xcrud->label('beneficiarys_address','Beneficiary’s Address');
		 $xcrud->label('acc_no1','Account Number (1)');
		 $xcrud->label('acc_no2','Account Number (2)');
		 $xcrud->label('curr1','Currency');
		 $xcrud->label('curr2','Currency');
		 $xcrud->label('swift_code','BSB/SWIFT Code');
		 $xcrud->hide_button('return');
        $data['content'] = $xcrud->render('view',$id);
        $data['id'] = $id;
        $data['link_approve'] = base_url("vendor/approve/$id");
        $data['link_reject'] = base_url("vendor/reject/$id");
		
        $data['title']="Data Vendor";
        // $this->template->display('master/customer',$data);

				$meta = array(
								'activeMenu' => 'master',
								'activeTab' => 'vendor',
								'page_title' => 'Master - Vendor',
								'menu' => 'Master',
								'sub_menu' => 'vendor',
								'load_js' => 'js.php',
								'load_css' => 'css.php',
								'xcrud_js' => 'y'
						);					
						
				$this->load->view('commons/header', $meta);
				// $this->load->view('expire_unit', $data);
				$this->load->view('approval', $data);
				$this->load->view('commons/footer',$meta);				
    }

    public function approve($id)
    {
			$comment = $this->input->post('comment');
			if($this->input->post('approve')){
				$approved = 1;
				$approved_word = "Approved"."<br>";
			}
			if($this->input->post('reject')){
				$approved = 0;
				$approved_word = "Rejected"."<br>";
			}
			
			// echo $approved_word;
			// echo "The comment is : ".$comment."<br>";
			// echo "The ID : ".$id."<br>";
			
			$data = array(
							'vendor_id' => $id,
							'approved' => $approved,
							'comment' => $comment
						);
			
			$query = $this->db->select('*')
					->from('m_approval')
					->where('vendor_id = '.$id)
					->order_by('created_date', 'desc')
					->limit(1)
					->get()
					;
			foreach ($query->result() as $row)
			{
				$approved_db = $row->approved;
			}
			
			if (($query->num_rows() == 0 || $approved_db != $approved)) {
				$this->db->insert('m_approval', $data);
			}
			
			$data['approved_word'] = $approved_word;
			$data['comment'] = $comment;
			$data['id'] = $id;	
			$data['title']="Data Vendor";
			// $this->template->display('master/customer',$data);

					$meta = array(
									'activeMenu' => 'master',
									'activeTab' => 'vendor',
									'page_title' => 'Master - Vendor',
									'menu' => 'Master',
									'sub_menu' => 'vendor',
									'load_js' => 'no_js.php',
									'load_css' => 'no_css.php',
									'xcrud_js' => 'y'
							);					
							
			$this->load->view('commons/header', $meta);
			// $this->load->view('expire_unit', $data);
			$this->load->view('thanks', $data);
			$this->load->view('commons/footer',$meta);				
	}
	public function edit($id){
        $this->load->helper('xcrud');
        $xcrud = xcrud_get_instance();
        $xcrud->table('m_vendor');
		$xcrud->fields('no,npwp,address,zip,phone',false,'Name of Vendor');
		$xcrud->fields('c_name,c_position,c_phone,c_email',false,'Purchasing Contact Detail');
		$xcrud->fields('f_name,f_position,f_phone,f_fax,f_email,f_payterm',false,'Pay to Detail (Finance)');
		$xcrud->fields('distributor,services,manufacturing,others',false,'Vendor Scope of Supply');
		$xcrud->fields('subsidiary_name,iso_accreditation,iso,iso_attachment,num_of_employees,job_ref',false,'Vendor Qualification');
		$xcrud->fields('bank_name,bank_address,beneficiarys_name,beneficiarys_address,acc_no1,curr1,acc_no2,curr2,swift_code',false,'Banking Details');
		$xcrud->disabled('no,npwp,address,zip,phone',false,'Name of Vendor');
		$xcrud->disabled('c_name,c_position,c_phone,c_email',false,'Purchasing Contact Detail');
		$xcrud->disabled('f_name,f_position,f_phone,f_fax,f_email,f_payterm',false,'Pay to Detail (Finance)');
		$xcrud->disabled('distributor,services,manufacturing,others',false,'Vendor Scope of Supply');
		$xcrud->disabled('subsidiary_name,iso_accreditation,iso,iso_attachment,num_of_employees,job_ref',false,'Vendor Qualification');
		$xcrud->disabled('bank_name,bank_address,beneficiarys_name,beneficiarys_address,acc_no1,curr1,acc_no2,curr2,swift_code',false,'Banking Details');
		// $xcrud->disabled('bank_name,bank_address,beneficiarys_name,beneficiarys_address,acc_no1,curr1,acc_no2,curr2',false,'Banking Details');
		
		$xcrud->create_action('approve', 'send_mail');
		$xcrud->button('#', 'Sending Approval', 'icon-close glyphicon glyphicon-envelope', 'xcrud-action', 
								array(  // set action vars to the button
								'data-task' => 'action',
								'data-action' => 'approve',
								'data-primary' => '{id}'), 
								array(  // set condition ( when button must be shown)
								'status',
								'=',
								'Request')
								);
								
		 $xcrud->label('npwp','NPWP');
		 $xcrud->label('c_name','Name');
		 $xcrud->label('c_position','Position');
		 $xcrud->label('c_phone','Phone');
		 $xcrud->label('c_email','Email');
		 $xcrud->label('f_name','Name');
		 $xcrud->label('f_position','Position');
		 $xcrud->label('f_phone','Phone');
		 $xcrud->label('f_fax','Fax');
		 $xcrud->label('f_email','Email');
		 $xcrud->label('f_payterm','Payment Terms');
		 $xcrud->label('distributor','Distributor/Agent');
		 $xcrud->label('others','Others (Pls. specify)');
		 $xcrud->label('subsidiary_name','Name Subsidiary/Parents Company');
		 $xcrud->label('iso_accreditation','ISO Accreditation');
		 $xcrud->label('iso','ISO');
		 $xcrud->label('iso_attachment','ISO Attachment');
		 $xcrud->label('num_of_employees','Number of Employees');
		 $xcrud->label('job_ref','Job References');
		 $xcrud->label('bank_name','Name of Bank');
		 $xcrud->label('bank_address','Address of Bank (Complete)');
		 $xcrud->label('beneficiarys_name','Beneficiary’s Name');
		 $xcrud->label('beneficiarys_address','Beneficiary’s Address');
		 $xcrud->label('acc_no1','Account Number (1)');
		 $xcrud->label('acc_no2','Account Number (2)');
		 $xcrud->label('curr1','Currency');
		 $xcrud->label('curr2','Currency');
		 $xcrud->label('swift_code','BSB/SWIFT Code');
		 $xcrud->hide_button('save_return');
		 $xcrud->hide_button('return');
		 $xcrud->hide_button('save_new');
		// $xcrud->render('edit', 12); // edit entry screen, '12' - primary key
		$data['content'] = $xcrud->render('edit', $id);
        $data['title']="Data Vendor";
        // $this->template->display('master/customer',$data);

				$meta = array(
								'activeMenu' => 'master',
								'activeTab' => 'vendor',
								'page_title' => 'Master - Vendor',
								'menu' => 'Master',
								'sub_menu' => 'vendor',
								'load_js' => 'js.php',
								'load_css' => 'css.php',
								'xcrud_js' => 'y'
						);					
						
				$this->load->view('commons/header', $meta);
				// $this->load->view('expire_unit', $data);
				$this->load->view('vendor', $data);
				$this->load->view('commons/footer',$meta);
		
		
	}
	
    public function send_mail($id){

		// $query = $this->db->query("SELECT * FROM m_vendor LIMIT 1;");
		// $row = $query->row();

		// $datestring = '%d-%M-%Y %h:%i';
		// echo mdate($datestring, mysql_to_unix($row->created_date)); 
		
		// // echo $row->created_date; // access attributes
		// die();
	
	
	   // load library email
        $this->load->library("PHPMailerAutoload");
        

        $mail = new PHPMailer();

        $mail->SMTPDebug = 2;

        $mail->Debugoutput = "html";

        

        // set smtp

        $mail->isSMTP();

        $mail->Host = "smtp.gmail.com";

        $mail->Port = "587";

        $mail->SMTPAuth = true;

        $mail->Username = "georgfischer.idn@gmail.com";

        $mail->Password = "Citerep4153";

        // $mail->WordWrap = 50;  

        // set email content

        $mail->setFrom("a@b.c", "Vendor Information Systems");

        $mail->addAddress("akhmad.akbar@georgfischer.com");

        $mail->Subject = "Requisition Approval Needed";

		// Mengatur format email ke HTML
		$mail->isHTML(true);
		$mail->addCustomHeader('MIME-Version: 1.0');
		$mail->addCustomHeader('Content-Type: text/html; charset=ISO-8859-1');		

		$this->load->helper('file');

		// $message = read_file(base_url().'cerberus-hybrid.html');
		$message = file_get_contents(base_url().'cerberus-hybrid.html');
		$message = str_replace("href_button_approve",base_url("vendor/approval/$id"),$message);
        // echo("<pre>");
        // print_r($message);
        // echo("</pre>");
		// die(base_url().'cerberus-hybrid.html');
        // $mail->Body = "Email ini dikirim oleh PHPMailer";
		//href_button_approve
		//href_button_reject
        $mail->Body = $message;

        $mail->send();

	}	
}
