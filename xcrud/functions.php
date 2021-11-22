<?php
function send_mail($xcrud){

	// die("http://".$_SERVER['SERVER_NAME'].dirname($_SERVER["REQUEST_URI"].'?').'/');
	// die("http://".$_SERVER['SERVER_NAME'].dirname($_SERVER["REQUEST_URI"].'?').'/plugins');
	// $plugin_url = "http://".$_SERVER['SERVER_NAME'].dirname($_SERVER["REQUEST_URI"].'?').'/plugins';
	// require '../PHPMailerAutoload.php';
	require 'plugins/PHPMailer/PHPMailerAutoload.php';

	//Create a new PHPMailer instance
	$mail = new PHPMailer;

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
	//Set an alternative reply-to address
	$mail->addReplyTo('akhmad.akbar@georgfischer.com', 'Akhmad Akbar');
	$mail->Subject = "Requisition Approval Needed";
	// die(dirname(__FILE__));
	//convert HTML into a basic plain-text alternative body
	// $mail->Body = "Email ini dikirim oleh PHPMailer";
	$message = file_get_contents('contents.html');
	$link_approve = "http://172.28.192.13/e-doc/vendor/edit/".(int)$xcrud->get('primary');
	$link_reject = "http://172.28.192.13/e-doc/vendor/edit/".(int)$xcrud->get('primary');
	$message = str_replace("href_button_approve",$link_approve,$message);
	$message = str_replace("href_button_reject",$link_reject,$message);

	$mail->msgHTML($message, dirname(__FILE__));
	// $mail->msgHTML(file_get_contents('contents.html'), dirname(__FILE__));
	//Replace the plain text body with one created manually
	$mail->AltBody = 'This is a plain-text message body';
	//Attach an image file
	// $mail->addAttachment('images/phpmailer_mini.png');

	//send the message, check for errors
	if (!$mail->send()) {
		echo "Mailer Error: " . $mail->ErrorInfo;
	} else {
		$xcrud->set_exception('simple_upload','Requisition Approval '.$xcrud->get('primary').' Sent','success');
		// echo "Message sent!";
	}
}

function approval_action($xcrud)
{
    if ($xcrud->get('primary'))
    {
		$now = Date('Y-m-d h:i:s');
        $db = Xcrud_db::get_instance();
        $query = 'UPDATE m_vendor a
									SET a.status = "Sending Approval", a.modified_date = "$now"
									WHERE a.id = ' . (int)$xcrud->get('primary');
		$xcrud->set_exception('simple_upload','Sending Approval ...','success');						
		//die("query1 : ".$query.", query2 : ".$query2);
			$base_url = $xcrud->get('base_url');
			$name = "";
			?>
				<script type="text/javascript">
					// bootbox.alert("<?php echo $user;?>");
					// bootbox.confirm("Apakah anda ingin mencetak voucher ?", function(result) {
						// Example.show("Confirm result: "+result);
						// if(result == true){
							window.location.href = "<?php echo $base_url;?>vendor/send_mail/"+<?php echo (int)$xcrud->get('primary');?>; 
							// alert(result);
						// }
					// }); 		
				</script>
			<?php
        $db->query($query);								
    }
}

function update_doc_no($postdata, $primary){
		// die((int)$xcrud->get('primary'));
		$now = Date('Ymd');
		$db = Xcrud_db::get_instance();
		$query = "select CONCAT('".$now."','-','".$postdata->get('coa_id')."','-','".$postdata->get('doc_type_id')."','-',
		LPAD(count(*)+1, 4, '0')) as doc_no from doc where DATE_FORMAT(created_date, '%Y%m%d') = '".$now."'";
		$db->query($query);
		$arr = $db->result();

        // $db = Xcrud_db::get_instance();
        // $query = 'UPDATE doc SET `doc_no` = "'.$arr[0]['doc_no'].'" WHERE id = ' . (int)$xcrud->get('primary');
        // $db->query($query);

		// return $db->row()['jml'];	
		// die($arr[0]['doc_no']);
    $postdata->set('doc_no',$arr[0]['doc_no']);
    // $postdata->set('doc_no','testset');
    // $postdata->set('no_wo', (int)$xcrud->get('primary'));
		// die((int)$xcrud->get('primary'));
}

