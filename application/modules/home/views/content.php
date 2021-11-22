						<div class="row">
							<div class="col-xs-12">
								<!-- PAGE CONTENT BEGINS -->

<!--								<div class="alert alert-block alert-success">
									<button type="button" class="close" data-dismiss="alert">
										<i class="ace-icon fa fa-times"></i>
									</button>

									<i class="ace-icon fa fa-check green"></i>

									Welcome to
									<strong class="green">
										Georgfischer Indonesia - Survey System
										<small>(v1.4)</small>
									</strong>
								</div>
-->							
<?php if($message) { echo "<div class=\"alert alert-danger\" role=\"alert\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>" . $message . "</div>"; } ?>
<?php if($success_message) { echo "<div class=\"alert alert-success\" role=\"alert\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>" . $success_message . "</div>"; } ?>

<form id="productForm" method="post" class="form-horizontal">
		<br>
    <div class="form-group">
        <div class="col-md-2" id="YearOpt">
            <select class="form-control" name="color">
                <option value="">-- Pilih tahun --</option>
                <option selected value="2021">2021</option>
                <option value="2022">2022</option>
                <option value="2023">2023</option>
                <option value="2024">2024</option>
                <option value="2025">2025</option>
            </select>
        </div>
    </div>
</form>
	
<!--<div id="chart" style="min-width: 310px; height: 400px; margin: 0 auto"></div>-->
									<div class="mapcontainer">
											<div class="map">
													<span>Alternative content for the map</span>
											</div>
											<div class="areaLegend">
													<span>Alternative content for the legend</span>
											</div>
									</div>


								

								<!-- PAGE CONTENT ENDS -->
							</div><!-- /.col -->
						</div><!-- /.row -->
