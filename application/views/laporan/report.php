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
						<h1 class="mb" align="center">Laporan Performance</h1>
						<div class="row">
							<div class="col-md-11">
								<?php if ($this->session->flashdata('pesan')):?>
								<div class="alert alert-success"><b>Berhasil ! </b> <?= $this->session->flashdata('pesan') ?></div>
								<?php endif; ?>
							</div>
						</div>
						<div class="row">
							<div class="col-md-11">
								<form action="<?php echo base_url() ?>laporan/report_act/set_grafik" method="post">
								<div class="form-group row" >
									<label for="department" class="col-md-2">Periode</label>
									<div class="col-md-2">
										<select class="form-control" name="periode_search" id="periode_search" required>
											<option value=""> -- Periode --</option>
											<?php foreach ($periode as $periode): ?>
											<option value="<?php echo $periode->ID_PERIODE ?>"><?php echo ucfirst(strtolower($periode->NAMA_PERIODE)) ?></option>

											<?php endforeach ?>
										</select>
									</div>
									<div class="col-md-2">
										<select class="form-control" name="tahun_search" id="tahun_search" required>
											<option value=""> -- Tahun --</option>
											<?php foreach ($years as $year): ?>
											<option value="<?php echo $year->NAME_YEAR ?>"><?php echo $year->NAME_YEAR ?></option>

											<?php endforeach ?>
										</select>
									</div>
								</div>
								<div class="form-group row" >
									<label class="col-md-2">Kriteria</label>
									<div class="col-md-4" >
										<select class="form-control" name="kriteria" id="kriteria" required>
											<option value=""> -- Pilih kriteria --</option>
											<option value="1"> kpi Department</option>
											<option value="2"> Competency</option>
											<option value="3"> ZAP</option>
											<option value="4"> Disciplinary</option>
										</select>
									</div>
								</div>
								<div class="form-group row" >
									<div class="col-md-offset-2 col-md-4" >
										<button type="button" class="btn btn-primary" onclick="set_box()">
											Process
										</button>
										<button type="submit" class="btn btn-success">
											Chart
										</button>
									</div>
								</div>
								</form>
							</div><!-- end.col-md-offset-1 -->
						</div><!-- end.row -->
						<br>
						<div id="box_report">
							<div>							

							</div>
							<!-- end #box_report -->
						</div>
					</div>	
				</div><!-- end.col-lg-12 -->
			</div><!-- end.row mt -->
		</section>
	</section>

	<script>
		function set_box()
		{
			var periode 	= $("#periode_search").val();
			var tahun 		= $("#tahun_search").val();
			var kriteria 	= $("#kriteria").val();
			if (periode && tahun && kriteria)
			{
				$.ajax({
					url 	:'<?php echo base_url() ?>laporan/report_act/set_box',
					type 	:'post',
					data 	:{'periode':periode, 'tahun':tahun, 'kriteria':kriteria},
					success : function(r)
					{
						$("#box_report").html(r);
					},
					error 	: function(r)
					{
						alert("Sistem Error , Please contact administrator !"+r);
					}
				});
			}else{
				alert("Semua kolom harus di pilih !");
				$("#periode_search").focus();
				$("#periode_search").val('');
				$("#tahun_search").val('');
				$("#kriteria").val('');
				$("#box_report").html('');
			}
		}

		function cetak_dept()
		{
			var periode 	= $("#periode_search").val();
			var tahun 		= $("#tahun_search").val();
			var kriteria 	= $("#kriteria").val();
			if (periode && tahun && kriteria)
			{
				$.ajax({
					url 	:'<?php echo base_url() ?>laporan/print_DEPT',
					type 	:'post',
					data 	:{'periode':periode, 'tahun':tahun, 'kriteria':kriteria},
					success : function(r)
					{
						alert("Data berhasil di cetak.");
					},
					error 	: function(r)
					{
						alert("Sistem Error , Please contact administrator !"+r);
					}
				});
			}else{
				alert("Semua kolom harus di pilih !");
				$("#periode_search").focus();
				$("#periode_search").val('');
				$("#tahun_search").val('');
				$("#kriteria").val('');
				$("#box_report").html('');
			}	
		}
	</script>
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
<?php //$this->load->view("footer.php"); ?>