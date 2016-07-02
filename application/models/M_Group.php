<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
* Source table : "m_group"
*/
class M_Group extends CI_Model {

	public function get_all()
	{
		return $this->db->get('m_group')->result();
	}

	public	function GetGroup($where="")
	{
		$data= $this->db->query('select * from m_group , segment where m_group.ID_SEGMENT = segment.ID_SEGMENT '.$where);
		return $data->result_array();
	}

	public	function InsertGroup($tabelName,$data)
	{
		return $this->db->insert($tabelName,$data);
	}

	public	function UpdateGroup($tabelName,$data,$where)
	{
		return $this->db->update($tabelName,$data,$where);
	}

}