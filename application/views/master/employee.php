<title>Employee List</title>
<?php
$this->load->view('header.php');
?>
<!-- DataTables CSS -->
<script src="<?php echo base_url()."assets/";?>js/jquerya.js"></script>
<!-- DataTables CSS -->
<link rel="stylesheet" type="text/css" href="<?php echo base_url()."assets/";?>css/jquery.dataTables.css">
  
<!-- jQuery -->
<script src="<?php echo base_url()."assets/";?>js/jquery-1.11.3.min.js"></script>
<script>
var jq = $.noConflict();

</script>
<!-- DataTables -->
<script src="<?php echo base_url()."assets/";?>js/jquery.dataTables.js"></script>
<script>
jq(document).ready(function() {
	jq('#example').DataTable();
	
} );
</script>
<script>
var oTable;
 
jq(document).ready(function() {
    jq('#myForm').submit( function() {
        var sData = oTable.$('input').serialize();
        $.ajax({
		   type: "POST",
		   url: "<?php echo base_url()."master/employee_act/upstat_emp";?>",
		   data: sData,
		   success:function(data) {
		   		alert(data);
				location.reload();
			},
			error:function(data){
				alert(data);
			}
			});
        return false;
    } );
     
    oTable = jq('#example').dataTable();
} );

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
							<form method="post" action="#";?>">
								<h1 class="mb" align="center">Employee List</h1>
								<div class="row">
									<div class="col-md-1" style="margin-right:10px;">
										<a href='<?php echo base_url()."master/employee_act/tambah";?>' class="btn btn-success btn-xs"> Add Employee</a>
									</div>
									<div class="col-md-2">
										<?php 
										// <form id="myForm">
										// 	<button type="button" onclick="return confirm('Anda yakin menghapus data ini (menonaktifkan) ?');" id="del" class="btn btn-danger btn-xs">Delete</button>
										// </form>
										?>
									</div>
								</div>
								<br>
								<table id="example" class="display" cellspacing="0" width="100%">
									<thead>
										<tr  bgcolor="#696969">
										<?php
										echo "<td style='color:white'><b><center>NIK</td>";
										echo "<td style='color:white'><b><center>Name</td>";
										echo "<td style='color:white'><b><center>Department</td>";
										echo "<td style='color:white'><b><center>Job Title</td>";
										echo "<td style='color:white'><b><center>Employment Status</td>";
										echo "<td style='color:white'><b><center>Active Status</td>";
										echo "<td style='color:white'><b><center>Location</td>";
										echo "<td style='color:white'><b><center></td>";
										echo "</tr>";
										?>
										</tr>
									</thead>
									<tbody>
									<?php
									foreach($employee as $d)
									{
										echo "<tr id='row_".$d->ID_EMPLOYEE."'>";
										echo "<td>".$d->NIK."</td>";
										echo "<td><a href='".base_url()."master/employee_act/edit/".$d->ID_DETAIL."'>".$d->NAME."</a></td>";
										echo "<td>".$d->DEPARTMENT_NAME."</td>";
										echo "<td>".$d->TITLE."</td>";
										echo "<td>".$d->EMPLOYMENT_STATUS."</td>";
										if($d->ACTIVE_STATUS=='1')
										{
											echo "<td><center>Active</td>";	
										}
										else
										{
											echo "<td><center>Non-Active</td>";
										}
										switch ($d->LOCATION) {
											case '1':
											echo "<td><center>Pasuruan</td>";	
												break;
											case '2':
											echo "<td><center>Sidoarjo</td>";
												break;
											case '3':
											echo "<td><center>Jakarta</td>";
												break;
											case '4':
											echo "<td><center>Lainnya</td>";
												break;											
											default:
											echo "<td><center>Lainnya</td>";
												break;
										}
										echo "<td>
											<button type='button' class='btn btn-xs btn-danger' onclick='hapus(".$d->ID_EMPLOYEE.")'><i class='fa fa-times'></i> Delete</button>
										</td>";
										
										echo "</tr>";				
										
										}
									?>
									
									</tbody>
								</table>
							</form>
						</div>
					</div>
				</div>
			</section><!-- end.wrapper -->
		</section>
	</section>

	<script>
		function hapus(id)
		{
			var cek = confirm("apakah anda yakin ingin Non Active kan data ini ?");
			if (cek)
			{
				$.ajax({
					url 	: '<?php echo base_url() ?>master/employee_act/hapus',
					type 	: 'post',
					data 	: {'id':id},
					success : function(r)
					{
						location.reload();
					},
					error 	: function(r)
					{
						alert("Maaf data tidak dapat di hapus, cek transaksi yang terhubung dengan data ini !.");
					}
				});
			}
			else{
				location.reload();
			}
		}
	</script>
	</body>
<?php
$this->load->view("footer.php");
?>