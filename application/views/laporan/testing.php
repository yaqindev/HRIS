<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>

	<link rel="shortcut icon" type="image/x-icon" href="<?php echo base_url();?>assets/img/icon.png" />
	<link href="<?php echo base_url()."assets/";?>css/bootstrap.css" rel="stylesheet">
    <!--external css-->
    <link href="<?php echo base_url()."assets/";?>font-awesome/css/font-awesome.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url()."assets/";?>css/zabuto_calendar.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url()."assets/";?>js/gritter/css/jquery.gritter.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url()."assets/";?>lineicons/style.css">    
	<script src="<?php echo base_url()."assets/";?>js/modal.js"></script>
    <link href="<?php echo base_url()."assets/";?>css/style.css" rel="stylesheet">
    <link href="<?php echo base_url()."assets/";?>css/style-responsive.css" rel="stylesheet">

	<script src="<?php echo base_url()?>assets/js/jquery-1.8.2.min.js"></script>
    <script src="<?php echo base_url() ?>assets/js/highcharts.js"></script>
    <script src="<?php echo base_url() ?>assets/js/exporting.js"></script>
    <script>

		$(document).ready(function () {
			// alert("ok jquery jalan");
		    $('#box-grafik').highcharts({
		        chart: {
		            type: 'column'
		        },
		        title: {
		            text: 'Monthly Average Rainfall'
		        },
		        subtitle: {
		            text: 'Source: WorldClimate.com'
		        },
		        xAxis: {
		            categories: [
		                'Jan',
		                'Feb',
		                'Mar',
		                'Apr',
		                'May',
		                'Jun',
		                'Jul',
		                'Aug',
		                'Sep',
		                'Oct',
		                'Nov',
		                'Dec'
		            ],
		            crosshair: true
		        },
		        yAxis: {
		            min: 0,
		            title: {
		                text: 'Rainfall (mm)'
		            }
		        },
		        tooltip: {
		            headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
		            pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
		                '<td style="padding:0"><b>{point.y:.1f} mm</b></td></tr>',
		            footerFormat: '</table>',
		            shared: true,
		            useHTML: true
		        },
		        plotOptions: {
		            column: {
		                pointPadding: 0.2,
		                borderWidth: 0
		            }
		        },
		        series: [{
		            name: 'Tokyo',
		            data: [49.9, 71.5, 106.4, 129.2, 144.0, 176.0, 135.6, 148.5, 216.4, 194.1, 95.6, 54.4]

		        }, {
		            name: 'New York',
		            data: [83.6, 78.8, 98.5, 93.4, 106.0, 84.5, 105.0, 104.3, 91.2, 83.5, 106.6, 92.3]

		        }, {
		            name: 'London',
		            data: [48.9, 38.8, 39.3, 41.4, 47.0, 48.3, 59.0, 59.6, 52.4, 65.2, 59.3, 51.2]

		        }, {
		            name: 'Berlin',
		            data: [42.4, 33.2, 34.5, 39.7, 52.6, 75.5, 57.4, 60.4, 47.6, 39.1, 46.8, 51.1]

		        }]
		    });
		});
    </script>
</head>
<body>
	<div id="container">
	<aside>
	
		<?php
		$this->load->view('sidebar.php');
		?>
		</aside>
	<section id="main-content">
		<section class="wrapper">
			<div class="row mt">
				<div class="col-lg-12">
					<div class="form-panel">
						<h1 class="mb" align="center">Laporan Performance</h1>
						<div class="row">
							<div class="col-md-11">
								<?php if ($this->session->flashdata('pesan')):?>
								<div class="alert alert-success"><b>Berhasil ! </b> <?= $this->session->flashdata('pesan') ?></div>
								<?php endif; ?>
							</div>
						</div>
						
							<br>
						<div id="box_report">							
						</div>
						<!-- end #box_report -->

						<div id="box_grafik">
							<h4><center>--- Grafik Performance Department ---</center></h4>
							<hr>
							<div class="row">
								<div class="col-md-12" >
								<div id="box-grafik"></div>
									
								</div>
							</div>
							<hr>
						</div><!-- end #box_grafik -->

					</div>	
				</div><!-- end.col-lg-12 -->
			</div><!-- end.row mt -->
		</section>
	</section>
	</div>
	<?php //$this->load->view("footer.php"); ?>
</body>
</html>