<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
* Source table : "disciplinary_evaluation"
*/
class M_Disciplinary_evaluation extends CI_Model {

	public function get_all()
	{
		return $this->db->get('disciplinary_evaluation')->result();
	}

	public function get_id($id)
	{
		return $this->db->get_where('disciplinary_evaluation',array('ID_DISCIPLINARY_EVALUATION'=>$id),1)->result();
	}

	public function add(array $data)
	{
		return $this->db->insert('disciplinary_evaluation',$data);
	}

	public function Update(array $data,array $where)
	{
		return $this->db->update('disciplinary_evaluation',$data,$where);
		
	}

	public function join_full(array $cond = NULL)
	{
		$this->db->select('*');
		$this->db->from('disciplinary_evaluation');
		$this->db->join('periode','periode.ID_PERIODE = disciplinary_evaluation.ID_PERIODE');
		$this->db->join('employee','employee.ID_EMPLOYEE = disciplinary_evaluation.ID_EMPLOYEE');
		if (count($cond) > 0)
			$this->db->where($cond);
		return $this->db->get()->result();
	}

	// public function get_bulan($id_employee,$name_year,$periode)
	// {
	// 	if ($periode == 1) {
	// 		$query_bulan = ' AND BULAN_DISCIPLINARY > 0 AND BULAN_DISCIPLINARY < 7';
	// 	}else{
	// 		$query_bulan = ' AND BULAN_DISCIPLINARY > 6 AND BULAN_DISCIPLINARY < 13';
	// 	}
	// 	return $this->db->query('
	// 			SELECT
	// 				DISTINCT BULAN_DISCIPLINARY AS BULAN
	// 			FROM disciplinary_monitoring
	// 			WHERE 
	// 				ID_EMPLOYEE = '.$id_employee.' AND
	// 				NAME_YEAR = '.$name_year.'
	// 				'.$query_bulan.'
	// 			ORDER BY BULAN_DISCIPLINARY ASC
	// 		')->result();
	// }
	

}