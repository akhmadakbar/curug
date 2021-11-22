<?php
class Test extends CI_Controller {
 
    public function __construct() {
        parent::__construct();
        $this->load->library(array('form_validation','session')); // load form lidation libaray & session library
        $this->load->helper(array('url','html','form'));  // load url,html,form helpers optional
    }    
 
    public function index(){
    
        // set validation rules
        $this->form_validation->set_rules('name', 'Name', 'required|min_length[4]|max_length[10]');
        // $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        // $this->form_validation->set_rules('number', 'Phone Number', 'required|numeric|max_length[15]');
        // $this->form_validation->set_rules('subject', 'Subject', 'required|max_length[10]|alpha');
        // $this->form_validation->set_rules('message', 'Message', 'required|min_length[12]|max_length[100]');
 
    
        // hold error messages in div
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        
        // check for validation
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('form_validation_demo');
        }else{
            $this->session->set_flashdata('item', 'form submitted successfully');
            redirect(current_url());
        }
    
    }
		
		public function show_site_offline() {
		// echo '<html><body><span style="color:red;"><strong>The site is offline due to maintenance. We will be back soon. Please check back later</strong></span>.</body></html>';
		echo '



		<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

		<html xmlns="http://www.w3.org/1999/xhtml">
		<head><title>
			Under Maintenance
		</title></head>
		<body style="margin:0; padding:0; background-color:Black;">
				<form method="post" action="./Default.aspx" id="form1">
		<div class="aspNetHidden">
		<input type="hidden" name="__VIEWSTATE" id="__VIEWSTATE" value="/wEPDwUKMTk3MzY5NzU2NmRkQ72lPzPnxpzzHmo4slUXL0/0SislypF0lxGAbW8C1yk=" />
		</div>

		<div class="aspNetHidden">

			<input type="hidden" name="__VIEWSTATEGENERATOR" id="__VIEWSTATEGENERATOR" value="481DC91D" />
		</div>
				

				<center><img id="Image1" align="center" Border="0" src="'.$config['base_url'].'assets/img/under-maintenance.jpg" style="height:300px;width:500px;" /></center>

				</form>
		</body>
		</html>

		';
		}		
}