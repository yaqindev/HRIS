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
							<h1 class="mb" align="center">Edit User</h1>
							<div class="row">
								<div class="col-md-6">
									<?php if ($this->session->flashdata('pesan')):?>
									<div class="alert alert-danger"><b>Perhatian ! </b> <?= $this->session->flashdata('pesan') ?></div>
									<?php endif; ?>
								</div>
							</div>
							<form action="<?php echo base_url()."master/user_act/update";?>" method="post">
								<div class="form-group">
									<label>Job Position</label>
									<div class="row">
										<div class="col-md-4">
										<select name="job" id="job" class="form-control" autofocus="true" onchange="set_employee()">
											<option value="">-- Pilih Job --</option>
											<?php foreach ($jobs as $job): ?>
											<option value="<?php echo $job->ID_JOBTITLE ?>"><?php echo $job->TITLE ?></option>
											<?php endforeach ?>
										</select>
										<input type="hidden" name="id_user" value="<?php echo $user->ID_USER ?>">
										</div>
									</div> 
								</div>
								<div class="form-group">
									<label >Nama Karyawan</label>
									<div class="row">
										<div class="col-md-4" id="box-employee">
										<select name="employee" id="employee" class="form-control" required>

											<option value="<?php echo $user->ID_EMPLOYEE ?>"><?php echo $user->NAME ?></option>
										</select>
										</div>
									</div>
								</div>
								<div class="form-group">
									<label >Username</label>
									<div class="row">
										<div class="col-md-4">
										<input type="text" name="username" id="username" class="form-control" value="<?php echo $user->NAMA_USER ?>" required>
										</div>
									</div>
								</div>
								<div class="form-group">
									<label >Email</label>
									<div class="row">
										<div class="col-md-4">
										<input type="email" name="email" id="email" class="form-control" value="<?php echo $user->EMAIL_USER ?>" required>
										</div>
									</div>
								</div>
								<div class="form-group">
									<label >Akses</label>
									<div class="row">
										<div class="col-md-4">
										<select name="akses" id="akses" class="form-control" required>
											<option value="">-- Pilih akses --</option>
											<option value="2" <?php if($user->HAK_AKSES == '2'){echo "selected";} ?> >Manager</option>
											<option value="1" <?php if($user->HAK_AKSES == '1'){echo "selected";} ?> >Administrator</option>
										</select>
										</div>
									</div>
								</div>

							  <button type="submit" class="btn btn-primary">Submit</button>
							  <a href="<?php echo base_url()."master/user";?>" class="btn btn-info" role="button">Cancel</a>
							</form>
						</div>	
					</div>
				</div>
		</section>
	</section>
	<script>
		function set_employee()
		{
			var job = $("#job").val();	
			if (job)
			{
				$.ajax({
					url 	: '<?php echo base_url(); ?>master/user_act/set_employee',
					type	: 'post',
					data	: {'job':job},
					success : function(r)
					{
						$("#box-employee").html(r);
					},
					error 	: function()
					{
						alert("Sistem error, Please contact administrator !");
					}
				});
			}else{
				$("#box-employee").val('');
				$("#job").focus();
			}
		}
	</script>
</body>
<?php
$this->load->view("footer.php");
?>