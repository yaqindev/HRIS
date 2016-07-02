<?php
$this->load->view('header.php');
?>
<script>
function abc()
{	
    document.getElementById("abc1").disabled = false;
	document.getElementById("abc2").disabled = false;
	document.getElementById("abc3").disabled = false;
	document.getElementById("abc4").disabled = false;
	document.getElementById("abc5").disabled = false;
	document.getElementById("abc6").disabled = false;
	document.getElementById("abc7").disabled = false;
	document.getElementById("department").disabled = false;
}
</script>
<body>
	<section id="container">
		<aside>
		<?php $this->load->view('sidebar.php'); ?>
		</aside>
		<section id="main-content">
			<section class="wrapper">
				<div class="row mt">
					<div class="col-lg-12">
					<form action="<?php echo base_url()."appraisal/kpi_act/update";?>" method="post">
						<div class="form-panel">
							<h4 class="mb"><i class="fa fa-angle-right"></i>Edit KPI</h4>
							<div class="tab-content">
								<div role="tabpanel" class="tab-pane active" id="home">
										<div class="form-group">
											<label for="department">Department</label>
											<div class="row">
												<div class="col-md-4">
													<select class="form-control" name="department" id="department" onchange="cek_bobot()" required disabled="true">
														<option value=""> -- Pilih department -- </option>
														<?php
															foreach($departments as $d)
															{
																if ($d->ID_DEPARTMENT == $id_department) {
																	echo  '<option value="'.$d->ID_DEPARTMENT.'" selected>'.$d->DEPARTMENT_NAME.'</option>';
																}else{
																	echo  '<option value="'.$d->ID_DEPARTMENT.'">'.$d->DEPARTMENT_NAME.'</option>';
																}
															}
														?>
													</select>
												</div>
											</div> 
										</div>
										<input type="hidden" name="id_kpi" value="<?php echo $id_kpi; ?>">
										<div class="form-group">
											<label for="exampleInputEmail1">KPI</label>
											<div class="row">
												<div class="col-md-4"><input type="text" name="kpi" class="form-control" id="abc7" value="<?php echo $kpi?>" disabled></div>
											</div> 
										</div>

										<div class="form-group">
											<label for="exampleInputEmail1">Stategic Objective</label>
											<div class="row">
												<div class="col-md-4"><input type="name" name="target_description" class="form-control" id="abc1" value="<?php echo $target_description?>" disabled></div>
											</div> 
										</div>
												
										<div class="form-group">
											<label for="exampleInputEmail1">Hasil Aktual</label>
											<div class="row">
												<div class="col-md-4"><input type="name" name="kpi" class="form-control" id="abc2" value="<?php echo $kpi;?>" disabled></div>
											</div>
										</div>
												
										<div class="form-group">
											<label for="exampleInputEmail1">UOM</label>
											<div class="row">
												<div class="col-md-4"><input type="name" name="uom" class="form-control" id="abc3" value="<?php echo $uom;?>" disabled></div>
											</div>
										</div>
												
										<div class="form-group">
											<label for="exampleInputEmail1">Target</label>
											<div class="row">
												<div class="col-md-4"><input type="name" name="target" class="form-control" id="abc4" value="<?php echo $target;?>" disabled></div>
											</div>
										</div>
												
										<div class="form-group">
											<label for="exampleInputEmail1">Type</label>
											<div class="row">
												<div class="col-md-4"><input type="name" name="type" class="form-control" id="abc5" value="<?php echo $type;?>" disabled></div>
											</div>
										</div>
												
										<div class="form-group">
											<label for="exampleInputEmail1">Weight</label>
											<div class="row">
												<div class="col-md-4"><input type="name" name="weight" class="form-control" id="abc6" value="<?php echo $weight;?>" disabled></div>
											</div> 
										</div>
								</div>
							</div>
						<button type="submit" class="btn btn-primary">Save</button>
						<a href="<?php echo base_url()."appraisal/kpi";?>" class="btn btn-info" role="button">Cancel</a>
						<button onclick="abc()" class="btn btn-success" name="btn" type="button">Edit*</button>
						</div>
					</form>
					</div>	
				</div>
		</section>
	</section>
</body>
<?php $this->load->view("footer.php"); ?>