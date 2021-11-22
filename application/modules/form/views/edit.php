								<form class="form-horizontal" role="form" action="" method="post" id="myForm">

									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-input-readonly"> Doc. No. </label>

										<div class="col-sm-9">
											<input readonly="" type="text" class="col-xs-10 col-sm-5" id="doc_no" name="doc_no" 
												placeholder="Document Number" value="<?php echo $doc->doc_no?>"/>
											<span class="help-inline col-xs-12 col-sm-7">
												<label class="middle">
													<input class="ace" type="checkbox" id="id-disable-check"/>
												</label>
											</span>
										</div>
									</div>

		
									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="id-date-picker-1">Date</label>

										<div class="col-sm-9">
											<div class="row">
												<div class="col-xs-8 col-sm-5">
													<div class="input-group">
														<input class="form-control date-picker" id="id-date-picker-1" 
															name="date" type="text" placeholder="Date" data-date-format="dd-mm-yyyy" 
															value="<?php echo date ("d-m-Y",strtotime($doc->date)); ?>"
														/>														
														<span class="input-group-addon">
															<i class="fa fa-calendar bigger-110"></i>
														</span>
													</div>
												</div>
											</div>
										</div>
									</div>
														
									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Title </label>

										<div class="col-sm-9">
											<input type="text" id="form-field-1" name="title" value="<?php echo $doc->title; ?>" placeholder="Title" class="col-xs-10 col-sm-5" />
										</div>
									</div>

									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> No </label>

										<div class="col-sm-9">
											<input type="text" id="form-field-1" name="no" value="<?php echo $doc->no; ?>" placeholder="No" class="col-xs-10 col-sm-5" />
										</div>
									</div>

									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-select-3">C.O.A</label>

										<div class="col-sm-3">
										<?php //print_r($coa);?>
										<select class="coa-select form-control" name="coa" id="coa-select" data-placeholder="Choose a C.O.A...">
                        <?php
                        // ambil data dari database
												foreach ($coa as $row)
												{
                            ?>
                            <option value="<?php echo $row['coa_id'] ?>" <?php echo $row['coa_id'] == $doc->coa_id ? 'selected="selected"' : '' ?>><?php echo $row['coa'] ?></option>														
                            <?php
                        }												
                        ?>
										</select>
										</div>
									</div>
					
									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-select-3">Doc. Type</label>

										<div class="col-sm-3">
										<select  name="doctype" class="doctype-select form-control" id="doctype-select" data-placeholder="Choose a Doc. Type...">
                        <?php
                        // ambil data dari database
												foreach ($doctype as $row)
												{
                            ?>
                            <option value="<?php echo $row['doc_type_id'] ?>" <?php echo ($row['doc_type_id'] == $doc->doc_type_id && $row['coa_id'] == $doc->coa_id)? 'selected="selected"' : '' ?>><?php echo $row['doc_type'] ?></option>														
                            <?php
                        }												
                        ?>
										</select>
										</div>
									</div>
									
							<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-input-readonly">Scanned File </label>
										<div class="col-xs-10 col-sm-5">
											<input multiple="" type="file" id="id-input-file-3" 
												name="scanned_file"/>
											<a href="<?php echo base_url()."uploads/".$doc->scanned_file?>" target="_blank">
											<?php echo base_url()."uploads/".$doc->scanned_file?></a>
										</div>
									</div>
									
									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-11">Note</label>

										<div class="col-xs-10 col-sm-5">
											<textarea id="form-field-11" class="autosize-transition form-control" name="note"><?php echo $doc->note?></textarea>
										</div>
									</div>

									<div class="clearfix form-actions">
										<div class="col-md-offset-3 col-md-9">
											<button class="btn btn-info" type="submit">
												<i class="ace-icon fa fa-check bigger-110"></i>
												Submit
											</button>

											&nbsp; &nbsp; &nbsp;
											<button class="btn" type="button" onclick="window.open('<?php echo base_url(); ?>form','_parent');">
												<i class="ace-icon fa fa-undo bigger-110"></i>
												Reset
											</button>
										</div>
									</div>
								</form>