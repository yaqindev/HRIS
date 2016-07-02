<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
* Source table : "kra"
*/
class M_Kra extends CI_Model {

	public function get_all()
	{
		return $this->db->get('kra')->result();
	}

	public function get_id($id)
	{
		return $this->db->get_where('kra',array('kra.ID_KRA'=>$id),1)->result();
	}

	public function join_unit_competency(array $cond)
	{
		$this->db->select('*');
		$this->db->from('kra');
		$this->db->join('unit_competency','unit_competency.ID_KRA = kra.ID_KRA');
		if (count($cond) > 0)
			$this->db->where($cond);
		return $this->db->get()->result();
	}

	public function insert($data)
	{
		return $this->db->insert('kra',$data);
	}

	function Update($tabelName,$data,$where)
	{
		return $this->db->update($tabelName,$data,$where);
	}

	function delete($id)
	{
		return $this->db->delete('kra',array('ID_KRA'=>$id));
	}
	

}