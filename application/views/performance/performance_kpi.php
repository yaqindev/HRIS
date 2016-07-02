<title>Performance KPI</title>
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
						<h1 class="mb" align="center">Performance KPI</h1>
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
										<select class="form-control" name="department_search" id="department_search" onchange="pilih_employee()" required>
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
									<div class="col-md-4" id="box_employee">
										<select class="form-control" name="employee_search" id="employee_search" required>
											<option value=""> -- Pilih Karyawan --</option>
										</select>
									</div>
								</div>
							</div><!-- end.col-md-offset-1 -->
						</div><!-- end.row -->
							<br>							
							<br>
						<div id="box_performance_kpi">							
							<ul class="nav nav-tabs" role="tablist">
								<li role="presentation" class="active"><a href="#input" aria-controls="input" role="tab" data-toggle="tab">Input Bulanan</a></li>
								<li role="presentation" ><a href="#monitoring" aria-controls="monitoring" role="tab" data-toggle="tab">Monitoring</a></li>
								<li role="presentation"><a href="#evaluation" aria-controls="evaluation" role="tab" data-toggle="tab">Evaluation</a></li>
							</ul>

							<div class="tab-content">
								<div role="tabpanel" class="tab-pane active" id="input">
									<div class="form-panel">
										<form action="<?php echo base_url()."performance/insert_kpi_production";?>" method="post">
											<div class="row">
												<div class="col-md-12">
													<div class="row form-group">
														<label for="tahun" class="col-md-1">Tahun</label>
														<div class="col-md-4">
															<select class="form-control" name="tahun" id="tahun" disabled="true">
																<option value=""> -- Pilih Tahun --</option>
																<option value="2015">2015</option>
																<option value="2014">2014</option>
															</select>
														</div>
													</div>
													<div class="row form-group">
														<label for="bulan" class="col-md-1">Bulan</label>
														<div class="col-md-4">
															<select class="form-control" name="bulan" id="bulan" disabled="true">
																<option value=""> -- Pilih Bulan --</option>
																<option value="1">January</option>
																<option value="2">February</option>
															</select>
														</div>
													</div>
			 									</div><!-- end .col-md-12 -->
											</div><!-- end .row -->
											<br>
											<div class="row">
												<div class="col-md-12">
													<table  class="display" cellspacing="0" width="100%">
														<thead bgcolor="#696969">
															<tr>
																<th style ='color :white; text-align:center;' width="5%">No.</th>
																<th style ='color :white; text-align:center;' width="40%">KPI</th>
																<th style ="color :white; text-align:center;" width="10%">Weight</th>
																<th style ='color :white; text-align:center;' width="10%">UOM</th>
																<th style ='color :white; text-align:center;' width="10%">Target</th>
																<th style ='color :white; text-align:center;' width="20%">Actual Bulanan</th>
																<th style ='color :white; text-align:center;' width="5%"></th>
															</tr>
														</thead>
														<tbody>
															<tr>
																<td></td>
																<td></td>
																<td></td>
																<td></td>
																<td></td>
																<td></td>
																<td></td>
															</tr>
														</tbody>
													</table>
												</div><!-- end .col-md-12 -->
											</div><!-- end .row -->
											<br>
											<div class="row">
												<div class="col-md-12">
													<div class="pull-right">
													<button type="submit" class="btn btn-primary" disabled="true">Simpan</button>
													<a href="<?php echo base_url()."index.php/performance/performance_kpi";?>" class="btn btn-info" role="button" disabled="true">Cancel</a>
													</div>
												</div><!-- end col-md-12 -->
											</div><!-- end.row -->
										</form>
									</div><!-- end #form-panel -->
								</div><!-- end #input -->

								<div role="tabpanel" class="tab-pane" id="monitoring">
									<table  id="example" class="display" cellspacing="0" width="100%">
									<thead>
										<tr  bgcolor="#696969">
											<th rowspan ="2" style ="color :white"><center>No.</center></th>
											<th rowspan = "2" style ="color :white"><center>KPI</center></th>
											<th colspan="12" style ="color :white"><center>Actual</center></th>
											
										</tr>
										  
										<tr bgcolor=#696969>
											<th style ="color :white"><center>Jan</center></th>
											<th style ="color :white"><center>Feb</center></th>
											<th style ="color :white"><center>Mar</center></th>
											<th style ="color :white"><center>Apr</center></th>
											<th style ="color :white"><center>Mei</center></th>
											<th style ="color :white"><center>Jun</center></th>
											<th style ="color :white"><center>Jul</center></th>
											<th style ="color :white"><center>Aug</center></th>
											<th style ="color :white"><center>Sep</center></th>
											<th style ="color :white"><center>Oct</center></th>
											<th style ="color :white"><center>Nov</center></th>
											<th style ="color :white"><center>Des</center></th>
										</tr>
									</thead>
										<tr>
											<td></td>
											<td></td>
											<td></td>
											<td></td>
											<td></td>
											<td></td>
											<td></td>
											<td></td>
											<td></td>
											<td></td>
											<td></td>
											<td></td>
											<td></td>
											<td></td>
										</tr>
									<tbody>
									</tbody>
									</table>
								</div>
								
								<div role="tabpanel" class="tab-pane" id="evaluation">
									<table  id="example" class="display" cellspacing="0" width="100%">
									<thead>
										<tr bgcolor =#696969>
											<td style ='color :white'>No.</td>
											<td style ='color :white'>Strategic Objective</td>
											<td style ='color :white'>KPI</td>
											<td style ='color :white'>UOM</td>
											<td style ='color :white'>Target</td>
											<td style ='color :white'>Weight</td>
											<td style ='color :white'>Actual</td>
											<td style ='color :white'>Score</td>
											<td style ='color :white'>Total</td>
										</tr>
									</thead>
							
									<tbody>
										<tr>
											<td></td>
											<td></td>
											<td></td>
											<td></td>
											<td></td>
											<td></td>
											<td></td>
											<td></td>
											<td></td>
										</tr>
									</tbody>														
									</table>
								</div>
							</div><!-- end.tab-content -->
						</div><!-- end #box_performance_kpi -->
					</div>	
				</div><!-- end.col-lg-12 -->
			</div><!-- end.row mt -->
		</section>
	</section>
	<script>
		function set_performance_kpi()
		{
			var department = $("#department_search").val();
			var karyawan = $("#employee_search").val();
			if (department != '')
			{
				if (karyawan != '')
				{
					// alert(department+" dan "+karyawan);
					$.ajax({
						url 	:'<?= base_url() ?>performance/performance_kpi_act/set_performance_kpi',
						type 	:'post',
						data 	:{'department':department,'karyawan':karyawan},
						success : function(r)
						{
							$("#box_performance_kpi").html(r);
						},
						error : function()
						{
							alert("sistem error, please contact administrator !");
						}
					});
				}else{
					$.ajax({
						url 	:'<?= base_url() ?>performance/performance_kpi_act/set_kosong',
						success :function(r)
						{
							$("#box_performance_kpi").html(r);
						}
					});
					alert("Anda harus memilih karyawan !");
					$("#employee_search").focus();
				}
			}else{
				$.ajax({
					url 	:'<?= base_url() ?>performance/performance_kpi_act/set_kosong',
					success :function(r)
					{
						$("#box_performance_kpi").html(r);
					}
				});
				alert("Anda harus memilih department !");
				$("#department_search").focus();
				$("#employee_search").val('');
			}	
		}

		function pilih_employee()
		{
			var department = $("#department_search").val();
			if (department != '')
			{
				$.ajax({
					url 	:'<?= base_url() ?>performance/performance_kpi_act/pilih_employee',
					type 	:'post',
					data 	:{'department':department},
					success : function(r)
					{
						$("#box_employee").html(r);
						$.ajax({
							url 	:'<?= base_url() ?>performance/performance_kpi_act/set_kosong',
							success :function(r)
							{
								$("#box_performance_kpi").html(r);
							}
						});
					},
					error : function(r)
					{
						alert("Sistem error, pleace contact administrator");
					}

				});
			}else{
				$.ajax({
					url 	:'<?= base_url() ?>performance/performance_kpi_act/set_kosong',
					success :function(r)
					{
						$("#box_performance_kpi").html(r);
					}
				});
				alert("Anda harus memilih department !");
				$("#department_search").focus();
				$("#employee_search").val('');
			}
		}

		function set_bulan()
		{
			var tahun = $('#tahun').val();
			if (tahun != '')
			{
				$.ajax({
					url 	:'<?= base_url() ?>performance/performance_kpi_act/set_bulan',
					type 	:'post',
					data 	:{'tahun':tahun},
					success :function(r)
					{
						$("#box_bulan").html(r);
					}
				});
			}else{
				alert("pilih tahun");
				$("#bulan").val('');				
				$('#tahun').focus();
			}
		}

		function set_inputan_kpi()
		{
			var tahun 		= $("#tahun").val();
			var bulan 		= $("#bulan").val();
			var department 	= $("#department_id").val();
			var karyawan 	= $("#employee_id").val();

			if (tahun != "") 
			{
				if (bulan != '')
				{
					$.ajax({
						url : '<?= base_url() ?>performance/performance_kpi_act/set_inputan_kpi',
						type : 'post',
						data : {'tahun':tahun,'bulan':bulan,'department':department,'karyawan':karyawan},
						success : function(r)
						{
							$("#box_inputan_kpi").html(r);
						},
						error : function (r)
						{
							alert("sistem error , please contact administator !");
						}
 					});
				}else{
					alert("pilih bulan");
					$('#bulan').focus();
				}
			}else{
				alert("pilih tahun");
				$("#bulan").val('');				
				$('#tahun').focus();
			}
		}

		function edit(id)
		{
			$("#btn_input_"+id).attr('disabled','true');
			$("#kpi_"+id).removeAttr('readonly');
		}

		function set_box_monitoring()
		{
			var department 		= $("#department_search").val();
			var employee 		= $("#employee_search").val();
			var tahun 			= $("#tahun_monitoring").val();
			$.ajax({
				url 		: '<?= base_url() ?>performance/performance_kpi_act/set_box_monitoring',
				type 		: 'post',
				data 		: {'department':department,'employee':employee,'tahun':tahun},
				success 	: function(r)
				{
					$("#box_monitoring").html(r);
				},
				error		: function()
				{
					alert('Error sistem , pleace contact administator!');
				}
			});
		}

		function set_periode()
		{
			var tahun 		= $("#tahun_periode").val();
			if (tahun == '')
			{
				$("#periode").val('');
				alert('pilih tahun !');
				$.ajax({
					url 		: '<?= base_url() ?>performance/performance_kpi_act/set_periode_kosong',
					type 		: 'post',
					success 	: function(r)
					{
						$("#box_periode").html(r);
					},
				});
			}	
		}

		function set_box_periode()
		{
			var tahun 		= $("#tahun_periode").val();
			var periode 	= $("#periode").val();
			var department 	= $("#department_id").val();
			var employee 	= $("#employee_id").val();

			if (periode != '')
			{
				$.ajax({
					url 		: '<?= base_url() ?>performance/performance_kpi_act/set_box_periode',
					type 		: 'post',
					data 		: {'department':department,'employee':employee,'tahun':tahun,'periode':periode},
					success 	: function(r)
					{
						$("#box_periode").html(r);
					},
					error		: function()
					{
						alert('Error sistem , pleace contact administator!');
					}
				});
			}else{
				alert('pilih periode !');
				$.ajax({
					url 		: '<?= base_url() ?>performance/performance_kpi_act/set_periode_kosong',
					type 		: 'post',
					success 	: function(r)
					{
						$("#box_periode").html(r);
					},
				});
			}
		}

		function enable_edit(id)
		{
			$("#input_actual_"+id).removeAttr('readonly');
		}

	</script>
</body>
<?php $this->load->view("footer.php"); ?>