<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan extends CI_Controller {
	
	function __construct()
	{
		parent::__construct();
		$this->load->library('pdf');
	}

	public function report()
	{
		$data['periode'] 		= $this->tbl_periode->get_all();
		$data['years'] 			= $this->tbl_year->get_all();

		$this->load->view('laporan/report',$data);
	}

	public function report_act($act)
	{
		switch ($act) {
			case 'set_box':
				$periode 	= $this->input->post('periode');
				$tahun 		= $this->input->post('tahun');
				$kriteria 	= $this->input->post('kriteria');

				switch ($kriteria) {
					case '1':
						$dept 	= 'performance_appraisal_detail.TOTAL_KPI';
						break;
					case '2':
						$dept 	= 'performance_appraisal_detail.TOTAL_COMPETENCY';
						break;
					case '3':
						$dept 	= 'performance_appraisal_detail.TOTAL_ZAP';
						break;
					case '4':
						$dept 	= 'performance_appraisal_detail.TOTAL_DICIPLINARY';
						break;
				}
				
				if (isset($_SESSION['level'])) {
					$level = $_SESSION['level'];
				}else{
					$this->session->sess_destroy();
					redirect('login');
				}

				if ($level== '1'||$level== '3')
				{
					$alias 	= 'DEPT';
					$cond 	= array(
							'performance_appraisal_detail.ID_PERIODE' => $periode,
							'performance_appraisal_detail.NAME_YEAR' => $tahun,
						);
					
					$dept 			= $this->tbl_performance_appraisal_detail->avg_dept($cond,$dept,$alias);

					echo '
					<h4><center>--- Performance Department ---</center></h4>
					<hr>							
						<div class="row">
							<div class="col-md-12">
								<table class="table table-bordered">
									<thead bgcolor="#696969">
										<tr>
											<th style ="color :white; text-align:center;" width="5%">No.</th>
											<th style ="color :white; text-align:center;" width="60%">Department</th>
											<th style ="color :white; text-align:center;" width="15%">Nilai</th>
										</tr>
									</thead>
									<tbody>';
										$no = 1;
										foreach ($dept as $dept) {
										echo '
										<tr>
											<td style="text-align:center">'.$no++.'</td>
											<td>'.$dept->DEPARTMENT_NAME.'</td>
											<td style="text-align:center">'.round($dept->DEPT,2).'</td>
										</tr>
										';
										}
										echo '
									</tbody>
								</table>
								<div class="row">
									<div class="col-md-12">
										<div class="pull-right">
										<p><a href="'.base_url().'laporan/print_DEPT/'.$periode.'/'.$tahun.'/'.$kriteria.'"><i class="glyphicon glyphicon-save"></i> Cetak PDF</a></p>
										</div>
									</div>
								</div>
							</div><!-- end .col-md-12 -->
						</div><!-- end .row -->
					<hr>
					';
				}else if ($level== '2')
				{
					$id_user 			= $_SESSION['id_user'];
					$department 		= $this->user->join_full(array('user.ID_USER'=>$id_user))[0];
					$id_department 		= $department->ID_DEPARTMENT;
					$nama_department 	= $this->tbl_department->get_id($id_department)[0]->DEPARTMENT_NAME;

					$alias 	= 'DEPT';
					$cond 	= array(
							'performance_appraisal_detail.ID_PERIODE' 	=> $periode,
							'performance_appraisal_detail.NAME_YEAR' 	=> $tahun,
							'employee.ID_DEPARTMENT' 					=> $id_department,
						);
					
					$dept 			= $this->tbl_performance_appraisal_detail->avg_seg($cond,$dept,$alias);
					
					echo '
					<h4><center>--- Performance Department '.$nama_department.'---</center></h4>
					<hr>							
						<div class="row">
							<div class="col-md-12">
								<table class="table table-bordered">
									<thead bgcolor="#696969">
										<tr>
											<th style ="color :white; text-align:center;" width="5%">No.</th>
											<th style ="color :white; text-align:center;" width="60%">Department</th>
											<th style ="color :white; text-align:center;" width="15%">Nilai</th>
										</tr>
									</thead>
									<tbody>';
										$no = 1;
										foreach ($dept as $dept) {
										echo '
										<tr>
											<td style="text-align:center">'.$no++.'</td>
											<td>'.$dept->SEGMENT_NAME.'</td>
											<td style="text-align:center">'.round($dept->DEPT,2).'</td>
										</tr>
										';
										}
										echo '
									</tbody>
								</table>
								<div class="row">
									<div class="col-md-12">
										<div class="pull-right">
										<p><a href="'.base_url().'laporan/print_DEPT/'.$periode.'/'.$tahun.'/'.$kriteria.'"><i class="glyphicon glyphicon-save"></i> Cetak PDF</a></p>
										</div>
									</div>
								</div>
							</div><!-- end .col-md-12 -->
						</div><!-- end .row -->
					<hr>
					';
				}else{
					$this->session->sess_destroy();
					redirect('login');	
				}
				break;
			case 'set_grafik':
				$periode 	= $this->input->post('periode_search');
				$tahun 		= $this->input->post('tahun_search');
				$kriteria 	= $this->input->post('kriteria');

				switch ($kriteria) {
					case '1':
						$dept 	= 'performance_appraisal_detail.TOTAL_KPI';
						$nama_kriteria = 'KPI Department';
						break;
					case '2':
						$dept 	= 'performance_appraisal_detail.TOTAL_COMPETENCY';
						$nama_kriteria = 'Competency';
						break;
					case '3':
						$dept 	= 'performance_appraisal_detail.TOTAL_ZAP';
						$nama_kriteria = 'ZAP';
						break;
					case '4':
						$dept 	= 'performance_appraisal_detail.TOTAL_DICIPLINARY';
						$nama_kriteria = 'Disciplinary';
						break;
					default:
						$dept 	= 'performance_appraisal_detail.TOTAL_KPI';
						$nama_kriteria = 'KPI Department';
						break;
				}

				$alias 	= 'DEPT';
				if (isset($_SESSION['level'])) {
					$level = $_SESSION['level'];
				}else{
					$this->session->sess_destroy();
					redirect('login');
				}

				if ($level== '1'||$level== '3')
				{
					$cond 	= array(
							'performance_appraisal_detail.ID_PERIODE' => $periode,
							'performance_appraisal_detail.NAME_YEAR' => $tahun,
						);
					
					$data['dept'] = $this->tbl_performance_appraisal_detail->avg_dept($cond,$dept,$alias);
					$data['kriteria'] = $nama_kriteria;

				}else if($level== '2')
				{
					$id_user 			= $_SESSION['id_user'];
					$department 		= $this->user->join_full(array('user.ID_USER'=>$id_user))[0];
					$id_department 		= $department->ID_DEPARTMENT;
					$nama_department 	= $this->tbl_department->get_id($id_department)[0]->DEPARTMENT_NAME;

					$cond 	= array(
							'performance_appraisal_detail.ID_PERIODE' 	=> $periode,
							'performance_appraisal_detail.NAME_YEAR' 	=> $tahun,
							'employee.ID_DEPARTMENT' 					=> $id_department,
						);
					
					$data['dept'] = $this->tbl_performance_appraisal_detail->avg_seg($cond,$dept,$alias);
					$data['kriteria'] = $nama_kriteria;					
				}

				$this->load->view('laporan/grafik',$data);

				break;
			default:
				redirect('laporan/report');
				break;
		}
	}

	public function print_PA($id)
	{
		$cond = array(
				'performance_appraisal.ID_PERFORMANCE_APPRAISAL' => $id
			);
		$PA = $this->tbl_performance_appraisal->join_full($cond);

		$data =array();
		$nama_karyawan = '';
		if (count($PA) > 0)
		{
			$emp 							= $this->tbl_employee->join_full(array('employee.ID_EMPLOYEE'=>$PA[0]->ID_EMPLOYEE))[0];	
			$data['nama_karyawan']			= $emp->NAME;
			$data['nik']					= $emp->NIK;
			$data['department'] 			= $emp->DEPARTMENT_NAME;
			$id_segment 					= $this->tbl_jobtitle->join_segment(array('ID_JOBTITLE' => $emp->ID_JOBTITLE))[0]->ID_SEGMENT;
			$data['segment'] 				= $this->tbl_segment->get_id($id_segment)[0]->SEGMENT_NAME;
			$data['job'] 					= $emp->TITLE;
			$data['periode'] 				= $PA[0]->NAMA_PERIODE;
			$data['tahun'] 					= $PA[0]->NAME_YEAR;

			$data['score_kpi'] 				= round($PA[0]->TOTAL_KPI,2);
			$data['score_competency'] 		= round($PA[0]->TOTAL_COMPETENCY,2);
			$data['score_zap'] 				= round($PA[0]->TOTAL_ZAP,2);
			$data['score_disciplinary'] 	= round($PA[0]->TOTAL_DICIPLINARY,2);

			$data['total_score_kpi'] 			= round((($data['score_kpi']*20)/100),2);
			$data['total_score_competency'] 	= round((($data['score_competency']*60)/100),2);
			$data['total_score_zap'] 			= round((($data['score_zap']*20)/100),2);
			$data['total_score_disciplinary'] 	= round($data['score_disciplinary'],2);

			$data['total_score'] 				= round($PA[0]->PERFORMANCE_APPRAISAL_SCORE,2);


				if ($data['total_score'] >= 90) {
					$data['grade']  = "A";
				}else
				if ($data['total_score'] >= 80) {
					$data['grade']  = "B";
				}else
				if ($data['total_score'] >= 70) {
					$data['grade']  = "C";
				}else
				if ($data['total_score'] >= 60) {
					$data['grade']  = "D";
				}else{
					$data['grade']  = "E";
				}
		}else{
			$data['nama_karyawan']			= '';
			$data['nik']					= '';
			$data['department'] 			= '';
			$data['segment'] 				= '';
			$data['job'] 					= '';
			$data['periode'] 				= '';
			$data['tahun'] 					= '';

			$data['score_kpi'] 				= 0;
			$data['score_competency'] 		= 0;
			$data['score_zap'] 				= 0;
			$data['score_disciplinary'] 	= 0;

			$data['total_score_kpi'] 			= 0;
			$data['total_score_competency'] 	= 0;
			$data['total_score_zap'] 			= 0;
			$data['total_score_disciplinary'] 	= 0;
			$data['total_score'] 				= 0;
			$data['grade'] 						= "E";
		}

		$fileName 			= 'Laporan PA '.$data['nama_karyawan'];
		$this->pdf->load_view('laporan/performance_appraisal',$data);
		$this->pdf->render();
		$this->pdf->stream($fileName);
	}

	public function print_DEPT($periode, $tahun, $kriteria)
	{
		switch ($kriteria) {
			case '1':
				$dept 	= 'performance_appraisal_detail.TOTAL_KPI';
				$nama_kriteria = 'KPI Department';
				break;
			case '2':
				$dept 	= 'performance_appraisal_detail.TOTAL_COMPETENCY';
				$nama_kriteria = 'Competency';
				break;
			case '3':
				$dept 	= 'performance_appraisal_detail.TOTAL_ZAP';
				$nama_kriteria = 'ZAP';
				break;
			case '4':
				$dept 	= 'performance_appraisal_detail.TOTAL_DICIPLINARY';
				$nama_kriteria = 'Disciplinary';
				break;
		}

		if (isset($_SESSION['level'])) {
			$level = $_SESSION['level'];
		}else{
			$this->session->sess_destroy();
			redirect('login');
		}

		if ($level== '1'||$level== '3')
		{
			$alias 	= 'DEPT';
			$cond 	= array(
					'performance_appraisal_detail.ID_PERIODE' => $periode,
					'performance_appraisal_detail.NAME_YEAR' => $tahun,
				);

			$data['department']	= '';
			$data['periode']	= $this->tbl_periode->get_id($periode)[0]->NAMA_PERIODE;
			$data['tahun'] 		= $tahun;
			$data['kriteria'] 	= $nama_kriteria;
			$data['dept'] 		= $this->tbl_performance_appraisal_detail->avg_dept($cond,$dept,$alias);

			$fileName 			= 'Laporan Performance Department By '.$nama_kriteria;
		}else if ($level== '2')
		{
			$id_user 			= $_SESSION['id_user'];
			$department 		= $this->user->join_full(array('user.ID_USER'=>$id_user))[0];
			$id_department 		= $department->ID_DEPARTMENT;
			$nama_department 	= $this->tbl_department->get_id($id_department)[0]->DEPARTMENT_NAME;

			$alias 	= 'DEPT';
			$cond 	= array(
					'performance_appraisal_detail.ID_PERIODE' 	=> $periode,
					'performance_appraisal_detail.NAME_YEAR' 	=> $tahun,
					'employee.ID_DEPARTMENT' 					=> $id_department,
				);
			$data['department']	= $nama_department;
			$data['periode']	= $this->tbl_periode->get_id($periode)[0]->NAMA_PERIODE;
			$data['tahun'] 		= $tahun;
			$data['kriteria'] 	= $nama_kriteria;
			$data['dept'] 		= $this->tbl_performance_appraisal_detail->avg_seg($cond,$dept,$alias);
			$fileName 			= 'Laporan Performance Department '.$nama_department.' By '.$nama_kriteria;
		}



		$this->pdf->load_view('laporan/performance_dept',$data);
		$this->pdf->render();
		$this->pdf->stream($fileName);
	}

	public function test()
	{
		$this->load->view('laporan/testing');
	}

}