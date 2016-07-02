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
			url: '<?php echo base_url()."index.php/crud/get_segment";?>',
			data: { sid: id},
			success:function(data) {
				var appenddata = '<option value="0">-SELECT-</option>';
				$.each(data, function (key, value) {
					appenddata += "<option value = '" + value.id_segment + " '>" + value.segment_name + " </option>";                        
				});
				$('#segment_id').html(appenddata);
			},
			error:function(data){
				alert(data);
				// failed request; give feedback to user
			}
		});
	});	
});
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
						<div class="form-panel">
							<h1 class="mb" align="center">Edit Job List</h1>
							&nbsp;
							&nbsp;
							<ul class="nav nav-tabs" role="tablist">
							
							 <form action="<?php echo base_url()."master/joblist_act/update";?>" method="post">
							<div class="tab-content">
								<div role="tabpanel" class="tab-pane active" id="home">

								<?php echo '<input type="hidden" name="id_jobtitle" value="'.$data4.'">'; ?>
							<div class="form-group">
								<label for="exampleInputEmail1">Department</label>
								<div class="row">
								<div class="col-md-4">
								<select class="form-control" name="department_id" id="dept_id" >
								<?php
									foreach($data2 as $d1)
									{
										foreach($data1 as $d2)
										{
											$id_dept = $d2['ID_DEPARTMENT'];
										}
										if($d1['ID_DEPARTMENT']==$id_dept)
											echo  '<option value="'.$d1['ID_DEPARTMENT'].'" selected>'.$d1['DEPARTMENT_NAME'].'</option>';
										else
											echo  '<option value="'.$d1['ID_DEPARTMENT'].'">'.$d1['DEPARTMENT_NAME'].'</option>';
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
						  		<?php
									foreach($data3 as $d1)
									{
										foreach($data1 as $d2)
										{
											$id_segt = $d2['ID_SEGMENT'];
										}
										if($d1['ID_SEGMENT']==$id_segt){
											echo  '<option value="'.$d1['ID_SEGMENT'].'" selected>'.$d1['SEGMENT_NAME'].'</option>';
										}
										else{
											echo  '<option value="'.$d1['ID_SEGMENT'].'">'.$d1['SEGMENT_NAME'].'</option>';
										}
									}
								?>
								</select>
						  </div>
							</div> 
						  </div>
						  
						  <div class="form-group">
							<label for="exampleInputEmail1">Code Job Title</label>
							<div class="row">
						  <div class="col-md-4">
						  <?php
								foreach($data1 as $d1)
								{
									echo '<input type="text" name="code" class="form-control" value="'.$d1['CODE_JOBTITLE'].'">';
								}
							?>
							</div>
							</div> 
						  </div>
						  
						  <div class="form-group">
							<label for="exampleInputEmail1">Job Title</label>
							<div class="row">
						  <div class="col-md-4">
						  <?php
								foreach($data1 as $d1)
								{

									echo '<input type="text" name="jtitle" class="form-control" value="'.$d1['TITLE'].'">';
								}
							?>
							
						  </div>
							</div> 
						  </div>
						  
						  <div class="form-group">
							<label for="exampleInputEmail1">Grade</label>
							<div class="row">
						  <div class="col-md-4">
						  
						  <?php
								foreach($data1 as $d1)
								{

									echo '<input type="text" name="grade" class="form-control" value="'.$d1['GRADE'].'">';
								}
							?>
						  </div>
							</div> 
						  </div>
						  
						  <div class="form-group">
							<div class="row">
						  <div class="col-md-4">
						  <?php
								foreach($data1 as $d1)
								{
									if($d1['GET_FLEXI_JOB']==1)
										echo '<input type="checkbox" value="1" name="flexi" checked>     Flexi';
									else
										echo '<input type="checkbox" value="1" name="flexi">     Flexi';
								}
							?>
						  </div>
						  </div> 
						  </div>
						  
						  <div class="form-group">
							<div class="row">
						  <div class="col-md-4">
						  <?php
								foreach($data1 as $d1)
								{
									if($d1['GET_SECTORAL_JOB']==1)
										echo '<input type="checkbox" value="1" name="sektoral" checked>     Sektoral';
									else
										echo '<input type="checkbox" value="1" name="sektoral">     Sektoral';
								}
							?>
						  </div>
						  </div> 
						  </div>
						  
						  <div class="form-group">
							<div class="row">
						  <div class="col-md-4">
						  <?php
								foreach($data1 as $d1)
								{
									if($d1['GET_SHIFT_JOB']==1)
										echo '<input type="checkbox" value="1" name="shift" checked>     Shift';
									else
										echo '<input type="checkbox" value="1" name="shift">     Shift';
								}
							?>
						  </div>
						  </div> 
						  </div>
					
						<button type="submit" class="btn btn-primary">Save</button>
						<a href="<?php echo base_url()."master/joblist";?>" class="btn btn-info" role="button">Cancel</a>
						</form>
						</div>
					</div>
				</div>
		</section>
	</section>
</body>
<?php $this->load->view("footer.php"); ?>