function lost_order($xcrud)
{
    if ($xcrud->get('primary'))
    {
        $db = Xcrud_db::get_instance();
        $query = 'UPDATE tbl_order_planning SET `status` = "Miss" WHERE order_planning_id = ' . (int)$xcrud->get('primary');
        $db->query($query);
				$xcrud->set_exception('simple_upload','No.Antri '.$xcrud->get('primary').' berhasil di-Lost','error');
    }
}
function update_ujo($xcrud)
{
    if ($xcrud->get('primary'))
    {
        $db = Xcrud_db::get_instance();
        $query = 'call proc_update_ujo(' . (int)$xcrud->get('primary') . ')';
        $db->query($query);
				$xcrud->set_exception('simple_upload','UJO '.$xcrud->get('primary').' berhasil di-Update','success');
    }
}

function gagal_muat($xcrud)
{
    if ($xcrud->get('primary'))
    {
        $db = Xcrud_db::get_instance();
        $query = 'call proc_gagal_muat(' . (int)$xcrud->get('primary') . ')';
        $db->query($query);
				$xcrud->set_exception('simple_upload','UJO '.$xcrud->get('primary').' berhasil di-Gagalkan','success');
    }
}

function request_status($xcrud)
{
    if ($xcrud->get('primary'))
    {
        $db = Xcrud_db::get_instance();
        $query = 'UPDATE tbl_part_request_detail SET `status` = 1 WHERE status < 2 AND request_id = ' . (int)$xcrud->get('primary');
        $db->query($query);
				$xcrud->set_exception('simple_upload','No.Antri '.$xcrud->get('primary').' berhasil di-Request','success');
    }
}
function pending_status($xcrud)
{
    if ($xcrud->get('primary'))
    {
        $db = Xcrud_db::get_instance();
        $query = 'UPDATE tbl_part_request_detail SET `status` = 0 WHERE status < 2 AND request_id = ' . (int)$xcrud->get('primary');
        $db->query($query);
				$xcrud->set_exception('simple_upload','No.Antri '.$xcrud->get('primary').' berhasil di-Pending','success');
    }
}

function cetak_req_tire($xcrud)
{
    if ($xcrud->get('primary'))
    {
			$db = Xcrud_db::get_instance();
			$query = 'UPDATE tbl_part_request SET `status` = 2 WHERE request_id = ' . (int)$xcrud->get('primary');
			$db->query($query);
			// $xcrud->set_exception('simple_upload','No.Antri '.$xcrud->get('primary').' berhasil di-Pending','error');

			$user = $xcrud->get('user');
			$base_url = $xcrud->get('base_url');
			$name = "";
			?>
				<script type="text/javascript">
					// bootbox.alert("<?php echo $user;?>");
					// bootbox.confirm("Apakah anda ingin mencetak voucher ?", function(result) {
						// Example.show("Confirm result: "+result);
						// if(result == true){
							window.location.href = "<?php echo $base_url;?>email/"+<?php echo (int)$xcrud->get('primary');?>; 
							// alert(result);
						// }
					// }); 		
				</script>
			<?php
    }
}

