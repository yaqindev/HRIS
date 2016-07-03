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
        // alert(sData);
        // alert('ok');
        $.ajax({
		   type: "post",
		   url: "<?php echo base_url();?>master/user_act/upstat_user",
		   data: sData,
		   success:function(data) {
				location.reload();
				// alert(data);
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
							<h1 class="mb" align="center">Master User</h1>
							<div class="row">
								<div class="col-md-1">
									<a href="<?php echo base_url() ?>master/user_act/tambah" class="btn btn-success btn-xs">Add User</a>
								</div>
								<div class="col-md-1">
									<!--<form id="myForm">
										<button type="submit"   onclick="return confirm('Anda yakin menghapus data ini?');" id="del" class="btn btn-danger btn-xs">Delete</button>
									</form> -->
								</div>
							</div>
							<br>
							<table  id="example" class="display" cellspacing="0" width="100%">
							
								<thead>
									<tr  bgcolor="#696969">
										<td style='color:white'>No.</td>
										<td style='color:white'>NIK</td>
										<td style='color:white'>Nama karyawan</td>
										<td style='color:white'>Username</td>
										<td style='color:white'>Email</td>
										<td style='color:white'>Akses</td>
										<td style='color:white'></td>
									</tr>
								</thead>
								<tbody>
								<?php
								foreach($data as $d)
								{
									$akses = $d->HAK_AKSES == '1'?'Administrator':'Manager';
									echo "<tr id='row_".$d->ID_USER."'>";
									echo "<td><input type='checkbox' name='checklist[]' value='".$d->ID_USER."'></td>";
									echo "<td><a href='".base_url()."master/user_act/edit/".$d->ID_USER."'>".$d->NIK."</a> </td>";
									echo "<td>".$d->NAME."</td>";
									echo "<td>".$d->NAMA_USER."</td>";
									echo "<td>".$d->EMAIL_USER."</td>";
									echo "<td>".$akses."</td>";
									echo "<td>
										<button type='button' class='btn btn-xs btn-danger' onclick='hapus(".$d->ID_USER.")'><i class='fa fa-times'></i> Delete</button>
									</td>";
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
	<div id="myModal" class="modal fade">
		<div class="" style="background-color:white;border: 5px solid grey;width:180px;height:70px;margin:210px 20px 20px 450px;">
			<center>Data Ingin Di Hapus?</center>
			<form action="<?php echo base_url()."master/department_act/upstat_dept";?>" method="post" enctype="multipart/form-data" class="form-horizontal" role="form">
				 <pre><center><button type="submit" class="btn btn-primary">Iya</button> <button type="button" class="btn btn-default" data-dismiss="modal">Tidak</button> </center></pre>
			</form>
		</div>
	</div>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
	<script>
		function hapus(id)
		{
			var cek = confirm("apakah anda yakin ingin menghapus data ini ?");
			if (cek)
			{
				$.ajax({
					url 	: '<?php echo base_url() ?>master/user_act/hapus',
					type 	: 'post',
					data 	: {'id':id},
					success : function(r)
					{
						$("#row_"+id).hide();
					},
					error 	: function(r)
					{
						alert("Maaf data tidak dapat di hapus, cek transaksi yang terhubung dengan data ini !.");
					}
				});
			}
		}
	</script>
</body>
<?php
$this->load->view("footer.php");
?>