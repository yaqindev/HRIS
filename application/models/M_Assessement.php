<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
* Source table : "assessement_competency"
*/
class M_Assessement extends CI_Model {

	public function get_all()
	{
		return $this->db->get('assessement_competency')->result();
	}

	public function get_id(array $cond)
	{
		return $this->db->get_where('assessement_competency',$cond,1)->result();
	}

	// public function join(array $cond)
	// {
	// 	$this->db->select('*');
	// 	$this->db->from('assessement_competency');
	// 	// $this->db->join('kpi','kpi_monitoring.ID_KPI = kpi.ID_KPI');
	// 	if (count($cond) > 0)
	// 		$this->db->where($cond);
	// 	return $this->db->get()->result();
	// }

	public function add(array $data)
	{
		return $this->db->insert('assessement_competency',$data);
	}

	public function Update(array $data,array $where)
	{
		return $this->db->update('assessement_competency',$data,$where);
	}

	public function total_result(array $cond)
	{
		$this->db->select_sum('RESULT_ASSESSMENT','TOTAL_RESULT');
		$this->db->from('assessement_competency');
		if (count($cond) > 0)
			$this->db->where($cond);
		$hasil = $this->db->get()->result();
		if ($hasil[0]->TOTAL_RESULT != null) {
			return $hasil[0]->TOTAL_RESULT;
		}else{
			return 0;
		}
	}	

}