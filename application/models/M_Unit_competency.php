<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
* Source table : "unit_competency"
*/
class M_Unit_competency extends CI_Model {

	public function get_all()
	{
		return $this->db->get('unit_competency')->result();
	}

	public function get_id($id)
	{
		return $this->db->get_where('unit_competency',array('unit_competency.ID_UNIT_COMPETENCY'=>$id),1)->result();
	}

	public function join_kra(array $cond)
	{
		$this->db->select('*');
		$this->db->from('unit_competency');
		$this->db->join('kra','kra.ID_KRA = unit_competency.ID_KRA');
		if (count($cond) > 0)
			$this->db->where($cond);
		return $this->db->get()->result();
	}

	public function join_full(array $cond=null)
	{
		$this->db->select('*');
		$this->db->from('unit_competency');
		$this->db->join('kra','kra.ID_KRA = unit_competency.ID_KRA');
		$this->db->order_by('kra.JENIS_COMPETENCY','ASC');
		$this->db->order_by('kra.ID_KRA','ASC');
		$this->db->order_by('ID_UNIT_COMPETENCY','ASC');
		if (count($cond) > 0)
			$this->db->where($cond);
		return $this->db->get()->result();
	}

	public function insert($data)
	{
		return $this->db->insert('unit_competency',$data);
	}

	function Update($tabelName,$data,$where)
	{
		return $this->db->update($tabelName,$data,$where);
	}

	function delete($id)
	{
		return $this->db->delete('unit_competency',array('ID_UNIT_COMPETENCY'=>$id));
	}

	
}