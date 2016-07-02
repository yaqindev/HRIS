
<title>Competency</title>
<?php $this->load->view('header.php'); ?>

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
	<!-- DataTables CSS -->
	<script src="<?php echo base_url()."assets/";?>js/jquerya.js"></script>
	<!-- DataTables CSS -->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url()."assets/";?>css/jquery.dataTables.css">
	<script>
		var jq = $.noConflict();
	</script>
	<!-- DataTables -->
	<script src="<?php echo base_url()."assets/";?>js/jquery.dataTables.js"></script>
	<script>
		jq(document).ready(function() {
			jq('#kra_table').DataTable();		
			jq('#umum_tabel').DataTable();		
			jq('#khusus_tabel').DataTable();		
		} );
	</script>

<body>   				
	<section id="container">
		<aside>	
			<?php
				$this->load->view('sidebar.php');
			?>
		</aside>
		<section id="main-content">
			<section class="wrapper">
					<div class="row mt">
						<div class="col-lg-12">
							<div class="form-panel">
								<h2 class="mb"><center>Competency</center></h2>
								<div class="row">
									<div class="col-md-11">
										<?php if ($this->session->flashdata('notif')):?>
											<?php $notif = $this->session->flashdata('notif'); ?>
											<?php if ($notif == 'success'): ?>
												<div class="alert alert-success alert-dismissible" role="alert">
													<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
													<b>Berhasil ! </b> Data berhasil di simpan 
												</div>
											<?php else: ?>
												<div class="alert alert-danger   alert-dismissible" role="alert">
													<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
													<b>Berhasil ! </b> Data gagal di simpan
												</div>
											<?php endif; ?>
										<?php endif; ?>
									</div>
								</div>
								
								<br>
								<div id="box_competency">
									<ul class="nav nav-tabs" role="tablist">
										<li role="presentation" class="active"><a href="#kra" aria-controls="katalog" role="tab" data-toggle="tab">Key Result Area</a></li>
										<li role="presentation"><a href="#katalog" aria-controls="katalog" role="tab" data-toggle="tab">Unit Competency</a></li>
										<li role="presentation"><a href="#standard" aria-controls="standard" role="tab" data-toggle="tab">Standard Competency</a></li>
									</ul>
									
									<div class="tab-content">
										<div role="tabpanel" class="tab-pane active" id="kra">
											<br>
											<div class="row">
												<div class="col-md-1">
													<button class="btn btn-success btn-sm" data-toggle="modal" data-target="#kra_add">
													  Add Key Result Area
													</button>
												</div>
											</div>
											<br>
											<table class="display" style="width:100%" id="kra_table">											
												<thead bgcolor= #696969>
													<tr>
														<td style ='color :white;text-align:center;' width="5%">No.</td>
														<td style ='color :white;text-align:center;' width="40%">Key Result Area (KRA)</td>
														<td style ='color :white;text-align:center;' width="30%">Jenis Competency</td>
														<td style ='color :white;text-align:center;' width="20%">Action</td>
													</tr>
												</thead>
												<tbody>
													<?php $no=1; ?>
													<?php foreach ($kra as $kra): ?>
													<tr id="kra_<?= $kra->ID_KRA ?>">
														<td style="text-align:center;"><?= $no++ ?></td>
														<td id="nama_k<?= $kra->ID_KRA ?>"><?= $kra->NAMA_KRA ?></td>
														<td id="jenis_k<?= $kra->ID_KRA ?>"> <?= $kra->JENIS_COMPETENCY=='1'?'Kompetensi Umum':'Kompetensi Khusus' ?> </td>
														<td style="text-align:center;">
															<button class="btn btn-primary" onclick="edit_kra(<?= $kra->ID_KRA ?>)" data-toggle="modal" data-target="#kra_add"><i class="fa fa-pencil"></i></button>
															<button class="btn btn-danger" onclick="hapus_kra(<?= $kra->ID_KRA ?>)" ><i class="fa fa-times"></i></button>
														</td>
													</tr>					
													<?php endforeach ?>
												</tbody>
											</table>
										</div><!-- end #kra -->
										<div role="tabpanel" class="tab-pane" id="katalog">
											<br>
											<div class="row">
												<div class="col-md-1">
													<button class="btn btn-success btn-sm" data-toggle="modal" data-target="#unit_add">
													  Add Unit Competency
													</button>
												</div>
											</div>
											<br>
											<div><center><h4><u>Technical Competency</u></h4></center></div>
											<table style="width:100%" class="display" id="umum_tabel">
												<thead bgcolor= #696969>
													<tr>
													<td style ='color :white;text-align:center;' width="5%">No.</td>
													<td style ='color :white;text-align:center;' width="20%">Jenis</td>
													<td style ='color :white;text-align:center;' width="20%">Key Result Area (KRA)</td>
													<td style ='color :white;text-align:center;' width="10%">Code</td>
													<td style ='color :white;text-align:center;' width="30%">Unit Competency</td>
													<td style ='color :white;text-align:center;' width="15%">Action</td>
													</tr>
												</thead>
												<tbody>
													<?php $no = 1; ?>
													<?php foreach ($unit_umum as $umum): ?>
													<tr id="unit_<?= $umum->ID_UNIT_COMPETENCY ?>">
														<td style="text-align:center;"><?= $no++ ?></td>
														<td><?= $umum->JENIS_COMPETENCY=='1'?'Kompetensi Umum':'Komptensi Khusus' ?></td>
														<td><input type="hidden" id="kra_u<?= $umum->ID_UNIT_COMPETENCY ?>" value="<?= $umum->ID_KRA?>"><?= $umum->NAMA_KRA ?></td>
														<td style="text-align:center;" id="code_u<?= $umum->ID_UNIT_COMPETENCY ?>"><?= $umum->CODE_UNIT_COMPETENCY ?></td>
														<td id="nama_u<?= $umum->ID_UNIT_COMPETENCY ?>"><?= $umum->NAMA_UNIT_COMPETENCY ?></td>
														<td style="text-align:center;">
															<button class="btn btn-primary" onclick="edit_umum(<?= $umum->ID_UNIT_COMPETENCY ?>)" data-toggle="modal" data-target="#unit_add"><i class="fa fa-pencil"></i></button>
															<button class="btn btn-danger" onclick="hapus_unit(<?= $umum->ID_UNIT_COMPETENCY ?>)" ><i class="fa fa-times"></i></button>
														</td>
													</tr>					
													<?php endforeach ?>
												</tbody>
											</table>
											<br>
											<div><center><h4><u>Non-Technical Competency</u></h4></center></div>
											<table style="width:100%" class="display" id="khusus_tabel">
												<thead bgcolor= #696969>
													<tr>
													<td style ='color :white;text-align:center;' width="5%">No.</td>
													<td style ='color :white;text-align:center;' width="20%">Jenis</td>
													<td style ='color :white;text-align:center;' width="20%">Key Result Area (KRA)</td>
													<td style ='color :white;text-align:center;' width="10%">Code</td>
													<td style ='color :white;text-align:center;' width="30%">Unit Competency</td>
													<td style ='color :white;text-align:center;' width="15%">Action</td>
													</tr>
												</thead>
												<tbody>
													<?php $no = 1; ?>
													<?php foreach ($unit_khusus as $khusus): ?>
													<tr id="unit_<?= $khusus->ID_UNIT_COMPETENCY ?>">
														<td style="text-align:center;"><?= $no++ ?></td>
														<td><?= $khusus->JENIS_COMPETENCY=='1'?'Kompetensi Umum':'Komptensi Khusus' ?></td>
														<td><input type="hidden" id="kra_u<?= $khusus->ID_UNIT_COMPETENCY ?>" value="<?= $khusus->ID_KRA?>"><?= $khusus->NAMA_KRA ?></td>
														<td style="text-align:center;" id="code_u<?= $khusus->ID_UNIT_COMPETENCY ?>"><?= $khusus->CODE_UNIT_COMPETENCY ?></td>
														<td id="nama_u<?= $khusus->ID_UNIT_COMPETENCY ?>"><?= $khusus->NAMA_UNIT_COMPETENCY ?></td>
														<td style="text-align:center;">
															<button class="btn btn-primary" onclick="edit_umum(<?= $khusus->ID_UNIT_COMPETENCY ?>)" data-toggle="modal" data-target="#unit_add"><i class="fa fa-pencil"></i></button>
															<button class="btn btn-danger" onclick="hapus_unit(<?= $khusus->ID_UNIT_COMPETENCY ?>)" ><i class="fa fa-times"></i></button>
														</td>
													</tr>					
													<?php endforeach ?>
												</tbody>
											</table>

											<!-- <table style="width:100%" class="display" id="umum_khusus">
												<thead bgcolor= #696969>
													<tr>
													<td style ='color :white;text-align:center;' width="5%">No.</td>
													<td style ='color :white;text-align:center;' width="20%">Jenis</td>
													<td style ='color :white;text-align:center;' width="20%">Key Result Area (KRA)</td>
													<td style ='color :white;text-align:center;' width="10%">Code</td>
													<td style ='color :white;text-align:center;' width="30%">Unit Competency</td>
													<td style ='color :white;text-align:center;' width="15%">Action</td>
													</tr>
												</thead>
												<tbody>
													<tr>
														<td style="text-align:center;">1</td>
														<td>Kompetensi Umum</td>
														<td>Managerial Skill</td>
														<td style="text-align:center;">G.01.01</td>
														<td>Merencanakan dan mengorganisasi pekerjaan</td>
														<td style="text-align:center;">
															<button class="btn btn-primary" onclick="edit_kra(<?= $kra->ID_KRA ?>)" data-toggle="modal" data-target="#kra_add"><i class="fa fa-pencil"></i></button>
															<button class="btn btn-danger" onclick="hapus_kra(<?= $kra->ID_KRA ?>)" ><i class="fa fa-times"></i></button>
														</td>
													</tr>					
												</tbody>
											</table> -->
										</div><!-- end #katalog -->
										<div role="tabpanel" class="tab-pane" id="standard">
											<br>
											<div class="row">
												<div class="col-md-11">
													<div class="form-group row">
														<label for="department" class="col-md-2">Department</label>
														<div class="col-md-4 ">
															<select class="form-control" name="department_search" id="department_search" onchange="set_segment()" required>
																<option value=""> -- Pilih Department --</option>
																<?php
																	foreach($departments as $department) {
																	echo "<option value=".$department->ID_DEPARTMENT.">".$department->DEPARTMENT_NAME."</option>";
																	}
																?>
															</select>
														</div>
													</div>
													<div class="form-group row" >
														<label for="segment" class="col-md-2">Segment</label>
														<div class="col-md-4" id="box_segment_search">
															<select class="form-control" name="segment_search" id="segment_search" required>
																<option value=""> -- Pilih Segment --</option>
															</select>
														</div>
													</div>
													<div class="form-group row" >
														<label for="job" class="col-md-2">Job Position</label>
														<div class="col-md-4" id="box_job_search">
															<select class="form-control" name="job_search" id="job_search" required>
																<option value=""> -- Pilih Job --</option>
															</select>
														</div>
													</div>
												</div><!-- end.col-md-offset-1 -->
											</div><!-- end.row -->
											<br>
											<div class="row">
												<div class="col-md-12">
													<form action="<?= base_url() ?>appraisal/competency_act/std_simpan" method="post" id="form_input_std">
													<table style = "width:100%">
														<thead bgcolor= #696969>
															<tr>
																<td style ='color :white; text-align:center;' width="5%"><center>No.</td>
																<td style ='color :white; text-align:center;' width="10%"><center>jenis kompetensi</td>
																<td style ='color :white; text-align:center;' width="25%"><center>Key Result Area</td>
																<td style ='color :white; text-align:center;' width="10%"><center>Code</td>
																<td style ='color :white; text-align:center;' width="30%"><center>Unit Competency</td>
																<td style ='color :white; text-align:center;' width="10%"><center>Standard</td>
																<td style ='color :white; text-align:center;' width="10%"><center>action</td>
															</tr>
														</thead>
														<tbody>
															<?php 
															$jns = '0';
															$kra = '0';
															$no  = 1;
															?>
															<?php foreach ($unt as $unt): ?>
															<tr>
															<?php 
																$cek_unit = $this->tbl_unit_competency->join_kra(array('kra.JENIS_COMPETENCY'=>$unt->JENIS_COMPETENCY));
																if (count($cek_unit)>0)
																{
																	$rowspan = count($cek_unit);
																	$rowspan_kra = count($this->tbl_unit_competency->join_kra(array('kra.ID_KRA'=>$unt->ID_KRA)));
																	$jenis = $unt->JENIS_COMPETENCY=='1'?'Kompetensi Umum':'Kompetensi Khusus';
																	if ($jns == $unt->JENIS_COMPETENCY)
																	{
																		if ($kra == $unt->ID_KRA)
																		{
																			echo'
																			<td  style="text-align:center;">'.$no.'</td>
																			<td style="text-align:center;">'.$unt->CODE_UNIT_COMPETENCY.'</td>
																			<td>'.$unt->NAMA_UNIT_COMPETENCY.'</td>
																			<td style="text-align:center;">
																				<input type="number" class="form-control" name="input_standard[1]['.$unt->ID_UNIT_COMPETENCY.']" id="input_standard'.$unt->ID_UNIT_COMPETENCY.'" disabled="true" min="1" max="5">
																			</td>
																			<td style="text-align:center;" id="box_btn_'.$unt->ID_UNIT_COMPETENCY.'">
																				<button class="btn btn-primary" onclick="active_input('.$unt->ID_UNIT_COMPETENCY.')"><i class="fa fa-pencil"></i></button>
																			</td>';
																		}else{
																			$kra = $unt->ID_KRA;
																			echo'
																			<td  style="text-align:center;">'.$no.'</td>
																			<td rowspan="'.$rowspan_kra.'">'.$unt->NAMA_KRA.'</td>
																			<td style="text-align:center;">'.$unt->CODE_UNIT_COMPETENCY.'</td>
																			<td>'.$unt->NAMA_UNIT_COMPETENCY.'</td>
																			<td style="text-align:center;">
																				<input type="number" class="form-control" name="input_standard[1]['.$unt->ID_UNIT_COMPETENCY.']" id="input_standard'.$unt->ID_UNIT_COMPETENCY.'" disabled="true" min="1" max="5">
																			</td>
																			<td style="text-align:center;" id="box_btn_'.$unt->ID_UNIT_COMPETENCY.'">
																				<button class="btn btn-primary" onclick="active_input('.$unt->ID_UNIT_COMPETENCY.')"><i class="fa fa-pencil"></i></button>
																			</td>';
																		}
																	}else{
																		$jns = $unt->JENIS_COMPETENCY;
																		if ($kra != $unt->ID_KRA)
																		{
																			$kra = $unt->ID_KRA;
																			echo'
																			<td  style="text-align:center;">'.$no.'</td>
																			<td rowspan="'.$rowspan.'">'.$jenis.'</td>
																			<td rowspan="'.$rowspan_kra.'">'.$unt->NAMA_KRA.'</td>
																			<td style="text-align:center;">'.$unt->CODE_UNIT_COMPETENCY.'</td>
																			<td>'.$unt->NAMA_UNIT_COMPETENCY.'</td>
																			<td style="text-align:center;">
																				<input type="number" class="form-control" name="input_standard[1]['.$unt->ID_UNIT_COMPETENCY.']" id="input_standard'.$unt->ID_UNIT_COMPETENCY.'" disabled="true" min="1" max="5">
																			</td>
																			<td style="text-align:center;" id="box_btn_'.$unt->ID_UNIT_COMPETENCY.'">
																				<button class="btn btn-primary" onclick="active_input('.$unt->ID_UNIT_COMPETENCY.')"><i class="fa fa-pencil"></i></button>
																			</td>';
																		}
																	}
																}
																$no++;
															?>
															</tr>	
															<?php endforeach; ?>
														</tbody>
													</table>
													<input type="hidden" name="id_joblist" id="id_joblist">
													<br>
													<div class="row">
														<div class="col-md-12">
															<div class="pull-right">
																<button type="submit" class="btn btn-primary" id="btn_save_unit">Save</button>
																<button type="reset" class="btn btn-default">Cancel</button>
															</div>
														</div>
													</div>																						
													</form>
												</div>
											</div><!-- end.row -->
										</div><!-- end #standard -->
									</div><!-- end #box_competency -->
								</div>
							</div><!-- end .form-panel -->
						</div><!-- end .col-lg-12 -->
					</div><!-- end.row mt -->
			</section><!-- end .wrapper -->
		</section><!-- end.main-content -->
	</section>

	<!-- modal tambah KRA -->
	<div class="modal fade" id="kra_add" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
			<form action="<?= base_url() ?>appraisal/competency_act/kra_simpan" method="POST" role="form" class="form-horizontal" id="form_kra">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title">Tambah Key Result Area</h4>
				</div><!-- end .modal-header -->
				<div class="modal-body" >
					<div class="row">
						<div class="col-lg-12">
							<div class="form-group">
								<label for="nama_kra" class="col-md-4 control-label">Nama KRA</label>
								<div class="col-md-7">
									<input type="text" class="form-control" id="nama_kra" name="nama_kra" placeholder="Key Result Area" autofocus="true" required>
								</div>
							</div>
							<div class="form-group">
								<label for="jenis_kra" class="col-md-4 control-label">Jenis Competency</label>
								<div class="col-md-7">
									<select name="jenis_kra" id="jenis_kra" class="form-control" required>
										<option value="">-- pilih jenis --</option>
										<option value="1">Kompetensi Umum</option>
										<option value="2">Kompetensi Khusus</option>
									</select>
								</div>
							</div>
						</div><!-- col-lg-12-->      	
					</div><!-- /row -->
				</div><!-- end .modal-body -->
				<div class="modal-footer">
					<button type="submit" class="btn btn-primary">Save</button>
					<button type="reset" class="btn btn-default" data-dismiss="modal">Close</button>
				</div><!-- end .modal-footer -->
			</form>
			</div><!-- end .modal-content -->
		</div><!-- end .modal-dialog -->
	</div><!-- end .modal --> 
	<!-- end modal tambah KRA -->

	<!-- modal tambah unit competency -->
	<div class="modal fade" id="unit_add" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
			<form action="<?= base_url() ?>appraisal/competency_act/unit_simpan" method="POST" role="form" class="form-horizontal" id="form_unit">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title">Tambah Unit Competency</h4>
				</div><!-- end .modal-header -->
				<div class="modal-body" >
					<div class="row">
						<div class="col-lg-12">
							<div class="form-group">
								<label for="code_unit" class="col-md-4 control-label">Code Unit Competency</label>
								<div class="col-md-7">
									<input type="text" class="form-control" id="code_unit" name="code_unit" placeholder="Code" autofocus="true" required>
								</div>
							</div>
							<div class="form-group">
								<label for="nama_unit" class="col-md-4 control-label">Nama Unit Competency</label>
								<div class="col-md-7">
									<input type="text" class="form-control" id="nama_unit" name="nama_unit" placeholder="Nama Unit Competency" autofocus="true" required>
								</div>
							</div>
							<div class="form-group">
								<label for="kra_unit" class="col-md-4 control-label">Nama Kra</label>
								<div class="col-md-7">
									<select name="kra_unit" id="kra_unit" class="form-control" required>
										<option value="">-- pilih key result area --</option>
										<?php $pilih_kra = $this->tbl_kra->get_all(); ?>
										<?php foreach ($pilih_kra as $key): ?>
										<option value="<?= $key->ID_KRA ?>"><?= $key->NAMA_KRA ?></option>
										<?php endforeach ?>
									</select>
								</div>
							</div>
						</div><!-- col-lg-12-->      	
					</div><!-- /row -->
				</div><!-- end .modal-body -->
				<div class="modal-footer">
					<button type="submit" class="btn btn-primary">Save</button>
					<button type="reset" class="btn btn-default" data-dismiss="modal">Close</button>
				</div><!-- end .modal-footer -->
			</form>
			</div><!-- end .modal-content -->
		</div><!-- end .modal-dialog -->
	</div><!-- end .modal --> 
	<!-- end modal tambah unit competency -->




