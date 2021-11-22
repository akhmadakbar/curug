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
function populateForm($form, data)
{
		//console.log("PopulateForm, All form data: " + JSON.stringify(data));

		$.each(data, function(key, value)   // all json fields ordered by name
		{
				//console.log("Data Element: " + key + " value: " + value );
				var $ctrls = $(this).find('[name='+key+']');  //all form elements for a name. Multiple checkboxes can have the same name, but different values

				//console.log("Number found elements: " + $ctrls.length );

				if ($ctrls.is('select')) //special form types
				{
						$('option', $ctrls).each(function() {
								if (this.value == value)
										this.selected = true;
						});
				} 
				else if ($ctrls.is('textarea')) 
				{
						$ctrls.val(value);
				} 
				else 
				{
						switch($ctrls.attr("type"))   //input type
						{
								case "text":
								case "hidden":
										$ctrls.val(value);   
										break;
								case "radio":
										if ($ctrls.length >= 1) 
										{   
												//console.log("$ctrls.length: " + $ctrls.length + " value.length: " + value.length);
												$.each($ctrls,function(index)
												{  // every individual element
														var elemValue = $(this).attr("value");
														var elemValueInData = singleVal = value;
														if(elemValue===value){
																$(this).prop('checked', true);
														}
														else{
																$(this).prop('checked', false);
														}
												});
										}
										break;
								case "checkbox":
										if ($ctrls.length > 1) 
										{   
												//console.log("$ctrls.length: " + $ctrls.length + " value.length: " + value.length);
												$.each($ctrls,function(index) // every individual element
												{  
														var elemValue = $(this).attr("value");
														var elemValueInData = undefined;
														var singleVal;
														for (var i=0; i<value.length; i++){
																singleVal = value[i];
																console.log("singleVal : " + singleVal + " value[i][1]" +  value[i][1] );
																if (singleVal === elemValue){elemValueInData = singleVal};
														}

														if(elemValueInData){
																//console.log("TRUE elemValue: " + elemValue + " value: " + value);
																$(this).prop('checked', true);
																//$(this).prop('value', true);
														}
														else{
																//console.log("FALSE elemValue: " + elemValue + " value: " + value);
																$(this).prop('checked', false);
																//$(this).prop('value', false);
														}
												});
										}
										else if($ctrls.length == 1)
										{
												$ctrl = $ctrls;
												if(value) {$ctrl.prop('checked', true);}
												else {$ctrl.prop('checked', false);}

										}
										break;
						}  //switch input type
				}
		}) // all json fields
}  // populate form


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
    $body = $("body");

    $(document).on({
        ajaxStart: function () {
            $body.addClass("loading");
        },
        ajaxStop: function () {
            $body.removeClass("loading");
        }
    });

</script>