<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
* Source table : "kpi"
*/
class M_Kpi extends CI_Model {

	public function get_all()
	{
		return $this->db->get('kpi')->result();
	}

	public function get_id($id)
	{
		return $this->db->get_where('kpi',array('kpi.ID_KPI'=>$id),1)->result();
	}

	public function join_department(array $cond = null)
	{
		$this->db->select('*');
		$this->db->from('kpi');
		$this->db->join('departement','kpi.ID_DEPARTMENT = departement.ID_DEPARTMENT');
		if (count($cond) > 0)
			$this->db->where($cond);
		return $this->db->get()->result();
	}

	public function get_by_department($id_department)
	{
		$this->db->select('*');
		$this->db->from('kpi');
		$this->db->join('departement','kpi.ID_DEPARTMENT = departement.ID_DEPARTMENT');
		$this->db->where('performance_m_kpi.department_id',$id_department);
		return $this->db->get()->result();
	}

	public function get_sum_weight($id_department)
	{
		$this->db->select_sum('WEIGHT','jumlah_total');
		$this->db->from('kpi');
		$this->db->where('ID_DEPARTMENT',$id_department);
		return $this->db->get()->result();
	}

	public function insert($data)
	{
		return $this->db->insert('kpi',$data);
	}

	function Update($tabelName,$data,$where)
	{
		return $this->db->update($tabelName,$data,$where);
		
	}

	function remove($id)
	{
		return $this->db->delete('kpi',array('ID_KPI'=>$id));
	}
	

}