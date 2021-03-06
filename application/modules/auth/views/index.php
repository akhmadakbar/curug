<!-- js placed at the end of the document so the pages load faster -->
<script src="<?php echo base_url();?>assets/js/jquery.js"></script>
<!--<script src="<?php echo base_url();?>assets/js/bootstrap.min.js"></script>-->
<script class="include" type="text/javascript" src="<?php echo base_url();?>assets/js/jquery.dcjqaccordion.2.7.js"></script>
<script src="<?php echo base_url();?>assets/js/jquery.scrollTo.min.js"></script>
<script src="<?php echo base_url();?>assets/js/jquery.nicescroll.js" type="text/javascript"></script>


<!--common script for all pages-->
<!--<script src="<?php echo base_url();?>assets/js/common-scripts.js"></script>-->

<!--script for this page-->
<script src="<?php echo base_url();?>assets/js/jquery-ui-1.9.2.custom.min.js"></script>

<script type="text/javascript" src="<?php echo base_url();?>assets/js/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/bootstrap-daterangepicker/date.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/bootstrap-daterangepicker/daterangepicker.js"></script>

<script type="text/javascript" src="<?php echo base_url();?>assets/js/bootstrap-datetimepicker/js/bootstrap-datetimepicker.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/bootstrap-daterangepicker/moment.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/bootstrap-timepicker/js/bootstrap-timepicker.js"></script>

<script type="text/javascript" language="javascript" src="<?php echo base_url();?>assets/datatables/media/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" language="javascript" src="<?php echo base_url();?>assets/datatables/extensions/TableTools/js/dataTables.tableTools.js"></script>
<script type="text/javascript" language="javascript" src="<?php echo base_url();?>assets/datatables/extensions/Responsive/js/dataTables.responsive.min.js"></script>
<script src="<?php echo base_url();?>assets/js/morris-0.4.3.min.js"></script>

<style type="text/css" class="init">
body { padding-top:20px; }
.panel-body .btn:not(.btn-block) { width:150px;margin-bottom:10px; }
</style>

<script>

$(document).ready(function() {
	$('#fileData').dataTable( {		
		"columnDefs": [
				{ "visible": false, "targets": [ 2 ]}
		],
		"order": [[ 0, 'asc' ]],
		"displayLength": 5,
		"lengthMenu": [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]],
		// "processing": true,
		// "serverSide": true,
		"columns": [
					  null,
					  null,
					  null,
					  null,
					  null,
					  { "bSortable": false }
			],
		"dom": 'T<"clear">lfrtip',
		tableTools: {
				"sSwfPath": "<?php echo base_url();?>assets/datatables/extensions/TableTools/swf/copy_csv_xls_pdf.swf"
		}
	} );
		
} );						
</script>
<!-- Errors -->
<?php if($message) { echo "<div class=\"alert alert-danger\" role=\"alert\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>" . $message . "</div>"; } ?>
<?php if($success_message) { echo "<div class=\"alert alert-success\" role=\"alert\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>" . $success_message . "</div>"; } ?>

	<h1>Manajemen Pengguna</h1>
	<p class="introtext"><?php echo $this->lang->line("list_results"); ?></p>
	
	<table id="fileData" class="table table-bordered table-hover table-striped" style="margin-bottom: 5px;">
		<thead>
        <tr>
			<th><?php echo $this->lang->line("username"); ?></th>
			<th><?php echo $this->lang->line("first_name"); ?></th>
			<th><?php echo $this->lang->line("last_name"); ?></th>
			<th><?php echo $this->lang->line("email_address") ?></th>
      <th><?php echo $this->lang->line("phone"); ?></th>
			<th><?php echo $this->lang->line("user_role"); ?></th>
			<th style="width:75px;"><?php echo $this->lang->line("actions"); ?></th>
		</tr>
        </thead>
		<tbody>
		<?php foreach ($users as $user):?>
			<tr>
				<td><?php echo $user->username;?></td>
				<td><?php echo $user->first_name;?></td>
				<td><?php echo $user->last_name;?></td>
				<td><?php echo $user->email;?></td>
        <td><?php echo $user->phone;?></td>
				<td>
					<?php foreach ($user->groups as $group):?>
						<?php echo $group->description;?>
	                <?php endforeach?>
				</td>
				<td style="text-align:center;"><?php echo ($user->active) ? anchor("auth/deactivate/".$user->id, 'Active') : anchor("auth/activate/". $user->id, 'Inactive'); ?>
                <?php echo '
                <a class="tip" title="'.$this->lang->line("edit_user").'" href="auth/edit_user/' . $user->id . '"><i class="glyphicon glyphicon-edit"></i></a> ';
								if ($this->ion_auth->in_group('admin')) {
								echo '<a class="tip" title="'.$this->lang->line("delete_user").'" href="auth/delete_user/' . $user->id . '" onClick="return confirm(\''. $this->lang->line('alert_x_user') .'\');"><i class="glyphicon glyphicon-trash"></i></a>
                '; }  ?></td>
			</tr>
		<?php endforeach;?>
        </tbody>
	</table>
	
	<p><a href="<?php echo site_url('auth/create_user');?>" class="btn btn-primary"><?php echo $this->lang->line("add_user"); ?></a>
	<a href="<?php echo site_url('auth/create_group');?>" class="btn btn-primary">Tambah Grup</a></p>
	
