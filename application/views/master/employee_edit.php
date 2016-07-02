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
							<h1 class="mb" align="center">Edit Employee</h1>
							<form action="<?php echo base_url()."master/employee_act/update";?>" method="post">
							<div class="row">
								<div class="col-md-12">
									<h3>Persolan Detail</h3>
									<hr>

									<div class="form-group row">
										<label class="col-md-offset-1 col-md-2">NIK</label>
										<div class="col-md-4">
											<input type="text" class="form-control" name="nik" placeholder="Nomer Induk Karyawan" value="<?php echo $employee->NIK ?> " required>
											<input type="hidden" class="form-control" name="id_detail" value="<?php echo $employee->ID_DETAIL ?> " required>
											<input type="hidden" class="form-control" name="id_employee" value="<?php echo $employee->ID_EMPLOYEE ?> " required>
										</div>
									</div>
									<div class="form-group row">
										<label class="col-md-offset-1 col-md-2">Full Name</label>
										<div class="col-md-4">
											<input type="text" class="form-control" name="nama" placeholder="Full Name" value="<?php echo $employee->NAME ?> " required>
										</div>
									</div>
									<div class="form-group row">
										<label class="col-md-offset-1 col-md-2">ID Card Number</label>
										<div class="col-md-4">
											<input type="text" class="form-control" name="idc" placeholder="ID Card" value="<?php echo $employee->IDC_NUMBER ?> " required>
										</div>
									</div>
									<div class="form-group row">
										<label class="col-md-offset-1 col-md-2">Gender</label>
										<div class="col-md-4">
											<select name="gender" id="gender" class="form-control" required>
												<option value="">-- Pilih Gender --</option>
												<option value="1" <?php if ($employee->GENDER =='1'){echo "selected";} ?> >Male</option>
												<option value="2" <?php if ($employee->GENDER =='2'){echo "selected";} ?> >Female</option>
											</select>
										</div>
									</div>
									<div class="form-group row">
										<label class="col-md-offset-1 col-md-2">Place of Birth</label>
										<div class="col-md-4">
											<input type="text" class="form-control" name="pob" value="<?php echo $employee->BIRTHPLACE ?> " required>
										</div>
									</div>
									<div class="form-group row">
										<label class="col-md-offset-1 col-md-2">Date of Birth</label>
										<div class="col-md-4">
											<input type="date" class="form-control" name="dob" value="<?php echo $employee->BIRTHDATE ?> " required>
										</div>
									</div>
									<div class="form-group row">
										<label class="col-md-offset-1 col-md-2">Marital Status</label>
										<div class="col-md-4">
											<select name="marital" id="marital" class="form-control" required>
												<option value="">-- Pilih Marital --</option>
												<option value="1" <?php if ($employee->MARITAL_STATUS =='1'){echo "selected";} ?> >Married</option>
												<option value="2" <?php if ($employee->MARITAL_STATUS =='2'){echo "selected";} ?> >Not Married</option>
											</select>
										</div>
									</div>
									<div class="form-group row">
										<label class="col-md-offset-1 col-md-2">Nationality</label>
										<div class="col-md-4">
											<input type="text" class="form-control" name="nationality" placeholder="Nationality" value="<?php echo $employee->NATIONALITY ?> " required>
										</div>
									</div>
									<div class="form-group row">
										<label class="col-md-offset-1 col-md-2">Religion</label>
										<div class="col-md-4">
											<input type="text" class="form-control" name="religion" placeholder="Religion" value="<?php echo $employee->RELIGION ?> " required>
										</div>
									</div>
								</div>
							</div>

							<div class="row">
								<div class="col-md-12">
									<h3>Job Detail</h3>
									<hr>

									<div class="form-group row">
										<label class="col-md-offset-1 col-md-2">Join Date</label>
										<div class="col-md-4">
											<input type="date" class="form-control" name="join" value="<?php echo $employee->JOINT_DATE ?> " required>
										</div>
									</div>
									<div class="form-group row">
										<label class="col-md-offset-1 col-md-2">Employment Status</label>
										<div class="col-md-4">
											<select name="e_status" class="form-control" required>
												<option value="">-- Pilih --</option>
												<option value="Tetap" <?php if ($employee->EMPLOYMENT_STATUS =='Tetap'){echo "selected";} ?> >Tetap</option>
												<option value="Kontrak" <?php if ($employee->EMPLOYMENT_STATUS =='Kontrak'){echo "selected";} ?> >Kontrak</option>
												<option value="Harian lepas" <?php if ($employee->EMPLOYMENT_STATUS =='Harian lepas'){echo "selected";} ?> >Harian Lepas</option>
												<option value="Borongan" <?php if ($employee->EMPLOYMENT_STATUS =='Borongan'){echo "selected";} ?> >Borongan</option>
												<option value="Masa percobaan" <?php if ($employee->EMPLOYMENT_STATUS =='Masa percobaan'){echo "selected";} ?> >Masa percobaan</option>
												<option value="Lain - lain" <?php if ($employee->EMPLOYMENT_STATUS =='Lain - lain'){echo "selected";} ?> >Lain - lain</option>
											</select>
										</div>
									</div>
									<div class="form-group row">
										<label class="col-md-offset-1 col-md-2">Department</label>
										<div class="col-md-4">
											<select name="department" id="department" class="form-control" onchange="set_segment()" required>
												<option value="">-- Pilih --</option>
												<?php foreach ($department as $department): ?>
												<option value="<?php echo $department->ID_DEPARTMENT ?>" <?php if ($employee->ID_DEPARTMENT == $department->ID_DEPARTMENT){echo "selected";} ?> ><?php echo $department->DEPARTMENT_NAME ?></option>
												<?php endforeach ?>
											</select>
										</div>
									</div>
									<div class="form-group row">
										<label class="col-md-offset-1 col-md-2">Segment</label>
										<div class="col-md-4" id="box-segment">
											<select name="segment" class="form-control">
												<option value="">-- Pilih --</option>
											</select>
										</div>
									</div>
									<div class="form-group row">
										<label class="col-md-offset-1 col-md-2">Job Title</label>
										<div class="col-md-4" id="box-job">
											<select name="job" class="form-control" required>
												<option value="<?php echo $jobtitle[0]->ID_JOBTITLE ?>"><?php echo $jobtitle[0]->TITLE ?></option>
											</select>
										</div>
									</div>
									<div class="form-group row">
										<label class="col-md-offset-1 col-md-2">Location</label>
										<div class="col-md-4">
											<select name="location" class="form-control" required>
												<option value="">-- Pilih --</option>
												<option value="1" <?php if ($employee->LOCATION =='1'){echo "selected";} ?> >Pasuruan</option>
												<option value="2" <?php if ($employee->LOCATION =='2'){echo "selected";} ?> >Sidoarjo</option>
												<option value="4" <?php if ($employee->LOCATION =='3'){echo "selected";} ?> >Jakarta</option>
												<option value="3" <?php if ($employee->LOCATION =='4'){echo "selected";} ?> >Lain-lain</option>
											</select>
										</div>
									</div>
								</div>
							</div>
							<hr>
							<div class="row">
								<div class="col-md-11 col-md-offset-1">
									<button type="submit" class="btn btn-success">Save</button>
									<button type="reset" class="btn btn-default">Cancel</button>
								</div>
							</div>
						</div>	
					</div>
					</form>
				</div>
		</section>
	</section>
	<script src="<?php echo base_url();?>assets/js/jquery-1.8.3.min.js"></script>
	<script>
		function set_segment()
		{
			var department = $("#department").val();
			if (department)
			{
				$.ajax({
					url 	:'<?php echo base_url() ?>master/employee_act/set_segment',
					type 	:'post',
					data 	:{'department':department},
					success : function(r)
					{
						$("#box-segment").html(r);
					},
					error 	: function(r)
					{
						alert("Sistem Error , Please contact administrator !"+r);
					}
				});
			}else{
				alert("Pilih Department ! ");
				$("#segment").val('');
				$("#job").val('');
				$("#department").focus();
			}
		}

		function set_job()
		{
			var segment = $("#segment").val();
			if (segment)
			{
				$.ajax({
					url 	:'<?php echo base_url() ?>master/employee_act/set_job',
					type 	:'post',
					data 	:{'segment':segment},
					success : function(r)
					{
						$("#box-job").html(r);
					},
					error 	: function(r)
					{
						alert("Sistem Error , Please contact administrator !"+r);
					}
				});
			}else{
				alert("Pilih Segment ! ");
				$("#job").val('');
				$("#segment").focus();
			}
		}
	</script>
</body>
<?php
$this->load->view("footer.php");
?>