function get_stock($value, $field, $primary_key, $list, $xcrud){
    if ($xcrud->get('primary'))
    {
				$user = $xcrud->get('user');
				$qty_allocated = $xcrud->get('qty_allocated');
				// die($qty_allocated);
				$receive_date = date('Y-m-d H:i:s');
        $db = Xcrud_db::get_instance();
				$query = 'SELECT request_id FROM tbl_part_request WHERE status = 1 ORDER BY request_id DESC LIMIT 1';
				$db->query($query);
				// if($db->row()['request_id'] == (int)$xcrud->get('primary')){
					// $query = "UPDATE tbl_part_request SET `status` = 3, modified_user = '".$user."' , modified_date = '".$receive_date."'  WHERE request_id = " . (int)$xcrud->get('primary');
					// $db->query($query);
				// } else {
					// $xcrud->set_exception('simple_upload','Please received by sequence first','error');
				// }
    }
		return '<div class="col-sm-9"><input class="xcrud-input form-control" data-required="1" disabled="" type="text" data-type="float" value="'.$value.'" name="'.$field.'" data-pattern="numeric" id="qty"></div>
		<div class="form-group"><label class="control-label col-sm-3">Stock*</label><div class="col-sm-9"><input class="xcrud-input form-control" data-required="1" disabled="" type="text" data-type="float" value="'.$value.'" name="'.$field.'" data-pattern="numeric" id="qty"></div></div>';
}
function nopol_id_callback($value, $field, $primary_key, $list, $xcrud){
	return '<div><input class="xcrud-input form-control" type="text" data-type="text" value="'.$value.'" name="'.$field.'-" maxlength="10"></div>';
}
function driver_id_callback($value, $field, $primary_key, $list, $xcrud){
	return '<div><input class="xcrud-input form-control" type="text" data-type="text" value="'.$value.'" name="'.$field.'-" maxlength="100"></div>';
}
function qty_allocated($value, $field, $primary_key, $list, $xcrud){
	return '<div><input class="xcrud-input form-control" data-required="1" type="text" data-type="float" value="'.$value.'" id="qty_allocated" data-pattern="numeric"></div>';
}
function qty_received($value, $field, $primary_key, $list, $xcrud){
	return '<input class="xcrud-input form-control" data-required="1" type="text" data-type="float" value="'.$value.'" id="qty_received" data-pattern="numeric"></input>';
}
function x_get_stock($tire_size_id, $tire_quality_id){
        $db = Xcrud_db::get_instance();
				$query = "select qty from v_stock where tire_size_id = ".$tire_size_id." and tire_quality_id = ".$tire_quality_id;
				$db->query($query);
				// die($db->row()['request_id'].'<br>'.$request_id);
				// return $db->row()['qty'];	
}
function received($xcrud)
{
    if ($xcrud->get('primary'))
    {
				$user = $xcrud->get('user');
				$receive_date = date('Y-m-d H:i:s');
				$request_detail_id = $xcrud->get('primary');
				$tire_quality_id = $xcrud->get('tire_quality_id');
        $db = Xcrud_db::get_instance();
				$query = "call pAllocateStock('monitoring2');";
				$db->query($query);
				
        $result = $db->result();
        // $count = count($result);
        // $sort = array();
				// echo "<pre>";
				// print_r($result);
				// echo "<pre>";
				// die();
        foreach ($result as $key => $item)
        {
					if($item['request_detail_id'] = $request_detail_id){ //Cek Request Detail ID
						// die($item['tire_quality_id_pasang']);
						// die($item['request_detail_id']." = ".$request_detail_id."<br>=".$tire_quality_id);
						$query = "UPDATE tbl_part_request_detail SET `status` = 3, modified_user = '".$user."' , modified_date = '".$receive_date."', tire_quality_id_pasang = '".$item['tire_quality_id_pasang']."'  WHERE request_detail_id = " . $xcrud->get('primary');
						$db->query($query);						
						$xcrud->set_exception('simple_upload','Pemasangan berhasil','success');						
					} else {
						$xcrud->set_exception('simple_upload','Stok tidak tersedia','error');						
					}
        }			

				// $user = $xcrud->get('user');
				// $request_detail_id = $xcrud->get('request_detail_id');
				// $request_id = $xcrud->get('request_id');
				// $tire_size_id = $xcrud->get('tire_size_id');
				// $tire_quality_id = $xcrud->get('tire_quality_id');
				// $min_stock = $xcrud->get('min_stock');
				// $stock = x_get_stock($tire_size_id,$tire_quality_id);
				// $stock = $stock - $min_stock;
				// // die((string)$stock);
				// $receive_date = date('Y-m-d H:i:s');
        // $db = Xcrud_db::get_instance();
				// $query = 'SELECT a.request_id FROM tbl_part_request a WHERE (SELECT min(b.status) FROM tbl_part_request_detail b WHERE a.request_id = b.request_id) = 1 ORDER BY a.request_id LIMIT 1';
				// $db->query($query);
				// // die($db->row()['request_id'].'<br>'.$request_id);
				// $no_antrian = $db->row()['request_id'];
				
        // $db2 = Xcrud_db::get_instance();
				// $query2 = 'SELECT min(b.status) AS status FROM tbl_part_request_detail b WHERE b.request_id = '.$request_id;
				// $db2->query($query2);
				// // die($db->row()['request_id'].'<br>'.$request_id);
				// $status = $db2->row()['status'];
				// // die($no_antrian.'<br>'.$request_id.'<br>'.$status);
				
				// if($no_antrian == $request_id || $status == -1){ //Cek Urutan Antrian dan Status Urgent Request
				// // die((string)$stock);
					// if($stock > 0){ //Cek Stock
						// $query = "UPDATE tbl_part_request_detail SET `status` = 3, modified_user = '".$user."' , modified_date = '".$receive_date."'  WHERE request_detail_id = " . (int)$xcrud->get('primary');
						// $db->query($query);						
						// $xcrud->set_exception('simple_upload','Pemasangan berhasil','success');						
					// } else {
						// $xcrud->set_exception('simple_upload','Stok tidak tersedia','error');						
					// }
				// } else {
					// $xcrud->set_exception('simple_upload','Pemasangan dilakukan harus berdasarkan urutan, silahkan pasang No. Antrian '.$no_antrian.' terlebih dahulu','error');
				// }
    }
}

