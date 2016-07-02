<title>Master KPI</title>
<?php
$this->load->view('header.php');
?>



<!-- DataTables CSS -->
<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.8/css/jquery.dataTables.css">
  
<!-- jQuery -->
<!-- <script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.11.3.min.js"></script> -->
<script type="text/javascript" src="<?= base_url() ?>assets/js/jquery.js"></script>
<script>
// var jq = $.noConflict();
</script>
<!-- DataTables -->
<script type="text/javascript" charset="utf8" src="//cdn.datatables.net/1.10.8/js/jquery.dataTables.js"></script>
<script>
// jq(document).ready(function() {
$(document).ready(function() {
	// jq('#example').DataTable();
	$('#example').DataTable();
	
} );
</script>
<style>
table, th, td {
    border: 1px solid black;
    border-collapse: collapse;
}
th, td {
    padding: 5px;
    text-align: left;    
}
</style>

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
						<h4 class="mb"><i class="fa fa-angle-right"></i>Master KPI</h4>	
							<div class="row">
								<div class="col-md-11">
									
								<div class="form-group">
									<label class="col-md-2 control-label">Department</label>
									<div class="col-sm-3">
										<select class=' form-control' style='width:100%' name='department' id='department' onchange="pilih_department()">
											<option value=""> --  pilih department -- </option>
											<?php
												foreach($departments as $department) {
												echo "<option value=".$department->ID_DEPARTMENT.">".$department->DEPARTMENT_NAME."</option>";
												}
											?>
										</select>																			
									</div>
								</div>
								</div>
								<div class="col-md-1">
									<form action="<?php echo base_url()."appraisal/kpi_act/tambah";?>">
									<button class="btn btn-success btn-sm" data-toggle="modal" data-target="#myModal">
									  Add KPI
									</button>
									</form>
								</div>
							</div>
							
								<br>
							<div id="box_kpi">
								<table  id="example" class="display" cellspacing="0" width="100%">
									<thead>
										<tr  bgcolor="#696969">
											<?php
											echo "<td style ='color :white' width='10'>No.</td>";
											echo "<td style ='color :white' width='10'>Department</td>";
											echo "<td style ='color :white' width='40'>Strategic Objective</td>";
											echo "<td style ='color :white' width='30'>KPI</td>";
											echo "<td style ='color :white' width='10'>UOM</td>";
											echo "<td style ='color :white' width='10'>Target</td>";
											echo "<td style ='color :white' width='10'>Weight</td>";
											echo "<td style ='color :white' width='10'>Type</td>";
											?>
										</tr>
									</thead>
									<tbody>
										<?php
										$no = 1;
										foreach($kpi as $kpi)
										{
											echo"<tr>";
											echo "<td style='text-align:center'>".$no++."</td>";
											echo "<td>".ucfirst(strtolower($kpi->DEPARTMENT_NAME))."</td>";
											echo "<td><a href='".base_url()."appraisal/kpi_act/edit/".$kpi->ID_KPI."'>".ucfirst(strtolower($kpi->TARGET_DESCRIPTION))."</a></td>";
											echo "<td>".ucfirst(strtolower($kpi->KPI))."</td>";
											echo "<td style='text-align:center'>".$kpi->UOM."</td>";
											echo "<td style='text-align:center'>".$kpi->TARGET."</td>";
											echo "<td style='text-align:center'>".$kpi->WEIGHT."</td>";
											echo "<td style='text-align:center'>".$kpi->TYPE."</td>";		
										}?>
																
									</tbody>
								</table>
							</div>
					</div>	
				</div>
			</div>
		</section>
	</section>
	<script>
		function bulan(clicked_id)
		{
			var cells = document.getElementsByClassName(clicked_id); 
			for (var i = 0; i < cells.length; i++) { 
				cells[i].disabled = false;
			}
		}

		function actual(clicked_id)
		{
			var cells = document.getElementsByClassName(clicked_id); 
			for (var i = 0; i < cells.length; i++) { 
				cells[i].disabled = false;
			}
		}
		
		function pilih_department()
		{
			var department = $("#department").val();
			$.ajax({
				url : '<?= base_url() ?>appraisal/kpi_act/pilih_department',
				type : 'post',
				data : {'department':department},
				success : function(r)
				{
					$("#box_kpi").html(r);
				}
			});
		}
	</script>
<?php $this->load->view("footer.php"); ?>
</body>