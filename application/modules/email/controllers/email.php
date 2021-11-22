<?php
class Email extends CI_Controller {
 
    public function __construct() {
        parent::__construct();
        $this->load->library(array('form_validation','session')); // load form lidation libaray & session library
        $this->load->helper(array('url','html','form'));  // load url,html,form helpers optional
    }    
 
    public function index_(){
        $this->load->library("PHPMailerAutoload");
		$mail = new PHPMailer(true);
		$mail->IsSMTP();

		try {
			$mail->Debugoutput = "html";
			$mail->Host = "10.1.223.12";
			$mail->Port = 25;
			$mail->SMTPDebug  = 2;
			$mail->SMTPSecure = false;
			$mail->SMTPAuth = false;
			$mail->Username = "idn01@georgfischer.com";
			// $mail->Password = "@kbar156";

			// $mail->From = "akhmad.akbar@georgfischer.com";
			$mail->FromName = "My Mail Address";
			$mail->SetFrom("akhmad.akbar@georgfischer.com", "My Mail Address");

			$mail->AddAddress('akhmad.akbar@georgfischer.com');

			$mail->Subject = "Test for subject";
			$mail->MsgHTML("Test my mail body");

			if ($mail->Send()) {
				$result = 1;
			} else {
				$result = "Error: " . $mail->ErrorInfo;
			}
		} catch (phpmailerException $e) {
			$result = $e->errorMessage();
		} catch (Exception $e) {
			$result = $e->getMessage();
		}
		echo("<pre>");
		print_r($result);
		echo("</pre>");
		die();
		// return $result;
	
		// $this->send_mail();
	}
	
    public function index(){
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
        // echo("<pre>");
        // print_r($message);
        // echo("</pre>");
		// die(base_url().'cerberus-hybrid.html');
        // $mail->Body = "Email ini dikirim oleh PHPMailer";
        $mail->Body = $message;

        $mail->send();

	}
}