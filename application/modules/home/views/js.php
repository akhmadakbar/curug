		<!-- page specific plugin scripts -->

		<!--[if lte IE 8]>
		  <script src="<?php echo base_url();?>assets/js/excanvas.min.js"></script>
		<![endif]-->
		<script src="<?php echo base_url();?>assets/js/jquery-ui.custom.min.js"></script>
		<script src="<?php echo base_url();?>assets/js/jquery.ui.touch-punch.min.js"></script>
		<script src="<?php echo base_url();?>assets/js/jquery.easypiechart.min.js"></script>
		<script src="<?php echo base_url();?>assets/js/jquery.sparkline.index.min.js"></script>
		<script src="<?php echo base_url();?>assets/js/jquery.flot.min.js"></script>
		<script src="<?php echo base_url();?>assets/js/jquery.flot.pie.min.js"></script>
		<script src="<?php echo base_url();?>assets/js/jquery.flot.resize.min.js"></script>

		<!-- ace scripts -->
		<script src="<?php echo base_url();?>assets/js/ace-elements.min.js"></script>
		<script src="<?php echo base_url();?>assets/js/ace.min.js"></script>

		<!-- inline scripts related to this page -->
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/highcharts-3d.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<!--<script src="https://code.highcharts.com/themes/grid-light.js"></script>-->

		<!-- Tambahan Maps -->
		
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js" charset="utf-8"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-mousewheel/3.1.13/jquery.mousewheel.min.js"
            charset="utf-8"></script>
	
    <script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.2.7/raphael.min.js" charset="utf-8"></script>
    <script src="<?php echo base_url();?>assets/js/jquery.mapael.js" charset="utf-8"></script>
    <script src="<?php echo base_url();?>assets/js/maps/kec_curug.js" charset="utf-8"></script>
		

		<script type="text/javascript">
tahunPar = '2014';
drawChart(tahunPar);
function drawChart(tahunPar) {
	new Highcharts.setOptions({
		lang: {
				decimalPoint: ',',
				thousandsSep: '.'
		},
	chart: {
				style: {
						fontFamily: 'Arial'
				},
				events: {
                load: requestData(tahunPar)
            }
		}
	});
	chart = new Highcharts.Chart({
	chart: {
	 renderTo: 'chart'
	},
	credits: {
				enabled: false
		},
	title: {
   text: 'Graphics Scanned Document - '+tahunPar,
   x: -20
  },
  subtitle: {
   text: 'Monthly Document',
	 x: -20
	},
	xAxis: {
	 categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun',
								'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
	},
	yAxis: [{ // Primary yAxis
						title: {
								text: '',
								style: {
										color: Highcharts.getOptions().colors[3]
								}
						},
						labels: {
				format: '{value:,.0f}',
								style: {
										color: Highcharts.getOptions().colors[3]
								}
						}//,
						// min: 0,
						// max: 9000000000,
						// tickInterval: 1000000000
				}],
	
	series: [
				// {
						// name: 'Revenue',
						// type: 'spline',
						// data: []
				// }, 
				// {
						// name: 'Profit',
						// type: 'column',
						// data: <?php echo json_encode($grafik1); ?>
				// },
				// {
						// name: 'Cost',
						// type: 'spline',
						// data: <?php echo json_encode($grafik2); ?>
				// },
				// {
						// name: 'Maintenance',
						// type: 'spline',
						// data: <?php echo json_encode($grafik3); ?>
				// }
				],
	exporting: {
						enabled: true
				}
 });
}

