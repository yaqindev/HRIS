<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Appraisal extends CI_Controller
{
	public function index()
	{
		redirect('appraisal/kpi');
	}

	public function kpi()
	{
		$data['kpi'] 			= $this->tbl_kpi->join_department(array('kpi.ID_DEPARTMENT'=>'2'));
		$data['departments'] 	= $this->tbl_department->dept_active();
		$this->load->view('appraisal/kpi',$data);
	}

	public function kpi_act($act,$id='')
	{
		switch ($act) {
			case 'pilih_department':
				$id_department = $this->input->post('department');
				$data = $this->tbl_kpi->join_department(array('kpi.ID_DEPARTMENT'=>$id_department));

				echo'
					<table  id="example" class="display" cellspacing="0" width="100%">
						<thead>
							<tr  bgcolor="#696969">
								<td style ="color :white" width="10">No.</td>
								<td style ="color :white" width="10">Department</td>
								<td style ="color :white" width="30">Strategic Objective</td>
								<td style ="color :white" width="30">KPI</td>
								<td style ="color :white" width="10">UOM</td>
								<td style ="color :white" width="10">Target</td>
								<td style ="color :white" width="10">Weight</td>
								<td style ="color :white" width="10">Type</td>
								<td style ="color :white" width="10"></td>
							</tr>
						</thead>
				
						<tbody>';
							$no = 1;
							foreach($data as $kpi)
							{
							
								echo"<tr id='row_".$kpi->ID_KPI."'>";
								echo "<td style='text-align:center'>".$no++."</td>";
								echo "<td>".ucfirst(strtolower($kpi->DEPARTMENT_NAME))."</td>";
								echo "<td><a href='".base_url()."appraisal/kpi_act/edit/".$kpi->ID_KPI."'>".ucfirst(strtolower($kpi->TARGET_DESCRIPTION))."</a></td>";
								echo "<td>".ucfirst(strtolower($kpi->KPI))."</td>";
								echo "<td style='text-align:center'>".$kpi->UOM."</td>";
								echo "<td style='text-align:center'>".$kpi->TARGET."</td>";
								echo "<td style='text-align:center'>".$kpi->WEIGHT."</td>";
								echo "<td style='text-align:center'>".$kpi->TYPE."</td>";
								echo "<td style='text-align:center'>
									<button type='button' class='btn btn-xs btn-danger' onclick='hapus(".$kpi->ID_KPI.")'><i class='fa fa-times'></i> Delete</button>
								</td>";
								echo"</tr>";
										
							}
						echo '							
						</tbody>
					</table>
				</div>
				';
				break;
			case 'cek_bobot':
				$id_department 	= $this->input->post('department');
				$data 			= $this->tbl_kpi->get_sum_weight($id_department);
				$sisa_bobot 	= 100 - $data[0]->jumlah_total;

				if ($sisa_bobot > 0) {
					echo " * Weight harus diantara 1 - ".$sisa_bobot;
				}else{
					echo " <span style='color:red;'>* Weight sudah batas maksimum , anda tidak dapat menambahkan data baru .</span>";
				}
				break;
			case 'tambah':
				$data['departments'] = $this->tbl_department->dept_active();
				$this->load->view('appraisal/kpi_add',$data);
				break;
			case 'simpan':
				$id 					= $this->m_security->gen_id('kpi','ID_KPI');
				$target_description 	= $_POST['target_description'];
				$kpi 					= $_POST['kpi'];
				$uom 					= $_POST['uom'];
				$target 				= $_POST['target'];
				$type 					= $_POST['type'];
				$weight 				= $_POST['weight'];
				$id_department 			= $_POST['department_id'];
				$data_insert 			= array (
						'ID_KPI' 				=> $id,
						'TARGET_DESCRIPTION' 	=> $target_description,
						'KPI' 					=> $kpi,
						'UOM' 					=> $uom,
						'TARGET'				=> $target,
						'TYPE' 					=> $type,
						'WEIGHT' 				=> $weight,
						'ID_DEPARTMENT' 		=> $id_department
				);

				$data 		= $this->tbl_kpi->get_sum_weight($id_department);
				$sisa_bobot = $data[0]->jumlah_total + $weight;

				if ($sisa_bobot > 100) {
					$this->session->set_flashdata('pesan','Jumlah bobot tidak boleh lebih dari 100%.');
					redirect('appraisal/kpi_act/tambah');
				}else{
					$this->tbl_kpi->insert($data_insert);
					redirect('appraisal/kpi');
				}
				break;
			case 'edit':
				$kpi 	= $this->tbl_kpi->get_id($id);
				$data 	= array(
					"id_kpi" 				=> $kpi[0]->ID_KPI,
					"target_description" 	=> $kpi[0]->TARGET_DESCRIPTION,
					"kpi" 					=> $kpi[0]->KPI,
					"uom" 					=> $kpi[0]->UOM,
					"target" 				=> $kpi[0]->TARGET,
					"type" 					=> $kpi[0]->TYPE,
					"weight" 				=> $kpi[0]->WEIGHT,
					'id_department' 		=> $kpi[0]->ID_DEPARTMENT,
					'departments'			=> $this->tbl_department->get_all()
				);
				$this->load->view('appraisal/kpi_edit',$data);
				break;
			case 'update':
				$id_kpi 			= $_POST['id_kpi'];
				$target_description = $_POST['target_description'];
				$kpi 				= $_POST['kpi'];
				$uom 				= $_POST['uom'];
				$target 			= $_POST['target'];
				$type 				= $_POST['type'];
				$weight 			= $_POST['weight'];
				$department 		= $_POST['department'];
				$data_update 		= array (
					'TARGET_DESCRIPTION'	=> $target_description,
					'KPI' 					=> $kpi,
					'UOM' 					=> $uom,
					'TARGET' 				=> $target,
					'TYPE' 					=> $type,
					'WEIGHT' 				=> $weight,
					'TYPE' 					=> $type,
					'ID_DEPARTMENT' 		=> $department
				);
				$where 	= array('ID_KPI'=> $id_kpi);
				$res 	= $this->tbl_kpi->Update('kpi',$data_update,$where);
				if($res>=1)
				{
					redirect('appraisal/kpi');
				}else{
					echo "error sistem , please contact administrator";
				}
				break;			
			case 'hapus':
				$id_kpi = $this->input->post('id');
				$query = $this->tbl_kpi->remove($id_kpi);
				break;
			default:
				redirect('appraisal/kpi');
				break;
		}
	}

	public function competency()
	{
		$data['departments'] 	= $this->tbl_department->dept_active();	
		$data['kra'] 			= $this->tbl_kra->get_all();
		$data['unit_umum'] 		= $this->tbl_unit_competency->join_kra(array('kra.JENIS_COMPETENCY'=>'1'));
		$data['unit_khusus'] 	= $this->tbl_unit_competency->join_kra(array('kra.JENIS_COMPETENCY'=>'2'));
		$data['unt'] 			= $this->tbl_unit_competency->join_full();

		$this->load->view('appraisal/competency',$data);
	}

	public function competency_act($act)
	{
		switch ($act)
		{
			case 'kra_simpan':
				$id_kra 	= $this->m_security->gen_id('kra','ID_KRA');
				$kra_name 	= $this->input->post('nama_kra');
				$jenis 		= $this->input->post('jenis_kra');
				$data = array(
						'ID_KRA'			=> $id_kra,
						'NAMA_KRA'			=> $kra_name,
						'JENIS_COMPETENCY'	=> $jenis
					);
				$query = $this->tbl_kra->insert($data);

				if ($query > 0) 
				{
					$this->session->set_flashdata('notif','success');
				}else{
					$this->session->set_flashdata('notif','danger');
				}
				redirect('appraisal/competency');

				break;
			case 'kra_update':
				$id_kra 	= $this->input->post('kra_id');
				$kra_name 	= $this->input->post('nama_kra');
				$jenis 		= $this->input->post('jenis_kra');
				$data = array(
						'NAMA_KRA'			=> $kra_name,
						'JENIS_COMPETENCY'	=> $jenis
					);
				$where = array('ID_KRA' => $id_kra);
				$query = $this->tbl_kra->update('kra',$data,$where);

				if ($query > 0) 
				{
					$this->session->set_flashdata('notif','success');
				}else{
					$this->session->set_flashdata('notif','danger');
				}
				redirect('appraisal/competency');
				break;
			case 'kra_hapus' :
				$id 	= $this->input->post('id');
				$this->tbl_kra->delete($id);
				break;
			case 'unit_simpan':
				$id 		= $this->m_security->gen_id('unit_competency','ID_UNIT_COMPETENCY');
				$code 	 	= $this->input->post('code_unit');
				$nama 		= $this->input->post('nama_unit');
				$id_kra 	= $this->input->post('kra_unit');
				$data = array(
						'ID_UNIT_COMPETENCY'	=> $id,
						'ID_KRA'				=> $id_kra,
						'NAMA_UNIT_COMPETENCY'	=> $nama,
						'CODE_UNIT_COMPETENCY'	=> $code
					);
				$query = $this->tbl_unit_competency->insert($data);

				if ($query > 0) 
				{
					$this->session->set_flashdata('notif','success');
				}else{
					$this->session->set_flashdata('notif','danger');
				}
				redirect('appraisal/competency');

				break;
			case 'unit_update':
				$id 		= $this->input->post('unit_id');
				$code 	 	= $this->input->post('code_unit');
				$nama 		= $this->input->post('nama_unit');
				$id_kra 	= $this->input->post('kra_unit');
				$data = array(
						'ID_KRA'				=> $id_kra,
						'NAMA_UNIT_COMPETENCY'	=> $nama,
						'CODE_UNIT_COMPETENCY'	=> $code
					);
				$where = array('ID_UNIT_COMPETENCY' => $id);
				$query = $this->tbl_kra->update('unit_competency',$data,$where);

				if ($query > 0) 
				{
					$this->session->set_flashdata('notif','success');
				}else{
					$this->session->set_flashdata('notif','danger');
				}
				redirect('appraisal/competency');
				break;
			case 'unit_hapus' :
				$id 	= $this->input->post('id');
				$this->tbl_unit_competency->delete($id);
				break;
			case 'std_simpan' :
				$std 			= $this->input->post('input_standard');
				$id_joblist 	= $this->input->post('id_joblist');

				if($std and $id_joblist)
				{
					foreach ($std as $jenis => $standard)
					{
						if ($jenis == '2')
						{
							foreach ($standard as $id => $value)
							{
								$where = array('ID_JOBTITLE' => $id_joblist,'ID_UNIT_COMPETENCY' => $id);
								$data 	= array(
										'NILAI_STANDART' 		=> $value
									);
								$this->tbl_standard_competency->update('standard_unit_competency',$data,$where);
							}
						}else{
							foreach ($standard as $id => $value)
							{
								$data 	= array(
										'ID_JOBTITLE' 			=> $id_joblist,
										'ID_UNIT_COMPETENCY' 	=> $id,
										'NILAI_STANDART' 		=> $value
									);
								$this->tbl_standard_competency->insert($data);
							}
						}
					}
					$this->session->set_flashdata('notif','success');
					redirect('appraisal/competency');
				}else{
					$this->session->set_flashdata('notif','danger');
					redirect('appraisal/competency');
				}
				break;
			case 'set_segment':
				$id_department			= $this->input->post('department');
				$segments				= $this->tbl_segment->get_by_department($id_department);

				echo '
				<select class="form-control" name="segment_search" id="segment_search" onchange="set_job_search()">
					<option value=""> -- Pilih Segment --</option>';
					foreach ($segments as $segment) {
						echo '<option value="'.$segment->ID_SEGMENT.'">'.$segment->SEGMENT_NAME.'</option>';
					}
					echo '
				</select>
				';
				break;
			case 'set_job':
				$id_department	= $this->input->post('department');
				$id_segment		= $this->input->post('segment');
				$joblists		= $this->tbl_jobtitle->join_segment(array('job_title.ID_SEGMENT'=>$id_segment));
				echo '
					<select class="form-control" name="job_search" id="job_search" onchange="set_input_standard()" required>
						<option value=""> -- Pilih Job --</option>';
						foreach ($joblists as $joblist) {
						echo '<option value="'.$joblist->ID_JOBTITLE.'">'.$joblist->TITLE.'</option>';
						}
						echo'
					</select>
				';
				break;
			case 'set_input_standard':
				$id_joblist 	= $this->input->post('job');
				$unt 			= $this->tbl_unit_competency->join_full();

				echo '
				<table style = "width:100%">
				<thead bgcolor= #696969>
					<tr>
						<td style ="color :white; text-align:center;" width="5%"><center>No.</td>
						<td style ="color :white; text-align:center;" width="10%"><center>jenis kompetensi</td>
						<td style ="color :white; text-align:center;" width="25%"><center>Key Result Area</td>
						<td style ="color :white; text-align:center;" width="10%"><center>Code</td>
						<td style ="color :white; text-align:center;" width="30%"><center>Unit Competency</td>
						<td style ="color :white; text-align:center;" width="10%"><center>Standard</td>
						<td style ="color :white; text-align:center;" width="10%"><center>action</td>
					</tr>
				</thead>
				<tbody>';

					$jns = '0';
					$kra = '0';
					$no  = 1;
					foreach ($unt as $unt):
					$id_unit = $unt->ID_UNIT_COMPETENCY;
					$cek 	= $this->tbl_standard_competency->get_id(array('ID_JOBTITLE'=>$id_joblist, 'ID_UNIT_COMPETENCY'=>$id_unit));
					if (count($cek))//tipe input atau update
					{
						$nilai_std = $cek[0]->NILAI_STANDART;
					echo '<tr>';
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
										<input type="number" class="form-control" name="input_standard[2]['.$unt->ID_UNIT_COMPETENCY.']" id="input_standard'.$unt->ID_UNIT_COMPETENCY.'" disabled="true" min="1" max="5" value="'.$nilai_std.'">
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
										<input type="number" class="form-control" name="input_standard[2]['.$unt->ID_UNIT_COMPETENCY.']" id="input_standard'.$unt->ID_UNIT_COMPETENCY.'" disabled="true" min="1" max="5" value="'.$nilai_std.'">
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
										<input type="number" class="form-control" name="input_standard[2]['.$unt->ID_UNIT_COMPETENCY.']" id="input_standard'.$unt->ID_UNIT_COMPETENCY.'" disabled="true" min="1" max="5" value="'.$nilai_std.'">
									</td>
									<td style="text-align:center;" id="box_btn_'.$unt->ID_UNIT_COMPETENCY.'">
										<button class="btn btn-primary" onclick="active_input('.$unt->ID_UNIT_COMPETENCY.')"><i class="fa fa-pencil"></i></button>
									</td>';
								}
							}
						}
						$no++;
					echo '</tr>';
					}else{
					echo '<tr>';
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
					echo '</tr>';
					}
					endforeach;

							echo'
						</tbody>
					</table>
					<input type="hidden" name="id_joblist" id="id_joblist" value="'.$id_joblist.'">
					<br>
					<div class="row">
						<div class="col-md-12">
							<div class="pull-right">
								<button type="submit" class="btn btn-primary" id="btn_save_unit">Save</button>
								<button type="reset" class="btn btn-default">Cancel</button>
							</div>
						</div>
					</div>';	




				break;
			default:
				redirect('appraisal/competency');
				break;
		}
	}
	
}