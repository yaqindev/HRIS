<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
* Source table : "performance_appraisal_detail"
*/
class M_Performance_appraisal_detail extends CI_Model {

	public function get_all()
	{
		return $this->db->get('performance_appraisal_detail')->result();
	}

	public function get_id($id)
	{
		return $this->db->get_where('performance_appraisal_detail',array('ID_PA_DETAIL'=>$id),1)->result();
	}
	
	public function add(array $data)
	{
		return $this->db->insert('performance_appraisal_detail',$data);
	}

	public function Update(array $data,array $where)
	{
		return $this->db->update('performance_appraisal_detail',$data,$where);
	}

	public function join_full(array $cond = NULL)
	{
		$this->db->select('*');
		$this->db->from('performance_appraisal_detail');
		$this->db->join('employee','performance_appraisal_detail.ID_EMPLOYEE = employee.ID_EMPLOYEE');
		$this->db->join('year','performance_appraisal_detail.NAME_YEAR = `year`.NAME_YEAR');
		$this->db->join('periode','performance_appraisal_detail.ID_PERIODE = periode.ID_PERIODE');
		if (count($cond) > 0)
			$this->db->where($cond);
		return $this->db->get()->result();
	}

	public function avg_dept(array $cond = NULL,$dept,$alias)
	{
		$this->db->select_avg($dept,$alias);
		$this->db->select('departement.DEPARTMENT_NAME');
		$this->db->from('performance_appraisal_detail');
		$this->db->join('employee','performance_appraisal_detail.ID_EMPLOYEE = employee.ID_EMPLOYEE');
		$this->db->join('departement','departement.ID_DEPARTMENT = employee.ID_DEPARTMENT');
		if (count($cond) > 0)
			$this->db->where($cond);
		$this->db->group_by('employee.ID_DEPARTMENT');
		return $this->db->get()->result();
	}
	
	public function avg_seg(array $cond = NULL,$dept,$alias)
	{
		$this->db->select_avg($dept,$alias);
		$this->db->select('segment.SEGMENT_NAME');
		$this->db->from('performance_appraisal_detail');
		$this->db->join('employee','performance_appraisal_detail.ID_EMPLOYEE = employee.ID_EMPLOYEE');
		$this->db->join('job_title','job_title.ID_JOBTITLE = employee.ID_JOBTITLE');
		$this->db->join('segment','segment.ID_SEGMENT = job_title.ID_SEGMENT');
		if (count($cond) > 0)
			$this->db->where($cond);
		$this->db->group_by('job_title.ID_SEGMENT');
		return $this->db->get()->result();	
	}

	public function avg_dept_all(array $cond = NULL)
	{
		$this->db->select_avg('performance_appraisal_detail.TOTAL_KPI','KPI');
		$this->db->select_avg('performance_appraisal_detail.TOTAL_COMPETENCY','COMPETENCY');
		$this->db->select_avg('performance_appraisal_detail.TOTAL_ZAP','ZAP');
		$this->db->select_avg('performance_appraisal_detail.TOTAL_DICIPLINARY','DISCIPLINARY');
		$this->db->select('departement.DEPARTMENT_NAME');
		$this->db->from('performance_appraisal_detail');
		$this->db->join('employee','performance_appraisal_detail.ID_EMPLOYEE = employee.ID_EMPLOYEE');
		$this->db->join('departement','departement.ID_DEPARTMENT = employee.ID_DEPARTMENT');
		if (count($cond) > 0)
			$this->db->where($cond);
		$this->db->group_by('employee.ID_DEPARTMENT');
		return $this->db->get()->result();	
	}

	public function avg_seg_all(array $cond = NULL)
	{
		$this->db->select_avg('performance_appraisal_detail.TOTAL_KPI','KPI');
		$this->db->select_avg('performance_appraisal_detail.TOTAL_COMPETENCY','COMPETENCY');
		$this->db->select_avg('performance_appraisal_detail.TOTAL_ZAP','ZAP');
		$this->db->select_avg('performance_appraisal_detail.TOTAL_DICIPLINARY','DISCIPLINARY');
		$this->db->select('segment.SEGMENT_NAME');
		$this->db->from('performance_appraisal_detail');
		$this->db->join('employee','performance_appraisal_detail.ID_EMPLOYEE = employee.ID_EMPLOYEE');
		$this->db->join('job_title','job_title.ID_JOBTITLE = employee.ID_JOBTITLE');
		$this->db->join('segment','segment.ID_SEGMENT = job_title.ID_SEGMENT');
		if (count($cond) > 0)
			$this->db->where($cond);
		$this->db->group_by('job_title.ID_SEGMENT');
		return $this->db->get()->result();	
	}
}