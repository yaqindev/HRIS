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
							<h1 class="mb" align="center">Add Group</h1>
							<form action="<?php echo base_url()."master/group_act/simpan";?>" method="post">
							
								<div class="form-group">
									<label for="exampleInputEmail1">Segment</label>
									<div class="row">
									<div class="col-md-4">
									<select class="form-control" name="segment_id" id="segt_id" >
									<?php
										foreach($data1 as $d1)
										{
											echo  '<option value="'.$d1['ID_SEGMENT'].'">'.$d1['SEGMENT_NAME'].'</option>';
										}
									?>
									</select>
									</div>
									</div>
								</div>
							  <div class="form-group">
							    <label for="exampleInputEmail1">Group Name</label>
								<div class="row">
							  <div class="col-md-4"><input type="name" name="gname" class="form-control"></div>
								</div> 
							  </div>
							  <div class="form-group">
							    <label for="exampleInputEmail1">Group Code</label>
								<div class="row">
							    <div class="col-md-4"><input type="name" name="gcode" class="form-control"></div>
								</div>
							  </div>
							  
							  <button type="submit" class="btn btn-primary">Submit</button>
							  <a href="<?php echo base_url()."master/group";?>" class="btn btn-info" role="button">Cancel</a>
							 
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