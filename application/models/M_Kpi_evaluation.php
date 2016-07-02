<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
* Source table : "kpi_evaluation"
*/
class M_Kpi_evaluation extends CI_Model {

	public function get_all()
	{
		return $this->db->get('kpi_evaluation')->result();
	}

	public function get_id($id)
	{
		return $this->db->get_where('kpi_evaluation',array('ID_KPI_EVALUATION'=>$id),1)->result();
	}

	public function actual_periode(array $cond)
	{
		$this->db->select('*');
		$this->db->from('kpi_evaluation');
		$this->db->join('kpi','kpi.ID_KPI = kpi_evaluation.ID_KPI');
		if (count($cond) > 0)
			$this->db->where($cond);
		return $this->db->get()->result();
	}

	public function add(array $data)
	{
		return $this->db->insert('kpi_evaluation',$data);
	}

	public function Update(array $data,array $where)
	{
		return $this->db->update('kpi_evaluation',$data,$where);
		
	}
}