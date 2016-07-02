<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
* Source table : "zap"
*/
class M_Zap extends CI_Model {

	public function get_all()
	{
		return $this->db->get('zap')->result();
	}

	public function get_id($id)
	{
		return $this->db->get_where('zap',array('ID_ZAP'=>$id),1)->result();
	}

	public function join_full(array $cond = NULL)
	{
		$this->db->select('*');
		$this->db->from('zap');
		$this->db->join('employee','employee.ID_EMPLOYEE = zap.ID_EMPLOYEE');
		$this->db->join('departement','departement.ID_DEPARTMENT = zap.ID_DEPARTMENT');
		if (count($cond) > 0)
			$this->db->where($cond);
		return $this->db->get()->result();
	}

	public function add(array $data)
	{
		return $this->db->insert('zap',$data);
	}

	public function Update(array $data,array $where)
	{
		return $this->db->update('zap',$data,$where);
		
	}
	

}