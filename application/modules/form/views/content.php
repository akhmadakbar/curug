<?php if($success_message) { echo "<div class=\"alert alert-success\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>" . $success_message . "</div>"; } ?>
<?php if($message) { echo "<div class=\"alert alert-danger\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>" . $message . "</div>"; } ?>

								<!-- PAGE CONTENT BEGINS -->	
			<table id="table"
							data-toolbar="#toolbar"
							data-toggle="table"
							data-search="true"
							data-show-refresh="true"
							data-show-toggle="true"
							data-show-columns="true"
							data-show-export="true"
							data-minimum-count-columns="2"
							data-show-pagination-switch="true"
							data-pagination="true"
							data-page-list="[10, 25, 50, 100, ALL]"
							data-show-footer="false"
							data-export-data-type="all"
							data-export-types="['excel']"
							data-height="600"
				   data-url="<?php echo base_url();?>form/getData">
				<thead>
				<tr>
					<th data-field="doc_no">Doc. No</th>
					<th data-field="doc_type_id">Doc. Type</th>
					<th data-field="coa_id">C.O.A</th>
					<th data-field="scanned_file">Scanned File</th>
					<th data-field="title">Title</th>
					<th data-field="date">Date</th>
					<th data-field="no">No.</th>
					<!--<th data-field="notes">Notes</th>-->
					<th data-field="note">Note</th>
				</tr>
				</thead>
			</table>
