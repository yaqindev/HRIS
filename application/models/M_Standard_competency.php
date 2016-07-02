<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
* Source table : "standard_unit_competency"
*/
class M_Standard_competency extends CI_Model {

	public function get_all()
	{
		return $this->db->get('standard_unit_competency')->result();
	}

	public function get_id(array $cond)
	{
		return $this->db->get_where('standard_unit_competency',$cond,1)->result();
	}

	public function join_full(array $cond = null)
	{
		$this->db->select('*');
		$this->db->from('standard_unit_competency');
		$this->db->join('unit_competency','unit_competency.ID_UNIT_COMPETENCY = standard_unit_competency.ID_UNIT_COMPETENCY');
		$this->db->join('job_title','standard_unit_competency.ID_JOBTITLE = job_title.ID_JOBTITLE');
		$this->db->join('kra','kra.ID_KRA = unit_competency.ID_KRA');
		if (count($cond) > 0)
			$this->db->where($cond);
		return $this->db->get()->result();
	}

	public function insert($data)
	{
		return $this->db->insert('standard_unit_competency',$data);
	}

	function Update($tabelName,$data,$where)
	{
		return $this->db->update($tabelName,$data,$where);
	}

	function delete(array $cond)
	{
		return $this->db->delete('standard_unit_competency',$cond);
	}
}