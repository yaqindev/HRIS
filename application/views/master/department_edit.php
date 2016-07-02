<?php
$this->load->view('header.php');
?>
<script>
function abc() {
	
    document.getElementById("abc1").disabled = false;
	document.getElementById("abc2").disabled = false;

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
							<h1 class="mb" align="center">Edit Department</h1>
							<ul class="nav nav-tabs" role="tablist">
							 <form action="<?php echo base_url()."master/department_act/update";?>" method="post">
							<div class="tab-content">
								<div role="tabpanel" class="tab-pane active" id="home">
								<input type="text" name="id_department" value="<?php echo $id_department; ?>" style="visibility:hidden;">
								<div class="form-group">
								<label for="exampleInputEmail1">Department Name</label>
								<div class="row">
								<div class="col-md-4"><input type="name" name="dname" class="form-control" id="abc1" value="<?php echo $department_name;?>" disabled></div>
								</div> 
								<label for="exampleInputEmail1">Code</label>
								<div class="row">
								<div class="col-md-4"><input type="name" name="dcode" class="form-control" id="abc2" value="<?php echo $code_department;?>" disabled></div>
								</div>
								</div>
							</div>
							</div>
							<button type="submit" class="btn btn-primary">Save</button>
							<a href="<?php echo base_url()."master/department";?>" class="btn btn-info" role="button">Cancel</a>
							</form>
							<div style="margin:-47px 20px 20px 132px;">
								<button onclick="abc()" class="btn btn-success" name="btn" type="submit">Edit*</button>
							</div>
						</div>	
					</div>
				</div>
		</section>
	</section>
</body>
<?php
$this->load->view("footer.php");
?>