<title>Laporan Performance</title>
<?php
$this->load->view('header.php');
?>
<style>
	table, th, td {
	    border: 1px solid black;
	    border-collapse: collapse;
	}
	th, td {
	    padding: 5px;
	    text-align: left;    
}
</style>
<script src="<?php echo base_url()?>assets/js/jquery-1.8.2.min.js"></script>
<script src="<?php echo base_url() ?>assets/js/highcharts.js"></script>
<script src="<?php echo base_url() ?>assets/js/exporting.js"></script>
<script>
	$(document).ready(function () {
	    $('#grafik').highcharts({
	        chart: {
	            type: 'column'
	        },
	        title: {
	            text: 'Performance Department Procurement'
	        },
	        subtitle: {
	            text: 'periode Midyear, 2016'
	        },
	        xAxis: {
	            categories: [
	                'segment 1',
	                'segment 2',
	                'segment 3',
	                'segment 4',
	            ],
	            crosshair: true
	        },
	        yAxis: {
	            min: 0,
	            title: {
	                text: 'Nilai'
	            }
	        },
	        tooltip: {
	            headerFormat: '<span style="font-size:10px"><b>{point.key}</b></span><br>',
	            pointFormat: '<span style="color:{series.color};">{series.name}:</span> : <b>{point.y:.1f}</b><br>',
	            footerFormat: '',
	            shared: true,
	            useHTML: true
	        },
	        plotOptions: {
	            column: {
	                pointPadding: 0.2,
	                borderWidth: 0
	            }
	        },
	        series: [
				{
		            name: 'KPI Department',
		            data: [45,89,33,55]
		        },
				{
		            name: 'Competency',
		            data: [68,23,56,78]
		        },
				{
		            name: 'ZAP',
		            data: [44,75,34,67]
		        },
				{
		            name: 'Disciplinary',
		            data: [52,90,34,99]
		        },
	        ]
	    });
	});
</script>

<body>
	<section id="container">
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
						<div class="row">
							<div class="col-md-12" id="grafik">
								
							</div>
						</div>
					</div>

					</div>	
				</div><!-- end.col-lg-12 -->
			</div><!-- end.row mt -->
		</section>
	</section>

    <script src="<?php echo base_url()."assets/";?>js/bootstrap.min.js"></script>
    <script class="include" type="text/javascript" src="<?php echo base_url()."assets/";?>js/jquery.dcjqaccordion.2.7.js"></script>
    <script src="<?php echo base_url()."assets/";?>js/jquery.scrollTo.min.js"></script>
    <script src="<?php echo base_url()."assets/";?>js/jquery.nicescroll.js" type="text/javascript"></script>
    <script src="<?php echo base_url()."assets/";?>js/jquery.sparkline.js"></script>


    <!--common script for all pages-->
    <script src="<?php echo base_url()."assets/";?>js/common-scripts.js"></script>
    
    <script type="text/javascript" src="<?php echo base_url()."assets/";?>js/gritter/js/jquery.gritter.js"></script>
    <script type="text/javascript" src="<?php echo base_url()."assets/";?>js/gritter-conf.js"></script>

    <!--script for this page-->
    <script src="<?php echo base_url()."assets/";?>js/sparkline-chart.js"></script>    
	<script src="<?php echo base_url()."assets/";?>js/zabuto_calendar.js"></script>
</body>