function received_tire($value, $field, $primary_key, $list, $xcrud){
	// return '<a class="btn btn-default btn-sm xcrud-action" onclick="javascript:alert("testtt")"><i class="icon-checkmark glyphicon glyphicon-share"></i></a>';
	return '<a class="btn btn-default btn-sm xcrud-action" onclick="TireRecv()">'.$value.'</a>';
}

function x_get_no_ujo($tgl){
				// $tgl = str_replace("-","",$tgl);
        $db = Xcrud_db::get_instance();
				$query = "select count(*) as jml from tbl_order_planning where left(tbl_order_planning.no_ujo,8) = ".$tgl;
				$db->query($query);
				// die($db->row()['request_id'].'<br>'.$request_id);
				// return $db->row()['jml'];	
}

function cetak_struk($value, $field, $primary_key, $list, $xcrud)
{
    if ($xcrud->get('primary'))
    {
				return '<div class="input-prepend input-append">' 
						. '<span class="add-on">'.$value.'</span><br>'
						// . '<button onclick="alert('.$value.')" class="btn btn-primary">Cetak</button>'
						// . '<p><a href="'.$scripts_url.'print_ksm/'.$value.'" title="Cetak KSM" class="example1demo">Cetak KSM</a></p> '
						// . '<p><a href="print_ksm/'.$value.'" title="Cetak Bukti UJO" class="example1demo">Cetak Bukti UJO</a></p> '
						. '<p><a href="print_ksm_direct/'.$value.'" title="Cetak Bukti UJO" class="example1demo">Cetak Bukti UJO</a></p> '
						// . '<button type="submit" id="cetak" value="cetak" name="submit" class="btn btn-primary">Cetak</button>'
						. '</div>';
    }
}
function cetak_struk_komisi($value, $field, $primary_key, $list, $xcrud)
{
   return '<div class="input-prepend input-append">' 
        . '<span class="add-on">'.$value.'</span><br>'
				// . '<button onclick="alert('.$value.')" class="btn btn-primary">Cetak</button>'
				// . '<p><a href="'.$scripts_url.'print_ksm/'.$value.'" title="Cetak KSM" class="example1demo">Cetak KSM</a></p> '
				// . '<p><a href="print_komisi/'.$value.'" title="Cetak Bukti Komisi" class="example1demo">Cetak Bukti Komisi</a></p> '
				. '<p><a href="print_komisi_direct/'.$value.'" title="Cetak Bukti Komisi" class="example1demo">Cetak Bukti Komisi</a></p> '
				// . '<button type="submit" id="cetak" value="cetak" name="submit" class="btn btn-primary">Cetak</button>'
        . '</div>';
}
function duplicate($xcrud)
{
    if ($xcrud->get('primary'))
    {
        $db = Xcrud_db::get_instance();
				// $query = 'UPDATE tbl_order_planning SET customer_id = 2';
				$query = 'INSERT INTO tbl_order_planning (
					order_date,
					request_date,
					customer_id,
					product_id,
					plant_id,
					trucktype_id,
					origin_id,
					user_planning
				) SELECT
					order_date,
					request_date,
					customer_id,
					product_id,
					plant_id,
					trucktype_id,
					origin_id,
					user_planning
				FROM
					tbl_order_planning
				WHERE
					order_planning_id = '. (int)$xcrud->get('primary');
				$db->query($query);
    }
}

