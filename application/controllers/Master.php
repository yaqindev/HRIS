<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Master extends CI_Controller {

	public function index()
	{
		redirect('master/employee');
	}

	public function employee()
	{
		$data['employee']	= $this->tbl_employee->join_all_kar();

		$this->load->view('master/employee',$data);
	}

	public function employee_act($act,$id=NULL)
	{
		switch ($act)
		{
			case 'set_segment':
				$id_department = $this->input->post('department');
				$segments = $this->tbl_segment->get_by_department($id_department);

				echo '
				<select name="segment" id="segment" class="form-control" onchange="set_job()" required>
					<option value="">-- Pilih --</option>';
					foreach ($segments as $segment) {
						echo '<option value="'.$segment->ID_SEGMENT.'">'.$segment->SEGMENT_NAME.'</option>';
					}
					echo '
				</select>
				';
				break;
			case 'set_job':
				case 'set_segment':
				$id_segment = $this->input->post('segment');
				$jobs = $this->tbl_jobtitle->join_segment(array('segment.ID_SEGMENT' => $id_segment));

				echo '
				<select name="job" id="job" class="form-control" required>
					<option value="">-- Pilih --</option>';
					foreach ($jobs as $job) {
						echo '<option value="'.$job->ID_JOBTITLE.'">'.$job->TITLE.'</option>';
					}
					echo '
				</select>
				';
				break;
			case 'tambah':
				$data['id_employee']	= $this->m_security->gen_id('employee','ID_EMPLOYEE');
				$data['department']		= $this->tbl_department->dept_active();
				$data['segment']		= $this->tbl_segment->get_all();
				$data['group']			= $this->tbl_group->get_all();
				$data['jobtitle']		= $this->tbl_jobtitle->get_all();

				$this->load->view('master/employee_add',$data);
				break;
			case 'simpan':
				$id_employee 	= $this->m_security->gen_id('employee','ID_EMPLOYEE');
				$id_department 	= $this->input->post('department');
				$id_job 		= $this->input->post('job');
				$join_date 		= $this->input->post('join');
				$e_status 		= $this->input->post('e_status');
				$active 		= 1;
				$salary 		= 0;
				$nik 			= $this->input->post('nik');
				$data_e = array(
						'ID_EMPLOYEE' 		=> $id_employee,
						'ID_DEPARTMENT' 	=> $id_department,
						'ID_JOBTITLE' 		=> $id_job,
						'JOINT_DATE' 		=> $join_date,
						'EMPLOYMENT_STATUS' => $e_status,
						'ACTIVE_STATUS' 	=> $active,
						'BASIC_SALARY' 		=> $salary,
						'NIK' 				=> $nik
					);
				$this->tbl_employee->add($data_e);

				$data_p = array(
						'ID_DETAIL' 		=> $this->m_security->gen_id('employee_personal_detail','ID_DETAIL'),
						'ID_EMPLOYEE' 		=> $id_employee,
						'NAME' 				=> $this->input->post('nama'),
						'LOCATION' 			=> $this->input->post('location'),
						'BIRTHDATE' 		=> $this->input->post('dob'),
						'BIRTHPLACE' 		=> $this->input->post('pob'),
						'GENDER' 			=> $this->input->post('gender'),
						'MARITAL_STATUS' 	=> $this->input->post('marital'),
						'NATIONALITY' 		=> $this->input->post('nationality'),
						'RELIGION' 			=> $this->input->post('religion'),
						'IDC_NUMBER' 		=> $this->input->post('idc')
					);
				$this->tbl_personal_detail->add($data_p);
				// $this->session->set_flashdata('pesan','data berhasil di simpan');
				redirect('master/employee');
				break;
			case 'edit':
				if ($id) 
				{
					$id_detail = $id;
				}else{
					redirect('master/employee');	
				}

				$data['employee'] 		= $this->tbl_personal_detail->join_full(array('ID_DETAIL' => $id_detail))[0];
				$data['department']		= $this->tbl_department->dept_active();
				$data['segment']		= $this->tbl_segment->get_all();
				$data['jobtitle']		= $this->tbl_jobtitle->get_id($data['employee']->ID_JOBTITLE);
				$this->load->view('master/employee_edit',$data);
				break;
			case 'update':
				$id_detail 		= $this->input->post('id_detail');
				$id_employee 	= $this->input->post('id_employee');

				$where_e = array('ID_EMPLOYEE' 		=> $id_employee);
				$data_e = array(
						'ID_DEPARTMENT' 	=> $this->input->post('department'),
						'ID_JOBTITLE' 		=> $this->input->post('job'),
						'JOINT_DATE' 		=> $this->input->post('join'),
						'EMPLOYMENT_STATUS' => $this->input->post('e_status'),
						'NIK' 				=> $this->input->post('nik')
					);
				$this->tbl_employee->update($data_e,$where_e);

				$where_p = array('ID_DETAIL' => $id_detail);
				$data_p = array(
						'ID_EMPLOYEE' 		=> $id_employee,
						'NAME' 				=> $this->input->post('nama'),
						'LOCATION' 			=> $this->input->post('location'),
						'BIRTHDATE' 		=> $this->input->post('dob'),
						'BIRTHPLACE' 		=> $this->input->post('pob'),
						'GENDER' 			=> $this->input->post('gender'),
						'MARITAL_STATUS' 	=> $this->input->post('marital'),
						'NATIONALITY' 		=> $this->input->post('nationality'),
						'RELIGION' 			=> $this->input->post('religion'),
						'IDC_NUMBER' 		=> $this->input->post('idc')
					);
				$this->tbl_personal_detail->update($data_p,$where_p);
				redirect('master/employee');
				break;
			case 'upstat_emp':
				$aDoor = $_POST['checklist'];
				if(!empty($aDoor)) {
					$N = count($aDoor);

					for($i=0; $i < $N; $i++){
						// echo $aDoor[$i];
						$data_updatestat= array (
						'ACTIVE_STATUS'=> '2');
						$where= array('ID_EMPLOYEE'=>$aDoor[$i]);
						$res= $this->tbl_employee->Update($data_updatestat,$where);
					}
				} 
				break;
			case 'hapus':
				$id_employee = $this->input->post('id');
				$this->tbl_employee->Update(array('employee.ACTIVE_STATUS'=>'2'),array('employee.ID_EMPLOYEE'=>$id_employee));
				break;
			default:
				redirect('master/employee');
				break;
		}
	}

	public function user()
	{
		$data['data']	= $this->user->join_full(array());	
		$this->load->view('master/user',$data);
	}


	public function user_act($act,$id='')
	{
		switch ($act) {
			case 'tambah':
				$data['jobs']	= $this->tbl_jobtitle->get_manager();
				$this->load->view('master/user_add',$data);
				break;
			case 'simpan':
				$id 		= $this->m_security->gen_id('user','ID_USER');
				$employee 	= $this->input->post('employee');
				$username 	= $this->input->post('username');
				$email 		= $this->input->post('email');
				$akses 		= $this->input->post('akses');
				$password 	= $this->input->post('password');
				$c_password = $this->input->post('c_password');

				if ($password != $c_password)
				{
					$this->session->set_flashdata('pesan','Maaf password harus sama dengan confirmasi password.');
					redirect('master/user_act/tambah');	
				}

				$data= array (
								'ID_USER'	 	=> $id,
								'ID_EMPLOYEE'	=> $employee,
								'EMAIL_USER'	=> $email,
								'PASSWORD'		=> md5($password),
								'NAMA_USER'		=> $username,
								'HAK_AKSES'		=> $akses
							);
				$res 		= $this->user->add($data);
				if($res>=1)
				{
					redirect('master/user');
				}
				break;
			case 'edit':
				$data['jobs']	= $this->tbl_jobtitle->get_manager();
				$data['user']	= count($this->user->get_id($id))>0?$this->user->get_id($id)[0]:redirect('master/user');
				$this->load->view('master/user_edit',$data);
				break;
			case 'update':
				$id 		= $this->input->post('id_user');
				$employee 	= $this->input->post('employee');
				$username 	= $this->input->post('username');
				$email 		= $this->input->post('email');
				$akses 		= $this->input->post('akses');

				$data= array (
								'ID_EMPLOYEE'	=> $employee,
								'EMAIL_USER'	=> $email,
								'NAMA_USER'		=> $username,
								'HAK_AKSES'		=> $akses
							);
				$where = array('ID_USER'	 	=> $id);
				$res 		= $this->user->update($data,$where);
				if($res>=1)
				{
					redirect('master/user');
				}
				break;
			// case 'upstat_user':
			// 	$aDoor = $_POST['checklist'];
			// 	// echo "<pre>";
			// 	// print_r($aDoor);
			// 	// echo "</pre>";
			// 	if(!empty($aDoor)) {
			// 		$N = count($aDoor);

			// 		for($i=0; $i < $N; $i++){
			// 			$where = array('ID_USER'=>$aDoor[$i]);
			// 			$this->user->remove($where);
			// 		}
			// 	} 
			// 	break;
			case 'set_employee':
				$job = $this->input->post('job');
				$emp = $this->tbl_employee->join_full(array('employee.ID_JOBTITLE'=>$job));
				echo '
				<select name="employee" id="employee" class="form-control" required>
					<option value="">-- Pilih Karyawan --</option>';
					foreach ($emp as $emp) {
						echo '<option value="'.$emp->ID_EMPLOYEE.'">'.$emp->NAME.'</option>';
					}
					echo '
				</select>
				';
				break;
			case 'hapus':
				$id_user = $this->input->post('id');
				$this->user->remove(array('ID_USER'=>$id_user));
				break;
			default:
				redirect('master/user');
				break;
		}
	}


	public function department()
	{
		$data['data']	= $this->tbl_department->GetDept("WHERE STATUS_DEPARTMENT <> 2 or STATUS_DEPARTMENT is NULL");	
		$this->load->view('master/department',$data);
	}

	public function department_act($act,$id='')
	{
		switch ($act) {
			case 'tambah':
				$this->load->view('master/department_add');
				break;
			case 'simpan':
				$id 		= $this->m_security->gen_id('departement','ID_DEPARTMENT');
				$dname 		= $_POST['dname'];
				$dcode 		= $_POST['dcode'];
				$data_insert= array (
								'ID_DEPARTMENT'	 	=> $id,
								'DEPARTMENT_NAME'	=> $dname,
								'CODE_DEPARTMENT'	=> $dcode,
								'STATUS_DEPARTMENT'	=> 0
							);
				$res 		= $this->tbl_department->InsertDept('departement',$data_insert);
				if($res>=1)
				{
					redirect('master/department');
				}
				break;
			case 'edit':
				$dept= $this->tbl_department->GetDept("where ID_DEPARTMENT='$id'");
				$data= array(
				"id_department" => $dept[0]['ID_DEPARTMENT'],
				"department_name" => $dept[0]['DEPARTMENT_NAME'],
				"code_department" => $dept[0]['CODE_DEPARTMENT']
				);
				$this->load->view('master/department_edit',$data);
				break;
			case 'update':
				$id_department= $_POST['id_department'];
				$dname= $_POST['dname'];
				$dcode= $_POST['dcode'];
				
				$data_update= array (
					'DEPARTMENT_NAME'=> $dname,
					'CODE_DEPARTMENT'=> $dcode
				);
				$where=array('ID_DEPARTMENT'=> $id_department);
				$res= $this->tbl_department->Update('departement',$data_update,$where);
				if($res>=1)
				{
					redirect('master/department');
				}
				break;
			case 'upstat_dept':
				$aDoor = $_POST['checklist'];
				if(!empty($aDoor)) {
					$N = count($aDoor);

					for($i=0; $i < $N; $i++){
						echo $aDoor[$i];
						$data_updatestat= array (
						'STATUS_DEPARTMENT'=> '2');
						$where= array('ID_DEPARTMENT'=>$aDoor[$i]);
						$res= $this->tbl_department->Update('departement',$data_updatestat,$where);
					}
				} 
				break;
			default:
				redirect('master/department');
				break;
		}
	}

	public function segment()
	{
		$data['data']	= $this->tbl_segment->GetSegt("and (segment.STATUS_SEGMENT != 2 OR segment.STATUS_SEGMENT is NULL)");
		$this->load->view('master/segment',$data);
	}

	public function segment_act($act,$id_segment='',$id_department='')
	{
		switch ($act) {
			case 'tambah':
				$data['data'] 	= $this->tbl_department->dept_active();
				$this->load->view('master/segment_add',$data);
				break;
			case 'simpan':
				$id 			= $this->m_security->gen_id('segment','ID_SEGMENT');
				$sname 			= $_POST['sname'];
				$scode 			= $_POST['scode'];
				$department_id 	= $_POST['department_id'];
				$data_insert 	= array (
					'ID_SEGMENT' 	=> $id,
					'SEGMENT_NAME' 	=> $sname,
					'CODE_SEGMENT' 	=> $scode,
					'STATUS_SEGMENT' 	=> 0,
					'ID_DEPARTMENT' => $department_id,
				);
				$res= $this->tbl_segment->InsertSegt('segment',$data_insert);
				if($res>=1)
				{
					redirect('master/segment');
				}				
				break;
			case 'edit':
				$segt= $this->tbl_segment->GetSegt("AND id_segment='$id_segment'");
				$dept= $this->tbl_department->GetDept();
				
				$this->load->view('master/segment_edit',array('data1' => $segt, 'data2' => $dept, 'data' => $id_department));
				break;
			case 'update':
				$id_segment 	= $_POST['id_segment'];
				$segment_name 	= $_POST['segment_name'];
				$code_segment 	= $_POST['code_segment'];
				$department_id 	= $_POST['department_name'];

				$data_update= array (
				'SEGMENT_NAME'	=> $segment_name,
				"CODE_SEGMENT" 	=> $code_segment,
				"ID_DEPARTMENT" => $department_id
				);
				$where=array('ID_SEGMENT'=> $id_segment);
				$res= $this->tbl_segment->UpdateSegt('segment',$data_update,$where);
				if($res>=1)
				{
					redirect('master/segment');
				}				
				break;
			case 'upstat_segt':
				print_r($_POST);
		
				$aDoor = $_POST['checklist'];
				if(!empty($aDoor)) {
					$N = count($aDoor);

					for($i=0; $i < $N; $i++){
						echo $aDoor[$i];
						$data_updatestat= array (
						'STATUS_SEGMENT'=> '2');
						$where= array('ID_SEGMENT'=>$aDoor[$i]);
						$res= $this->tbl_segment->UpdateSegt('segment',$data_updatestat,$where);
					}
				} 
				break;		
			default:
				redirect('master/segment');
				break;
		}
	}

	public function group()
	{
		$data['data'] 	= $this->tbl_group->GetGroup("and (m_group.STATUS_GROUP != 2 OR m_group.STATUS_GROUP is NULL)");
		$this->load->view('master/group',$data);
	}

	public function group_act($act,$id='',$id_segment='')
	{
		switch ($act) {
			case 'tambah':
				$data['data1'] = $this->tbl_segment->GetSegt('AND STATUS_SEGMENT = 0');
				$this->load->view('master/group_add',$data);
				break;
			case 'simpan':
				$id 		= $this->m_security->gen_id('m_group','ID_GROUP');
				$gname 		= $_POST['gname'];
				$gcode 		= $_POST['gcode'];
				$segment_id = $_POST['segment_id'];
				$data_insert= array (
					'ID_GROUP'=> $id,
					'GROUP_NAME'=> $gname,
					'CODE_GROUP'=> $gcode,
					'ID_SEGMENT'=> $segment_id,
				);
				$res= $this->tbl_group->InsertGroup('m_group',$data_insert);
				if($res>=1)
				{
					redirect('master/group');
				}
				break;
			case 'edit':
				$data['data1']	= $this->tbl_group->GetGroup("AND ID_GROUP='$id'");
				$data['data2'] 	= $this->tbl_segment->GetSegt();
				$data['data']	= $id_segment;
				$this->load->view('master/group_edit',$data);
				break;
			case 'update':
				$id_group 		= $_POST['id_group'];
				$group_name 	= $_POST['group_name'];
				$code_group 	= $_POST['code_group'];
				$segment_id 	= $_POST['segment'];
				$data_update 	= array (
					'GROUP_NAME'=> $group_name,
					'CODE_GROUP'=> $code_group,
					'ID_SEGMENT'=> $segment_id,
				);
				$where=array('ID_GROUP'=> $id_group);
				$res= $this->tbl_group->UpdateGroup('m_group',$data_update,$where);
				if($res>=1)
				{
					redirect('master/group');
				}
				break;
			case 'upstat_group':
				print_r($_POST);
				$aDoor = $_POST['checklist'];
				if(!empty($aDoor)) {
					$N = count($aDoor);
					for($i=0; $i < $N; $i++){
						echo $aDoor[$i];
						$data_updatestat= array (
						'STATUS_GROUP'=> '2');
						$where= array('ID_GROUP'=>$aDoor[$i]);
						$res= $this->tbl_group->UpdateGroup('m_group',$data_updatestat,$where);
					}
				}		
				break;
			default:
				redirect('master/group');
				break;
		}
	}

	public function joblist()
	{
		$data['data'] = $this->tbl_jobtitle->GetJob('where segment.ID_DEPARTMENT = departement.ID_DEPARTMENT AND segment.ID_SEGMENT = job_title.ID_SEGMENT AND segment.ID_SEGMENT = job_title.ID_SEGMENT AND (job_title.STATUS_JOB != 2 OR job_title.STATUS_JOB is NULL)');
		$this->load->view('master/joblist',$data);
	}

	public function joblist_act($act,$id='')
	{
		switch ($act) {
			case 'tambah':
				$data['data'] = $this->tbl_department->dept_active();
				$this->load->view('master/joblist_add',$data);
				break;
			case 'simpan':
				$id 		= $this->m_security->gen_id('job_title','ID_JOBTITLE');
				$jtitle 	= $_POST['jtitle'];
				$dep_id 	= $_POST['department_id'];
				$seg_id 	= $_POST['sname'];
				$code 		= $_POST['code'];
				$grade 		= $_POST['grade'];

				$flexi 		= 0;
				$sektoral 	= 0;
				$shift 		= 0;
				if(isset($_POST['flexi']))
					$flexi= $_POST['flexi'];
				if(isset($_POST['sektoral']))
					$sektoral= $_POST['sektoral'];
				if(isset($_POST['shift']))
					$shift= $_POST['shift'];

				$data_insert= array (
					'ID_JOBTITLE' 		=> $id,
					'TITLE' 			=> $jtitle,
					'ID_SEGMENT' 		=> $seg_id,
					'GRADE' 			=> $grade,
					'GET_FLEXI_JOB' 	=> $flexi,
					'GET_SECTORAL_JOB' 	=> $sektoral,
					'GET_SHIFT_JOB' 	=> $shift,
					'CODE_JOBTITLE' 	=> $code,
					'STATUS_JOB' 		=> 0
				);

				$res 	= $this->tbl_jobtitle->InsertJob('job_title',$data_insert);
				if($res>=1)
				{
					redirect('master/joblist');
				}			
				break;
			case 'edit':
				$data['data1']	= $this->tbl_jobtitle->GetJob("where segment.ID_DEPARTMENT = departement.ID_DEPARTMENT AND segment.ID_SEGMENT = job_title.ID_SEGMENT AND segment.ID_SEGMENT = job_title.ID_SEGMENT AND ID_JOBTITLE='$id'");
				$data['data2']	= $this->tbl_department->GetDept();
				$data['data3']	= $this->tbl_segment->GetSegt();
				$data['data4']	= $id;
				
				$this->load->view('master/joblist_edit',$data);			
				break;
			case 'update':
				$id_jobtitle 	= $_POST['id_jobtitle'];
				$code_jobtitle 	= $_POST['code'];
				$title 			= $_POST['jtitle'];
				$department 	= $_POST['department_id'];
				$segment 		= $_POST['sname'];
				$grade 			= $_POST['grade'];
				
				$flexi 			= 0;
				$sektoral 		= 0;
				$shift 			= 0;
				if(isset($_POST['flexi']))
					$flexi= $_POST['flexi'];
				if(isset($_POST['sektoral']))
					$sektoral= $_POST['sektoral'];
				if(isset($_POST['shift']))
					$shift= $_POST['shift'];
				
				$data_update= array (
					"TITLE"				=> $title,
					"CODE_JOBTITLE" 	=> $code_jobtitle,
					"ID_SEGMENT" 		=> $segment,
					'GRADE'				=> $grade,
					"GET_FLEXI_JOB" 	=> $flexi,
					'GET_SECTORAL_JOB'	=> $sektoral,
					"GET_SHIFT_JOB" 	=> $shift
				);

				$where 	= array('ID_JOBTITLE'=> $id_jobtitle);
				$res 	= $this->tbl_jobtitle->UpdateJob('job_title',$data_update,$where);
				if($res>=1)
				{
					redirect('master/joblist');
				}		
				break;
			case 'get_segment':
				$sid= $_POST['sid'];;
				$data = $this->tbl_segment->GetSegt("AND segment.ID_DEPARTMENT = '$sid' AND segment.STATUS_SEGMENT = 0");
				
				$arr = array();
				foreach ($data as $d) {
					$arr[] = $d;
		        }
				
				print json_encode($arr);				
				break;
			case 'upstat_job':
				print_r($_POST);
				$aDoor = $_POST['checklist'];
				if(!empty($aDoor)) {
					$N = count($aDoor);

					for($i=0; $i < $N; $i++){
						echo $aDoor[$i];
						$data_updatestat= array (
						'STATUS_JOB'=> '2');
						$where= array('ID_JOBTITLE'=>$aDoor[$i]);
						$res= $this->tbl_jobtitle->UpdateJob('job_title',$data_updatestat,$where);
					}
				}
				break;
			default:
				redirect('master/joblist');
				break;
		}
	}
}

