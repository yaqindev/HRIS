<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
* Source table : "performance_m_kpi"
*/
class M_Segment extends CI_Model {

	public function get_by_department($id_department)
	{
		$this->db->select('*');
		$this->db->from('segment');
		$this->db->where('ID_DEPARTMENT',$id_department);
		return $this->db->get()->result();
	}

	public function get_id($id){
		return $this->db->get_where('segment',array('ID_SEGMENT'=>$id),1)->result();
	}

	public function get_all()
	{
		return $this->db->get('segment')->result();
	}

	function GetSegt($where="")
	{
		return $this->db->query('select * from segment , departement where segment.ID_DEPARTMENT = departement.ID_DEPARTMENT '.$where)->result_array();
	}

	function UpdateSegt($tabelName,$data,$where)
	{
		return $this->db->update($tabelName,$data,$where);
	}

	function InsertSegt($tabelName,$data)
	{
		return $this->db->insert($tabelName,$data);
	}

}