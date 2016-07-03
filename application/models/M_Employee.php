<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
* Source table : "employee"
*/
class M_Employee extends CI_Model {

	public function get_all()
	{
		return $this->db->get('employee')->result();
	}

	public function join_dept_personal(array $cond = null)
	{
		$this->db->select('*');
		$this->db->from('employee');
		$this->db->join('departement','departement.ID_DEPARTMENT = employee.ID_DEPARTMENT');
		$this->db->join('employee_personal_detail','employee_personal_detail.ID_EMPLOYEE = employee.ID_EMPLOYEE');
		if (count($cond) > 0)
			$this->db->where($cond);
		$this->db->where('employee.ACTIVE_STATUS','1');
		return $this->db->get()->result();
	}

	public function join_all()
	{
		$this->db->select('*');
		$this->db->from('employee');
		$this->db->join('employee_personal_detail','employee.ID_EMPLOYEE = employee_personal_detail.ID_EMPLOYEE');
		$this->db->join('departement','departement.ID_DEPARTMENT = employee.ID_DEPARTMENT');
		$this->db->join('job_title','job_title.ID_JOBTITLE = employee.ID_JOBTITLE');
		$this->db->where('employee.ACTIVE_STATUS','1');
		return $this->db->get()->result();
	}

	public function join_all_kar()
	{
		$this->db->select('*');
		$this->db->from('employee');
		$this->db->join('employee_personal_detail','employee.ID_EMPLOYEE = employee_personal_detail.ID_EMPLOYEE');
		$this->db->join('departement','departement.ID_DEPARTMENT = employee.ID_DEPARTMENT');
		$this->db->join('job_title','job_title.ID_JOBTITLE = employee.ID_JOBTITLE');
		return $this->db->get()->result();
	}

	public function join_full(array $cond)
	{
		$this->db->select('*');
		$this->db->from('employee');
		$this->db->join('employee_personal_detail','employee.ID_EMPLOYEE = employee_personal_detail.ID_EMPLOYEE');
		$this->db->join('departement','departement.ID_DEPARTMENT = employee.ID_DEPARTMENT');
		$this->db->join('job_title','job_title.ID_JOBTITLE = employee.ID_JOBTITLE');
		if (count($cond) > 0)
			$this->db->where($cond);
		
		$this->db->where('employee.ACTIVE_STATUS','1');
		return $this->db->get()->result();
	}

	public function add(array $data)
	{
		$this->db->insert('employee',$data);
	}
	
	public function Update(array $data,array $where)
	{
		return $this->db->update('employee',$data,$where);
		
	}
	

}