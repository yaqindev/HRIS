<title>Group List</title>
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
		   url: "<?php echo base_url()."master/group_act/upstat_group";?>",
		   data: sData,
		   success:function(data) {
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
							<h1 class="mb" align="center">Group List</h1>
							</form>
							<div class="row">
							<div class="col-md-1">
							<form action="<?php echo base_url()."master/group_act/tambah";?>">
							<button type="submit" class="btn btn-success btn-xs">Add Group</button>
							</form>
							</div>
							<div class="col-md-4">
							<form id="myForm" >
							<button type="submit"   onclick="return confirm('Anda yakin menghapus data ini?');" id="del" class="btn btn-danger btn-xs">Delete</button>
							</div>
							</div>
							<table id="example" class="display" cellspacing="0" width="100%">
								<thead>
									<tr  bgcolor="#696969">
									<?php
									echo "<td></td>";
									echo "<td style='color:white'>Group Name</td>";
									echo "<td style='color:white'>Code</td>";
									echo "<td style='color:white'>Segment</td>";
									?>
									</tr>
								</thead>
								<tbody>
								<?php
								foreach($data as $d)
								{?>
									<?php
									echo "<tr>";
									echo "<td><input type='checkbox' name='checklist[]' value='".$d['ID_GROUP']."'></td>";
							        echo "<td><a href='".base_url()."master/group_act/edit/".$d['ID_GROUP']."/". $d['ID_SEGMENT']."'>".$d['GROUP_NAME']."</a></td>";
									echo "<td>".$d['CODE_GROUP']."</td>";
									echo "<td>".$d['SEGMENT_NAME']."</td>";
									echo "</tr>";
								}?>
								
								</tbody>
							</table>
						</form>
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