function publish_action($xcrud)
{
    if ($xcrud->get('primary'))
    {
        $db = Xcrud_db::get_instance();
        $query = 'UPDATE base_fields SET `bool` = b\'1\' WHERE id = ' . (int)$xcrud->get('primary');
        $db->query($query);
    }
}
function unpublish_action($xcrud)
{
    if ($xcrud->get('primary'))
    {
        $db = Xcrud_db::get_instance();
        $query = 'UPDATE base_fields SET `bool` = b\'0\' WHERE id = ' . (int)$xcrud->get('primary');
        $db->query($query);
    }
}

function close_service_status($xcrud)
{
    if ($xcrud->get('primary'))
    {
        $db = Xcrud_db::get_instance();
        $query = 'UPDATE tbl_routine_service SET `status` = "READY", `close_date` = NOW() WHERE routine_service_id = ' . (int)$xcrud->get('primary');
        $db->query($query);
				$xcrud->set_exception('simple_upload','Service '.$xcrud->get('primary').' berhasil di-Close','error');
    }
}
function pending_service_status($xcrud)
{
    if ($xcrud->get('primary'))
    {
        $db = Xcrud_db::get_instance();
        $query = 'UPDATE tbl_routine_service SET `status` = "PENDING" WHERE routine_service_id = ' . (int)$xcrud->get('primary');
        $db->query($query);
				$xcrud->set_exception('simple_upload','Service '.$xcrud->get('primary').' berhasil di-Pending','error');
    }
}
function open_pending_service_status($xcrud)
{
    if ($xcrud->get('primary'))
    {
        $db = Xcrud_db::get_instance();
        $query = 'UPDATE tbl_routine_service SET `status` = "REPAIR" WHERE routine_service_id = ' . (int)$xcrud->get('primary');
        $db->query($query);
				$xcrud->set_exception('simple_upload','Service '.$xcrud->get('primary').' berhasil di-Open','error');
    }
}

function action_menunggu($xcrud)
{
    if ($xcrud->get('primary'))
    {
		$now = Date('Y-m-d h:i:s');
        $db = Xcrud_db::get_instance();
        $query = 'UPDATE tbl_vehicle_license a
									SET a.status = "Menunggu", a.modify_date = "$now"
									WHERE a.vehicle_license_id = ' . (int)$xcrud->get('primary');
		//die("query1 : ".$query.", query2 : ".$query2);
        $db->query($query);								
    }
}

function update_surat($xcrud)
{
	$now = Date('Y-m-d h:i:s');
    $db = Xcrud_db::get_instance();
        
    $query = "select vehicle_license_id, jenis_surat, nopol_id, tgl_expired, status, is_current 
					from tbl_vehicle_license order by vehicle_license_id desc";
	$db->query($query);
	$arr = $db->result();
		
	$query2 = "UPDATE tbl_vehicle_license 
				SET is_current = 'N', status = 'Selesai'
				WHERE nopol_id = '".$arr[0]['nopol_id']."' AND jenis_surat = '".$arr[0]['jenis_surat']."' 
				AND vehicle_license_id < '".$arr[0]['vehicle_license_id']."'";
	//die("query2 : ".$query2);
    $db->query($query2);	
}

////////////////// service station ////////////////////////////

