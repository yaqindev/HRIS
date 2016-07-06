<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Performance extends CI_Controller {
	public function performance_kpi()
	{
		$this->m_security->check();
		$level = $_SESSION['level'];

		$data['kpi'] 			= $this->tbl_kpi->join_department(array('kpi.ID_DEPARTMENT'=>2));
		if ($level == '1')
		{
			$data['departments'] 	= $this->tbl_department->dept_active();
		}else{
			$id_department = $this->user->get_id($_SESSION['id_user'])[0]->ID_DEPARTMENT;
			$data['departments'] 	= $this->tbl_department->get_id($id_department);
		}
		$this->load->view('performance/performance_kpi',$data);		
	}

	public function performance_kpi_act($act)
	{
		switch ($act) {
			case 'set_performance_kpi':
				$id_department 	= $this->input->post('department');
				$id_employee 	= $this->input->post('karyawan');

				$KPIs 			= $this->tbl_kpi->join_department(array('kpi.ID_DEPARTMENT'=>$id_department));
								
				echo'
				<ul class="nav nav-tabs" role="tablist">
					<li role="presentation" class="active"><a href="#input" aria-controls="input" role="tab" data-toggle="tab">Input Bulanan</a></li>
					<li role="presentation" ><a href="#monitoring" aria-controls="monitoring" role="tab" data-toggle="tab">Monitoring</a></li>
					<li role="presentation"><a href="#evaluation" aria-controls="evaluation" role="tab" data-toggle="tab">Evaluation</a></li>
				</ul>

				<div class="tab-content">
					<div role="tabpanel" class="tab-pane active" id="input">
						<div class="form-panel">
							<form action="'.base_url().'performance/performance_kpi_act/input_bulanan" method="post">
								<div class="row">
									<div class="col-md-12">
										<div class="row form-group">
											<label for="tahun" class="col-md-1">Tahun</label>
											<div class="col-md-4">
												<select class="form-control" name="tahun" id="tahun" onchange="set_bulan()" required>
													<option value=""> -- Pilih Tahun --</option>';
													$tahun = date("Y");
													$batas = $tahun-2;
													for ($i=$tahun; $i > $batas; $i--) {
														echo '<option value="'.$i.'">'.$i.'</option>';
													}
												echo '
												</select>
												<input type="hidden" name="department" id="department_id" value="'.$id_department.'" readonly>
												<input type="hidden" name="employee" id="employee_id" value="'.$id_employee.'" readonly>
											</div>
										</div>
										<div class="row form-group">
											<label for="bulan" class="col-md-1">Bulan</label>
											<div class="col-md-4">
												<div id="box_bulan">
													<select class="form-control" name="bulan" id="bulan" required>
														<option value=""> -- Pilih Bulan --</option>
													</select>
												</div>
											</div>
										</div>
										</div><!-- end .col-md-12 -->
								</div><!-- end .row -->
								<br>
								<div class="row">
									<div class="col-md-12">
										<table  class="display" cellspacing="0" width="100%">
											<thead bgcolor="#696969">
												<tr>
													<th style ="color :white; text-align:center;" width="5%">No.</th>
													<th style ="color :white; text-align:center;" width="40%">KPI</th>
													<th style ="color :white; text-align:center;" width="10%">Weight</th>
													<th style ="color :white; text-align:center;" width="10%">Target</th>
													<th style ="color :white; text-align:center;" width="10%">UOM</th>
													<th style ="color :white; text-align:center;" width="20%">Actual Bulanan</th>
													<th style ="color :white; text-align:center;" width="5%"></th>
												</tr>
											</thead>
											<tbody id="box_inputan_kpi">';
												echo'
												<tr>
													<td></td>
													<td></td>
													<td></td>
													<td></td>
													<td></td>
													<td></td>
													<td></td>
												</tr>';
												echo '
											</tbody>
										</table>
									</div><!-- end .col-md-12 -->
								</div><!-- end .row -->
								<br>
								<div class="row">
									<div class="col-md-12">
										<div class="pull-right">
										<button type="submit" class="btn btn-primary">Simpan</button>
										<a href="'.base_url().'performance/performance_kpi" class="btn btn-info" role="button">Cancel</a>
										</div>
									</div><!-- end col-md-12 -->
								</div><!-- end.row -->
							</form>
						</div><!-- end #form-panel -->
					</div><!-- end #input -->

					<div role="tabpanel" class="tab-pane" id="monitoring">
						<br>
						<div class="row">
							<div class="col-md-12">
								<div class="row form-group">
									<label for="tahun" class="col-md-1">Tahun</label>
									<div class="col-md-4">
										<select class="form-control" name="tahun_monitoring" id="tahun_monitoring" onchange="set_box_monitoring()" required>';
											$tahun = date("Y");
											$batas = $tahun-2;
											for ($i=$tahun; $i > $batas; $i--) {
												echo '<option value="'.$i.'">'.$i.'</option>';
											}
										echo '
										</select>
										<input type="hidden" name="department" id="department_id" value="'.$id_department.'" readonly>
										<input type="hidden" name="employee" id="employee_id" value="'.$id_employee.'" readonly>
									</div>
								</div>
							</div>
						</div>
						<table  id="example" class="display" cellspacing="0" width="100%">
						<thead>
							<tr  bgcolor="#696969">
								<th rowspan ="2" style ="color :white"><center>No.</center></th>
								<th rowspan = "2" style ="color :white"><center>KPI</center></th>
								<th colspan="12" style ="color :white"><center>Actual</center></th>
								
							</tr>
							  
							<tr bgcolor=#696969>
								<th style ="color :white"><center>Jan</center></th>
								<th style ="color :white"><center>Feb</center></th>
								<th style ="color :white"><center>Mar</center></th>
								<th style ="color :white"><center>Apr</center></th>
								<th style ="color :white"><center>Mei</center></th>
								<th style ="color :white"><center>Jun</center></th>
								<th style ="color :white"><center>Jul</center></th>
								<th style ="color :white"><center>Aug</center></th>
								<th style ="color :white"><center>Sep</center></th>
								<th style ="color :white"><center>Oct</center></th>
								<th style ="color :white"><center>Nov</center></th>
								<th style ="color :white"><center>Des</center></th>
							</tr>
						</thead>
						<tbody id="box_monitoring">';
								$no = 1;
								foreach ($KPIs as $kpi) {
									echo "<tr>";
									echo "<td style='text-align:center'>".$no++."</td>";
									echo "<td>".ucfirst(strtolower($kpi->KPI))."</td>";

									$tahun 	= '2016';
									for ($i=1; $i <= 12 ; $i++) { 
										$bulan 				= $i;
										$cond_monitoring	= array(
												'ID_EMPLOYEE' 	=> $id_employee,
												'NAME_YEAR' 	=> $tahun,
												'BULAN' 		=> $bulan,
												'kpi.ID_KPI' 	=> $kpi->ID_KPI
											);
										$data_actual 		= $this->tbl_kpi_monitoring->actual_bulanan($cond_monitoring);	
										if (count($data_actual) > 0) {
											$actual_bulanan 	= $data_actual[0]->ACTUAL_BULANAN;
											echo "<td style='text-align:center'>".$actual_bulanan."</td>";
										}else{
											echo "<td style='text-align:center'></td>"; 
										}
									}
									echo "</tr>";
								}
								echo '					
						</tbody>
						</table>
					</div>
					
					<div role="tabpanel" class="tab-pane" id="evaluation">
						<br>
						<div class="row">
							<div class="col-md-12">
								<div class="row form-group">
									<label for="tahun" class="col-md-1">Tahun</label>
									<div class="col-md-4">
										<select class="form-control" name="tahun_periode" id="tahun_periode" onchange="set_periode()" required>
											<option value=""> -- Pilih Tahun --</option>';
											$tahun = date("Y");
											$batas = $tahun-2;
											for ($i=$tahun; $i > $batas; $i--) {
												echo '<option value="'.$i.'">'.$i.'</option>';
											}
										echo '
										</select>
										<input type="hidden" name="department" id="department_id" value="'.$id_department.'" readonly>
										<input type="hidden" name="employee" id="employee_id" value="'.$id_employee.'" readonly>
									</div>
								</div>
								<div class="row form-group">
									<label for="tahun" class="col-md-1">Periode</label>
									<div class="col-md-4">
										<select class="form-control" name="periode" id="periode" onchange="set_box_periode()" required>
											<option value=""> -- Pilih Periode --</option>
											<option value="1"> Mid Year</option>
											<option value="2"> Year End</option>';
										echo '
										</select>
									</div>
								</div>
							</div>
						</div>
						<br>
						<div class="row">
							<div class="col-md-12">
								<table  id="example" class="display" cellspacing="0" width="100%">
									<thead>
										<tr bgcolor =#696969>
											<td style ="color :white; text-align:center;" width="5%">No.</td>
											<td style ="color :white; text-align:center;" width="20%">Strategic Objective</td>
											<td style ="color :white; text-align:center;" width="15%">KPI</td>
											<td style ="color :white; text-align:center;" width="10%">UOM</td>
											<td style ="color :white; text-align:center;" width="10%">Target</td>
											<td style ="color :white; text-align:center;" width="10%">Weight</td>
											<td style ="color :white; text-align:center;" width="10%">Actual</td>
											<td style ="color :white; text-align:center;" width="10%">Score</td>
											<td style ="color :white; text-align:center;" width="10%">Total</td>
										</tr>
									</thead>
									<tbody id="box_periode">';
										echo '
										<tr>
											<td></td>
											<td></td>
											<td></td>
											<td></td>
											<td></td>
											<td></td>
											<td></td>
											<td></td>
											<td></td>
										</tr>
										';
										echo '										
									</tbody>														
								</table>
							</div>
						</div>
						<br>
					</div><!-- #evaluation -->
				</div><!-- end.tab-content -->
				';
				break;
			case 'pilih_employee':
				$id_department 	= $this->input->post('department');
				$employees 		= $this->tbl_employee->join_dept_personal(array('employee.ID_DEPARTMENT'=>$id_department));
				echo '
				<select class="form-control" name="employee_search" id="employee_search" onchange="set_performance_kpi()" required>
					<option value=""> -- Pilih Karyawan -- </option>';
					foreach ($employees as $employee) {
						echo '<option value="'.$employee->ID_EMPLOYEE.'">'.ucfirst(strtolower($employee->NAME)).'</option>';
					}
				echo '</select>';
				break;
			case 'set_kosong':
				echo '
				<ul class="nav nav-tabs" role="tablist">
					<li role="presentation" class="active"><a href="#input" aria-controls="input" role="tab" data-toggle="tab">Input Bulanan</a></li>
					<li role="presentation" ><a href="#monitoring" aria-controls="monitoring" role="tab" data-toggle="tab">Monitoring</a></li>
					<li role="presentation"><a href="#evaluation" aria-controls="evaluation" role="tab" data-toggle="tab">Evaluation</a></li>
				</ul>

				<div class="tab-content">
					<div role="tabpanel" class="tab-pane active" id="input">
						<div class="form-panel">
							<form action="#" method="post">
								<div class="row">
									<div class="col-md-12">
										<div class="row form-group">
											<label for="tahun" class="col-md-1">Tahun</label>
											<div class="col-md-4">
												<select class="form-control" name="tahun" id="tahun" disabled="true">
													<option value=""> -- Pilih Tahun --</option>
												</select>
											</div>
										</div>
										<div class="row form-group">
											<label for="bulan" class="col-md-1">Bulan</label>
											<div class="col-md-4">
												<select class="form-control" name="bulan" id="bulan" disabled="true">
													<option value=""> -- Pilih Bulan --</option>
													<option value="1">January</option>
													<option value="2">February</option>
												</select>
											</div>
										</div>
										</div><!-- end .col-md-12 -->
								</div><!-- end .row -->
								<br>
								<div class="row">
									<div class="col-md-12">
										<table  class="display" cellspacing="0" width="100%">
											<thead bgcolor="#696969">
												<tr>
													<th style ="color :white; text-align:center;" width="5%">No.</th>
													<th style ="color :white; text-align:center;" width="40%">KPI</th>
													<th style ="color :white; text-align:center;" width="10%">Weight</th>
													<th style ="color :white; text-align:center;" width="10%">UOM</th>
													<th style ="color :white; text-align:center;" width="10%">Target</th>
													<th style ="color :white; text-align:center;" width="20%">Actual Bulanan</th>
													<th style ="color :white; text-align:center;" width="5%"></th>
												</tr>
											</thead>
											<tbody>
												<tr>
													<td></td>
													<td></td>
													<td></td>
													<td></td>
													<td></td>
													<td></td>
													<td></td>
												</tr>
											</tbody>
										</table>
									</div><!-- end .col-md-12 -->
								</div><!-- end .row -->
								<br>
								<div class="row">
									<div class="col-md-12">
										<div class="pull-right">
										</div>
									</div><!-- end col-md-12 -->
								</div><!-- end.row -->
							</form>
						</div><!-- end #form-panel -->
					</div><!-- end #input -->

					<div role="tabpanel" class="tab-pane" id="monitoring">
						<table  id="example" class="display" cellspacing="0" width="100%">
						<thead>
							<tr  bgcolor="#696969">
								<th rowspan ="2" style ="color :white"><center>No.</center></th>
								<th rowspan = "2" style ="color :white"><center>KPI</center></th>
								<th colspan="12" style ="color :white"><center>Actual</center></th>
								
							</tr>
							  
							<tr bgcolor=#696969>
								<th style ="color :white"><center>Jan</center></th>
								<th style ="color :white"><center>Feb</center></th>
								<th style ="color :white"><center>Mar</center></th>
								<th style ="color :white"><center>Apr</center></th>
								<th style ="color :white"><center>Mei</center></th>
								<th style ="color :white"><center>Jun</center></th>
								<th style ="color :white"><center>Jul</center></th>
								<th style ="color :white"><center>Aug</center></th>
								<th style ="color :white"><center>Sep</center></th>
								<th style ="color :white"><center>Oct</center></th>
								<th style ="color :white"><center>Nov</center></th>
								<th style ="color :white"><center>Des</center></th>
							</tr>
						</thead>
							<tr>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
							</tr>
						<tbody>
						</tbody>
						</table>
					</div>
					
					<div role="tabpanel" class="tab-pane" id="evaluation">
						<table  id="example" class="display" cellspacing="0" width="100%">
						<thead>
							<tr bgcolor =#696969>
								<td style ="color :white">No.</td>
								<td style ="color :white">Strategic Objective</td>
								<td style ="color :white">KPI</td>
								<td style ="color :white">UOM</td>
								<td style ="color :white">Target</td>
								<td style ="color :white">Weight</td>
								<td style ="color :white">Actual</td>
								<td style ="color :white">Score</td>
								<td style ="color :white">Total</td>
							</tr>
						</thead>
				
						<tbody>
							<tr>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
							</tr>
						</tbody>														
						</table>
					</div>
				</div><!-- end.tab-content -->
				';
				break;
			case 'set_bulan':
				$tahun 	= $this->input->post('tahun');
				$now 	= date("Y");

				echo '
				<select class="form-control" name="bulan" id="bulan" onchange="set_inputan_kpi()" required>
					<option value=""> -- Pilih Bulan --</option>';
					if ($tahun == $now)
					{
						$bulan = date("m");
						for ($i=1; $i <= $bulan ; $i++)
						{ 
							echo '<option value="'.date("m",strtotime($tahun.'-'.$i.'-1')).'">'.date("M",strtotime($tahun.'-'.$i.'-1')).'</option>';
						}
					}else
					if ($tahun < $now)
					{
						for ($i=1; $i <= 12 ; $i++)
						{ 
							echo '<option value="'.date("m",strtotime($tahun.'-'.$i.'-1')).'">'.date("M",strtotime($tahun.'-'.$i.'-1')).'</option>';
						}
					}
				echo '</select>';
				break;
			case 'set_inputan_kpi':
				$tahun 			= $this->input->post('tahun');
				$department 	= $this->input->post('department');
				$karyawan 		= $this->input->post('karyawan');
				$bulan 			= $this->input->post('bulan');

				$KPIs 			= $this->tbl_kpi->join_department(array('kpi.ID_DEPARTMENT'=>$department));
				$no 			= 1;
				foreach ($KPIs as $kpi)
				{
					$cond_monitoring	= array(
						'ID_EMPLOYEE' 	=> $karyawan,
						'NAME_YEAR' 	=> $tahun,
						'BULAN' 		=> $bulan,
						'kpi.ID_KPI' 	=> $kpi->ID_KPI
					);
					$actual 		= $this->tbl_kpi_monitoring->actual_bulanan($cond_monitoring);
					if (count($actual) > 0)
					{
						echo '
						<tr>
							<td style="text-align:center;">'.$no.'</td>
							<td>'.ucfirst(strtolower($kpi->KPI)).'</td>
							<td style="text-align:center;">'.$kpi->WEIGHT.'%</td>
							<td style="text-align:center;">'.$kpi->TARGET.'</td>
							<td style="text-align:center;">'.$kpi->UOM.'</td>
							<td style="text-align:center;">
								<input type="number" name="actual[2]['.$actual[0]->ID_KPI_MONITORING.']" id="kpi_'.$kpi->ID_KPI.'" class="form-control" value="'.$actual[0]->ACTUAL_BULANAN.'" readonly>
							</td>
							<td>';
								echo '<button type="button" class="btn btn-info" id="btn_input_'.$kpi->ID_KPI.'" onclick="edit('.$kpi->ID_KPI.')"><i class="fa fa-pencil"></i></button>';
							echo '
							</td>
						</tr>
						';
					}else{
						echo '
						<tr>
							<td style="text-align:center;">'.$no.'</td>
							<td>'.ucfirst(strtolower($kpi->KPI)).'</td>
							<td style="text-align:center;">'.$kpi->WEIGHT.'%</td>
							<td style="text-align:center;">'.$kpi->TARGET.'</td>
							<td style="text-align:center;">'.$kpi->UOM.'</td>
							<td style="text-align:center;">
								<input type="number" name="actual[1]['.$kpi->ID_KPI.']" id="kpi_'.$kpi->ID_KPI.'" class="form-control" value="0">
							</td><td>';
							echo '
							</td>
						</tr>
						';
					}
					$no++;
				}
				break;
			case 'input_bulanan':
				$tahun 			= $this->input->post('tahun');
				$id_employee 	= $this->input->post('employee');
				$actuals 		= $this->input->post('actual');
				$bulan 			= $this->input->post('bulan');
				$periode 		= 1;

				$total_PA_kpi = 0;
				foreach ($actuals as $key => $actual)
				{
					if ($key == '1')
					{
						foreach ($actual as $key => $value)
						{
							$id = $this->m_security->gen_id('kpi_monitoring','ID_KPI_MONITORING');
							$data = array(
									'ID_KPI_MONITORING' => $id,
									'NAME_YEAR' 		=> $tahun,
									'ID_KPI' 			=> $key,
									'ID_EMPLOYEE' 		=> $id_employee,
									'BULAN' 			=> $bulan,
									'ACTUAL_BULANAN' 	=> $value
								);
							$this->tbl_kpi_monitoring->add($data);

							if ($bulan >= 7 && $bulan <= 12 ) {
								$periode = 2;
							}
							$kpi 	= $this->tbl_kpi->get_id($key)[0];
							$id_kpi = $kpi->ID_KPI;
							$type 	= $kpi->TYPE;
							$target = $kpi->TARGET;
							$weight = $kpi->WEIGHT;


							$actual_periode = $this->tbl_kpi_monitoring->sum_actual_bulanan(array('ID_KPI'=>$id_kpi,'NAME_YEAR'=>$tahun,'ID_EMPLOYEE'=>$id_employee ),$periode);
							$actual_periode = $actual_periode/6;

							if ($type == '+')
							{
								$score_periode = round((($actual_periode/$target)*100),2);
							}else
							if ($type == '-')
							{
								$score_periode = round((($target/$actual_periode)*100),2);
							}else{
								$score_periode = 0;
							}

							if ($score_periode > 110)
							{
								$total_score_periode = round((($weight * 100)/100),2);
							}else{
								$total_score_periode = round((($score_periode * $weight)/100),2);
							}

							$total_PA_kpi = $total_PA_kpi + $total_score_periode;

							$cond_e = array(
									'kpi_evaluation.ID_EMPLOYEE' 	=> $id_employee, 
									'kpi_evaluation.ID_KPI' 		=> $id_kpi, 
									'kpi_evaluation.NAME_YEAR' 		=> $tahun, 
									'kpi_evaluation.ID_PERIODE' 	=> $periode 
								);
							$evaluation = $this->tbl_kpi_evaluation->actual_periode($cond_e);
							if (count($evaluation) > 0)
							{
								$where_e = array( 'ID_KPI_EVALUATION' => $evaluation[0]->ID_KPI_EVALUATION );
								$data_e = array(
										'ID_EMPLOYEE' 			=> $id_employee,
										'ID_KPI' 				=> $id_kpi,
										'NAME_YEAR' 			=> $tahun,
										'ID_PERIODE' 			=> $periode,
										'ACTUAL_PERIODE' 		=> $actual_periode,
										'TOTAL_SCORE_PERIODE' 	=> $total_score_periode
									);
								$this->tbl_kpi_evaluation->update($data_e,$where_e);
							}else{
								$id = $this->m_security->gen_id('kpi_evaluation','ID_KPI_EVALUATION');
								$data_e = array(
										'ID_KPI_EVALUATION' 	=> $id,
										'ID_EMPLOYEE' 			=> $id_employee,
										'ID_KPI' 				=> $id_kpi,
										'NAME_YEAR' 			=> $tahun,
										'ID_PERIODE' 			=> $periode,
										'ACTUAL_PERIODE' 		=> $actual_periode,
										'TOTAL_SCORE_PERIODE' 	=> $total_score_periode
									);
								$this->tbl_kpi_evaluation->add($data_e);
							}
						}
					}else
					if ($key == '2')
					{
						foreach ($actual as $key => $value)
						{
							$data = array('ACTUAL_BULANAN' => $value );
							$where = array('ID_KPI_MONITORING' => $key );
							$this->tbl_kpi_monitoring->update($data,$where);

							if ($bulan >= 7 && $bulan <= 12 ) {
								$periode = 2;
							}

							$kpi 	= $this->tbl_kpi_monitoring->join_kpi(array('kpi_monitoring.ID_KPI_MONITORING'=>$key))[0];
							$id_kpi = $kpi->ID_KPI;
							$type 	= $kpi->TYPE;
							$target = $kpi->TARGET;
							$weight = $kpi->WEIGHT;

							$actual_periode = $this->tbl_kpi_monitoring->sum_actual_bulanan(array('ID_KPI'=>$id_kpi,'NAME_YEAR'=>$tahun,'ID_EMPLOYEE'=>$id_employee));

							if ($type == '+')
							{
								$score_periode = round((($actual_periode/$target)*100),2);
							}else
							if ($type == '-')
							{
								$score_periode = round((($target/$actual_periode)*100),2);
							}else{
								$score_periode = 0;
							}

							if ($score_periode > 110)
							{
								$total_score_periode = round((($weight * 100)/100),2);
							}else{
								$total_score_periode = round((($score_periode * $weight)/100),2);
							}

							$total_PA_kpi = $total_PA_kpi + $total_score_periode;

							$cond_e = array(
									'kpi_evaluation.ID_EMPLOYEE' 	=> $id_employee, 
									'kpi_evaluation.ID_KPI' 		=> $id_kpi, 
									'kpi_evaluation.NAME_YEAR' 		=> $tahun, 
									'kpi_evaluation.ID_PERIODE' 	=> $periode 
								);

							$evaluation = $this->tbl_kpi_evaluation->actual_periode($cond_e);
							if (count($evaluation) > 0)
							{
								$where_e = array( 'ID_KPI_EVALUATION' => $evaluation[0]->ID_KPI_EVALUATION );
								$data_e = array(
										'ID_EMPLOYEE' 			=> $id_employee,
										'ID_KPI' 				=> $id_kpi,
										'NAME_YEAR' 			=> $tahun,
										'ID_PERIODE' 			=> $periode,
										'ACTUAL_PERIODE' 		=> $actual_periode,
										'TOTAL_SCORE_PERIODE' 	=> $total_score_periode
									);
								$this->tbl_kpi_evaluation->update($data_e,$where_e);
							}else{
								$id = $this->m_security->gen_id('kpi_evaluation','ID_KPI_EVALUATION');
								$data_e = array(
										'ID_KPI_EVALUATION' 	=> $id,
										'ID_EMPLOYEE' 			=> $id_employee,
										'ID_KPI' 				=> $id_kpi,
										'NAME_YEAR' 			=> $tahun,
										'ID_PERIODE' 			=> $periode,
										'ACTUAL_PERIODE' 		=> $actual_periode,
										'TOTAL_SCORE_PERIODE' 	=> $total_score_periode
									);
								$this->tbl_kpi_evaluation->add($data_e);
							}
						}
					}
				}

				$cond_PA_detail = array(
						'performance_appraisal_detail.ID_EMPLOYEE' 	=> $id_employee,
						'performance_appraisal_detail.NAME_YEAR' 	=> $tahun,
						'performance_appraisal_detail.ID_PERIODE' 	=> $periode
					);
				$detail_PA = $this->tbl_performance_appraisal_detail->join_full($cond_PA_detail);

				$id_PA_detail = '';

				if (count($detail_PA) > 0) {
					$id_PA_detail 	= $detail_PA[0]->ID_PA_DETAIL;
					$where 	= array('ID_PA_DETAIL' 		=> $detail_PA[0]->ID_PA_DETAIL);
					$data 	= array('TOTAL_KPI' 		=> $total_PA_kpi );
					$this->tbl_performance_appraisal_detail->update($data,$where);
				}else{
					$id = $this->m_security->gen_id('performance_appraisal_detail','ID_PA_DETAIL');
					$id_PA_detail 	= $id;
					$data = array(
							'ID_PA_DETAIL' 		=> $id,
							'ID_EMPLOYEE' 		=> $id_employee,
							'NAME_YEAR' 		=> $tahun,
							'ID_PERIODE' 		=> $periode,
							'TOTAL_KPI' 		=> $total_PA_kpi,
							'TOTAL_COMPETENCY' 	=> 0,
							'TOTAL_ZAP' 		=> 0,
							'TOTAL_DICIPLINARY' => 0
						);
					$this->tbl_performance_appraisal_detail->add($data);
				}

				//menhitung nilai performance appraisal
					//mendapatkan masing2 nilai dari PA detail

				$detail_PA = $this->tbl_performance_appraisal_detail->get_id($id_PA_detail)[0];
				$kpi_score 			= ($detail_PA->TOTAL_KPI * 20)/100; 
				$competency_score 	= ($detail_PA->TOTAL_COMPETENCY * 60)/100; 
				$zap_score 			= ($detail_PA->TOTAL_ZAP * 20)/100; 
				$disciplinary_score = $detail_PA->TOTAL_DICIPLINARY;

				$TOTAL_SCORE 		= ($kpi_score + $competency_score + $zap_score)-$disciplinary_score;
				$TOTAL_SCORE 		= round($TOTAL_SCORE,2);

				$cond_PA = array(
						'performance_appraisal.ID_EMPLOYEE' => $id_employee,
						'performance_appraisal.NAME_YEAR' 	=> $tahun,
						'performance_appraisal.ID_PERIODE' 	=> $periode,
						'performance_appraisal.ID_PA_DETAIL'=> $id_PA_detail
					);
				$PA = $this->tbl_performance_appraisal->join_full($cond_PA);

				if (count($PA) > 0)
				{
					//update
					$where 	= array('ID_PERFORMANCE_APPRAISAL' 		=> $PA[0]->ID_PERFORMANCE_APPRAISAL);
					$data 	= array('PERFORMANCE_APPRAISAL_SCORE' 		=> $TOTAL_SCORE );
					$this->tbl_performance_appraisal->update($data,$where);
				}else{
					//simpan
					$id = $this->m_security->gen_id('performance_appraisal','ID_PERFORMANCE_APPRAISAL');
					$data = array(
							'ID_PERFORMANCE_APPRAISAL' 		=> $id,
							'ID_EMPLOYEE' 		=> $id_employee,
							'NAME_YEAR' 		=> $tahun,
							'ID_PERIODE' 		=> $periode,
							'ID_PA_DETAIL' 		=> $id_PA_detail,
							'PERFORMANCE_APPRAISAL_SCORE' 	=> $TOTAL_SCORE
						);
					$this->tbl_performance_appraisal->add($data);
				}

				$this->session->set_flashdata('pesan','Data berhasil di simpan.');
				redirect('performance/performance_kpi');
				break;
			case 'set_box_monitoring':
				$id_department		= $this->input->post('department');
				$id_employee		= $this->input->post('employee');
				$tahun				= $this->input->post('tahun');
				$KPIs 				= $this->tbl_kpi->join_department(array('kpi.ID_DEPARTMENT'=>$id_department));

				$no = 1;
				foreach ($KPIs as $kpi) {
					echo "<tr>";
					echo "<td style='text-align:center'>".$no++."</td>";
					echo "<td>".ucfirst(strtolower($kpi->KPI))."</td>";

					for ($i=1; $i <= 12 ; $i++) { 
						$bulan 				= $i;
						$cond_monitoring	= array(
								'ID_EMPLOYEE' 	=> $id_employee,
								'NAME_YEAR' 	=> $tahun,
								'BULAN' 		=> $bulan,
								'kpi.ID_KPI' 	=> $kpi->ID_KPI
							);
						$data_actual 		= $this->tbl_kpi_monitoring->actual_bulanan($cond_monitoring);
						if (count($data_actual) > 0) {
							$actual_bulanan 	= $data_actual[0]->ACTUAL_BULANAN;
							echo "<td style='text-align:center'>".$actual_bulanan."</td>";
						}else{
							echo "<td style='text-align:center'></td>"; 
						}
					}
					echo "</tr>";
				}
				break;
			case 'set_box_periode':
				$id_department 		= $this->input->post('department');
				$id_employee 		= $this->input->post('employee');
				$tahun 				= $this->input->post('tahun');
				$periode 			= $this->input->post('periode');

				$KPIs 				= $this->tbl_kpi->join_department(array('kpi.ID_DEPARTMENT'=>$id_department));
				$no 				= 1;
				foreach ($KPIs as $kpi) {
					$cond_periode	= array(
							'kpi_evaluation.ID_KPI' 		=> $kpi->ID_KPI,
							'kpi_evaluation.ID_EMPLOYEE' 	=> $id_employee,
							'kpi_evaluation.NAME_YEAR' 		=> $tahun,
							'kpi_evaluation.ID_PERIODE' 	=> $periode
						);
					$data_periode 	= $this->tbl_kpi_evaluation->actual_periode($cond_periode);

					if (count($data_periode) > 0) {
						$evaluation = $data_periode[0];
						echo "<tr>";
							echo "<td style='text-align:center;'> ".$no++." </td>";
							echo "<td>".$kpi->TARGET_DESCRIPTION."</td>";
							echo "<td> ".$kpi->KPI." </td>";
							echo "<td style='text-align:center;'>".$kpi->UOM."</td>";	
							echo "<td style='text-align:center;'>".$kpi->TARGET."</td>";
							echo "<td style='text-align:center;'>".$kpi->WEIGHT."</td>";
							echo "<td style='text-align:center;'> ".$evaluation->ACTUAL_PERIODE."</td>";
							$score = 0;
							if ($kpi->TYPE == '+')
							{
								$score = ($evaluation->ACTUAL_PERIODE / $kpi->TARGET)*100;
							}else{
								$score = ($kpi->TARGET / $evaluation->ACTUAL_PERIODE)*100;
							}
							echo "<td style='text-align:center;'>".number_format($score,2)."% </td>";
							echo "<td style='text-align:center;'>".number_format($evaluation->TOTAL_SCORE_PERIODE,2)."% </td>";
						echo "</tr>";
					}else{
						echo "<tr>";
							echo "<td style='text-align:center;'> ".$no++." </td>";
							echo "<td>".$kpi->TARGET_DESCRIPTION."</td>";
							echo "<td> ".$kpi->KPI." </td>";
							echo "<td style='text-align:center;'>".$kpi->UOM."</td>";	
							echo "<td style='text-align:center;'>".$kpi->TARGET."</td>";
							echo "<td style='text-align:center;'>".$kpi->WEIGHT."</td>";
							echo "<td style='text-align:center;'> </td>";
							echo "<td style='text-align:center;'> </td>";
							echo "<td style='text-align:center;'> </td>";
						echo "</tr>";
					}
				}
				break;
			default:
				redirect('performance/performance_kpi');
				break;
		}
	}

	public function performance_competency()
	{
		$this->m_security->check();
		$level = $_SESSION['level'];

		if ($level == '1')
		{
			$data['departments'] 	= $this->tbl_department->dept_active();
		}else{
			$id_department = $this->user->get_id($_SESSION['id_user'])[0]->ID_DEPARTMENT;
			$data['departments'] 	= $this->tbl_department->get_id($id_department);
		}
		$data['periode'] 		= $this->tbl_periode->get_all();
		$data['years'] 			= $this->tbl_year->get_all();
		$this->load->view('performance/performance_competency',$data);
	}

	public function performance_competency_act($act)
	{
		switch ($act) {
			case 'set_job':
				$id_department 	= $this->input->post('department');
				$jobs 			= $this->tbl_jobtitle->join_segment_departement(array('departement.STATUS_DEPARTMENT'=>0,'segment.ID_DEPARTMENT'=>$id_department));

				echo '
				<select class="form-control" name="job_search" id="job_search" onchange="set_employee()" required>
					<option value=""> -- Pilih Job --</option>';
					foreach ($jobs as $job) {
						echo '<option value="'.$job->ID_JOBTITLE.'">'.$job->TITLE.'</option>';
					}
					echo '
				</select>
				';
				break;
			case 'set_employee':
				$id_jobtitle 	= $this->input->post('job');
				$employees 		= $this->tbl_employee->join_dept_personal(array('employee.ID_JOBTITLE'=> $id_jobtitle));
				echo '
				<select class="form-control" name="employee_search" id="employee_search" required>
					<option value=""> -- Pilih Karyawan --</option>';
					foreach ($employees as $employee) {
						echo '<option value="'.$employee->ID_EMPLOYEE.'">'.$employee->NAME.'</option>';
					}
					echo '
				</select>
				';
				break;
			case 'set_box_competency':
				$id_department 	= $this->input->post('department');
				$id_jobtitle 	= $this->input->post('job');
				$id_employee 	= $this->input->post('karyawan');
				$periode 		= $this->input->post('periode');
				$tahun 			= $this->input->post('tahun');
				$cond = array(
						'standard_unit_competency.ID_JOBTITLE' => $id_jobtitle
					);
				$assesments = $this->tbl_standard_competency->join_full($cond);

				echo '
				<h4><center>--- INPUT PENILAIAN COMPETENCY ---</center></h4>
				<hr>							
					<form action="'.base_url().'performance/performance_competency_act/simpan" method="post">
						<div class="row">
							<div class="col-md-12">
								<input type="hidden" name="periode" value="'.$periode.'">
								<input type="hidden" name="tahun" value="'.$tahun.'">
								<input type="hidden" name="employee" value="'.$id_employee.'">
								<input type="hidden" name="job" value="'.$id_jobtitle.'">
								<table  class="display" cellspacing="0" width="100%">
									<thead bgcolor="#696969">
										<tr>
											<th style ="color :white; text-align:center;" width="5%">No.</th>
											<th style ="color :white; text-align:center;" width="15%">Key Result Area</th>
											<th style ="color :white; text-align:center;" width="10%">Code</th>
											<th style ="color :white; text-align:center;" width="25%">Unit Competency</th>
											<th style ="color :white; text-align:center;" width="5%">Standard</th>
											<th style ="color :white; text-align:center;" width="5%">K</th>
											<th style ="color :white; text-align:center;" width="5%">S</th>
											<th style ="color :white; text-align:center;" width="5%">A</th>
											<th style ="color :white; text-align:center;" width="5%">Result</th>
											<th style ="color :white; text-align:center;" width="20%">Keterangan</th>
											<th style ="color :white; text-align:center;" width="5%"></th>
										</tr>
									</thead>
									<tbody>';
										$no = 1;
										foreach ($assesments as $assesment) {
											$cond_ca = array(
												'assessement_competency.ID_PERIODE'			=> $periode,
												'assessement_competency.ID_EMPLOYEE' 		=> $id_employee,
												'assessement_competency.ID_JOBTITLE' 		=> $id_jobtitle,
												'assessement_competency.ID_UNIT_COMPETENCY' => $assesment->ID_UNIT_COMPETENCY,
												);
											$cek_assesment = $this->tbl_assessement->get_id($cond_ca);
											if (count($cek_assesment) > 0) {
												echo '
												<tr>
													<td style="text-align:center;">'.$no.'</td>
													<td >'.$assesment->NAMA_KRA.'</td>
													<td style="text-align:center;">'.$assesment->CODE_UNIT_COMPETENCY.'</td>
													<td >'.$assesment->NAMA_UNIT_COMPETENCY.'</td>
													<td style="text-align:center;">'.$assesment->NILAI_STANDART.'</td>
													<td>
														<center>
															<select name="competency[2]['.$cek_assesment[0]->ID_ASSESSMENT_COMPETENCY.'][1]" id="competency_'.$cek_assesment[0]->ID_ASSESSMENT_COMPETENCY.'_1" onchange="hitung_result('.$cek_assesment[0]->ID_ASSESSMENT_COMPETENCY.')" style="width:75px;" class="form-control input-data'.$cek_assesment[0]->ID_ASSESSMENT_COMPETENCY.'" disabled="true">';
															if ($cek_assesment[0]->CRITERIA_K > 0) {
																echo '
																<option value="0">No</option>
																<option value="25" selected>Yes</option>
																';
															}else{
																echo '
																<option value="0" selected>No</option>
																<option value="25">Yes</option>
																';
															}
																echo '
															</select>
														</center>
													</td>
													<td>
														<center>
															<select name="competency[2]['.$cek_assesment[0]->ID_ASSESSMENT_COMPETENCY.'][2]" id="competency_'.$cek_assesment[0]->ID_ASSESSMENT_COMPETENCY.'_2" onchange="hitung_result('.$cek_assesment[0]->ID_ASSESSMENT_COMPETENCY.')" style="width:75px;" class="form-control input-data'.$cek_assesment[0]->ID_ASSESSMENT_COMPETENCY.'" disabled="true">';
															if ($cek_assesment[0]->CRITERIA_S > 0) {
																echo '
																<option value="0">No</option>
																<option value="25" selected>Yes</option>
																';
															}else{
																echo '
																<option value="0" selected>No</option>
																<option value="25">Yes</option>
																';
															}
																echo '
															</select>
														</center>
													</td>
													<td>
														<center>
															<select name="competency[2]['.$cek_assesment[0]->ID_ASSESSMENT_COMPETENCY.'][3]" id="competency_'.$cek_assesment[0]->ID_ASSESSMENT_COMPETENCY.'_3" onchange="hitung_result('.$cek_assesment[0]->ID_ASSESSMENT_COMPETENCY.')" style="width:75px;" class="form-control input-data'.$cek_assesment[0]->ID_ASSESSMENT_COMPETENCY.'" disabled="true">';
															if ($cek_assesment[0]->CRITERIA_A > 0) {
																echo '
																<option value="0">No</option>
																<option value="50" selected>Yes</option>
																';
															}else{
																echo '
																<option value="0" selected>No</option>
																<option value="50">Yes</option>
																';
															}
																echo '
															</select>
														</center>
													</td>
													<td style="text-align:center;">
														<input type="hidden" name="result[2]['.$cek_assesment[0]->ID_ASSESSMENT_COMPETENCY.']" id="result'.$cek_assesment[0]->ID_ASSESSMENT_COMPETENCY.'" style="width:50px;" class="form-control input-data'.$cek_assesment[0]->ID_ASSESSMENT_COMPETENCY.'" result="'.$cek_assesment[0]->RESULT_ASSESSMENT.'" disabled="true">
														<span id="view_result_'.$cek_assesment[0]->ID_ASSESSMENT_COMPETENCY.'">
														'.$cek_assesment[0]->RESULT_ASSESSMENT.'%
														</span>
													</td>
													<td>
														<center>
														<textarea name="keterangan[2]['.$cek_assesment[0]->ID_ASSESSMENT_COMPETENCY.']" cols="30" rows="2" class="form-control input-data'.$cek_assesment[0]->ID_ASSESSMENT_COMPETENCY.'" disabled="true">'.$cek_assesment[0]->KETERANGAN_ASSESSMENT.'</textarea>
														</center>
													</td>
													<td>
													<center>
														<button type="button" class="btn btn-success" onclick="active_input_data('.$cek_assesment[0]->ID_ASSESSMENT_COMPETENCY.')"><i class="fa fa-pencil"></i></button>
													</center>
													</td>
												</tr>';
											}else{
												echo ' 
												<tr>
													<td style="text-align:center;">'.$no.'</td>
													<td >'.$assesment->NAMA_KRA.'</td>
													<td style="text-align:center;">'.$assesment->CODE_UNIT_COMPETENCY.'</td>
													<td >'.$assesment->NAMA_UNIT_COMPETENCY.'</td>
													<td style="text-align:center;">'.$assesment->NILAI_STANDART.'</td>
													<td>
														<center>
															<select name="competency[1]['.$assesment->ID_UNIT_COMPETENCY.'][1]" id="competency_'.$assesment->ID_UNIT_COMPETENCY.'_1" onchange="hitung_result('.$assesment->ID_UNIT_COMPETENCY.')" style="width:75px;" class="form-control">
																<option value="0">No</option>
																<option value="25">Yes</option>
															</select>
														</center>
													</td>
													<td>
														<center>
															<select name="competency[1]['.$assesment->ID_UNIT_COMPETENCY.'][2]" id="competency_'.$assesment->ID_UNIT_COMPETENCY.'_2" onchange="hitung_result('.$assesment->ID_UNIT_COMPETENCY.')" style="width:75px;" class="form-control">
																<option value="0">No</option>
																<option value="25">Yes</option>
															</select>
														</center>
													</td>
													<td>
														<center>
															<select name="competency[1]['.$assesment->ID_UNIT_COMPETENCY.'][3]" id="competency_'.$assesment->ID_UNIT_COMPETENCY.'_3" onchange="hitung_result('.$assesment->ID_UNIT_COMPETENCY.')" style="width:75px;" class="form-control">
																<option value="0">No</option>
																<option value="50">Yes</option>
															</select>
														</center>
													</td>
													<td style="text-align:center;">
														<input type="hidden" name="result[1]['.$assesment->ID_UNIT_COMPETENCY.']" id="result'.$assesment->ID_UNIT_COMPETENCY.'" style="width:50px;" class="form-control" >
														<span id="view_result_'.$assesment->ID_UNIT_COMPETENCY.'">
														0%
														</span>
													</td>
													<td>
														<center>
														<textarea name="keterangan[1]['.$assesment->ID_UNIT_COMPETENCY.']" cols="30" rows="2" class="form-control"></textarea>
														</center>
													</td>
													<td>
													<center>';
														echo '
													</center>
													</td>
												</tr>';
											}
											$no++;
										}
										echo '
									</tbody>
								</table>
							</div><!-- end .col-md-12 -->
						</div><!-- end .row -->
						<br>
						<div class="row">
							<div class="col-md-12">
								<div class="pull-right">
								<button type="submit" class="btn btn-primary">Simpan</button>
								<a href="'.base_url().'performance/performance_competency" class="btn btn-info" role="button">Cancel</a>
								</div>
							</div><!-- end col-md-12 -->
						</div><!-- end.row -->
					</form>
				<hr>
				';
				break;
			case 'simpan':
				$periode 		= $this->input->post('periode');
				$tahun 			= $this->input->post('tahun');
				$employee 		= $this->input->post('employee');
				$job 			= $this->input->post('job');
				

				$keterangan 	= $this->input->post('keterangan');//array
				$result 		= $this->input->post('result');//array
				$assesment 		= $this->input->post('competency');//array

				$total_competency = 0;


				foreach ($assesment as $key => $standard) {
					if ($key == '1') {
						foreach ($standard as $id_unit => $value) {
							$id_assesment = $this->m_security->gen_id('assessement_competency','ID_ASSESSMENT_COMPETENCY');
							$data = array(
									'ID_ASSESSMENT_COMPETENCY' => $id_assesment,
									'ID_PERIODE' => $periode,
									'NAME_YEAR' => $tahun,
									'ID_EMPLOYEE' => $employee,
									'ID_JOBTITLE' => $job,
									'ID_UNIT_COMPETENCY' => $id_unit,
									'CRITERIA_K' => $value[1],
									'CRITERIA_S' => $value[2],
									'CRITERIA_A' => $value[3],
									'RESULT_ASSESSMENT' => $result[1][$id_unit],
									'KETERANGAN_ASSESSMENT' => $keterangan[1][$id_unit]
								);
							$this->tbl_assessement->add($data);
						}
					}else{
						foreach ($standard as $id_assesment => $value) {
							$where = array('ID_ASSESSMENT_COMPETENCY' => $id_assesment);
							$data = array(
									'CRITERIA_K' => $value[1],
									'CRITERIA_S' => $value[2],
									'CRITERIA_A' => $value[3],
									'RESULT_ASSESSMENT' => $result[2][$id_assesment],
									'KETERANGAN_ASSESSMENT' => $keterangan[2][$id_assesment]
								);
							$this->tbl_assessement->update($data,$where);
						}
					}

					$jumlah_std = count($this->tbl_standard_competency->join_full(array('standard_unit_competency.ID_JOBTITLE' => $job )));
					$cond_j = array(
							'ID_PERIODE' => $periode,
							'ID_EMPLOYEE' => $employee,
							'ID_JOBTITLE' => $job
						);
					$jumlah_result = $this->tbl_assessement->total_result($cond_j);
					$total_competency = $jumlah_result / $jumlah_std;
				}

					$cond_PA_detail = array(
							'performance_appraisal_detail.ID_EMPLOYEE' 	=> $employee,
							'performance_appraisal_detail.NAME_YEAR' 	=> $tahun,
							'performance_appraisal_detail.ID_PERIODE' 	=> $periode
						);
					$detail_PA = $this->tbl_performance_appraisal_detail->join_full($cond_PA_detail);

					if (count($detail_PA) > 0) {
						$id_PA_detail = $detail_PA[0]->ID_PA_DETAIL;
						$where 	= array('ID_PA_DETAIL' 		=> $detail_PA[0]->ID_PA_DETAIL);
						$data 	= array('TOTAL_COMPETENCY' 	=> $total_competency );
						$this->tbl_performance_appraisal_detail->update($data,$where);
					}else{
						$id = $this->m_security->gen_id('performance_appraisal_detail','ID_PA_DETAIL');
						$id_PA_detail = $id;
						$data = array(
								'ID_PA_DETAIL' 		=> $id,
								'ID_EMPLOYEE' 		=> $employee,
								'NAME_YEAR' 		=> $tahun,
								'ID_PERIODE' 		=> $periode,
								'TOTAL_KPI' 		=> 0,
								'TOTAL_COMPETENCY' 	=> $total_competency,
								'TOTAL_ZAP' 		=> 0,
								'TOTAL_DICIPLINARY' => 0
							);
						$this->tbl_performance_appraisal_detail->add($data);
					}

					$detail_PA = $this->tbl_performance_appraisal_detail->get_id($id_PA_detail)[0];
					$kpi_score 			= ($detail_PA->TOTAL_KPI * 20)/100; 
					$competency_score 	= ($detail_PA->TOTAL_COMPETENCY * 60)/100; 
					$zap_score 			= ($detail_PA->TOTAL_ZAP * 20)/100; 
					$disciplinary_score = $detail_PA->TOTAL_DICIPLINARY;

					$TOTAL_SCORE 		= ($kpi_score + $competency_score + $zap_score)-$disciplinary_score;
					$TOTAL_SCORE 		= round($TOTAL_SCORE,2);

					$cond_PA = array(
							'performance_appraisal.ID_EMPLOYEE' => $employee,
							'performance_appraisal.NAME_YEAR' 	=> $tahun,
							'performance_appraisal.ID_PERIODE' 	=> $periode,
							'performance_appraisal.ID_PA_DETAIL'=> $id_PA_detail
						);
					$PA = $this->tbl_performance_appraisal->join_full($cond_PA);

					if (count($PA) > 0)
					{
						//update
						$where 	= array('ID_PERFORMANCE_APPRAISAL' 		=> $PA[0]->ID_PERFORMANCE_APPRAISAL);
						$data 	= array('PERFORMANCE_APPRAISAL_SCORE' 		=> $TOTAL_SCORE );
						$this->tbl_performance_appraisal->update($data,$where);
					}else{
						//simpan
						$id = $this->m_security->gen_id('performance_appraisal','ID_PERFORMANCE_APPRAISAL');
						$data = array(
								'ID_PERFORMANCE_APPRAISAL' 		=> $id,
								'ID_EMPLOYEE' 		=> $id_employee,
								'NAME_YEAR' 		=> $tahun,
								'ID_PERIODE' 		=> $periode,
								'ID_PA_DETAIL' 		=> $id_PA_detail,
								'PERFORMANCE_APPRAISAL_SCORE' 	=> $TOTAL_SCORE
							);
						$this->tbl_performance_appraisal->add($data);
					}

				$this->session->set_flashdata('pesan','Data berhasil di simpan.');
				redirect('performance/performance_competency');
				break;
			default:
				redirect('performance/performance_competency');
				break;
		}
	}

	public function performance_zap()
	{
		$this->m_security->check();
		$level = $_SESSION['level'];

		if ($level == '1')
		{
			$data['departments'] 	= $this->tbl_department->dept_active();
		}else{
			$id_department = $this->user->get_id($_SESSION['id_user'])[0]->ID_DEPARTMENT;
			$data['departments'] 	= $this->tbl_department->get_id($id_department);
		}
		$data['years'] 			= $this->tbl_year->get_all();
		$this->load->view('performance/performance_zap',$data);
	}

	public function performance_zap_act($act)
	{
		switch ($act) {
			case 'set_employee':
				$id_department 	= $this->input->post('department');
				$employees 		= $this->tbl_employee->join_dept_personal(array('employee.ID_DEPARTMENT'=> $id_department));
				echo '
				<select class="form-control" name="employee_search" id="employee_search" required>
					<option value=""> -- Pilih Karyawan --</option>';
					foreach ($employees as $employee) {
						echo '<option value="'.$employee->ID_EMPLOYEE.'">'.$employee->NAME.'</option>';
					}
					echo '
				</select>
				';
				break;
			case 'set_box_zap':
				$id_department 	= $this->input->post('department');
				$id_employee 	= $this->input->post('karyawan');
				$tahun 			= $this->input->post('tahun');

				$department = $this->tbl_department->get_id($id_department);
				$cond = array(
						'zap.ID_EMPLOYEE' 	=> $id_employee,
						'zap.ID_DEPARTMENT' => $id_department,
						'zap.NAME_YEAR' 	=> $tahun
					);
				$zap = $this->tbl_zap->join_full($cond);
				if (count($zap) > 0) {
					echo '
					<h4><center>--- INPUT PENILAIAN ZAP ---</center></h4>
					<hr>							
						<form action="'.base_url().'performance/performance_zap_act/simpan" method="post">
							<div class="row">
								<div class="col-md-12">
										<input type="hidden" name="tahun" value="'.$tahun.'">
										<input type="hidden" name="employee" value="'.$id_employee.'">
										<input type="hidden" name="department" value="'.$id_department.'">
										<input type="hidden" name="zap" value="'.$zap[0]->ID_ZAP.'">
										<table  class="display" cellspacing="0" width="100%">
										<thead bgcolor="#696969">
											<tr>
												<th style ="color :white; text-align:center;" width="25%">Departement</th>
												<th style ="color :white; text-align:center;" width="15%">Q1</th>
												<th style ="color :white; text-align:center;" width="15%">Q2</th>
												<th style ="color :white; text-align:center;" width="15%">Q3</th>
												<th style ="color :white; text-align:center;" width="15%">Q4</th>
												<th style ="color :white; text-align:center;" width="10%"></th>
											</tr>
										</thead>
										<tbody>';
											echo '	
											<tr>
												<td>'.$department[0]->DEPARTMENT_NAME.'</td>
												<td><center><input type="text" name="Q1" style="width:100px;" class="form-control input-data" value="'.$zap[0]->Q1.'" disabled="true"></center></td>
												<td><center><input type="text" name="Q2" style="width:100px;" class="form-control input-data" value="'.$zap[0]->Q2.'" disabled="true"></center></td>
												<td><center><input type="text" name="Q3" style="width:100px;" class="form-control input-data" value="'.$zap[0]->Q3.'" disabled="true"></center></td>
												<td><center><input type="text" name="Q4" style="width:100px;" class="form-control input-data" value="'.$zap[0]->Q4.'" disabled="true"></center></td>
												<td>
												<center>
													<button type="button" class="btn btn-success" onclick="active_input_data()"><i class="fa fa-pencil"></i></button>
												</center>
												</td>
											</tr>';
											echo '
										</tbody>
									</table>
								</div><!-- end .col-md-12 -->
							</div><!-- end .row -->
							<br>
							<div class="row">
								<div class="col-md-12">
									<div class="pull-right">
									<button type="submit" class="btn btn-primary input-data" disabled="true">Simpan</button>
									<a href="'.base_url().'performance/performance_zap" class="btn btn-info" role="button">Cancel</a>
									</div>
								</div><!-- end col-md-12 -->
							</div><!-- end.row -->
						</form>
					<hr>
					';
				}else{
					echo '
					<h4><center>--- INPUT PENILAIAN ZAP ---</center></h4>
					<hr>							
						<form action="'.base_url().'performance/performance_zap_act/simpan" method="post">
							<div class="row">
								<div class="col-md-12">
										<input type="hidden" name="tahun" value="'.$tahun.'">
										<input type="hidden" name="employee" value="'.$id_employee.'">
										<input type="hidden" name="department" value="'.$id_department.'">
										<table  class="display" cellspacing="0" width="100%">
										<thead bgcolor="#696969">
											<tr>
												<th style ="color :white; text-align:center;" width="25%">Departement</th>
												<th style ="color :white; text-align:center;" width="15%">Q1</th>
												<th style ="color :white; text-align:center;" width="15%">Q2</th>
												<th style ="color :white; text-align:center;" width="15%">Q3</th>
												<th style ="color :white; text-align:center;" width="15%">Q4</th>
												<th style ="color :white; text-align:center;" width="10%"></th>
											</tr>
										</thead>
										<tbody>';
											echo '	
											<tr>
												<td>'.$department[0]->DEPARTMENT_NAME.'</td>
												<td><center><input type="text" name="Q1" style="width:100px;" class="form-control" value="0"></center></td>
												<td><center><input type="text" name="Q2" style="width:100px;" class="form-control" value="0"></center></td>
												<td><center><input type="text" name="Q3" style="width:100px;" class="form-control" value="0"></center></td>
												<td><center><input type="text" name="Q4" style="width:100px;" class="form-control" value="0"></center></td>
												<td></td>
											</tr>';
											echo '
										</tbody>
									</table>
								</div><!-- end .col-md-12 -->
							</div><!-- end .row -->
							<br>
							<div class="row">
								<div class="col-md-12">
									<div class="pull-right">
									<button type="submit" class="btn btn-primary" >Simpan</button>
									<a href="'.base_url().'performance/performance_zap" class="btn btn-info" role="button">Cancel</a>
									</div>
								</div><!-- end col-md-12 -->
							</div><!-- end.row -->
						</form>
					<hr>
					';
				}
				break;
			case 'simpan':
				$tahun 			= $this->input->post('tahun');
				$employee 		= $this->input->post('employee');
				$department 	= $this->input->post('department');
				
				$Q1 = $this->input->post('Q1');				
				$Q2 = $this->input->post('Q2');				
				$Q3 = $this->input->post('Q3');				
				$Q4 = $this->input->post('Q4');				

				$cond = array(
						'zap.ID_EMPLOYEE' 	=> $employee,
						'zap.ID_DEPARTMENT' => $department,
						'zap.NAME_YEAR' 	=> $tahun
					);
				$zap = $this->tbl_zap->join_full($cond);
				if (count($zap) > 0) {
					$id_zap = $this->input->post('zap');
					$where 	= array('ID_ZAP'		=> $id_zap);
					$data 	= array(
							'Q1'			=> $Q1,
							'Q2'			=> $Q2,
							'Q3'			=> $Q3,
							'Q4'			=> $Q4
						);
					$this->tbl_zap->update($data,$where);
				}else{
					$id = $this->m_security->gen_id('zap','ID_ZAP');
					$data = array(
							'ID_ZAP'		=> $id,
							'ID_EMPLOYEE'	=> $employee,
							'ID_DEPARTMENT'	=> $department,
							'NAME_YEAR'		=> $tahun,
							'Q1'			=> $Q1,
							'Q2'			=> $Q2,
							'Q3'			=> $Q3,
							'Q4'			=> $Q4
						);
					$this->tbl_zap->add($data);
				}

				$cond_PA_detail_1 = array(
						'performance_appraisal_detail.ID_EMPLOYEE' 	=> $employee,
						'performance_appraisal_detail.NAME_YEAR' 	=> $tahun,
						'performance_appraisal_detail.ID_PERIODE' 	=> '1'
					);
				$detail_PA_1 = $this->tbl_performance_appraisal_detail->join_full($cond_PA_detail_1);

				if (count($detail_PA_1) > 0) {
					$id_PA_detail_1 = $detail_PA_1[0]->ID_PA_DETAIL;
					$where_p 	= array('performance_appraisal_detail.ID_PA_DETAIL' 	=> $detail_PA_1[0]->ID_PA_DETAIL);
					$data_p 	= array('performance_appraisal_detail.TOTAL_ZAP' 	=> $Q2 );
					$this->tbl_performance_appraisal_detail->update($data_p,$where_p);
				}else{
					$id = $this->m_security->gen_id('performance_appraisal_detail','ID_PA_DETAIL');
					$id_PA_detail_1 = $id;
					$data = array(
							'ID_PA_DETAIL' 		=> $id,
							'ID_EMPLOYEE' 		=> $employee,
							'NAME_YEAR' 		=> $tahun,
							'ID_PERIODE' 		=> '1',
							'TOTAL_KPI' 		=> 0,
							'TOTAL_COMPETENCY' 	=> 0,
							'TOTAL_ZAP' 		=> $Q2,
							'TOTAL_DICIPLINARY' => 0
						);
					$this->tbl_performance_appraisal_detail->add($data);
				}

				$detail_PA_1 		= $this->tbl_performance_appraisal_detail->get_id($id_PA_detail_1)[0];
				$kpi_score 			= ($detail_PA_1->TOTAL_KPI * 20)/100; 
				$competency_score 	= ($detail_PA_1->TOTAL_COMPETENCY * 60)/100; 
				$zap_score 			= ($detail_PA_1->TOTAL_ZAP * 20)/100; 
				$disciplinary_score = $detail_PA_1->TOTAL_DICIPLINARY;

				$TOTAL_SCORE 		= ($kpi_score + $competency_score + $zap_score)-$disciplinary_score;
				$TOTAL_SCORE 		= round($TOTAL_SCORE,2);

				$cond_PA_1 = array(
						'performance_appraisal.ID_EMPLOYEE' => $employee,
						'performance_appraisal.NAME_YEAR' 	=> $tahun,
						'performance_appraisal.ID_PERIODE' 	=> 1,
						'performance_appraisal.ID_PA_DETAIL'=> $id_PA_detail_1
					);
				$PA_1 = $this->tbl_performance_appraisal->join_full($cond_PA_1);

				if (count($PA_1) > 0)
				{
					$where 	= array('ID_PERFORMANCE_APPRAISAL' 		=> $PA_1[0]->ID_PERFORMANCE_APPRAISAL);
					$data 	= array('PERFORMANCE_APPRAISAL_SCORE' 		=> $TOTAL_SCORE );
					$this->tbl_performance_appraisal->update($data,$where);
				}else{
					$id = $this->m_security->gen_id('performance_appraisal','ID_PERFORMANCE_APPRAISAL');
					$data = array(
							'ID_PERFORMANCE_APPRAISAL' 		=> $id,
							'ID_EMPLOYEE' 		=> $employee,
							'NAME_YEAR' 		=> $tahun,
							'ID_PERIODE' 		=> 1,
							'ID_PA_DETAIL' 		=> $id_PA_detail_1,
							'PERFORMANCE_APPRAISAL_SCORE' 	=> $TOTAL_SCORE
						);
					$this->tbl_performance_appraisal->add($data);
				}

				$cond_PA_detail_2 = array(
						'performance_appraisal_detail.ID_EMPLOYEE' 	=> $employee,
						'performance_appraisal_detail.NAME_YEAR' 	=> $tahun,
						'performance_appraisal_detail.ID_PERIODE' 	=> '2'
					);
				$detail_PA_2 = $this->tbl_performance_appraisal_detail->join_full($cond_PA_detail_2);

				$id_PA_detail_2 = '';

				if (count($detail_PA_2) > 0) {
					echo "id pa detail ".$detail_PA_2[0]->ID_PA_DETAIL;
					$id_PA_detail_2 = $detail_PA_2[0]->ID_PA_DETAIL;
					$where 	= array('ID_PA_DETAIL' 		=> $detail_PA_2[0]->ID_PA_DETAIL);
					$data 	= array('TOTAL_ZAP' 	=> $Q4 );
					$this->tbl_performance_appraisal_detail->update($data,$where);
				}else{
					$id = $this->m_security->gen_id('performance_appraisal_detail','ID_PA_DETAIL');
					$id_PA_detail_2 = $id;
					$data = array(
							'ID_PA_DETAIL' 		=> $id,
							'ID_EMPLOYEE' 		=> $employee,
							'NAME_YEAR' 		=> $tahun,
							'ID_PERIODE' 		=> '2',
							'TOTAL_KPI' 		=> 0,
							'TOTAL_COMPETENCY' 	=> 0,
							'TOTAL_ZAP' 		=> $Q4,
							'TOTAL_DICIPLINARY' => 0
						);
					$this->tbl_performance_appraisal_detail->add($data);
				}

				$detail_PA_2 		= $this->tbl_performance_appraisal_detail->get_id($id_PA_detail_2)[0];
				$kpi_score 			= ($detail_PA_2->TOTAL_KPI * 20)/100; 
				$competency_score 	= ($detail_PA_2->TOTAL_COMPETENCY * 60)/100; 
				$zap_score 			= ($detail_PA_2->TOTAL_ZAP * 20)/100; 
				$disciplinary_score = $detail_PA_2->TOTAL_DICIPLINARY;

				$TOTAL_SCORE 		= ($kpi_score + $competency_score + $zap_score)-$disciplinary_score;
				$TOTAL_SCORE 		= round($TOTAL_SCORE,2);

				$cond_PA_2 = array(
						'performance_appraisal.ID_EMPLOYEE' => $employee,
						'performance_appraisal.NAME_YEAR' 	=> $tahun,
						'performance_appraisal.ID_PERIODE' 	=> 2,
						'performance_appraisal.ID_PA_DETAIL'=> $id_PA_detail_2
					);
				$PA_2 = $this->tbl_performance_appraisal->join_full($cond_PA_2);

				if (count($PA_2) > 0)
				{
					$where 	= array('ID_PERFORMANCE_APPRAISAL' 		=> $PA_2[0]->ID_PERFORMANCE_APPRAISAL);
					$data 	= array('PERFORMANCE_APPRAISAL_SCORE' 		=> $TOTAL_SCORE );
					$this->tbl_performance_appraisal->update($data,$where);
				}else{
					$id = $this->m_security->gen_id('performance_appraisal','ID_PERFORMANCE_APPRAISAL');
					$data = array(
							'ID_PERFORMANCE_APPRAISAL' 		=> $id,
							'ID_EMPLOYEE' 		=> $employee,
							'NAME_YEAR' 		=> $tahun,
							'ID_PERIODE' 		=> 2,
							'ID_PA_DETAIL' 		=> $id_PA_detail_2,
							'PERFORMANCE_APPRAISAL_SCORE' 	=> $TOTAL_SCORE
						);
					$this->tbl_performance_appraisal->add($data);
				}

				$this->session->set_flashdata('pesan','Data berhasil di simpan.');
				redirect('performance/performance_zap');
				break;
			default:
				redirect('performance/performance_zap');
				break;
		}
	}

	public function performance_disciplinary()
	{
		$this->m_security->check();
		$level = $_SESSION['level'];

		if ($level == '1')
		{
			$data['departments'] 	= $this->tbl_department->dept_active();
		}else{
			$id_department = $this->user->get_id($_SESSION['id_user'])[0]->ID_DEPARTMENT;
			$data['departments'] 	= $this->tbl_department->get_id($id_department);
		}
		$data['years'] 			= $this->tbl_year->get_all();
		$this->load->view('performance/performance_disciplinary',$data);
	}

	public function performance_disciplinary_act($act)
	{
		switch ($act) {
			case 'set_job':
				$id_department 	= $this->input->post('department');
				$jobs 			= $this->tbl_jobtitle->join_segment_departement(array('departement.STATUS_DEPARTMENT'=>0,'segment.ID_DEPARTMENT'=>$id_department));

				echo '
				<select class="form-control" name="job_search" id="job_search" onchange="set_employee()" required>
					<option value=""> -- Pilih Job --</option>';
					foreach ($jobs as $job) {
						echo '<option value="'.$job->ID_JOBTITLE.'">'.$job->TITLE.'</option>';
					}
					echo '
				</select>
				';
				break;
			case 'set_employee':
				$id_jobtitle 	= $this->input->post('job');
				$employees 		= $this->tbl_employee->join_dept_personal(array('employee.ID_JOBTITLE'=> $id_jobtitle));
				echo '
				<select class="form-control" name="employee_search" id="employee_search" required>
					<option value=""> -- Pilih Karyawan --</option>';
					foreach ($employees as $employee) {
						echo '<option value="'.$employee->ID_EMPLOYEE.'">'.$employee->NAME.'</option>';
					}
					echo '
				</select>
				';
				break;
			case 'set_box_disciplinary':
				$id_department 	= $this->input->post('department');
				$id_jobtitle 	= $this->input->post('job');
				$id_employee 	= $this->input->post('karyawan');
				$tahun 			= $this->input->post('tahun');

				$kriteria 		= $this->tbl_disciplinary->get_all();
				echo '
				<ul class="nav nav-tabs" role="tablist">
					<li role="presentation" class="active"><a href="#input" aria-controls="input" role="tab" data-toggle="tab">Input Bulanan</a></li>
					<li role="presentation" ><a href="#monitoring" aria-controls="monitoring" role="tab" data-toggle="tab">Monitoring</a></li>
				</ul>

				<div class="tab-content">
					<div role="tabpanel" class="tab-pane active" id="input">
						<div class="form-panel">
							<form action="'.base_url().'performance/performance_disciplinary_act/simpan" method="post">
								<input type="hidden" name="tahun" value="'.$tahun.'">
								<input type="hidden" name="employee" value="'.$id_employee.'">
								<div class="row">
									<div class="col-md-12">
										<div class="row form-group">
											<label for="bulan" class="col-md-1">Bulan</label>
											<div class="col-md-4" id="box_bulan">
												<select class="form-control" name="bulan" id="bulan" onchange="set_box_disciplinary()">
													<option value=""> -- Pilih Bulan --</option>';
													$now = date("Y");
													if ($tahun == $now)
													{
														$bulan = date("m");
														for ($i=1; $i <= $bulan ; $i++)
														{ 
															echo '<option value="'.date("m",strtotime($tahun.'-'.$i.'-1')).'">'.date("M",strtotime($tahun.'-'.$i.'-1')).'</option>';
														}
													}else
													if ($tahun < $now)
													{
														for ($i=1; $i <= 12 ; $i++)
														{ 
															echo '<option value="'.date("m",strtotime($tahun.'-'.$i.'-1')).'">'.date("M",strtotime($tahun.'-'.$i.'-1')).'</option>';
														}
													}
													echo '
												</select>
											</div>
										</div>
 									</div><!-- end .col-md-12 -->
								</div><!-- end .row -->
								<br>
								<div class="row">
									<div class="col-md-12">
										<table  class="display" cellspacing="0" width="100%">
											<thead bgcolor="#696969">
												<tr>
													<th style ="color :white; text-align:center;" width="5%">No.</th>
													<th style ="color :white; text-align:center;" width="60%">Disciplinary</th>
													<th style ="color :white; text-align:center;" width="10%">Demerit Point</th>
													<th style ="color :white; text-align:center;" width="10%">Nilai</th>
													<th style ="color :white; text-align:center;" width="10%"></th>
												</tr>
											</thead>
											<tbody id="box_disciplinary">
												<tr>
													<td></td>
													<td></td>
													<td></td>
													<td></td>
													<td></td>
												</tr>
											</tbody>
										</table>
									</div><!-- end .col-md-12 -->
								</div><!-- end .row -->
								<br>
								<div class="row">
									<div class="col-md-12">
										<div class="pull-right">
										<button type="submit" class="btn btn-primary">Simpan</button>
										<a href="'.base_url().'performance/performance_disciplinary" class="btn btn-info" role="button">Cancel</a>
										</div>
									</div><!-- end col-md-12 -->
								</div><!-- end.row -->
							</form>
						</div><!-- end #form-panel -->
					</div><!-- end #input -->

					<div role="tabpanel" class="tab-pane" id="monitoring">
						<br>
						<table  id="monitoring_table" class="display" cellspacing="0" width="100%">
							<thead>
								<tr  bgcolor="#696969">
									<th rowspan ="2" style ="color :white"><center>No.</center></th>
									<th rowspan = "2" style ="color :white"><center>Disciplinary</center></th>
									<th rowspan = "2" style ="color :white"><center>Demerit Point</center></th>
									<th colspan="12" style ="color :white"><center>Actual</center></th>
								</tr>
								<tr bgcolor=#696969>
									<th style ="color :white"><center>Jan</center></th>
									<th style ="color :white"><center>Feb</center></th>
									<th style ="color :white"><center>Mar</center></th>
									<th style ="color :white"><center>Apr</center></th>
									<th style ="color :white"><center>Mei</center></th>
									<th style ="color :white"><center>Jun</center></th>
									<th style ="color :white"><center>Jul</center></th>
									<th style ="color :white"><center>Aug</center></th>
									<th style ="color :white"><center>Sep</center></th>
									<th style ="color :white"><center>Oct</center></th>
									<th style ="color :white"><center>Nov</center></th>
									<th style ="color :white"><center>Des</center></th>
								</tr>
							</thead>
							<tbody>';
								$no = 1;
								foreach ($kriteria as $kriteria) {
									echo '
									<tr>
										<td style="text-align:center;">'.$no++.'</td>
										<td>'.$kriteria->DISCIPLINARY_CASES.'</td>
										<td style="text-align:center;">'.$kriteria->DEMERIT_POINT.'</td>';

										for ($i=1; $i <=12 ; $i++) { 
											$cond_m = array(
													'disciplinary_monitoring.ID_EMPLOYEE' => $id_employee,
													'disciplinary_monitoring.NAME_YEAR' => $tahun,
													'disciplinary_monitoring.ID_DISCIPLINARY' => $kriteria->ID_DISCIPLINARY,
													'disciplinary_monitoring.BULAN_DISCIPLINARY' => $i
												);
											$cek_monitoring = $this->tbl_disciplinary_monitoring->join_full($cond_m);
											if (count($cek_monitoring) > 0)
											{
												echo '<td style="text-align:center;">'.$cek_monitoring[0]->POINT_DISCIPLINARY.'</td>';
											}else{
												echo '<td></td>';
											}
										}
									echo '
									</tr>';
								}
								echo '
									<tr>
										<td colspan="3">Demerit Point per Month</td>';
										
										for ($i=1; $i <= 12 ; $i++) { 
											$cond_cek = array(
													'disciplinary_monitoring.ID_EMPLOYEE' => $id_employee,
													'disciplinary_monitoring.NAME_YEAR' => $tahun,
													'disciplinary_monitoring.BULAN_DISCIPLINARY' => $i
												);
											$monitoring = $this->tbl_disciplinary_monitoring->join_full($cond_cek);
											if (count($monitoring) > 0) {
												$actual_per_month = 0;
												foreach ($monitoring as $monitoring) {
													$actual_kriteria = $monitoring->DEMERIT_POINT * $monitoring->POINT_DISCIPLINARY;
													$actual_per_month = $actual_per_month + $actual_kriteria;
												}
												echo '<td style="text-align:center;"><b>'.$actual_per_month.'</b></td>';
											}else{
												echo '<td></td>';
											}
										}
										echo '
									</tr>
									<tr>
										<td colspan="3">Demerit Point per Periode</td>';
										for ($i=1; $i <= 2 ; $i++) { 
											$cond_eva = array(
													'disciplinary_evaluation.ID_EMPLOYEE' => $id_employee,
													'disciplinary_evaluation.NAME_YEAR' => $tahun,
													'disciplinary_evaluation.ID_PERIODE' => $i
												);
											$cek_evaluation = $this->tbl_disciplinary_evaluation->join_full($cond_eva);
											if (count($cek_evaluation) > 0) {
												echo '<td colspan="6" style="text-align:center;"><b>'.$cek_evaluation[0]->RESULT_POINT_DISCIPLINARY.'</b></td>';
											}else{
												echo '<td colspan="6"></td>';
												
											}
										}
										echo '
									</tr>
								';
								echo '
							</tbody>
						</table>
					</div><!-- end #monitoring -->								
				</div><!-- end.tab-content -->
				';

				break;
			case 'set_kriteria':
				$id_department 	= $this->input->post('department');
				$id_jobtitle 	= $this->input->post('job');
				$id_employee 	= $this->input->post('karyawan');
				$tahun 			= $this->input->post('tahun');
				$bulan 			= $this->input->post('bulan');

				$kriteria 		= $this->tbl_disciplinary->get_all();

				$no = 1;
				foreach ($kriteria as $kriteria) {
					$cond_m = array(
							'disciplinary_monitoring.ID_EMPLOYEE' => $id_employee,
							'disciplinary_monitoring.NAME_YEAR' => $tahun,
							'disciplinary_monitoring.ID_DISCIPLINARY' => $kriteria->ID_DISCIPLINARY,
							'disciplinary_monitoring.BULAN_DISCIPLINARY' => $bulan
						);
					$monitoring = $this->tbl_disciplinary_monitoring->join_full($cond_m);
					if (count($monitoring) > 0) {
						echo '
						<tr>
							<td style="text-align:center;">'.$no.'</td>
							<td >'.$kriteria->DISCIPLINARY_CASES.'</td>
							<td style="text-align:center;">'.$kriteria->DEMERIT_POINT.' %</td>
							<td><center><input type="text" name="actual[2]['.$monitoring[0]->ID_DISCIPLINARY_MONITORING.']" style="width:100px;" class="form-control" id="input-data'.$monitoring[0]->ID_DISCIPLINARY_MONITORING.'" value="'.$monitoring[0]->POINT_DISCIPLINARY.'" disabled="true"></center></td>
							<td>
							<center>
								<button type="button" class="btn btn-success" onclick="active_input_data('.$monitoring[0]->ID_DISCIPLINARY_MONITORING.')"><i class="fa fa-pencil"></i></button>
							</center>
							</td>
						</tr>
						';	
					}else{
						echo '
						<tr>
							<td style="text-align:center;">'.$no.'</td>
							<td >'.$kriteria->DISCIPLINARY_CASES.'</td>
							<td style="text-align:center;">'.$kriteria->DEMERIT_POINT.' %</td>
							<td><center><input type="text" name="actual[1]['.$kriteria->ID_DISCIPLINARY.']" style="width:100px;" class="form-control" value="0"></center></td>
							<td></td>
						</tr>
						';
					}
					$no++;
				}
				break;
			case 'simpan':
				$tahun 			= $this->input->post('tahun');
				$employee 		= $this->input->post('employee');
				$bulan 			= $this->input->post('bulan');
				$actuals 		= $this->input->post('actual');//array

				foreach ($actuals as $key => $actual) {
					if ($key == '1')
					{
						foreach ($actual as $id_disciplinary => $point) {
							$id = $this->m_security->gen_id('disciplinary_monitoring','ID_DISCIPLINARY_MONITORING');
							$data = array(
									'ID_DISCIPLINARY_MONITORING' 	=> $id,
									'ID_EMPLOYEE' 					=> $employee,
									'NAME_YEAR' 					=> $tahun,
									'ID_DISCIPLINARY' 				=> $id_disciplinary,
									'BULAN_DISCIPLINARY' 			=> $bulan,
									'POINT_DISCIPLINARY' 			=> $point
								);
							$this->tbl_disciplinary_monitoring->add($data);
						}
					}else
					if ($key == '2')
					{
						foreach ($actual as $id_disciplinary_monitoring => $point) {
							$where 	= array('ID_DISCIPLINARY_MONITORING' => $id_disciplinary_monitoring);
							$data 	= array(
									'POINT_DISCIPLINARY' 			=> $point
								);
							$this->tbl_disciplinary_monitoring->update($data,$where);
						}
					}
				}

				$periode = 1;
				if ($bulan >= 7 && $bulan <= 12) {
					$periode = 2;
				}

				$actual_per_periode = 0;

				$get_bulans = $this->tbl_disciplinary_monitoring->get_bulan($employee,$tahun,$periode);
				foreach ($get_bulans as $bulan) {
					$cond_cek = array(
							'disciplinary_monitoring.ID_EMPLOYEE' => $employee,
							'disciplinary_monitoring.NAME_YEAR' => $tahun,
							'disciplinary_monitoring.BULAN_DISCIPLINARY' => $bulan->BULAN
						);
					$actual_per_month = 0 ;
					$monitoring = $this->tbl_disciplinary_monitoring->join_full($cond_cek);
					if (count($monitoring) > 0) {
						foreach ($monitoring as $monitoring) {
							$per_kriteria = $monitoring->DEMERIT_POINT * $monitoring->POINT_DISCIPLINARY;
							$actual_per_month = $actual_per_month + $per_kriteria;
						}
					}
						$actual_per_periode = $actual_per_periode + $actual_per_month;

				}
				$cond_ev = array(
						'disciplinary_evaluation.ID_PERIODE' 	=> $periode,
						'disciplinary_evaluation.ID_EMPLOYEE' 	=> $employee,
						'disciplinary_evaluation.NAME_YEAR' 	=> $tahun
					);
				$cek_evaluation = $this->tbl_disciplinary_evaluation->join_full($cond_ev);
				if (count($cek_evaluation) > 0)
				{
					$where = array('ID_DISCIPLINARY_EVALUATION' => $cek_evaluation[0]->ID_DISCIPLINARY_EVALUATION);
					$data_e = array(
							'RESULT_POINT_DISCIPLINARY' => $actual_per_periode
						);
					$this->tbl_disciplinary_evaluation->update($data_e,$where);
				}else{
					$id = $this->m_security->gen_id('disciplinary_evaluation','ID_DISCIPLINARY_EVALUATION');
					$data_e = array(
							'ID_DISCIPLINARY_EVALUATION' 	=> $id,
							'ID_PERIODE' 					=> $periode,
							'ID_EMPLOYEE' 					=> $employee,
							'NAME_YEAR' 					=> $tahun,
							'RESULT_POINT_DISCIPLINARY' 	=> $actual_per_periode
						);
					$this->tbl_disciplinary_evaluation->add($data_e);
				}
				$id_PA_detail = '';
				$cond_PA_detail = array(
						'performance_appraisal_detail.ID_EMPLOYEE' 	=> $employee,
						'performance_appraisal_detail.NAME_YEAR' 	=> $tahun,
						'performance_appraisal_detail.ID_PERIODE' 	=> $periode
					);
				$detail_PA = $this->tbl_performance_appraisal_detail->join_full($cond_PA_detail);

				if (count($detail_PA) > 0) {
					$id_PA_detail = $detail_PA[0]->ID_PA_DETAIL;
					$where 	= array('ID_PA_DETAIL' 			=> $detail_PA[0]->ID_PA_DETAIL);
					$data 	= array('TOTAL_DICIPLINARY' 	=> $actual_per_periode );
					$this->tbl_performance_appraisal_detail->update($data,$where);
				}else{
					$id = $this->m_security->gen_id('performance_appraisal_detail','ID_PA_DETAIL');
					$id_PA_detail = $id;
					$data = array(
							'ID_PA_DETAIL' 		=> $id,
							'ID_EMPLOYEE' 		=> $employee,
							'NAME_YEAR' 		=> $tahun,
							'ID_PERIODE' 		=> $periode,
							'TOTAL_KPI' 		=> 0,
							'TOTAL_COMPETENCY' 	=> 0,
							'TOTAL_ZAP' 		=> 0,
							'TOTAL_DICIPLINARY' => $actual_per_periode
						);
					$this->tbl_performance_appraisal_detail->add($data);
				}


					$detail_PA = $this->tbl_performance_appraisal_detail->get_id($id_PA_detail)[0];
					$kpi_score 			= ($detail_PA->TOTAL_KPI * 20)/100; 
					$competency_score 	= ($detail_PA->TOTAL_COMPETENCY * 60)/100; 
					$zap_score 			= ($detail_PA->TOTAL_ZAP * 20)/100; 
					$disciplinary_score = $detail_PA->TOTAL_DICIPLINARY;

					$TOTAL_SCORE 		= ($kpi_score + $competency_score + $zap_score)-$disciplinary_score;
					$TOTAL_SCORE 		= round($TOTAL_SCORE,2);

					$cond_PA = array(
							'performance_appraisal.ID_EMPLOYEE' => $employee,
							'performance_appraisal.NAME_YEAR' 	=> $tahun,
							'performance_appraisal.ID_PERIODE' 	=> $periode,
							'performance_appraisal.ID_PA_DETAIL'=> $id_PA_detail
						);
					$PA = $this->tbl_performance_appraisal->join_full($cond_PA);

					if (count($PA) > 0)
					{
						//update
						$where 	= array('ID_PERFORMANCE_APPRAISAL' 		=> $PA[0]->ID_PERFORMANCE_APPRAISAL);
						$data 	= array('PERFORMANCE_APPRAISAL_SCORE' 		=> $TOTAL_SCORE );
						$this->tbl_performance_appraisal->update($data,$where);
					}else{
						//simpan
						$id = $this->m_security->gen_id('performance_appraisal','ID_PERFORMANCE_APPRAISAL');
						$data = array(
								'ID_PERFORMANCE_APPRAISAL' 		=> $id,
								'ID_EMPLOYEE' 		=> $id_employee,
								'NAME_YEAR' 		=> $tahun,
								'ID_PERIODE' 		=> $periode,
								'ID_PA_DETAIL' 		=> $id_PA_detail,
								'PERFORMANCE_APPRAISAL_SCORE' 	=> $TOTAL_SCORE
							);
						$this->tbl_performance_appraisal->add($data);
					}

				redirect('performance/performance_disciplinary');
				break;
			default:
				redirect('performance/performance_disciplinary');
				break;
		}
	}

	public function performance_appraisal()
	{
		$this->m_security->check();
		$level = $_SESSION['level'];

		if ($level == '1')
		{
			$data['departments'] 	= $this->tbl_department->dept_active();
		}else{
			$id_department = $this->user->get_id($_SESSION['id_user'])[0]->ID_DEPARTMENT;
			$data['departments'] 	= $this->tbl_department->get_id($id_department);
		}
		$data['periode'] 		= $this->tbl_periode->get_all();
		$data['years'] 			= $this->tbl_year->get_all();
		$this->load->view('performance/performance_appraisal',$data);
	}

	public function performance_appraisal_act($act)
	{
		switch ($act) {
			case 'set_employee':
				$id_department 	= $this->input->post('department');
				$employees 		= $this->tbl_employee->join_dept_personal(array('employee.ID_DEPARTMENT'=> $id_department));
				echo '
				<select class="form-control" name="employee_search" id="employee_search" required>
					<option value=""> -- Pilih Karyawan --</option>';
					foreach ($employees as $employee) {
						echo '<option value="'.$employee->ID_EMPLOYEE.'">'.$employee->NAME.'</option>';
					}
					echo '
				</select>
				';
				break;
			case 'set_box_appraisal':
				$department 	= $this->input->post('department');
				$employee 		= $this->input->post('karyawan');
				$periode 		= $this->input->post('periode');
				$tahun 			= $this->input->post('tahun');

				$cond_d 	= array(
						'performance_appraisal_detail.ID_EMPLOYEE' => $employee,
						'performance_appraisal_detail.NAME_YEAR' => $tahun,
						'performance_appraisal_detail.ID_PERIODE' => $periode
					);
				$PA_detail 	= $this->tbl_performance_appraisal_detail->join_full($cond_d);

				if (count($PA_detail) > 0)
				{
					$score_kpi 				= round($PA_detail[0]->TOTAL_KPI,2);
					$score_competency 		= round($PA_detail[0]->TOTAL_COMPETENCY,2);
					$score_zap 				= round($PA_detail[0]->TOTAL_ZAP,2);
					$score_disciplinary 	= round($PA_detail[0]->TOTAL_DICIPLINARY,2);
					
					$total_score_kpi 			= round((($score_kpi*20)/100),2);
					$total_score_competency 	= round((($score_competency*60)/100),2);
					$total_score_zap 			= round((($score_zap*20)/100),2);
					$total_score_disciplinary 	= round($score_disciplinary,2);


				}else{
					$score_kpi 				= 0;
					$score_competency 		= 0;
					$score_zap 				= 0;
					$score_disciplinary 	= 0;

					$total_score_kpi 			= 0;
					$total_score_competency 	= 0;
					$total_score_zap 			= 0;
					$total_score_disciplinary 	= 0;
				}


				$cond_t 	= array(
						'performance_appraisal_detail.ID_EMPLOYEE' => $employee,
						'performance_appraisal_detail.NAME_YEAR' => $tahun,
						'performance_appraisal_detail.ID_PERIODE' => $periode
					);

				$total_PA = $this->tbl_performance_appraisal->join_full($cond_t);

				if (count($total_PA) > 0)
				{
					$total_score = $total_PA[0]->PERFORMANCE_APPRAISAL_SCORE;
					$id_PA = $total_PA[0]->ID_PERFORMANCE_APPRAISAL;
				}else{
					$total_score = 0;
					$id_PA = '';
				}

				if ($total_score >= 90) {
					$grade = "A";
				}else
				if ($total_score >= 80) {
					$grade = "B";
				}else
				if ($total_score >= 70) {
					$grade = "C";
				}else
				if ($total_score >= 60) {
					$grade = "D";
				}else{
					$grade = "E";
				}


				echo '
					<h4><center>--- Data Performance Appraisal ---</center></h4>
					<hr>							
						<div class="row">
							<div class="col-md-12">
								<table class="table table-bordered">
									<thead bgcolor="#696969">
										<tr>
											<th style ="color :white; text-align:center;" width="5%">No.</th>
											<th style ="color :white; text-align:center;" width="40%">Criteria</th>
											<th style ="color :white; text-align:center;" width="15%">Score</th>
											<th style ="color :white; text-align:center;" width="15%">Weight</th>
											<th style ="color :white; text-align:center;" width="15%">Total Score</th>
										</tr>
									</thead>
									<tbody>';
										echo '	
										<tr>
											<td style="text-align:center">1</td>
											<td>KPI Department</td>
											<td style="text-align:center">'.$score_kpi.'</td>
											<td style="text-align:center">20%</td>
											<td style="text-align:center">'.$total_score_kpi.'</td>
										</tr>';
										echo '	
										<tr>
											<td style="text-align:center">2</td>
											<td>Competency</td>
											<td style="text-align:center">'.$score_competency.'</td>
											<td style="text-align:center">60%</td>
											<td style="text-align:center">'.$total_score_competency.'</td>
										</tr>';
										echo '	
										<tr>
											<td style="text-align:center">3</td>
											<td>ZAP</td>
											<td style="text-align:center">'.$score_zap.'</td>
											<td style="text-align:center">20%</td>
											<td style="text-align:center">'.$total_score_zap.'</td>
										</tr>';
										echo '	
										<tr>
											<td style="text-align:center">4</td>
											<td>Disciplinary</td>
											<td style="text-align:center">'.$score_disciplinary.'</td>
											<td style="text-align:center"></td>
											<td style="text-align:center">'.$total_score_disciplinary.'</td>
										</tr>';
										echo '	
										<tr>
											<td colspan="4" style="text-align:right">Total Score </td>
											<td style="text-align:center"><b>'.$total_score.'</b></td>
										</tr>';
										echo '	
										<tr>
											<td colspan="4" style="text-align:right">Nilai </td>
											<td style="text-align:center"><b>'.$grade.'</b></td>
										</tr>';
										echo '
									</tbody>
								</table>
								<div class="row">
									<div class="col-md-12">
										<div class="pull-right">
										<p><a href="'.base_url().'laporan/print_PA/'.$id_PA.'"><i class="glyphicon glyphicon-save"></i> Cetak PDF</a></p>
										</div>
									</div>
								</div>
							</div><!-- end .col-md-12 -->
						</div><!-- end .row -->
					<hr>
					';

				break;
			default:
				redirect('performance/performance_appraisal');
				break;
		}
	}
}