function requestData(tahunPar) {
    $.ajax({
        url: '<?php echo base_url();?>home/grafik/'+tahunPar,
        type: "GET",
        dataType: "json",
        // data : {username : "demo"},
        success: function(data) {
            chart.addSeries({
              name: "Finance",
              type: 'column',
							options3d: {
                enabled: true,
                alpha: 15,
                beta: 15,
                viewDistance: 25,
                depth: 40
            },
              data: data.finance
            });
            chart.addSeries({
              name: "Logistics",
              type: 'column',
							options3d: {
                enabled: true,
                alpha: 15,
                beta: 15,
                viewDistance: 25,
                depth: 40
            },
              data: data.logistics
            });
            chart.addSeries({
              name: "Extrusion",
              type: 'column',
							options3d: {
                enabled: true,
                alpha: 15,
                beta: 15,
                viewDistance: 25,
                depth: 40
            },
              data: data.extrusion
            });
            chart.addSeries({
              name: "Fabrication",
              type: 'column',
							options3d: {
                enabled: true,
                alpha: 15,
                beta: 15,
                viewDistance: 25,
                depth: 40
            },
              data: data.fabrication
            });
            // chart.addSeries({
              // name: "Cost",
              // type: 'spline',
              // data: data.cost
            // });
            // chart.addSeries({
              // name: "Maintenance",
              // type: 'spline',
              // data: data.maintenance
            // });
        },
        cache: false
    });		
}
	$("#YearOpt").change(function() {
		drawChart($(this).find('option:selected').val());
	})
		</script>
		<script type="text/javascript">
			// jQuery(function($) {
				// $('.easy-pie-chart.percentage').each(function(){
					// var $box = $(this).closest('.infobox');
					// var barColor = $(this).data('color') || (!$box.hasClass('infobox-dark') ? $box.css('color') : 'rgba(255,255,255,0.95)');
					// var trackColor = barColor == 'rgba(255,255,255,0.95)' ? 'rgba(255,255,255,0.25)' : '#E2E2E2';
					// var size = parseInt($(this).data('size')) || 50;
					// $(this).easyPieChart({
						// barColor: barColor,
						// trackColor: trackColor,
						// scaleColor: false,
						// lineCap: 'butt',
						// lineWidth: parseInt(size/10),
						// animate: ace.vars['old_ie'] ? false : 1000,
						// size: size
					// });
				// })
			
				// $('.sparkline').each(function(){
					// var $box = $(this).closest('.infobox');
					// var barColor = !$box.hasClass('infobox-dark') ? $box.css('color') : '#FFF';
					// $(this).sparkline('html',
									 // {
										// tagValuesAttribute:'data-values',
										// type: 'bar',
										// barColor: barColor ,
										// chartRangeMin:$(this).data('min') || 0
									 // });
				// });
			
			
			  // //flot chart resize plugin, somehow manipulates default browser resize event to optimize it!
			  // //but sometimes it brings up errors with normal resize event handlers
			  // $.resize.throttleWindow = false;
			
			  // var placeholder = $('#piechart-placeholder').css({'width':'90%' , 'min-height':'150px'});
			  // var data = [
				// { label: "social networks",  data: 38.7, color: "#68BC31"},
				// { label: "search engines",  data: 24.5, color: "#2091CF"},
				// { label: "ad campaigns",  data: 8.2, color: "#AF4E96"},
				// { label: "direct traffic",  data: 18.6, color: "#DA5430"},
				// { label: "other",  data: 10, color: "#FEE074"}
			  // ]
			  // function drawPieChart(placeholder, data, position) {
			 	  // $.plot(placeholder, data, {
					// series: {
						// pie: {
							// show: true,
							// tilt:0.8,
							// highlight: {
								// opacity: 0.25
							// },
							// stroke: {
								// color: '#fff',
								// width: 2
							// },
							// startAngle: 2
						// }
					// },
					// legend: {
						// show: true,
						// position: position || "ne", 
						// labelBoxBorderColor: null,
						// margin:[-30,15]
					// }
					// ,
					// grid: {
						// hoverable: true,
						// clickable: true
					// }
				 // })
			 // }
			 // drawPieChart(placeholder, data);
			
			 // /**
			 // we saved the drawing function and the data to redraw with different position later when switching to RTL mode dynamically
			 // so that's not needed actually.
			 // */
			 // placeholder.data('chart', data);
			 // placeholder.data('draw', drawPieChart);
			
			
			  // //pie chart tooltip example
			  // var $tooltip = $("<div class='tooltip top in'><div class='tooltip-inner'></div></div>").hide().appendTo('body');
			  // var previousPoint = null;
			
			  // placeholder.on('plothover', function (event, pos, item) {
				// if(item) {
					// if (previousPoint != item.seriesIndex) {
						// previousPoint = item.seriesIndex;
						// var tip = item.series['label'] + " : " + item.series['percent']+'%';
						// $tooltip.show().children(0).text(tip);
					// }
					// $tooltip.css({top:pos.pageY + 10, left:pos.pageX + 10});
				// } else {
					// $tooltip.hide();
					// previousPoint = null;
				// }
				
			 // });
			
				// /////////////////////////////////////
				// $(document).one('ajaxloadstart.page', function(e) {
					// $tooltip.remove();
				// });
			
			
			
			
				// var d1 = [];
				// for (var i = 0; i < Math.PI * 2; i += 0.5) {
					// d1.push([i, Math.sin(i)]);
				// }
			
				// var d2 = [];
				// for (var i = 0; i < Math.PI * 2; i += 0.5) {
					// d2.push([i, Math.cos(i)]);
				// }
			
				// var d3 = [];
				// for (var i = 0; i < Math.PI * 2; i += 0.2) {
					// d3.push([i, Math.tan(i)]);
				// }
				
			
				// var sales_charts = $('#sales-charts').css({'width':'100%' , 'height':'220px'});
				// $.plot("#sales-charts", [
					// { label: "Domains", data: d1 },
					// { label: "Hosting", data: d2 },
					// { label: "Services", data: d3 }
				// ], {
					// hoverable: true,
					// shadowSize: 0,
					// series: {
						// lines: { show: true },
						// points: { show: true }
					// },
					// xaxis: {
						// tickLength: 0
					// },
					// yaxis: {
						// ticks: 10,
						// min: -2,
						// max: 2,
						// tickDecimals: 3
					// },
					// grid: {
						// backgroundColor: { colors: [ "#fff", "#fff" ] },
						// borderWidth: 1,
						// borderColor:'#555'
					// }
				// });
			
			
				// $('#recent-box [data-rel="tooltip"]').tooltip({placement: tooltip_placement});
				// function tooltip_placement(context, source) {
					// var $source = $(source);
					// var $parent = $source.closest('.tab-content')
					// var off1 = $parent.offset();
					// var w1 = $parent.width();
			
					// var off2 = $source.offset();
					// //var w2 = $source.width();
			
					// if( parseInt(off2.left) < parseInt(off1.left) + parseInt(w1 / 2) ) return 'right';
					// return 'left';
				// }
			
			
				// $('.dialogs,.comments').ace_scroll({
					// size: 300
			    // });
				
				
				// //Android's default browser somehow is confused when tapping on label which will lead to dragging the task
				// //so disable dragging when clicking on label
				// var agent = navigator.userAgent.toLowerCase();
				// if(ace.vars['touch'] && ace.vars['android']) {
				  // $('#tasks').on('touchstart', function(e){
					// var li = $(e.target).closest('#tasks li');
					// if(li.length == 0)return;
					// var label = li.find('label.inline').get(0);
					// if(label == e.target || $.contains(label, e.target)) e.stopImmediatePropagation() ;
				  // });
				// }
			
				// $('#tasks').sortable({
					// opacity:0.8,
					// revert:true,
					// forceHelperSize:true,
					// placeholder: 'draggable-placeholder',
					// forcePlaceholderSize:true,
					// tolerance:'pointer',
					// stop: function( event, ui ) {
						// //just for Chrome!!!! so that dropdowns on items don't appear below other items after being moved
						// $(ui.item).css('z-index', 'auto');
					// }
					// }
				// );
				// $('#tasks').disableSelection();
				// $('#tasks input:checkbox').removeAttr('checked').on('click', function(){
					// if(this.checked) $(this).closest('li').addClass('selected');
					// else $(this).closest('li').removeClass('selected');
				// });
			
			
				// //show the dropdowns on top or bottom depending on window height and menu position
				// $('#task-tab .dropdown-hover').on('mouseenter', function(e) {
					// var offset = $(this).offset();
			
					// var $w = $(window)
					// if (offset.top > $w.scrollTop() + $w.innerHeight() - 100) 
						// $(this).addClass('dropup');
					// else $(this).removeClass('dropup');
				// });
			
			// })
		</script>
