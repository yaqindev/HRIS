<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
* Source table : "group"
*/
class M_Jobtitle extends CI_Model {

	public function get_all()
	{
		return $this->db->get('job_title')->result();
	}

	public function get_id($id){
		return $this->db->get_where('job_title',array('ID_JOBTITLE'=>$id),1)->result();
	}

	public function GetJob($where="")
	{
		$data= $this->db->query('select * from job_title , departement , segment '.$where);
		return $data->result_array();
	}

	public	function UpdateJob($tabelName,$data,$where)
	{
		return $this->db->update($tabelName,$data,$where);
	}

	public	function InsertJob($tabelName,$data)
	{
		return $this->db->insert($tabelName,$data);
	}

	public function join_segment(array $cond)
	{
		$this->db->select('*');
		$this->db->from('job_title');
		$this->db->join('segment','job_title.ID_SEGMENT = segment.ID_SEGMENT');
		if (count($cond))
			$this->db->where($cond);
		return $this->db->get()->result();		
	}

	public function join_segment_departement(array $cond)
	{
		$this->db->select('*');
		$this->db->from('job_title');
		$this->db->join('segment','job_title.ID_SEGMENT = segment.ID_SEGMENT');
		$this->db->join('departement','departement.ID_DEPARTMENT = segment.ID_DEPARTMENT');
		if (count($cond))
			$this->db->where($cond);
		return $this->db->get()->result();
	}

	public function get_manager()
	{
		$this->db->select('*');
		$this->db->from('job_title');
		$this->db->like('TITLE','manager','before');
		$this->db->where('STATUS_JOB','0');
		return $this->db->get()->result();		
	}

}