// function in functions.php
function update_no_wo($postdata){
		$now = Date('Y-m-d');
		$db = Xcrud_db::get_instance();
		// $query = "select CONCAT(DATE_FORMAT(created_date, '%Y-%m-%d'),'.',LPAD(count(*)+1, 3, '0')) as no_wo from ss_ro where DATE_FORMAT(created_date, '%Y-%m-%d') = '".$now."'";
		$query = "select CONCAT('WO.".$now."','.',LPAD(count(*)+1, 3, '0')) as no_wo from ss_ro where DATE_FORMAT(created_date, '%Y-%m-%d') = '".$now."'";
		$db->query($query);
		$arr = $db->result();
		// return $db->row()['jml'];	
		// die($arr[0]['jml']);

    $postdata->set('no_wo',$arr[0]['no_wo']);
    // $postdata->set('no_wo', (int)$xcrud->get('primary'));
		// die((int)$xcrud->get('primary'));
}
function update_in_queue($postdata, $xcrud){
	$db = Xcrud_db::get_instance();
			
	$query = 'select count(*) as jml 
				from tbl_queue_order WHERE nopol_id = '.$postdata->get('nopol_id').' and status = 12';
	$db->query($query);
	$arr = $db->result();
	
	if ($arr[0]['jml'] > 0 ){
		$query2 = 'UPDATE ss_ro SET in_queue = "Y" WHERE no_wo = "'.$postdata->get('no_wo').'"';
		$db->query($query2);		
		$query3 = 'DELETE FROM tbl_queue_order WHERE nopol_id = '.$postdata->get('nopol_id').' and status = 12';
		$db->query($query3);		
	}	
}

function tambah_stock($postdata){
		$db = Xcrud_db::get_instance();
		$query = 'UPDATE m_description SET `stock` = IFNULL(`stock`,0)+'.$postdata->get('qty').', `price` = '.$postdata->get('price').' WHERE material_id = ' . $postdata->get('material_id');
		// die($query);
		$db->query($query);
		
		// $xcrud->set_exception('simple_upload','Service '.$xcrud->get('primary').' berhasil di-Close','error');
}
function hapus_stock($primary, $xcrud){
		$db = Xcrud_db::get_instance();
		$query = 'UPDATE m_description SET `stock` = IFNULL(`stock`,0)-(SELECT qty FROM po_item WHERE id = '.(int)$xcrud->get('primary').') WHERE material_id = (SELECT material_id FROM po_item WHERE id = ' . (int)$xcrud->get('primary').')';
		// die($query);
		$db->query($query);

		$query = 'UPDATE po SET 
		`subtotal` = ((SELECT sum(subtotal) AS total FROM po_item WHERE po_id = (SELECT po_id FROM po_item WHERE id ='.(int)$xcrud->get('primary').'))-(SELECT subtotal FROM po_item WHERE id = '.(int)$xcrud->get('primary').')),
		ppn_amount = (ppn/100)*subtotal,
		total = (subtotal+ppn_amount)-disc_amount
		WHERE po_id = (SELECT po_id FROM po_item WHERE id ='.(int)$xcrud->get('primary').')';
		// die($query);
		$db->query($query);		

		// $query = 'UPDATE po SET `subtotal` = (SELECT sum(subtotal) AS total FROM po_item WHERE po_id = (SELECT po_id FROM po_item WHERE id ='.(int)$xcrud->get('primary').')) WHERE po_id = (SELECT po_id FROM po_item WHERE id ='.(int)$xcrud->get('primary').')';
		// // die($query);
		// $db->query($query);		

		// $xcrud->set_exception('simple_upload','Service '.$xcrud->get('primary').' berhasil di-Hapus','success');
}
function update_stock($postdata, $primary, $xcrud){
		$db = Xcrud_db::get_instance();
		$query = 'UPDATE m_description SET `stock` = IFNULL(`stock`,0)+('.$postdata->get('qty').'-(SELECT qty FROM po_item WHERE id = '.(int)$xcrud->get('primary').')), `price` = '.$postdata->get('price').' WHERE material_id = ' . $postdata->get('material_id');
		// die($query);
		$db->query($query);
		// $xcrud->set_exception('simple_upload','Service '.$xcrud->get('primary').' berhasil di-Hapus','success');
}


