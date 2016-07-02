<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	function index()
    {
		$tahun = date("Y");
		$periode  = 1;
		if (date("m") > 6)
		{
			$periode  = 2;
		}

		$data['dept'] = '';
		$data['kriteria']=array(
				'KPI'=>'',
				'COMP'=>'',
				'ZAP'=>'',
				'DISC'=>''
			);

		if (isset($_SESSION['level'])) {
			$level = $_SESSION['level'];
		}else{
			$this->session->sess_destroy();
			redirect('login');
		}


		if ($level == '1')
		{
			$cond 	= array(
					'performance_appraisal_detail.ID_PERIODE' => $periode,
					'performance_appraisal_detail.NAME_YEAR' => $tahun,
				);
			$dept = $this->tbl_performance_appraisal_detail->avg_dept_all($cond);
			foreach ($dept as $dept)
			{
				$data['dept'] = $data['dept']."'".$dept->DEPARTMENT_NAME."',";
				$data['kriteria']['KPI'] 	= $data['kriteria']['KPI'].round($dept->KPI,2).",";
				$data['kriteria']['COMP'] 	= $data['kriteria']['COMP'].round($dept->COMPETENCY,2).",";
				$data['kriteria']['ZAP'] 	= $data['kriteria']['ZAP'].round($dept->ZAP,2).",";
				$data['kriteria']['DISC'] 	= $data['kriteria']['DISC'].round($dept->DISCIPLINARY,2).",";
			}
			$data['department'] = '';
			$data['periode'] 	= $periode == '1'?'Mid Year':'Year End';
			$data['tahun'] 		= $tahun ;
			$this->load->view('dashboard/dashboard',$data);			
		}else{
			$id_user 			= $_SESSION['id_user'];
			$department 		= $this->user->join_full(array('user.ID_USER'=>$id_user))[0];
			$id_department 		= $department->ID_DEPARTMENT;
			$nama_department 	= $this->tbl_department->get_id($id_department)[0]->DEPARTMENT_NAME;

			$cond 	= array(
					'performance_appraisal_detail.ID_PERIODE' 	=> $periode,
					'performance_appraisal_detail.NAME_YEAR' 	=> $tahun,
					'employee.ID_DEPARTMENT' 					=> $id_department,
				);

			$dept = $this->tbl_performance_appraisal_detail->avg_seg_all($cond);
			foreach ($dept as $dept)
			{
				$data['dept'] 				= $data['dept']."'".$dept->SEGMENT_NAME."',";
				$data['kriteria']['KPI'] 	= $data['kriteria']['KPI'].round($dept->KPI,2).",";
				$data['kriteria']['COMP'] 	= $data['kriteria']['COMP'].round($dept->COMPETENCY,2).",";
				$data['kriteria']['ZAP'] 	= $data['kriteria']['ZAP'].round($dept->ZAP,2).",";
				$data['kriteria']['DISC'] 	= $data['kriteria']['DISC'].round($dept->DISCIPLINARY,2).",";
			}
			$data['department'] = $nama_department;
			$data['periode'] 	= $periode == '1'?'Mid Year':'Year End';
			$data['tahun'] 		= $tahun ;
			$this->load->view('dashboard/dashboard',$data);
		}

    }
}