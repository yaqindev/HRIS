<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
* Source table : "user"
*/
class M_user extends CI_Model {

	public function get_all()
	{
		return $this->db->get('user')->result();
	}

	public function get_id($id)
	{
		$this->db->select('*');
		$this->db->from('user');
		$this->db->join('employee','user.ID_EMPLOYEE = employee.ID_EMPLOYEE');
		$this->db->join('employee_personal_detail','employee_personal_detail.ID_EMPLOYEE = employee.ID_EMPLOYEE');
		$this->db->where('user.ID_USER',$id);
		return $this->db->get()->result();
	}

	public function join_full(array $cond)
	{
		$this->db->select('*');
		$this->db->from('user');
		$this->db->join('employee','user.ID_EMPLOYEE = employee.ID_EMPLOYEE');
		$this->db->join('employee_personal_detail','employee_personal_detail.ID_EMPLOYEE = employee.ID_EMPLOYEE');
		if(count($cond) > 0)
			$this->db->where($cond);
		return $this->db->get()->result();	
	}

	public function auth($user,$pass)
	{
		return $this->db->get_where(
			'user',
			array(
				'EMAIL_USER' => $user,
				'PASSWORD' => md5($pass)
			),
			1
		)->result();
	}

	public function add(array $data)
	{
		return $this->db->insert('user',$data);
	}

	public function update(array $data,array $where)
	{
		return $this->db->update('user',$data,$where);
	}

	public function remove(array $where)
	{
		return $this->db->delete('user',$where);
	}
}