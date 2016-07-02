<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
* Source table : "performance_appraisal_detail"
*/
class M_Performance_appraisal extends CI_Model {

	public function get_all()
	{
		return $this->db->get('performance_appraisal')->result();
	}

	public function get_id($id)
	{
		return $this->db->get_where('performance_appraisal',array('ID_PERFORMANCE_APPRAISAL'=>$id),1)->result();
	}
	
	public function add(array $data)
	{
		return $this->db->insert('performance_appraisal',$data);
	}

	public function Update(array $data,array $where)
	{
		return $this->db->update('performance_appraisal',$data,$where);
		
	}

	public function join_full(array $cond = NULL)
	{
		$this->db->select('*');
		$this->db->from('performance_appraisal');
		$this->db->join('employee','employee.ID_EMPLOYEE = performance_appraisal.ID_EMPLOYEE');
		$this->db->join('performance_appraisal_detail','performance_appraisal_detail.ID_PA_DETAIL = performance_appraisal.ID_PA_DETAIL');
		$this->db->join('periode','periode.ID_PERIODE = performance_appraisal.ID_PERIODE');
		if (count($cond) > 0)
			$this->db->where($cond);
		return $this->db->get()->result();
	}
}