<?php $this->load->view('footer.php'); ?>
<script>
	function set_segment()
	{
		var department 	= $("#department_search").val();
		
		if (department != '')
		{
			$.ajax({
				url 		: '<?= base_url() ?>appraisal/competency_act/set_segment',
				type 		: 'post',
				data 		: {'department':department},
				success 	: function(r)
				{
					$("#box_segment_search").html(r);
				},
				error		: function()
				{
					alert('Error sistem , pleace contact administator!');
				}
			});
		}else{
			alert("Pilih department !");
			$("#segment_search").val('');
			$("#job_search").val('');
			$("#department_search").focus();

			//NB : mengkosongkan box data competency
		}
	}

	function set_job_search()
	{
		var department 	= $("#department_search").val();
		var segment 	= $("#segment_search").val();

		if (department != '')
		{
			if (segment != '')
			{
				$.ajax({
					url 		: '<?= base_url() ?>appraisal/competency_act/set_job',
					type 		: 'post',
					data 		: {'department':department,'segment':segment},
					success 	: function(r)
					{
						$("#box_job_search").html(r);
					},
					error		: function()
					{
						alert('Error sistem , pleace contact administator!');
					}
				});

			}else{
				alert("Pilih segment !");
				$("#segment_search").focus();

				//NB : kosongkan box data competency
			}
		}else{
			alert("Pilih department !");
			$("#segment_search").val('');
			$("#job_search").val('');
			$("#department_search").focus();

			//NB : mengkosongkan box data competency
		}
	}

	function set_box_competency()
	{
		var department 	= $("#department_search").val();
		var segment 	= $("#segment_search").val();
		var job 		= $("#job_search").val();
		if (job != '')
		{
			
		}else{
			alert("Pilih job position !");
			$("#job_search").focus();

			//NB : mengkosongkan box data competency
		}
	}

	function edit_kra(id)
	{
		var nama 	= $("#nama_k"+id).text();
		var jenis 	= $("#jenis_k"+id).text();
		if (jenis='Kompetensi Umum'){jenis = '1';}else{jenis = '2';};
		$("#nama_kra").val(nama);
		$("#jenis_kra").val(jenis);
		$("#form_kra").attr('action','<?= base_url() ?>appraisal/competency_act/kra_update');
		$("#kra_id").remove();
		$("#form_kra").append('<input type="hidden" name="kra_id" id="kra_id" value="'+id+'">');
	}

	function hapus_kra(id)
	{
		var konfirmasi = confirm('Apakah anda yakin ingin menghapus data ini ?');
		if (konfirmasi)
		{
			$.ajax({
				url  : '<?= base_url() ?>appraisal/competency_act/kra_hapus',
				type : 'post',
				data : {'id':id},
				success : function(r)
				{
					$("#kra_"+id).hide();
				},
				error : function()
				{
					alert("Terjadi Kesalahan Data ini tidak dapat di hapus !.");
				}
			});
		}
	}

	function edit_umum(id)
	{
		var nama 	= $("#nama_u"+id).text();
		var code 	= $("#code_u"+id).text();
		var kra 	= $("#kra_u"+id).val();
		$("#code_unit").val(code);
		$("#nama_unit").val(nama);
		$("#kra_unit").val(kra);
		$("#form_unit").attr('action','<?= base_url() ?>appraisal/competency_act/unit_update');
		$("#unit_id").remove();
		$("#form_unit").append('<input type="hidden" name="unit_id" id="unit_id" value="'+id+'">');

	}

	function hapus_unit(id)
	{
		var konfirmasi = confirm('Apakah anda yakin ingin menghapus data ini ?');
		if (konfirmasi)
		{
			$.ajax({
				url  : '<?= base_url() ?>appraisal/competency_act/unit_hapus',
				type : 'post',
				data : {'id':id},
				success : function(r)
				{
					$("#unit_"+id).hide();
				},
				error : function()
				{
					alert("Terjadi Kesalahan Data ini tidak dapat di hapus !.");
				}
			});
		}
	}

	function active_input(id)
	{
		$("#input_standard"+id).attr('required','true');
		$("#input_standard"+id).removeAttr('disabled');
		$("#box_btn_"+id).html('<button class="btn btn-danger" onclick="non_active_input('+id+')"><i class="fa fa-times"></i></button>');
		$("#input_standard"+id).focus();
	}

	function non_active_input(id)
	{
		$("#input_standard"+id).removeAttr('required');
		$("#input_standard"+id).val('');
		$("#input_standard"+id).attr('disabled','true');
		$("#box_btn_"+id).html('<button class="btn btn-primary" onclick="active_input('+id+')"><i class="fa fa-pencil"></i></button>');
	}

	function set_input_standard()
	{
		var job = $("#job_search").val();
		if (job != '')
		{
			$("#id_joblist").val(job)
		}
	}
</script>
</body>