function sum_po_item($postdata){
		$db = Xcrud_db::get_instance();
		$query = 'UPDATE po SET 
		`subtotal` = (SELECT sum(subtotal) AS total FROM po_item WHERE po_id = "'.$postdata->get('po_id').'"),
		ppn_amount = (ppn/100)*subtotal,
		total = (subtotal+ppn_amount)-disc_amount
		WHERE po_id = '.$postdata->get('po_id');
		// die($query);
		$db->query($query);		
		// $xcrud->set_exception('simple_upload','Service '.$xcrud->get('primary').' berhasil di-Hapus','success');
}
function close_ro($xcrud)
{
	$user = $xcrud->get('user');
	
    if ($xcrud->get('primary'))
    {
        $db = Xcrud_db::get_instance();
				$query = 'UPDATE ss_ro SET status = "CLOSE", closed_user = "'.$user.'", closed_date = now() WHERE
					ro_id = '. (int)$xcrud->get('primary');

				$db->query($query);
				$query = 'INSERT INTO tbl_queue_order (queue_no, nopol_id, driver_id, queue_date, status) 
					SELECT (select max(queue_no) from tbl_queue_order), nopol_id, driver_id, now(),12 from `ss_ro` WHERE	in_queue = "Y" and nopol_id not in (select nopol_id from tbl_queue_order where status = 12 AND nopol_id not in (SELECT
							nopol_id
							FROM
							tbl_order_planning
							WHERE 
							ujo = 0 AND nopol_id IS NOT NULL)) and ro_id = '. (int)$xcrud->get('primary');
				$db->query($query);
				$xcrud->set_exception('Service Station','Service '.$xcrud->get('primary').' berhasil di-Close','success');
    }	
}
function disable_part($xcrud)
{
    if ($xcrud->get('primary'))
    {
        $db = Xcrud_db::get_instance();
				$query = 'UPDATE m_description SET active = "N" WHERE
					material_id = '. (int)$xcrud->get('primary');
				$db->query($query);
				$xcrud->set_exception('Service Station','Material '.$xcrud->get('primary').' berhasil di-Disable','success');
    }	
}
function enable_part($xcrud)
{
    if ($xcrud->get('primary'))
    {
        $db = Xcrud_db::get_instance();
				$query = 'UPDATE m_description SET active = "Y" WHERE
					material_id = '. (int)$xcrud->get('primary');
				$db->query($query);
				$xcrud->set_exception('Service Station','Material '.$xcrud->get('primary').' berhasil di-Enable','success');
    }	
}
function hapus_stock_audit($xcrud)
{
    if ($xcrud->get('primary'))
    {
        $db = Xcrud_db::get_instance();
				$query = 'DELETE FROM ss_audit WHERE audit_id = '. (int)$xcrud->get('primary');
				$db->query($query);

				$query = 'UPDATE m_description SET `stock` = 
				(
						(
							ifnull(
								(
									SELECT
										sum(`ss_audit`.`qty`)
									FROM
										`ss_audit`
									WHERE
										(
											`ss_audit`.`material_id` = `m_description`.`material_id` AND plus_minus = "Tambah"
										)
								),
								0
							) + ifnull(
								(
									SELECT
										sum(`po_item`.`qty`)
									FROM
										`po_item`
									WHERE
										(
											`po_item`.`material_id` = `m_description`.`material_id`
										)
								),
								0
							)
						) - (ifnull(
							(
								SELECT
									sum(`ss_ro_material`.`jml`)
								FROM
									`ss_ro_material`
								WHERE
									(
										`ss_ro_material`.`material_id` = `m_description`.`material_id`
									)
							),
							0
						) + ifnull(
								(
									SELECT
										sum(`ss_audit`.`qty`)
									FROM
										`ss_audit`
									WHERE
										(
											`ss_audit`.`material_id` = `m_description`.`material_id` AND plus_minus = "Kurang"
										)
								),
								0
							))
					),
				price = 
					(
						SELECT
							`v_material_price`.`price`
						FROM
							`v_material_price`
						WHERE
							(
								`v_material_price`.`material_id` = `m_description`.`material_id`
							)
						ORDER BY
							`v_material_price`.`created_date` DESC
						LIMIT 1
					)		
				WHERE material_id = ' . $xcrud->get('material_id');
				$db->query($query);
				$xcrud->set_exception('Service Station','Material '.$xcrud->get('primary').' berhasil di-Disable','success');
    }	
}
