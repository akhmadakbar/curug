	<script src="<?php echo base_url();?>assets/bootstrap-table-develop/dist/bootstrap-table.js"></script>
	<script src="<?php echo base_url();?>assets/bootstrap-table-develop/src/extensions/filter-control/bootstrap-table-filter-control.js"></script>
	<script src="<?php echo base_url();?>assets/bootstrap-table-develop/src/extensions/export/bootstrap-table-export.js"></script>
	<!--<script src="https://select2.github.io/dist/js/select2.full.js"></script>-->
		<!--[if lte IE 8]>
		  <script src="assets/js/excanvas.min.js"></script>
		<![endif]-->
		<script src="<?php echo base_url();?>assets/js/jquery-ui.custom.min.js"></script>
		<script src="<?php echo base_url();?>assets/js/jquery.ui.touch-punch.min.js"></script>
		<script src="<?php echo base_url();?>assets/js/chosen.jquery.min.js"></script>
		<script src="<?php echo base_url();?>assets/js/spinbox.min.js"></script>
		<script src="<?php echo base_url();?>assets/js/bootstrap-datepicker.min.js"></script>
		<script src="<?php echo base_url();?>assets/js/bootstrap-timepicker.min.js"></script>
		<script src="<?php echo base_url();?>assets/js/moment.min.js"></script>
		<script src="<?php echo base_url();?>assets/js/daterangepicker.min.js"></script>
		<script src="<?php echo base_url();?>assets/js/bootstrap-datetimepicker.min.js"></script>
		<script src="<?php echo base_url();?>assets/js/bootstrap-colorpicker.min.js"></script>
		<script src="<?php echo base_url();?>assets/js/jquery.knob.min.js"></script>
		<script src="<?php echo base_url();?>assets/js/autosize.min.js"></script>
		<script src="<?php echo base_url();?>assets/js/jquery.inputlimiter.min.js"></script>
		<script src="<?php echo base_url();?>assets/js/jquery.maskedinput.min.js"></script>
		<script src="<?php echo base_url();?>assets/js/bootstrap-tag.min.js"></script>

		<!-- ace scripts -->
		<script src="<?php echo base_url();?>assets/js/ace-elements.min.js"></script>
		<script src="<?php echo base_url();?>assets/js/ace.min.js"></script>

		<!-- inline scripts related to this page -->
<!--<script src="https://gist.github.com/ajaxray/187e7c9a00666a7ffff52a8a69b8bf31.js"></script>-->
<script src="<?php echo base_url();?>assets/js/select2.full.js"></script>
<script>
		// $(document).ready(function () {
				// $(".doctype-select").select2({
						// placeholder: "Please Select"
				// });

				// $(".coa-select").select2({
						// placeholder: "Please Select"
				// });
		// });
</script>
<script>
$(document.body).on("change",".coa-select",function(){
	$('.doctype-select').html('');
});
$('.coa-select').select2({
        ajax: {
          url: '<?php echo base_url();?>form/getCoa',
          dataType: 'json',
          // delay: 250,
           processResults: function (data) {
            return {
              results: data
            };
          },
          cache: true
        }
      });

$('.doctype-select').select2({
				ajax: {
					url: '<?php echo base_url();?>form/getDocType',
					dataType: 'json',
					// delay: 250,
					data: function (params) {
						return {
							q: params.term, // search term
							parent_id: $('.coa-select').val()
							// page: params.page
						};
					},
					processResults: function (data) {
						return {
							results: data
						};
					},
					cache: true
				}
			});

// $('.coa-select').val("150").trigger('change.select2');
//datepicker plugin
//link
$('.date-picker').datepicker({
	autoclose: true,
	todayHighlight: true
})
//show datepicker when clicking on the icon
.next().on(ace.click_event, function(){
	$(this).prev().focus();
});

//or change it into a date range picker
$('.input-daterange').datepicker({autoclose:true});


//to translate the daterange picker, please copy the "examples/daterange-fr.js" contents here before initialization
$('input[name=date-range-picker]').daterangepicker({
	'applyClass' : 'btn-sm btn-success',
	'cancelClass' : 'btn-sm btn-default',
	locale: {
		applyLabel: 'Apply',
		cancelLabel: 'Cancel',
	}
})
.prev().on(ace.click_event, function(){
	$(this).next().focus();
});


$('#timepicker1').timepicker({
	minuteStep: 1,
	showSeconds: true,
	showMeridian: false,
	disableFocus: true,
	icons: {
		up: 'fa fa-chevron-up',
		down: 'fa fa-chevron-down'
	}
}).on('focus', function() {
	$('#timepicker1').timepicker('showWidget');
}).next().on(ace.click_event, function(){
	$(this).prev().focus();
});




if(!ace.vars['old_ie']) $('#date-timepicker1').datetimepicker({
 //format: 'MM/DD/YYYY h:mm:ss A',//use this option to display seconds
 icons: {
	time: 'fa fa-clock-o',
	date: 'fa fa-calendar',
	up: 'fa fa-chevron-up',
	down: 'fa fa-chevron-down',
	previous: 'fa fa-chevron-left',
	next: 'fa fa-chevron-right',
	today: 'fa fa-arrows ',
	clear: 'fa fa-trash',
	close: 'fa fa-times'
 }
}).next().on(ace.click_event, function(){
	$(this).prev().focus();
});

