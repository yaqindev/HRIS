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
							<h1 class="mb" align="center">Add Segment</h1>
							<form action="<?php echo base_url()."master/segment_act/simpan";?>" method="post">
							
							<div class="form-group">
								<label for="exampleInputEmail1">Department</label>
								<div class="row">
								<div class="col-md-4">
								<select class="form-control" name="department_id" id="dept_id" >
								<?php
									foreach($data as $d1)
									{
										echo  '<option value="'.$d1->ID_DEPARTMENT.'">'.$d1->DEPARTMENT_NAME.'</option>';
									}
								?>
								</select>
								</div>
								</div>
							</div>
						  <div class="form-group">
						    <label for="exampleInputEmail1">Segment Name</label>
							<div class="row">
						  <div class="col-md-4"><input type="name" name="sname" class="form-control"></div>
							</div> 
						  </div>
						  <div class="form-group">
						    <label for="exampleInputEmail1">Segment Code</label>
							<div class="row">
						    <div class="col-md-4"><input type="name" name="scode" class="form-control"></div>
							</div>
						  </div>
						  
						  <button type="submit" class="btn btn-primary">Submit</button>
						  <a href="<?php echo base_url()."master/segment";?>" class="btn btn-info" role="button">Cancel</a>
						 
						</form>
						</div>	
					</div>
				</div>
		</section>
	</section>
</body>
<?php $this->load->view("footer.php"); ?>