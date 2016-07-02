<title>Performance Competency</title>
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
						<h1 class="mb" align="center">Performance Competency</h1>
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
										<select class="form-control" name="department_search" id="department_search" onchange="set_job()" required>
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
									<label for="department" class="col-md-2">Job Position</label>
									<div class="col-md-4" id="box_job_search">
										<select class="form-control" name="job_search" id="job_search" required>
											<option value=""> -- Pilih Job --</option>
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
									<div class="col-md-offset-2 col-md-4" >
										<button class="btn btn-primary" onclick="set_box_performance_competency()">
											Process
										</button>
									</div>
								</div>
							</div><!-- end.col-md-offset-1 -->
						</div><!-- end.row -->
							<br>
						<div id="box_performance_competency">							
						</div>
						<!-- end #box_performance_kpi -->
					</div>	
				</div><!-- end.col-lg-12 -->
			</div><!-- end.row mt -->
		</section>
	</section>
	<script>
		function set_job()
		{
			var department = $("#department_search").val();
			if (department)
			{
				$.ajax({
					url 	:'<?php echo base_url() ?>performance/performance_competency_act/set_job',
					type 	:'post',
					data 	:{'department':department},
					success : function(r)
					{
						$("#box_job_search").html(r);
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
				$("#periode_search").val('');
				$("#tahun_search").val('');
				$("#box_performance_competency").html('');
			}
		}

		function set_employee()
		{
			var job = $("#job_search").val();
			if (job)
			{
				$.ajax({
					url 	:'<?php echo base_url() ?>performance/performance_competency_act/set_employee',
					type 	:'post',
					data 	:{'job':job},
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
				alert("pilih Job Position !");
				$("#job_search").val('');
				$("#employee_search").val('');
				$("#periode_search").val('');
				$("#tahun_search").val('');
				$("#box_performance_competency").html('');
			}
		}

		function set_box_performance_competency()
		{
			var department 	= $("#department_search").val();
			var job 		= $("#job_search").val();
			var karyawan 	= $("#employee_search").val();
			var periode 	= $("#periode_search").val();
			var tahun 		= $("#tahun_search").val();

			if (department && job && karyawan && periode && tahun)
			{
				$.ajax({
					url 	:'<?php echo base_url() ?>performance/performance_competency_act/set_box_competency',
					type 	:'post',
					data 	:{'department':department,'job':job,'karyawan':karyawan,'periode':periode,'tahun':tahun},
					success : function(r)
					{
						$("#box_performance_competency").html(r);
					},
					error 	: function(r)
					{
						alert("Sistem Error , Please contact administrator !"+r);
					}
				});
			}else{
				alert("Cek inputan sebelum di proses, Pastikan sudah terpilih !");
				$("#department_search").val('');
				$("#job_search").val('');
				$("#employee_search").val('');
				$("#periode_search").val('');
				$("#tahun_search").val('');
				$("#box_performance_competency").html('');
			}
		}	

		function hitung_result(id)
		{
			var K = parseInt($("#competency_"+id+"_1").val());
			var S = parseInt($("#competency_"+id+"_2").val());
			var A = parseInt($("#competency_"+id+"_3").val());
			var result = K + S + A;
			$("#result"+id).val(result);
			$("#view_result_"+id).text(result+"%");
		}

		function active_input_data(id)
		{
			$(".input-data"+id).removeAttr('disabled');
		}
	</script>
</body>
<?php $this->load->view("footer.php"); ?>