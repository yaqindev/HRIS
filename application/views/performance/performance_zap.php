<title>Performance Zap</title>
<?php
$this->load->view('header.php');
?>
<!-- DataTables CSS -->
<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.8/css/jquery.dataTables.css">
  
<!-- jQuery -->
<script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
<script>
var jq = $.noConflict();

</script>
<!-- DataTables -->
<script type="text/javascript" charset="utf8" src="//cdn.datatables.net/1.10.8/js/jquery.dataTables.js"></script>
<script>
jq(document).ready(function() {
	jq('#example').DataTable();
	
} );
</script>
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
<script>
function bulan(clicked_id) {
	var cells = document.getElementsByClassName(clicked_id); 
	for (var i = 0; i < cells.length; i++) { 
		cells[i].disabled = false;
	}
}

function actual(clicked_id) {
	var cells = document.getElementsByClassName(clicked_id); 
	for (var i = 0; i < cells.length; i++) { 
		cells[i].disabled = false;
	}
}
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
						<h1 class="mb" align="center">Performance ZAP</h1>
						<div class="row">
							<div class="col-md-11">
								<?php if ($this->session->flashdata('pesan')):?>
								<div class="alert alert-success"><b>Berhasil ! </b> <?= $this->session->flashdata('pesan') ?></div>
								<?php endif; ?>
							</div>
						</div>
						<div class="row">
							<div class="col-md-11">
								<div class="form-group row">
									<label for="department" class="col-md-2">Department</label>
									<div class="col-md-4 ">
										<select class="form-control" name="department_search" id="department_search" onchange="set_employee()" required>
											<option value=""> -- Pilih Department --</option>
											<?php
												foreach($departments as $department) {
												echo "<option value=".$department->ID_DEPARTMENT.">".$department->DEPARTMENT_NAME."</option>";
												}
											?>
										</select>
									</div>
								</div>
								<div class="form-group row" >
									<label for="department" class="col-md-2">Karyawan</label>
									<div class="col-md-4" id="box_employee_search">
										<select class="form-control" name="employee_search" id="employee_search" required>
											<option value=""> -- Pilih Karyawan --</option>
										</select>
									</div>
								</div>
								<div class="form-group row" >
									<label for="department" class="col-md-2">Periode</label>
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
									<div class="col-md-offset-2 col-md-4" >
										<button class="btn btn-primary" onclick="set_box_performance_zap()">
											Process
										</button>
									</div>
								</div>
							</div><!-- end.col-md-offset-1 -->
						</div><!-- end.row -->
							<br>
						<div id="box_performance_zap">							
							
						</div><!-- end #box_performance_zap -->
					</div>	
				</div><!-- end.col-lg-12 -->
			</div><!-- end.row mt -->
		</section>
	</section>
	<script>
		function set_employee()
		{
			var department = $("#department_search").val();
			if (department)
			{
				$.ajax({
					url 	:'<?php echo base_url() ?>performance/performance_zap_act/set_employee',
					type 	:'post',
					data 	:{'department':department},
					success : function(r)
					{
						$("#box_employee_search").html(r);
					},
					error 	: function(r)
					{
						alert("Sistem Error , Please contact administrator !"+r);
					}
				});
			}else{
				alert("pilih Department !");
				$("#department_search").val('');
				$("#job_search").val('');
				$("#employee_search").val('');
				$("#tahun_search").val('');
				$("#box_performance_competency").html('');
			}
		}


		function set_box_performance_zap()
		{
			var department 	= $("#department_search").val();
			var karyawan 	= $("#employee_search").val();
			var tahun 		= $("#tahun_search").val();

			if (department && karyawan && tahun)
			{
				$.ajax({
					url 	:'<?php echo base_url() ?>performance/performance_zap_act/set_box_zap',
					type 	:'post',
					data 	:{'department':department,'karyawan':karyawan,'tahun':tahun},
					success : function(r)
					{
						$("#box_performance_zap").html(r);
					},
					error 	: function(r)
					{
						alert("Sistem Error , Please contact administrator !"+r);
					}
				});
			}else{
				alert("Cek inputan sebelum di proses, Pastikan sudah terpilih !");
				$("#department_search").val('');
				$("#employee_search").val('');
				$("#tahun_search").val('');
				$("#box_performance_competency").html('');
			}
		}

		function active_input_data()
		{
			$(".input-data").removeAttr('disabled');
		}	

	</script>
</body>
<?php $this->load->view("footer.php"); ?>