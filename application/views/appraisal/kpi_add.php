<?php
$this->load->view('header.php');
?>
<body>
	<section id="container">
		<aside>
	
		<?php $this->load->view('sidebar.php'); ?>
		</aside>
		<section id="main-content">
			<section class="wrapper">
				<div class="row mt">
					<div class="col-lg-12">
						<div class="form-panel">
							<h1 class="mb" align="center">Add KPI</h1>
								<?php 

								if ($this->session->flashdata('pesan')):?>
								<div>
									<div class="alert alert-danger"><?= $this->session->flashdata('pesan') ?></div>
								</div>							  
								<?php endif; ?>
								<form class="form-horizontal style-form" action="<?php echo base_url()."appraisal/kpi_act/simpan";?>" method="post">
									<div class="form-group">
										<label class="col-sm-2 col-sm-2 control-label">Department</label>
										<div class="row">
											<div class="col-md-4">
												<select class="form-control" name="department_id" id="department" onchange="cek_bobot()" required>
													<option value=""> -- Pilih department -- </option>
												<?php
													foreach($departments as $d)
													{
														echo  '<option value="'.$d->ID_DEPARTMENT.'">'.$d->DEPARTMENT_NAME.'</option>';
													}
												?>
												</select>
											</div>
										</div>
									</div>

									<div class="form-group">
										<label class="col-sm-2 col-sm-2 control-label" >Strategic Objectives</label>
										<div class="row">
											<div class="col-sm-4">
											  	<input class="form-control" id="focusedInput" type="text" name="target_description" required>
											</div>
										</div>
									</div>
								  
								  <div class="form-group">
									  	<label class="col-sm-2 col-sm-2 control-label">KPI</label>
									  	<div class="row">
										  	<div class="col-sm-4">
											  <input class="form-control" id="focusedInput" type="text" name="kpi" required>
										  	</div>
									  	</div>
								  </div>
								  
								  <div class="form-group">
									  	<label class="col-sm-2 col-sm-2 control-label">UOM</label>
									  	<div class="row">
										  	<div class="col-sm-4">
											  <input class="form-control" id="focusedInput" type="text" name="uom" required>
										  	</div>
									  	</div>
								  </div>
								  
								  <div class="form-group">
									  	<label class="col-sm-2 col-sm-2 control-label">Target</label>
									  	<div class="row">
										  	<div class="col-sm-4">
											  <input class="form-control" id="focusedInput" type="text" name="target" required>
										  	</div>
									  	</div>
								  </div>
								  
								  <div class="form-group">
									  	<label class="col-sm-2 col-sm-2 control-label">Type</label>
									  	<div class="row">
										  	<div class="col-sm-4">
												<select class="combobox" style="width:100%" name="type" required>
													<option value="+" selected>+</option>
													<option value="-">-</option>
												</select>
										  	</div>
									  	</div>
								  </div>
								  
								  <div class="form-group">
									  	<label class="col-sm-2 col-sm-2 control-label">Weight</label>
									  	<div class="row">
										  	<div class="col-sm-4">
											  <input type="number" class="form-control" id="focusedInput" type="text" name="weight"required>
											  <div id="help_bobot"></div>
										  	</div>
									  	</div>
								  </div>
							

						  	<button type="submit" class="btn btn-primary">Submit</button>
						  	<a href="<?php echo base_url()."appraisal/kpi";?>" class="btn btn-info" role="button">Cancel</a>
						 
						</form>
						</div>	
					</div>
				</div>
		</section>
	</section>
<?php
$this->load->view("footer.php");
?>
	<script>
	function cek_bobot()
	{
		var department = $("#department").val();

		$.ajax({
			url 	:'<?= base_url() ?>appraisal/kpi_act/cek_bobot',
			type 	:'post',
			data 	:{'department':department},
			success :function(r)
			{
				$("#help_bobot").html(r);
			},
			error : function ()
			{
				alert("sistem error, pleace contact administrator !");
			}
		});

	}
	</script>
</body>