<script type="text/javascript">
        $(function () {
            $(".mapcontainer").mapael({
                map: {
                    name: "kec_curug",
                    defaultArea: {
                        attrs: {
                            stroke: "#fff",
                            "stroke-width": 1
                        },
                        attrsHover: {
                            "stroke-width": 2
                        }
                    }
                },
                legend: {
                    area: {
                        title: "Populasi penduduk berdasarkan desa",
                        slices: [
                            {
                                max: 3000,
                                attrs: {
                                    fill: "#97e766"
                                },
                                label: "Kurang dari 3.000 jiwa"
                            },
                            {
                                min: 3000,
                                max: 5000,
                                attrs: {
                                    fill: "#7fd34d"
                                },
                                label: "Antara 3.000 - 5.000 jiwa"
                            },
                            {
                                min: 5000,
                                max: 10000,
                                attrs: {
                                    fill: "#5faa32"
                                },
                                label: "Antara 5.000 - 10.000 jiwa"
                            },
                            {
                                min: 10000,
                                attrs: {
                                    fill: "#3f7d1a"
                                },
                                label: "Lebih dari 10 ribu jiwa"
                            }
                        ]
                    }
                },
                areas: {
                    "ID-AC" :{
                        value: "15516",
                        href: "#",
                        tooltip: {content: "<span style=\"font-weight:bold;\">Binong (4.77	KM2)</span><br />Populasi : 15.516"}
                    },
										"ID-BA" :{
                        value: "3936",
                        href: "#",
                        tooltip: {content: "<span style=\"font-weight:bold;\">Cukang Galih (3.68 KM2)</span><br />Population : 3.936"}
                    },
										"ID-BB" :{
                        value: "6861",
                        href: "#",
                        tooltip: {content: "<span style=\"font-weight:bold;\">Curug Kulon (3.1 KM2)</span><br />Population : 6.861"}
                    },
										"ID-BE" :{
                        value: "4708",
                        href: "#",
                        tooltip: {content: "<span style=\"font-weight:bold;\">Curug Wetan (3.31 KM2)</span><br />Population : 4.708"}
                    },
										"ID-BT" :{
                        value: "8142",
                        href: "#",
                        tooltip: {content: "<span style=\"font-weight:bold;\">Kadu (5.75 KM2)</span><br />Population : 8.142"}
                    },
										"ID-GO" :{
                        value: "6361",
                        href: "#",
                        tooltip: {content: "<span style=\"font-weight:bold;\">Kadu Jaya (3.62 KM2)</span><br />Population : 6.361"}
                    },
										"ID-JA" :{
                        value: "6229",
                        href: "#",
                        tooltip: {content: "<span style=\"font-weight:bold;\">Sukabakti (3.12 KM2)</span><br />Population : 6.229"}
                    }
                }
            });
        });
    </script>