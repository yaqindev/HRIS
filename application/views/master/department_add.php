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
							<h1 class="mb" align="center">Add Department</h1>
							<form action="<?php echo base_url()."master/department_act/simpan";?>" method="post">
							  <div class="form-group">
							    <label for="exampleInputEmail1">Department Name</label>
								<div class="row">
							  <div class="col-md-4"><input type="name" name="dname" class="form-control"></div>
								</div> 
							  </div>
							  <div class="form-group">
							    <label for="exampleInputEmail1">Department Code</label>
								<div class="row">
							    <div class="col-md-4"><input type="name" name="dcode" class="form-control"></div>
								</div>
							  </div>
							  
							  <button type="submit" class="btn btn-primary">Submit</button>
							  <a href="<?php echo base_url()."master/department";?>" class="btn btn-info" role="button">Cancel</a>
							</form>
						</div>	
					</div>
				</div>
		</section>
	</section>
</body>
<?php
$this->load->view("footer.php");
?>