<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
* Source table : "disciplinary"
*/
class M_Disciplinary extends CI_Model {

	public function get_all()
	{
		return $this->db->get('disciplinary')->result();
	}

	public function get_id($id)
	{
		return $this->db->get_where('disciplinary',array('ID_DISCIPLINARY'=>$id),1)->result();
	}

	public function add(array $data)
	{
		return $this->db->insert('disciplinary',$data);
	}

	public function Update(array $data,array $where)
	{
		return $this->db->update('disciplinary',$data,$where);
		
	}
	
	// public function actual_bulanan(array $cond)
	// {
	// 	$this->db->select('*');
	// 	$this->db->from('disciplinary');
	// 	$this->db->join('kpi','kpi_monitoring.ID_KPI = kpi.ID_KPI');
	// 	if (count($cond) > 0)
	// 		$this->db->where($cond);
	// 	return $this->db->get()->result();
	// }

}