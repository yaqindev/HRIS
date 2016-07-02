<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
* Source table : "kpi_monitoring"
*/
class M_Personal_detail extends CI_Model {

	public function get_all()
	{
		return $this->db->get('employee_personal_detail')->result();
	}

	public function get_id($id)
	{
		return $this->db->get_where('employee_personal_detail',array('ID_DETAIL'=>$id),1)->result();
	}

	public function add(array $data)
	{
		return $this->db->insert('employee_personal_detail',$data);
	}

	public function Update(array $data,array $where)
	{
		return $this->db->update('employee_personal_detail',$data,$where);
		
	}
	
	public function join_full(array $cond = NULL)
	{
		$this->db->select('*');
		$this->db->from('employee_personal_detail');
		$this->db->join('employee','employee.ID_EMPLOYEE = employee_personal_detail.ID_EMPLOYEE');
		if (count($cond) > 0)
			$this->db->where($cond);
		return $this->db->get()->result();
	}

}