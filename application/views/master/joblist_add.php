<?php
$this->load->view('header.php');
?>
<script src="<?php echo base_url()."assets/";?>js/jquery-1.8.3.min.js"></script>
<script>
$(document).ready(function(){
	$('#dept_id').change(function(){
		var id = $(this).val();
		$.ajax({
			dataType: 'JSON',
			type: 'POST',
			url: '<?php echo base_url()."master/joblist_act/get_segment";?>',
			data: { 'sid': id},
			success:function(data) {
				var appenddata = '<option value="0">-SELECT-</option>';
				$.each(data, function (key, value) {
					appenddata += "<option value = '" + value.ID_SEGMENT + " '>" + value.SEGMENT_NAME + " </option>";                        
				});
				$('#segment_id').html(appenddata);
			},
			error:function(data){
				alert(data);
			}
		});
	});	
});
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
							<h4 class="mb"><i class="fa fa-angle-right"></i>Add Job</h4>
							<form action="<?php echo base_url()."master/joblist_act/simpan";?>" method="post">
							
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
							    <label for="exampleInputEmail1">Segment</label>
								<div class="row">
							  <div class="col-md-4">
							  <select class="form-control" name="sname" id="segment_id" >
									
									</select>
							  </div>
								</div> 
							  </div>
							  
							  <div class="form-group">
							    <label for="exampleInputEmail1">Code Job Title</label>
								<div class="row">
							  <div class="col-md-4"><input type="text" name="code" class="form-control"></div>
								</div> 
							  </div>
							  
							  <div class="form-group">
							    <label for="exampleInputEmail1">Job Title</label>
								<div class="row">
							  <div class="col-md-4"><input type="text" name="jtitle" class="form-control"></div>
								</div> 
							  </div>
							  
							  <div class="form-group">
							    <label for="exampleInputEmail1">Grade</label>
								<div class="row">
							  <div class="col-md-4"><input type="text" name="grade" class="form-control"></div>
								</div> 
							  </div>
							  
							  <div class="form-group">
							    <div class="row">
							  <div class="col-md-4"><input type="checkbox" value="1" name="flexi" >     Flexi</div>
							  </div> 
							  </div>
							  
							  <div class="form-group">
							    <div class="row">
							  <div class="col-md-4"><input type="checkbox" value="1" name="sektoral" >     Sektoral</div>
							  </div> 
							  </div>
							  
							  <div class="form-group">
							    <div class="row">
							  <div class="col-md-4"><input type="checkbox" value="1" name="shift" >     Shift</div>
							  </div> 
							  </div>
							  
							  <button type="submit" class="btn btn-primary">Submit</button>
							  <a href="<?php echo base_url()."master/joblist";?>" class="btn btn-info" role="button">Cancel</a>
							 
							</form>
						</div>	
					</div>
				</div>
		</section>
	</section>
</body>
<?php $this->load->view("footer.php"); ?>