<?php
$this->load->view('header.php');

?>
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
	<div class="col-md-12">
											
	<!-- Modal -->
	<div class="modal fade" id="myModal3" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
					  <div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						<h4 class="modal-title" id="myModalLabel">Competency</h4>
					  </div>
						<div class="modal-body">
							<div class="row mt">
									<div class="col-lg-12">
									
										  <h4 class="mb"><i class="fa fa-angle-right"></i> Standard Key Resource Area (KRA)</h4>
										
										<table>	
											<label>Technical Competency</label>
			
											<thead bgcolor= #696969>
												<tr>
												<?php
												echo "<td style ='color :white'>No.</td>";
												echo "<td style ='color :white'>Key Result Area (KRA)</td>";
												echo "<td style ='color :white'>Unit Competency</td>";
												echo "<td style ='color :white'>Standard</td>";
												?>
												</tr>
											</thead>
											
											<tbody>
												<?php
												$data=$this->db->query("select * from performance_m_kra where type='1'")->result_array();
												$no=1;
												foreach($data as $d)
												{?>
													<div class="modal fade" id="myModal23<?php echo $d['id_kra'];?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
												  <div class="modal-dialog">
													<div class="modal-content">
													  <div class="modal-header">
														<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
														<h4 class="modal-title" id="myModalLabel">Unit Competency</h4>
													  </div>
													  <div class="modal-body">
														<div class="row mt">
																<div class="col-lg-12">
																	  <h4 class="mb"><i class="fa fa-angle-right"></i> Add Unit Competency</h4>
																		<form class="form-horizontal style-form" action="<?php echo base_url()."index.php/performance/update_standard";?>" method="post">
																		<input value="<?php echo $d['id_jobtitle'];?>" name="id_jobtitle" disabled>
																			<?php
																			$idcomp=$this->db->query("select COUNT(id_u_comp)+1 a from performance_competency where id_kra =".$d['id_kra']."")->result_array();
																	
																
																			?>
																			<input name='id_u_comp' value='<?php echo $idcomp[0]["a"];?>' hidden>
																			 <input value="<?php echo $d['id_kra'];?>" name="id_kra" hidden>
															
																			<br>
																			
																			<div class="form-group">
																				  <label class="col-sm-2 col-sm-2 control-label">KRA</label>
																				  <div class="col-sm-10">
																					  <input class="form-control" type="text" value="<?php echo $d['kra'];?>" disabled>
																				  </div>
																				<div>
																					<br>
																					
																					<div class="form-group">
																					  <label class="col-sm-2 col-sm-2 control-label">Unit Competency</label>
																					  <div class="col-sm-10">
																						  <input class="form-control" id="focusedInput" type="text" name="u_comp">
																					  </div>
																					</div>
										
																				</div><!-- col-lg-12-->      	
																			</div><!-- /row -->
													  </div>
													 
													  
													</div>
												  </div>
												</div> 
												
												<?php
												
													$data2= $this->db->query('select * from performance_competency  where id_kra="'.$d["id_kra"].'"')->result_array();
													$rowspan=count($data2);
													echo"<tr>";
													echo "<td rowspan='".$rowspan."'>".$no."</td>";
													echo "<td rowspan='".$rowspan."'>".$d['kra']."</td>";
													$no++;
													$z =1;
													foreach($data2 as $d2)
													{
														if ($z==1)
														{
															echo "<td>".$d2['u_comp']."</td>";
															echo "<td><input type='text' id='".$d2['id_kra'].".".$d2['id_u_comp']."'></td></tr>";
															$z=2;
														}
														else
														{
														echo "<tr>
														<td>".$d2['u_comp']."</td>";
														echo "<td><input type='text' id='".$d2['id_kra'].".".$d2['id_u_comp']."'></td></tr>";
														}
													}
													
												}?>
																		
											</tbody>
											
											

											<table style = "width:100%">
											<br>	
											<label>Non-Technical Competence</label>
												<thead bgcolor= #696969>
													<tr>
													<?php
													echo "<td style ='color :white'>No.</td>";
													echo "<td style ='color :white'>Key Result Area (KRA)</td>";
													echo "<td style ='color :white'>Unit Competency</td>";
													echo "<td style ='color :white'>Standard</td>";
													?>
													</tr>
												</thead>
																					
												<tbody>
													<?php
													$data=$this->db->query("select * from performance_m_kra where type='2'")->result_array();
													$no=1;
													foreach($data as $d)
													{?>
														<div class="modal fade" id="myModal23<?php echo $d['id_kra'];?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
													  <div class="modal-dialog">
														<div class="modal-content">
														  <div class="modal-header">
															<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
															<h4 class="modal-title" id="myModalLabel">Unit Competency</h4>
														  </div>
														  <div class="modal-body">
															<div class="row mt">
																	<div class="col-lg-12">
																		  <h4 class="mb"><i class="fa fa-angle-right"></i> Add Unit Competency</h4>
																			
																				<?php
																				$idcomp=$this->db->query("select COUNT(id_u_comp)+1 a from performance_competency where id_kra =".$d['id_kra']."")->result_array();
																		
																	
																				?>
																				<input name='id_u_comp' value='<?php echo $idcomp[0]["a"];?>' hidden>
																				 <input value="<?php echo $d['id_kra'];?>" name="id_kra" hidden>
																				
																				<br>
																				
																				<div class="form-group">
																				  <label class="col-sm-2 col-sm-2 control-label">KRA</label>
																				  <div class="col-sm-10">
																					  <input class="form-control" type="text" value="<?php echo $d['kra'];?>" disabled>
																				  </div>
																				<div>
																				<br>
																				
																				<div class="form-group">
																				  <label class="col-sm-2 col-sm-2 control-label">Unit Competency</label>
																				  <div class="col-sm-10">
																					  <input class="form-control" id="focusedInput" type="text" name="u_comp">
																				  </div>
																				</div>
											
																	</div><!-- col-lg-12-->      	
															</div><!-- /row -->
														  </div>
														 
														 
														</div>
													  </div>
													</div> 
													
													<?php
													
														$data2= $this->db->query('select * from performance_competency  where id_kra="'.$d["id_kra"].'"')->result_array();
														$rowspan=count($data2);
														
														echo"<tr>";
														echo "<td rowspan='".$rowspan."'>".$no."</td>";
														echo "<td rowspan='".$rowspan."'>".$d['kra']."</td>";
														$no++;
														$z =1;
														foreach($data2 as $d2)
														{
															if ($z==1)
															{
																echo "<td>".$d2['u_comp']."</td>";
																echo "<td><input name='".$d2['id_kra'].".".$d2['id_u_comp']."' type='text'></td></tr>";
																$z=2;
															}
															else
															{
															echo "<tr>
															<td>".$d2['u_comp']."</td>";
															echo "<td><input name='".$d2['id_kra'].".".$d2['id_u_comp']."' type='text'></td></tr>";
															}
														}
														
													}?>
																			
												</tbody>
											
											</table>
											
										</table>		
									</div><!-- col-lg-12-->      	
							</div><!-- /row -->
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
							<button type="submit" class="btn btn-primary">Save changes</button>
						</div>
					</div>
				</div>
			</div>      				

		</div>
		 </form>
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
							<h4 class="mb"><i class="fa fa-angle-right"></i>Competency</h4>
							<form method="post" action="<?php echo base_url()."index.php/performance/search_department";?>">
							<div class="row">
								<div class="form-group">
									<label class="col-md-1 control-label">Department</label>
									<div class="col-sm-2">
										<?php
											$data4= $this->db->query('select * from m_departement')->result_array();																				
											echo "<select class='combobox' style='width:100%' name='searchtype'>";
											foreach($data4 as $d4) {
											echo "<option value=".$d4['id_department'].">".$d4['department_name']."</option>";
											}
											echo "</select>";																			
										?>
									</div>
								</div>
								<br>
								<div class="form-group">
									<label class="col-md-1 control-label">Segment</label>
									<div class="col-sm-2">
										<?php
											$data4= $this->db->query('select * from m_segment')->result_array();																				
											echo "<select class='combobox' style='width:100%' name='type'>";
											foreach($data4 as $d4) {
											echo "<option value=".$d4['id_segment'].">".$d4['segment_name']."</option>";
											}
											echo "</select>";
											echo "<button type='submit' name='search' class='btn btn-default btn-xs'>Search</button>";
										?>
										
									</div>
								</div>																	
							</div>
							</form>
							<br>
							
							<ul class="nav nav-tabs" role="tablist">
								<li role="presentation" class="active"><a href="#katalog" aria-controls="katalog" role="tab" data-toggle="tab">Catalogue</a></li>
								<li role="presentation"><a href="#standard" aria-controls="standard" role="tab" data-toggle="tab">Standard</a></li>
								<li role="presentation"><a href="#assessment" aria-controls="assessment" role="tab" data-toggle="tab">Assessment</a></li>
							</ul>
							
							<div class="tab-content">
								<div role="tabpanel" class="tab-pane active" id="katalog">
								
								<div class="row">
									<br>
										<div class="col-md-1">
											<! -- MODALS -->
											<!-- Button trigger modal -->
											<button class="btn btn-success btn-sm" data-toggle="modal" data-target="#myModal">
											  Add KRA
											</button>
											
											<!-- Modal -->
											<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
											  <div class="modal-dialog">
												<div class="modal-content">
												  <div class="modal-header">
													<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
													<h4 class="modal-title" id="myModalLabel">Competency</h4>
												  </div>
												  <div class="modal-body">
													<div class="row mt">
															<div class="col-lg-12">
																<div class="form-panel">
																  <h4 class="mb"><i class="fa fa-angle-right"></i> Add Key Resource Area (KRA)</h4>
																	<form class="form-horizontal style-form" action="<?php echo base_url()."index.php/performance/insert_kra";?>" method="post">
																	
																		<div class="form-group">
																			<label class="col-sm-2 col-sm-2 control-label">Key Resource Area</label>
																			<div class="col-sm-10">
																				<input class="form-control" id="focusedInput" type="text" name="kra">
																			</div>
																		</div>
																	  	
																		<div class="form-group">
																		  <label class="col-sm-2 col-sm-2 control-label">Type</label>
																		  <div class="col-sm-10">
																			<select class="combobox" style="width:100%" name="type">
																			<option value="1" selected>Technical</option>
																			<option value="2">Non-Technical</option>
																			</select>
																		  </div>
																		</div>

																		<div class="form-group">
																		  <label class="col-sm-2 col-sm-2 control-label">Department</label>
																		  <div class="col-sm-10">
																			<?php
																				$data4= $this->db->query('select * from m_departement')->result_array();
																				
																				echo "<select class='combobox' style='width:100%' name='id_department'>";
																				foreach($data4 as $d4) {
																				echo "<option value=".$d4['id_department'].">".$d4['name']."</option>";
																				}
																				echo "</select>";
																				
																			?>
																		  </div>
																		</div>
																
																</div>
															</div><!-- col-lg-12-->      	
													</div><!-- /row -->
												  </div>
												  <div class="modal-footer">
													<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
													<button type="submit" class="btn btn-primary">Save changes</button>
												  </div>
												  </form>
												</div>
											  </div>
											</div>      				

										</div>
								</div>
								
								
									<table style = "width:100%">
									<br>
										<label>Technical Competency</label>
										
										<thead bgcolor= #696969>
											<tr>
											<?php
											echo "<td style ='color :white'>No.</td>";
											echo "<td style ='color :white'>Key Result Area (KRA)</td>";
											echo "<td style ='color :white'>Unit Competency</td>";
											?>
											</tr>
										</thead>
											
										<tbody>
											<?php
											if(!isset( $_SESSION['search']))
											{
												$_SESSION['search']='1';
											}
											$data=$this->db->query("select * from performance_m_kra where type='1' and id_department ='".$_SESSION['search']."'")->result_array();
											$no=1;
											foreach($data as $d)
											{?>
												<div class="modal fade" id="myModal2<?php echo $d['id_kra'];?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
													<div class="modal-dialog">
														<div class="modal-content">
															<div class="modal-header">
																<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
																<h4 class="modal-title" id="myModalLabel">Unit Competency</h4>
															</div>
															<div class="modal-body">
															<div class="row mt">
																<div class="col-lg-12">
																	<h4 class="mb"><i class="fa fa-angle-right"></i> Add Unit Competency</h4>
																	<form class="form-horizontal style-form" action="<?php echo base_url()."index.php/performance/insert_u_comp";?>" method="post">
																		<?php
																		$idcomp=$this->db->query("select COUNT(id_u_comp)+1 a from performance_competency where id_kra =".$d['id_kra']."")->result_array();
																
															
																		?>
																		<input name='id_u_comp' value='<?php echo $idcomp[0]["a"];?>' hidden>
																		 <input value="<?php echo $d['id_kra'];?>" name="id_kra" hidden>
																		 <!--<input value="<?php echo $d['id_jobtitle'];?>" name="id_jobtitle" hidden>-->
														
																		<br>
																		
																		<div class="form-group">
																			  <label class="col-sm-2 col-sm-2 control-label">KRA</label>
																			  <div class="col-sm-10">
																				  <input class="form-control" type="text" value="<?php echo $d['kra'];?>" disabled>
																			  </div>
																		</div>
																				<br>
																				
																		<div class="form-group">
																			<label class="col-sm-2 col-sm-2 control-label">Unit Competency</label>
																			<div class="col-sm-10">
																				<input class="form-control" id="focusedInput" type="text" name="u_comp">
																			</div>
																		</div>
									
																</div><!-- col-lg-12-->      	
															</div><!-- /row -->
															</div>
															<div class="modal-footer">
																<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
																<button type="submit" class="btn btn-primary">Save changes</button>
															</div>
																	</form>
														</div>
													</div>
												</div> 
											
											<?php
											
												$data2= $this->db->query('select * from performance_competency  where id_kra="'.$d["id_kra"].'"')->result_array();
												$rowspan=count($data2);
												echo"<tr>";
												echo "<td rowspan='".$rowspan."'>".$no."</td>";
												echo "<td rowspan='".$rowspan."'><a href='#' data-toggle='modal' data-target='#myModal2".$d['id_kra']."'  >".$d['kra']."</a></td>";
												$no++;
												$z =1;
												foreach($data2 as $d2)
												{
													if ($z==1)
													{
														echo "<td>".$d2['u_comp']."</td></tr>";
														$z=2;
													}
													else
													{
													echo "<tr>
													<td>".$d2['u_comp']."</td></tr>";
													}
												}												
											}?>
																	
										</tbody>
									</table>
									
									<br>
									<label>Non-Technical Competence</label>
									<table style = "width:100%">
										
									
										<thead bgcolor= #696969>
											<tr>
											<?php
											echo "<td style ='color :white'>No.</td>";
											echo "<td style ='color :white'>Key Result Area (KRA)</td>";
											echo "<td style ='color :white'>Unit Competency</td>";
											?>
											</tr>
										</thead>
																			
										<tbody>
											<?php
											$data=$this->db->query("select * from performance_m_kra where type='2' and id_department ='".$_SESSION['search']."'")->result_array();
											$no=1;
											foreach($data as $d)
											{?>
												<div class="modal fade" id="myModal2<?php echo $d['id_kra'];?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
											  <div class="modal-dialog">
												<div class="modal-content">
												  <div class="modal-header">
													<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
													<h4 class="modal-title" id="myModalLabel">Unit Competency</h4>
												  </div>
												  <div class="modal-body">
													<div class="row mt">
															<div class="col-lg-12">
																  <h4 class="mb"><i class="fa fa-angle-right"></i> Add Unit Competency</h4>
																	<form class="form-horizontal style-form" action="<?php echo base_url()."index.php/performance/insert_u_comp";?>" method="post">
																		<?php
																		$idcomp=$this->db->query("select COUNT(id_u_comp)+1 a from performance_competency where id_kra =".$d['id_kra']."")->result_array();
																
															
																		?>
																		<input name='id_u_comp' value='<?php echo $idcomp[0]["a"];?>' hidden>
																		 <input value="<?php echo $d['id_kra'];?>" name="id_kra" hidden>
																		
																		<br>
																		
																		<div class="form-group">
																		  <label class="col-sm-2 col-sm-2 control-label">KRA</label>
																		  <div class="col-sm-10">
																			  <input class="form-control" type="text" value="<?php echo $d['kra'];?>" disabled>
																		  </div>
																		<div>
																		<br>
																		
																		<div class="form-group">
																		  <label class="col-sm-2 col-sm-2 control-label">Unit Competency</label>
																		  <div class="col-sm-10">
																			  <input class="form-control" id="focusedInput" type="text" name="u_comp">
																		  </div>
																		</div>
									
															</div><!-- col-lg-12-->      	
													</div><!-- /row -->
												  </div>
												  <div class="modal-footer">
													<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
													<button type="submit" class="btn btn-primary">Save changes</button>
												  </div>
												  </form>
												</div>
											  </div>
											</div> 
											
											<?php
											
												$data2= $this->db->query('select * from performance_competency  where id_kra="'.$d["id_kra"].'"')->result_array();
												$rowspan=count($data2);
												
												echo"<tr>";
												echo "<td rowspan='".$rowspan."'>".$no."</td>";
												echo "<td rowspan='".$rowspan."'><a href='#' data-toggle='modal' data-target='#myModal2".$d['id_kra']."'  >".$d['kra']."</a></td>";
												$no++;
												$z =1;
												foreach($data2 as $d2)
												{
													if ($z==1)
													{
														echo "<td>".$d2['u_comp']."</td></tr>";
														$z=2;
													}
													else
													{
													echo "<tr>
													<td>".$d2['u_comp']."</td></tr>";
													}
												}												
											}?>
																	
										</tbody>
									
									</table>
								</div>
							
								
								<div role="tabpanel" class="tab-pane" id="standard">
									<table style = "width:100%">
										<thead bgcolor= #696969>
											<tr>
											<?php
											echo "<td style ='color :white'><center>No.</td>";
											echo "<td style ='color :white'><center>Job Position</td>";
											echo "<td style ='color :white'><center></td>";
											?>
											</tr>
										</thead>
											
										<tbody>
										
										
											<?php
											$no=1;
											$data3= $this->db->query('SELECT * FROM m_jobtitle')->result_array();
											foreach($data3 as $d3)
											{
											
											?>
											<?php
												echo"<tr>";
												echo "<td>".$no."</td>";
												echo "<td>".$d3['title']."</td>";
												echo "<td><center><button type='submit' class='btn btn-primary' data-toggle='modal' data-target='#myModal3'><i class='fa fa-search'></i> View</button>
														<button type='submit' class='btn btn-danger'><i class='fa fa-trash'></i> Delete</button></td>";
												echo "</tr>";
												$no++;
												?>
												
												<?php
											}?>
																	
										</tbody>																						
									</table>
								</div>
								
								<div role="tabpanel" class="tab-pane" id="assessment">
									<table>
										<thead bgcolor= #696969>
											<tr>
											<?php
											echo "<td style ='color :white'>No.</td>";
											echo "<td style ='color :white'>Name</td>";
											echo "<td style ='color :white'>NIK</td>";
											echo "<td style ='color :white'>Job Position</td>";
											echo "<td style ='color :white'>Periode I</td>";
											echo "<td style ='color :white'>Periode II</td>";
											?>
											</tr>
										</thead>
										
										<tbody>
										
										
											<?php
											$no=1;
											$data3= $this->db->query('select * from m_employee
																	left join employee_personal_detail on id_employee = employee_id
																	left join m_jobtitle on jobtitle_id = id_jobtitle
																	')->result_array();

											foreach($data3 as $d3)
											{
											
											?>
											<?php
												echo"<tr>";
													echo "<td>".$no."</td>";
													echo "<td><a href='".base_url()."index.php/performance/edit_kpi/".$d3['id_employee']."'>".$d3['name']."</a></td>";
													echo "<td>".$d3['nik']."</td>";
													echo "<td>".$d3['title']."</td>";
													echo "<td></td>";
													echo "<td></td>";
												echo "</tr>";
												$no++;
												?>
												
												<?php
											}?>
																	
										</tbody>
									</table>
								</div>
								
							</div>	
						</div>
					</div>
				</div>	
		</section>
	</section>
</body>
<?php
$this->load->view('footer.php');
// include("footer.php");
?>