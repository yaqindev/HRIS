<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
* Source table : "year"
*/
class M_Year extends CI_Model {

	public function get_all()
	{
		$this->db->select('*');
		$this->db->from('year');
		$this->db->order_by('NAME_YEAR','DESC');
		return $this->db->get()->result();
	}

}