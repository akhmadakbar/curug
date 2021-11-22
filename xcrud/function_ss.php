<?php
function tambah_stock_audit($postdata, $xcrud){
		$db = Xcrud_db::get_instance();
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
		WHERE material_id = ' . $postdata->get('material_id');
		// die($query);
		$db->query($query);
		// $xcrud->set_exception('simple_upload','Data Spare Part '.$xcrud->get('primary').' berhasil di-Update','success');
}
function update_stock_audit($postdata, $primary, $xcrud){
		$db = Xcrud_db::get_instance();
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
		WHERE material_id = ' . $postdata->get('material_id');
		// die($query);
		$db->query($query);
		$xcrud->set_exception('simple_upload','Data Spare Part '.$xcrud->get('primary').' berhasil di-Update','success');
}

function tambah_stock_ro($primary, $xcrud){
		$db = Xcrud_db::get_instance();
		$query = 'UPDATE m_description SET `stock` = IFNULL(`stock`,0)+(SELECT jml FROM ss_ro_material WHERE ro_id = '.(int)$xcrud->get('primary').') WHERE material_id = (SELECT material_id FROM ss_ro_material WHERE ro_id = ' . (int)$xcrud->get('primary').')';
		// die($query);
		$db->query($query);
}
function hapus_stock_ro($postdata){
		$db = Xcrud_db::get_instance();
		$query = 'UPDATE m_description SET `stock` = IFNULL(`stock`,0)-'.$postdata->get('jml').' WHERE material_id = ' . $postdata->get('material_id');
		// die($query);
		$db->query($query);
		// $xcrud->set_exception('simple_upload','Service berhasil di-Hapus '.$query,'success');
}
function update_stock_ro($postdata, $primary, $xcrud){
		$db = Xcrud_db::get_instance();
		$query = 'UPDATE m_description SET `stock` = IFNULL(`stock`,0)-('.$postdata->get('jml').'-(SELECT jml FROM ss_ro_material WHERE ro_id = '.(int)$xcrud->get('primary').')) WHERE material_id = ' . $postdata->get('material_id');
		// die($query);
		$db->query($query);
		// $xcrud->set_exception('simple_upload','Service '.$xcrud->get('primary').' berhasil di-Hapus','success');
}

function tambah_price_audit($postdata, $xcrud){
		$db = Xcrud_db::get_instance();

		// cek stock
		$query = 'UPDATE m_description SET `price` = '.$postdata->get('price').' WHERE material_id = ' . $postdata->get('material_id');
		$db->query($query);
		$xcrud->set_exception('simple_upload','Harga Spare Part '.$postdata->get('price').'-'.$postdata->get('material_id').' berhasil di-Update','success');	
}

function hapus_price_audit($primary, $xcrud){
		$db = Xcrud_db::get_instance();
		
		$query = 'UPDATE m_description SET `price` = (SELECT price FROM ss_price_update WHERE price_update_id = '.(int)$xcrud->get('primary').') WHERE material_id = (SELECT material_id FROM ss_price_update WHERE price_update_id = ' . (int)$xcrud->get('primary').')';
		// die($query);
		$db->query($query);
		$xcrud->set_exception('simple_upload','Harga Spare Part '.$xcrud->get('primary').' berhasil di-Update','success');			
}
function update_price_audit($postdata, $primary, $xcrud){
		$db = Xcrud_db::get_instance();

		// cek stock
		$query = 'UPDATE m_description SET `price` = '.$postdata->get('price').' WHERE material_id = ' . $postdata->get('material_id');
		$db->query($query);
		$xcrud->set_exception('simple_upload','Harga Spare Part '.$xcrud->get('primary').' berhasil di-Update','success');	
}

