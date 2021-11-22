<?php

if (!defined('BASEPATH'))
exit('No direct script access allowed');

/**
* Description of site_offline
*
* @author admin
*/
class Site_Offline {

function __construct() {

}

public function is_offline() {
if (file_exists(APPPATH . 'config/config.php')) {
include(APPPATH . 'config/config.php');

if (isset($config['is_offline']) && $config['is_offline'] === TRUE) {
// die($config['base_url']);
$this->show_site_offline($config['base_url']);
exit;
}
}
}

private function show_site_offline($base_url) {
// echo '<html><body><span style="color:red;"><strong>The site is offline due to maintenance. We will be back soon. Please check back later</strong></span>.</body></html>';
echo '



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head><title>
	Under Maintenance
</title>
	<style>
		* { margin: 0; padding: 0; }
		
		html { 
			background: url('.$base_url.'assets/img/under-maintenance.jpg) no-repeat center center fixed; 
			-webkit-background-size: cover;
			-moz-background-size: cover;
			-o-background-size: cover;
			background-size: cover;
		}
		
		#page-wrap { width: 400px; margin: 50px auto; padding: 20px; background: white; -moz-box-shadow: 0 0 20px black; -webkit-box-shadow: 0 0 20px black; box-shadow: 0 0 20px black; }
		p { font: 15px/2 Georgia, Serif; margin: 0 0 30px 0; text-indent: 40px; }
	</style>
</head>
</html>

';
}

}

/* End of file site_offline.php */
/* Location: ./application/hooks/site_offline.php */