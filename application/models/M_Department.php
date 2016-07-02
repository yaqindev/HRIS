<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
* Source table : "performance_m_kpi"
*/
class M_department extends CI_Model {

	public function get_id($id)
	{
		return $this->db->get_where('departement',array('ID_DEPARTMENT'=>$id),1)->result();
	}

	public function get_all()
	{
		return $this->db->get('departement')->result();
	}

	public function dept_active()
	{
		return $this->db->get_where('departement',array('departement.STATUS_DEPARTMENT'=>0))->result();
	}

	public function GetDept($where="")
	{
		$data= $this->db->query('select * from departement '.$where);
		return $data->result_array();
	}

	public function InsertDept($tabelName,$data)
	{
		return $this->db->insert($tabelName,$data);
	}

	public function UpdateEmployee($tabelName,$data,$where)
	{
		return $this->db->update($tabelName,$data,$where);
	}
	function Update($tabelName,$data,$where)
	{
		return $this->db->update($tabelName,$data,$where);
	}

}