<?php
$this->load->view('header.php');
?>
<script>
function abc() {
	
    document.getElementById("abc1").disabled = false;
	document.getElementById("abc2").disabled = false;
	document.getElementById("abc3").disabled = false;
	document.getElementById("department_name").disabled = false;

}
</script>
<body>
	<section id="container">
		<aside>
	
		<?php
		/*if(isset($_GET['page']))
		{
			$page = $_GET['page'];
		}
		else
		{
			$page=0;
		}*/
		$this->load->view('sidebar.php');
		?>
		</aside>
		<section id="main-content">
			<section class="wrapper">
				<div class="row mt">
					<div class="col-lg-12">
						<div class="form-panel">
							<h1 class="mb" align="center">Edit Segment</h1>
							<ul class="nav nav-tabs" role="tablist">
							 <form action="<?php echo base_url()."master/segment_act/update";?>" method="post">
								<div class="tab-content">
									<div role="tabpanel" class="tab-pane active" id="home">
									<div class="form-group">
									<?php
										foreach($data1 as $d)
										{
											echo '<input type="text" name="id_segment" value="'.$d['ID_SEGMENT'].'" style="visibility:hidden;">';
											echo '<div class="form-group">';
											echo '<label for="exampleInputEmail1">Segment Name</label>';
											echo '<div class="row">';
											echo '<div class="col-md-4"><input type="name" name="segment_name" class="form-control" id="abc1" value="'.$d['SEGMENT_NAME'].'"></div>';
											echo '</div> ';
											echo '<label for="exampleInputEmail1">Code</label>';
											echo '<div class="row">';
											echo '<div class="col-md-4"><input type="name" name="code_segment" class="form-control" id="abc2" value="'.$d['CODE_SEGMENT'].'"></div>';
											echo '</div>';
										}
										echo '</div>';
									?></div>
									<div class="form-group">
									<label for="exampleInputEmail1">Department</label>
									<div class="row">
									<div class="col-md-4">
									<select class="form-control" name="department_name" id="department_name" value="<?php echo $department_name?>">
									<?php
										foreach($data2 as $d)
										{
											if($data==$d['ID_DEPARTMENT']){
												echo  '<option value="'.$d['ID_DEPARTMENT'].'" selected>'.$d['DEPARTMENT_NAME'].'</option>';
											}else{
												echo  '<option value="'.$d['ID_DEPARTMENT'].'">'.$d['DEPARTMENT_NAME'].'</option>';
											}
										}
									?>
									</select>
								</div>
								</div>	
								</div>
								<button type="submit" class="btn btn-primary">Save</button>
								<a href="<?php echo base_url()."master/segment";?>" class="btn btn-info" role="button">Cancel</a>
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