// var files = $('#id-input-file-3').ace_file_input('<?php echo "4tcrcsv3izacwc4.jpg";?>');
// var method = $('#id-input-file-3').ace_file_input('select');

$('#id-input-file-3').ace_file_input({
	style: 'well',
	btn_choose: 'Drop files here or click to choose',
	btn_change: null,
	no_icon: 'ace-icon fa fa-cloud-upload',
	droppable: true,
	thumbnail: 'small'//large | fit
	//,icon_remove:null//set null, to hide remove/reset button
	/**,before_change:function(files, dropped) {
		//Check an example below
		//or examples/file-upload.html
		return true;
	}*/
	/**,before_remove : function() {
		return true;
	}*/
	,
	preview_error : function(filename, error_code) {
		//name of the file that failed
		//error_code values
		//1 = 'FILE_LOAD_FAILED',
		//2 = 'IMAGE_LOAD_FAILED',
		//3 = 'THUMBNAIL_FAILED'
		//alert(error_code);
	}

}).on('change', function(){
	//console.log($(this).data('ace_input_files'));
	//console.log($(this).data('ace_input_method'));
});
// $('#id-input-file-3').val('<?php echo base_url()."uploads/4tcrcsv3izacwc4.jpg";?>');
// var files = $('#id-input-file-3').ace_file_input('<?php echo base_url()."uploads/4tcrcsv3izacwc4.jpg";?>');

				$('#id-input-file-3')
				.ace_file_input('show_file_list', [
					{type: 'file', name: '<?php echo $doc->scanned_file?>', path: '<?php echo base_url()."uploads/".$doc->scanned_file?>'}
				]);
				//dynamically change allowed formats by changing allowExt && allowMime function
				$('#id-file-format').removeAttr('checked').on('change', function() {
					var whitelist_ext, whitelist_mime;
					var btn_choose
					var no_icon
					if(this.checked) {
						btn_choose = "Drop images here or click to choose";
						no_icon = "ace-icon fa fa-picture-o";
			
						whitelist_ext = ["jpeg", "jpg", "png", "gif" , "bmp"];
						whitelist_mime = ["image/jpg", "image/jpeg", "image/png", "image/gif", "image/bmp"];
					}
					else {
						btn_choose = "Drop files here or click to choose";
						no_icon = "ace-icon fa fa-cloud-upload";
						
						whitelist_ext = null;//all extensions are acceptable
						whitelist_mime = null;//all mimes are acceptable
					}
					var file_input = $('#id-input-file-3');
					file_input
					.ace_file_input('update_settings',
					{
						'btn_choose': btn_choose,
						'no_icon': no_icon,
						'allowExt': whitelist_ext,
						'allowMime': whitelist_mime
					})
					file_input.ace_file_input('reset_input');
					
					file_input
					.off('file.error.ace')
					.on('file.error.ace', function(e, info) {
						//console.log(info.file_count);//number of selected files
						//console.log(info.invalid_count);//number of invalid files
						//console.log(info.error_list);//a list of errors in the following format
						
						//info.error_count['ext']
						//info.error_count['mime']
						//info.error_count['size']
						
						//info.error_list['ext']  = [list of file names with invalid extension]
						//info.error_list['mime'] = [list of file names with invalid mimetype]
						//info.error_list['size'] = [list of file names with invalid size]
						
						
						/**
						if( !info.dropped ) {
							//perhapse reset file field if files have been selected, and there are invalid files among them
							//when files are dropped, only valid files will be added to our file array
							e.preventDefault();//it will rest input
						}
						*/
						
						
						//if files have been selected (not dropped), you can choose to reset input
						//because browser keeps all selected files anyway and this cannot be changed
						//we can only reset file field to become empty again
						//on any case you still should check files with your server side script
						//because any arbitrary file can be uploaded by user and it's not safe to rely on browser-side measures
					});
					
					
					/**
					file_input
					.off('file.preview.ace')
					.on('file.preview.ace', function(e, info) {
						console.log(info.file.width);
						console.log(info.file.height);
						e.preventDefault();//to prevent preview
					});
					*/
				
				});
			
				$('#spinner1').ace_spinner({value:0,min:0,max:200,step:10, btn_up_class:'btn-info' , btn_down_class:'btn-info'})
				.closest('.ace-spinner')
				.on('changed.fu.spinbox', function(){
					//console.log($('#spinner1').val())
				}); 
				$('#spinner2').ace_spinner({value:0,min:0,max:10000,step:100, touch_spinner: true, icon_up:'ace-icon fa fa-caret-up bigger-110', icon_down:'ace-icon fa fa-caret-down bigger-110'});
				$('#spinner3').ace_spinner({value:0,min:-100,max:100,step:10, on_sides: true, icon_up:'ace-icon fa fa-plus bigger-110', icon_down:'ace-icon fa fa-minus bigger-110', btn_up_class:'btn-success' , btn_down_class:'btn-danger'});
				$('#spinner4').ace_spinner({value:0,min:-100,max:100,step:10, on_sides: true, icon_up:'ace-icon fa fa-plus', icon_down:'ace-icon fa fa-minus', btn_up_class:'btn-purple' , btn_down_class:'btn-purple'});
			
				//$('#spinner1').ace_spinner('disable').ace_spinner('value', 11);
				//or
				//$('#spinner1').closest('.ace-spinner').spinner('disable').spinner('enable').spinner('value', 11);//disable, enable or change value
				//$('#spinner1').closest('.ace-spinner').spinner('value', 0);//reset to 0
			
			
				//datepicker plugin
				//link
				$('.date-picker').datepicker({
					autoclose: true,
					todayHighlight: true
				})
				//show datepicker when clicking on the icon
				.next().on(ace.click_event, function(){
					$(this).prev().focus();
				});
			
				//or change it into a date range picker
				$('.input-daterange').datepicker({autoclose:true});
			
			
				//to translate the daterange picker, please copy the "examples/daterange-fr.js" contents here before initialization
				$('input[name=date-range-picker]').daterangepicker({
					'applyClass' : 'btn-sm btn-success',
					'cancelClass' : 'btn-sm btn-default',
					locale: {
						applyLabel: 'Apply',
						cancelLabel: 'Cancel',
					}
				})
				.prev().on(ace.click_event, function(){
					$(this).next().focus();
				});
			
			
				$('#timepicker1').timepicker({
					minuteStep: 1,
					showSeconds: true,
					showMeridian: false,
					disableFocus: true,
					icons: {
						up: 'fa fa-chevron-up',
						down: 'fa fa-chevron-down'
					}
				}).on('focus', function() {
					$('#timepicker1').timepicker('showWidget');
				}).next().on(ace.click_event, function(){
					$(this).prev().focus();
				});
				
				
			
				
				if(!ace.vars['old_ie']) $('#date-timepicker1').datetimepicker({
				 //format: 'MM/DD/YYYY h:mm:ss A',//use this option to display seconds
				 icons: {
					time: 'fa fa-clock-o',
					date: 'fa fa-calendar',
					up: 'fa fa-chevron-up',
					down: 'fa fa-chevron-down',
					previous: 'fa fa-chevron-left',
					next: 'fa fa-chevron-right',
					today: 'fa fa-arrows ',
					clear: 'fa fa-trash',
					close: 'fa fa-times'
				 }
				}).next().on(ace.click_event, function(){
					$(this).prev().focus();
				});

