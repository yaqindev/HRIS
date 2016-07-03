<title>Department List</title>
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
var oTable;
 
jq(document).ready(function() {
    jq('#myForm').submit( function() {
        var sData = oTable.$('input').serialize();
        $.ajax({
		   type: "POST",
		   url: "<?php echo base_url()."master/department_act/upstat_dept";?>",
		   data: sData,
		   success:function(data) {
				//alert(data);
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
						<form method="post" action="<?php echo base_url()."index.php/department_crud/search_list";?>">
							<h1 class="mb" align="center">Department List</h1>
							
						</form>
							<div class="row">
							<div class="col-md-1" style="margin-right:20px;">
								<form action="<?php echo base_url()."master/department_act/tambah";?>">
									<button type="submit" class="btn btn-success btn-xs">Add Department</button>
								</form>
							</div>
							<div class="col-md-1">
								<form id="myForm">
									<button type="submit"   onclick="return confirm('Anda yakin menghapus data ini?');" id="del" class="btn btn-danger btn-xs">Delete</button>
								</form>
							</div>
							</div>
							<table  id="example" class="display" cellspacing="0" width="100%">
							
								<thead>
									<tr  bgcolor="#696969">
											<?php
									echo "<td></td>";
									echo "<td style='color:white'>Department Name</td>";
									echo "<td style='color:white'>Code</td>";
									?>
									</tr>
								</thead>
								<tbody>
								<?php
								foreach($data as $d)
								{
								?>
								<div id="myModal" class="modal fade">
									<div class="" style="background-color:white;border: 5px solid grey;width:180px;height:70px;margin:210px 20px 20px 450px;">
										<center>Data Ingin Di Hapus?</center>
										<form action="<?php echo base_url()."master/department_act/upstat_dept";?>" method="post" enctype="multipart/form-data" class="form-horizontal" role="form">
											 <pre><center><button type="submit" class="btn btn-primary">Iya</button> <button type="button" class="btn btn-default" data-dismiss="modal">Tidak</button> </center></pre>
										</form>
									</div>
								</div>
									<?php
									echo "<tr>";
									echo "<td><input type='checkbox' name='checklist[]' value='".$d['ID_DEPARTMENT']."'></td>";
								    echo "<td><a href='".base_url()."master/department_act/edit/".$d['ID_DEPARTMENT']."'>".$d['DEPARTMENT_NAME']."</a></td>";	
									echo "<td>".$d['CODE_DEPARTMENT']."</td>";
									echo "</tr>";
								}?>
								
								</tbody>
							</table>
						</form>
						</div>	
					</div>
				</div>
				</div>
								
							</div>
							
		</section>
	</section>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
</body>
<?php
$this->load->view("footer.php");
?>