/////////////////////////// AUTO SIZE ////////////////////////////////////
autosize($('textarea[class*=autosize]'));

$(document).one('ajaxloadstart.page', function(e) {
	autosize.destroy('textarea[class*=autosize]')
	
	$('.limiterBox,.autosizejs').remove();
	$('.daterangepicker.dropdown-menu,.colorpicker.dropdown-menu,.bootstrap-datetimepicker-widget.dropdown-menu').remove();
});

</script>
		
<script type="text/javascript">
var $table = $('#table');

	$table.on('click-row.bs.table', function (row, $element) {
	// alert($element.doc_no);
    $('a[href="#home"]').click();
		window.open("<?php echo base_url(); ?>form/edit/"+$element.doc_no,'_parent');
		// populateForm('#myForm', $.parseJSON('<?php echo base_url();?>form/getDataSelect/'+$element.doc_no));
  // $.getJSON('<?php echo base_url();?>form/getDataSelect/'+$element.doc_no, function (data) {
    // console.log(data);
    // console.log(JSON.stringify(data));
  // });
// $.ajax({
  // url: '<?php echo base_url();?>form/getDataSelect/'+$element.doc_no,
  // method: 'POST',
  // dataType: 'json',
  // success: function(data) {
    // console.log(data);
    // for (d in data) 
			// console.log(data[d]['doc_no']);
			// populateForm('#MyForm', data[d]);
			// // $('#doc_no').prop('readonly', false)
			// // $("#doc_no").val(data[d]['doc_no']);
			// // $('#doc_no').prop('readonly', true)
			// // $("input[name='doc_type_id']").val(data[d]['doc_type_id']);
			// // $("#coa_id").val(data[d]['coa_id']);
			// // $("#scanned_file").val(data[d]['scanned_file']);
			// // $("input[name='title']").val(data[d]['title']);
			// // $("input[name='date']").val(data[d]['date']);
			// // $("input[name='no']").val(data[d]['no']);
			// // $("input[name='notes']").val(data[d]['notes']);
			// // $("input[name='note']").val(data[d]['note']);
  // }
// });	
		// $.getJSON('<?php echo base_url();?>form/getDataSelect/'+$element.doc_no,function(data){
      // console.log(data);

      // var items = data.items.map(function (item) {
        // return item.key + ': ' + item.value;
      // });

				// alert(data["doc_no"]);
				// $("input[name='doc_no']").val(d.doc_no);
				// $("input[name='doc_type_id']").val(d.doc_type_id);
		// },'json');				
	// window.open("<?php echo base_url(); ?>detail_karyawan/view_detail/payroll_id/"+$element.payroll_id,'_parent');
});
</script>